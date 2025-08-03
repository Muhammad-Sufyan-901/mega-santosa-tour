<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with('service');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('whatsapp_number', 'like', '%' . $request->search . '%');
            });
        }

        // Status filter
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(10);

        $viewData = [
            'title' => 'Pesanan',
            'activePage' => 'Pesanan',
            'orders' => $orders,
        ];

        return view('admin.orders.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('status', 'active')->get();

        $viewData = [
            'title' => 'Tambah Pesanan',
            'activePage' => 'Pesanan',
            'services' => $services,
        ];

        return view('admin.orders.add', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateOrder($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $data = $request->only([
                'service_id',
                'name',
                'email',
                'whatsapp_number',
                'number_of_participants',
                'pickup_location',
                'start_date',
                'end_date',
                'message',
                'status'
            ]);

            $data['status'] = $request->status ?? 'pending';

            Order::create($data);

            return redirect()
                ->route('admin.orders.index')
                ->with('success', 'Pesanan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with('service')->findOrFail($id);

        $viewData = [
            'title' => 'Detail Pesanan',
            'activePage' => 'Pesanan',
            'order' => $order,
        ];

        return view('admin.orders.detail', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $services = Service::where('status', 'active')->get();

        $viewData = [
            'title' => 'Edit Pesanan',
            'activePage' => 'Pesanan',
            'order' => $order,
            'services' => $services,
        ];

        return view('admin.orders.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateOrder($request, $id);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $order = Order::findOrFail($id);

            $data = $request->only([
                'service_id',
                'name',
                'email',
                'whatsapp_number',
                'number_of_participants',
                'pickup_location',
                'start_date',
                'end_date',
                'message',
                'status'
            ]);

            $order->update($data);

            return redirect()
                ->route('admin.orders.index')
                ->with('success', 'Pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating order: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()
                ->route('admin.orders.index')
                ->with('success', 'Pesanan berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return redirect()
                ->route('admin.orders.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    /**
     * Update order status - ENHANCED WITH DEBUGGING
     */
    public function updateStatus(Request $request, $id)
    {
        // Log the incoming request
        Log::info('Update status request received', [
            'order_id' => $id,
            'request_data' => $request->all(),
            'headers' => $request->headers->all()
        ]);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed for update status', [
                'order_id' => $id,
                'errors' => $validator->errors()->toArray()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Status tidak valid.',
                'errors' => $validator->errors()
            ], 400);
        }

        try {
            // Find the order
            $order = Order::findOrFail($id);
            Log::info('Order found', ['order_id' => $id, 'current_status' => $order->status]);

            // Update the status
            $oldStatus = $order->status;
            $order->update(['status' => $request->status]);

            Log::info('Order status updated successfully', [
                'order_id' => $id,
                'old_status' => $oldStatus,
                'new_status' => $order->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status pesanan berhasil diperbarui.',
                'data' => [
                    'id' => $order->id,
                    'status' => $order->status,
                    'status_text' => $this->getStatusText($order->status),
                    'old_status' => $oldStatus
                ]
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            Log::error('Order not found for status update', ['order_id' => $id]);

            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        } catch (\Exception $e) {
            Log::error('Error updating order status', [
                'order_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get order data for AJAX
     */
    public function getOrderAJAX($id)
    {
        try {
            $order = Order::with('service')->findOrFail($id);

            // Format data for frontend
            $orderData = [
                'id' => $order->id,
                'service_id' => $order->service_id,
                'name' => $order->name,
                'email' => $order->email,
                'whatsapp_number' => $order->whatsapp_number,
                'number_of_participants' => $order->number_of_participants,
                'pickup_location' => $order->pickup_location,
                'start_date' => $order->start_date,
                'end_date' => $order->end_date,
                'message' => $order->message,
                'status' => $order->status,
                'created_at' => $order->created_at,
                'updated_at' => $order->updated_at,
                'service' => $order->service ? [
                    'id' => $order->service->id,
                    'title' => $order->service->title,
                    'price' => $order->service->price,
                ] : null,
                // Computed fields
                'formatted_start_date' => $order->start_date ? Carbon::parse($order->start_date)->format('d M Y') : '',
                'formatted_end_date' => $order->end_date ? Carbon::parse($order->end_date)->format('d M Y') : '',
                'duration' => $this->calculateDuration($order->start_date, $order->end_date),
                'status_text' => $this->getStatusText($order->status),
                'clean_whatsapp_number' => $this->formatWhatsAppNumber($order->whatsapp_number),
                'total_price' => $order->service ? ($order->service->price * $this->calculateDuration($order->start_date, $order->end_date) * $order->number_of_participants) : 0
            ];

            return response()->json([
                'success' => true,
                'data' => $orderData
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching order data: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Pesanan tidak ditemukan.'
            ], 404);
        }
    }

    /**
     * Calculate duration between two dates
     */
    private function calculateDuration($startDate, $endDate)
    {
        if (!$startDate || !$endDate) {
            return 0;
        }

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return $start->diffInDays($end) + 1;
    }

    /**
     * Validate order data
     */
    private function validateOrder(Request $request, $id = null)
    {
        $rules = [
            'service_id' => 'required|exists:services,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp_number' => 'required|string|max:255',
            'number_of_participants' => 'required|integer|min:1',
            'pickup_location' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'message' => 'nullable|string',
            'status' => 'nullable|in:pending,confirmed,completed,cancelled'
        ];

        $messages = [
            'service_id.required' => 'Layanan wajib dipilih.',
            'service_id.exists' => 'Layanan yang dipilih tidak valid.',
            'name.required' => 'Nama wajib diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama maksimal 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 255 karakter.',
            'whatsapp_number.required' => 'Nomor WhatsApp wajib diisi.',
            'whatsapp_number.string' => 'Nomor WhatsApp harus berupa teks.',
            'whatsapp_number.max' => 'Nomor WhatsApp maksimal 255 karakter.',
            'number_of_participants.required' => 'Jumlah peserta wajib diisi.',
            'number_of_participants.integer' => 'Jumlah peserta harus berupa angka.',
            'number_of_participants.min' => 'Jumlah peserta minimal 1.',
            'pickup_location.required' => 'Lokasi pickup wajib diisi.',
            'pickup_location.string' => 'Lokasi pickup harus berupa teks.',
            'pickup_location.max' => 'Lokasi pickup maksimal 255 karakter.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date' => 'Format tanggal mulai tidak valid.',
            'start_date.after_or_equal' => 'Tanggal mulai tidak boleh kurang dari hari ini.',
            'end_date.required' => 'Tanggal selesai wajib diisi.',
            'end_date.date' => 'Format tanggal selesai tidak valid.',
            'end_date.after_or_equal' => 'Tanggal selesai tidak boleh kurang dari tanggal mulai.',
            'message.string' => 'Pesan harus berupa teks.',
            'status.in' => 'Status tidak valid.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Get status text
     */
    public function getStatusText($status)
    {
        $statusMap = [
            'pending' => 'Pending',
            'confirmed' => 'Dikonfirmasi',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $statusMap[$status] ?? $status;
    }

    /**
     * Get status badge class
     */
    public function getStatusClass($status)
    {
        $classMap = [
            'pending' => 'bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300',
            'confirmed' => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300',
            'completed' => 'bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300',
            'cancelled' => 'bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300'
        ];

        return $classMap[$status] ?? $classMap['pending'];
    }

    /**
     * Format WhatsApp number to international format
     */
    public function formatWhatsAppNumber($number)
    {
        // Remove all non-numeric characters
        $cleanNumber = preg_replace('/[^0-9]/', '', $number);

        // If starts with 08, replace with 628
        if (substr($cleanNumber, 0, 2) === '08') {
            $cleanNumber = '628' . substr($cleanNumber, 2);
        }
        // If starts with 8 (without 0), add 62
        elseif (substr($cleanNumber, 0, 1) === '8') {
            $cleanNumber = '62' . $cleanNumber;
        }
        // If starts with +62, remove +
        elseif (substr($cleanNumber, 0, 3) === '+62') {
            $cleanNumber = substr($cleanNumber, 1);
        }
        // If doesn't start with 62, assume it's Indonesian number and add 62
        elseif (substr($cleanNumber, 0, 2) !== '62') {
            $cleanNumber = '62' . $cleanNumber;
        }

        return $cleanNumber;
    }
}
