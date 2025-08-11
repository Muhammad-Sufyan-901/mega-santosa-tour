<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    /**
     * Display dashboard with statistics
     */
    public function index()
    {
        // Set initial last check time when dashboard is first loaded
        if (!session()->has('last_order_check')) {
            session(['last_order_check' => Carbon::now()->toISOString()]);
        }

        $viewData = [
            'title' => 'Dashboard',
            'activePage' => 'Dashboard',
            'todayOrders' => $this->getTodayOrdersCount(),
            'totalRevenue' => $this->getTotalRevenue(),
            'recentOrders' => $this->getRecentOrders(),
            'chartData' => $this->getChartData(),
            'statusStats' => $this->getStatusStatistics(),
            'serviceTypeStats' => $this->getServiceTypeStatistics(),
            'weeklyComparison' => $this->getWeeklyComparison(),
            'lastOrderCheck' => session('last_order_check'),
        ];

        return view('admin.dashboard.index', $viewData);
    }

    /**
     * Check for new orders since last check
     */
    public function checkNewOrders(Request $request)
    {
        try {
            $lastCheck = $request->input('last_check');
            
            // If no last_check provided, use session or default to 5 minutes ago
            if (!$lastCheck) {
                $lastCheck = session('last_order_check', Carbon::now()->subMinutes(5)->toISOString());
            }
            
            $lastCheckTime = Carbon::parse($lastCheck);
            $currentTime = Carbon::now();
            
            Log::info('Checking for new orders', [
                'last_check' => $lastCheckTime->toISOString(),
                'current_time' => $currentTime->toISOString()
            ]);
            
            $newOrders = Order::with('service')
                ->where('created_at', '>', $lastCheckTime)
                ->latest()
                ->get();
                
            Log::info('Found orders', [
                'count' => $newOrders->count(),
                'orders' => $newOrders->pluck('id')->toArray()
            ]);
            
            $formattedOrders = $newOrders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'customer_name' => $order->name,
                    'service_title' => $order->service->title ?? 'Layanan Tidak Ditemukan',
                    'service_type' => $order->service->type_of_service ?? 'Unknown',
                    'amount' => $order->service ? ($order->service->price * $this->calculateDuration($order->start_date, $order->end_date) * $order->number_of_participants) : 0,
                    'formatted_amount' => 'Rp ' . number_format($order->service ? ($order->service->price * $this->calculateDuration($order->start_date, $order->end_date) * $order->number_of_participants) : 0, 0, ',', '.'),
                    'status' => $order->status,
                    'status_text' => $this->getStatusText($order->status),
                    'order_number' => 'MST' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                    'created_at' => $order->created_at->toISOString(),
                    'formatted_date' => $order->created_at->format('d M Y H:i'),
                    'time_ago' => $order->created_at->diffForHumans(),
                ];
            });

            // Update session with current time for next check
            session(['last_order_check' => $currentTime->toISOString()]);

            return response()->json([
                'success' => true,
                'new_orders' => $formattedOrders,
                'count' => $formattedOrders->count(),
                'current_time' => $currentTime->toISOString(),
                'last_check_time' => $lastCheckTime->toISOString()
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error checking for new orders: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'new_orders' => [],
                'count' => 0,
                'current_time' => Carbon::now()->toISOString()
            ], 500);
        }
    }

    /**
     * Get recent notifications for layout
     */
    public function getNotifications()
    {
        $notifications = Order::with('service')
            ->latest()
            ->limit(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'title' => 'Pesanan Baru #' . 'MST' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                    'message' => $order->name . ' memesan ' . ($order->service->title ?? 'Layanan'),
                    'time_ago' => $order->created_at->diffForHumans(),
                    'created_at' => $order->created_at->toISOString(),
                    'type' => 'order',
                    'icon' => $order->service && $order->service->type_of_service === 'Sewa Mobil' ? 'car' : 'tour',
                    'url' => route('admin.orders.index'),
                ];
            });

        return response()->json($notifications);
    }

    /**
     * Reset last order check time (for testing purposes)
     */
    public function resetOrderCheck()
    {
        session()->forget('last_order_check');
        session(['last_order_check' => Carbon::now()->subHours(1)->toISOString()]);
        
        return response()->json([
            'success' => true,
            'message' => 'Order check time reset',
            'last_check' => session('last_order_check')
        ]);
    }

    /**
     * Get today's orders count
     */
    private function getTodayOrdersCount()
    {
        return Order::whereDate('created_at', Carbon::today())->count();
    }

    /**
     * Get total revenue from completed orders
     */
    private function getTotalRevenue()
    {
        return Order::with('service')
            ->where('status', 'completed')
            ->get()
            ->sum(function ($order) {
                if ($order->service) {
                    $duration = $this->calculateDuration($order->start_date, $order->end_date);
                    return $order->service->price * $duration * $order->number_of_participants;
                }
                return 0;
            });
    }

    /**
     * Get recent orders for transactions table
     */
    private function getRecentOrders($limit = 10)
    {
        return Order::with('service')
            ->latest()
            ->limit($limit)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'customer_name' => $order->name,
                    'service_title' => $order->service->title ?? 'Layanan Tidak Ditemukan',
                    'amount' => $order->service ? ($order->service->price * $this->calculateDuration($order->start_date, $order->end_date) * $order->number_of_participants) : 0,
                    'status' => $order->status,
                    'status_text' => $this->getStatusText($order->status),
                    'status_class' => $this->getStatusClass($order->status),
                    'created_at' => $order->created_at,
                    'formatted_date' => $order->created_at->format('M d, Y'),
                    'order_number' => 'MST' . str_pad($order->id, 3, '0', STR_PAD_LEFT),
                ];
            });
    }

    /**
     * Get chart data for last 7 days grouped by service type
     */
    private function getChartData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6); // Last 7 days including today

        // Get orders with service type for the last 7 days
        $orders = Order::with('service')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get();

        // Initialize data structure
        $chartData = [
            'dates' => [],
            'sewa_mobil' => [],
            'paket_tour' => [],
        ];

        // Generate date range
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dateStr = $date->format('M d');
            $chartData['dates'][] = $dateStr;

            // Count orders for each service type on this date
            $dayOrders = $orders->filter(function ($order) use ($date) {
                return $order->created_at->format('Y-m-d') === $date->format('Y-m-d');
            });

            $sewaMobilCount = $dayOrders->filter(function ($order) {
                return $order->service && $order->service->type_of_service === 'Sewa Mobil';
            })->count();

            $paketTourCount = $dayOrders->filter(function ($order) {
                return $order->service && $order->service->type_of_service === 'Paket Tour';
            })->count();

            $chartData['sewa_mobil'][] = $sewaMobilCount;
            $chartData['paket_tour'][] = $paketTourCount;
        }

        return $chartData;
    }

    /**
     * Get status statistics
     */
    private function getStatusStatistics()
    {
        return [
            'pending' => Order::where('status', 'pending')->count(),
            'confirmed' => Order::where('status', 'confirmed')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];
    }

    /**
     * Get service type statistics
     */
    private function getServiceTypeStatistics()
    {
        $stats = Order::join('services', 'orders.service_id', '=', 'services.id')
            ->select('services.type_of_service', DB::raw('count(*) as total'))
            ->groupBy('services.type_of_service')
            ->get()
            ->pluck('total', 'type_of_service')
            ->toArray();

        return [
            'sewa_mobil' => $stats['Sewa Mobil'] ?? 0,
            'paket_tour' => $stats['Paket Tour'] ?? 0,
        ];
    }

    /**
     * Get weekly comparison data
     */
    public function getWeeklyComparison()
    {
        $thisWeekStart = Carbon::now()->startOfWeek();
        $thisWeekEnd = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        $thisWeekOrders = Order::whereBetween('created_at', [$thisWeekStart, $thisWeekEnd])->count();
        $lastWeekOrders = Order::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->count();

        $percentageChange = $lastWeekOrders > 0
            ? (($thisWeekOrders - $lastWeekOrders) / $lastWeekOrders) * 100
            : ($thisWeekOrders > 0 ? 100 : 0);

        return [
            'this_week' => $thisWeekOrders,
            'last_week' => $lastWeekOrders,
            'percentage_change' => round($percentageChange, 1),
            'is_increase' => $percentageChange >= 0,
        ];
    }

    /**
     * Calculate duration between two dates
     */
    private function calculateDuration($startDate, $endDate)
    {
        if (!$startDate || !$endDate) {
            return 1; // Default to 1 day if dates are missing
        }

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);

        return $start->diffInDays($end) + 1;
    }

    /**
     * Get status text
     */
    private function getStatusText($status)
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
            'pending' => 'bg-yellow-100 text-yellow-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-yellow-300 border border-yellow-100 dark:border-yellow-500',
            'confirmed' => 'bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-green-400 border border-green-100 dark:border-green-500',
            'completed' => 'bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md dark:bg-gray-700 dark:text-blue-400 border border-blue-100 dark:border-blue-500',
            'cancelled' => 'bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded-md border border-red-100 dark:border-red-400 dark:bg-gray-700 dark:text-red-400'
        ];

        return $classMap[$status] ?? $classMap['pending'];
    }
}
