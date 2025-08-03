<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\ServiceInclude;
use App\Models\ServiceExclude;
use App\Models\ServiceRequirement;
use App\Models\ServiceImage;
use App\Models\ServiceVariant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Service::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $services = $query->latest()->paginate(10);

        $viewData = [
            'title' => 'Services',
            'services' => $services,
        ];

        return view('admin.services.index', $viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Tambah Service',
        ];

        return view('admin.services.add', $viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateService($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $data = $request->only([
                'title',
                'type_of_service',
                'prolog',
                'detail',
                'price',
                'travel_plan',
                'status'
            ]);
            $data['status'] = $request->status ?? 'active';

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'services');
            }

            $service = Service::create($data);

            // Handle service variants
            if ($request->has('has_variants') && $request->has('variant_names') && $request->has('variant_prices')) {
                $variantNames = $request->variant_names;
                $variantPrices = $request->variant_prices;

                for ($i = 0; $i < count($variantNames); $i++) {
                    if (!empty($variantNames[$i]) && !empty($variantPrices[$i])) {
                        ServiceVariant::create([
                            'service_id' => $service->id,
                            'name' => $variantNames[$i],
                            'price' => $variantPrices[$i]
                        ]);
                    }
                }
            }

            // Handle service includes
            if ($request->has('includes') && is_array($request->includes)) {
                foreach ($request->includes as $include) {
                    if (!empty($include)) {
                        ServiceInclude::create([
                            'service_id' => $service->id,
                            'include' => $include
                        ]);
                    }
                }
            }

            // Handle service excludes
            if ($request->has('excludes') && is_array($request->excludes)) {
                foreach ($request->excludes as $exclude) {
                    if (!empty($exclude)) {
                        ServiceExclude::create([
                            'service_id' => $service->id,
                            'exclude' => $exclude
                        ]);
                    }
                }
            }

            // Handle service requirements
            if ($request->has('requirements') && is_array($request->requirements)) {
                foreach ($request->requirements as $requirement) {
                    if (!empty($requirement)) {
                        ServiceRequirement::create([
                            'service_id' => $service->id,
                            'requirement' => $requirement
                        ]);
                    }
                }
            }

            // Handle service images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = $this->uploadImage($image, 'services');
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'image' => $imageName
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollback();
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
        $service = Service::with(['includes', 'excludes', 'requirements', 'images', 'variants'])->findOrFail($id);

        $viewData = [
            'title' => 'Detail Service',
            'service' => $service,
        ];

        return view('admin.services.detail', $viewData);
    }

    /**
     * Display public service detail page
     */
    public function publicDetail($id)
    {
        $service = Service::with(['includes', 'excludes', 'requirements', 'images', 'variants'])
            ->where('status', 'active')
            ->findOrFail($id);

        // Get other services for recommendations (exclude current service)
        $otherServices = Service::with(['images'])
            ->where('status', 'active')
            ->where('id', '!=', $id)
            ->latest()
            ->limit(6)
            ->get();

        $viewData = [
            'title' => 'Detail ' . $service->title,
            'sectionTitle' => 'Detail Layanan',
            'activePage' => 'Layanan',
            'service' => $service,
            'otherServices' => $otherServices,
        ];

        return view('services.detail', $viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = Service::with(['includes', 'excludes', 'requirements', 'images', 'variants'])->findOrFail($id);

        $viewData = [
            'title' => 'Edit Service',
            'service' => $service,
        ];

        return view('admin.services.edit', $viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateService($request, $id);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();

        try {
            $service = Service::findOrFail($id);

            $data = $request->only([
                'title',
                'type_of_service',
                'prolog',
                'detail',
                'price',
                'travel_plan',
                'status'
            ]);
            $data['status'] = $request->status ?? 'active';

            // Handle thumbnail upload
            if ($request->hasFile('thumbnail')) {
                // Delete old thumbnail if exists
                if ($service->thumbnail) {
                    $this->deleteImageFile($service->thumbnail, 'services');
                }
                $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'), 'services');
            }

            $service->update($data);

            // Update service variants
            $service->variants()->delete();
            if ($request->has('has_variants') && $request->has('variant_names') && $request->has('variant_prices')) {
                $variantNames = $request->variant_names;
                $variantPrices = $request->variant_prices;

                for ($i = 0; $i < count($variantNames); $i++) {
                    if (!empty($variantNames[$i]) && !empty($variantPrices[$i])) {
                        ServiceVariant::create([
                            'service_id' => $service->id,
                            'name' => $variantNames[$i],
                            'price' => $variantPrices[$i]
                        ]);
                    }
                }
            }

            // Update service includes
            $service->includes()->delete();
            if ($request->has('includes') && is_array($request->includes)) {
                foreach ($request->includes as $include) {
                    if (!empty($include)) {
                        ServiceInclude::create([
                            'service_id' => $service->id,
                            'include' => $include
                        ]);
                    }
                }
            }

            // Update service excludes
            $service->excludes()->delete();
            if ($request->has('excludes') && is_array($request->excludes)) {
                foreach ($request->excludes as $exclude) {
                    if (!empty($exclude)) {
                        ServiceExclude::create([
                            'service_id' => $service->id,
                            'exclude' => $exclude
                        ]);
                    }
                }
            }

            // Update service requirements
            $service->requirements()->delete();
            if ($request->has('requirements') && is_array($request->requirements)) {
                foreach ($request->requirements as $requirement) {
                    if (!empty($requirement)) {
                        ServiceRequirement::create([
                            'service_id' => $service->id,
                            'requirement' => $requirement
                        ]);
                    }
                }
            }

            // Handle image deletion BEFORE adding new images
            if ($request->has('delete_images') && is_array($request->delete_images)) {
                foreach ($request->delete_images as $imageId) {
                    $serviceImage = ServiceImage::where('id', $imageId)
                        ->where('service_id', $service->id)
                        ->first();

                    if ($serviceImage) {
                        // Delete physical file from storage
                        $this->deleteImageFile($serviceImage->image, 'services');

                        // Delete record from database
                        $serviceImage->delete();

                        Log::info("Deleted image: {$serviceImage->image} with ID: {$imageId}");
                    }
                }
            }

            // Handle new service images
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $imageName = $this->uploadImage($image, 'services');
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'image' => $imageName
                    ]);
                }
            }

            DB::commit();

            $deletedCount = $request->has('delete_images') ? count($request->delete_images) : 0;
            $successMessage = 'Service berhasil diperbarui.';

            if ($deletedCount > 0) {
                $successMessage .= " {$deletedCount} gambar berhasil dihapus.";
            }

            return redirect()
                ->route('admin.services.index')
                ->with('success', $successMessage);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error updating service: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $service = Service::with(['includes', 'excludes', 'requirements', 'images', 'variants'])->findOrFail($id);

            // Delete thumbnail if exists
            if ($service->thumbnail) {
                $this->deleteImageFile($service->thumbnail, 'services');
            }

            // Delete all related images from storage
            foreach ($service->images as $serviceImage) {
                $this->deleteImageFile($serviceImage->image, 'services');
            }

            // Delete all related records (will be handled by cascade if set in DB, but doing manually for safety)
            $service->includes()->delete();
            $service->excludes()->delete();
            $service->requirements()->delete();
            $service->images()->delete();
            $service->variants()->delete();

            $service->delete();

            DB::commit();

            return redirect()
                ->route('admin.services.index')
                ->with('success', 'Service berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()
                ->route('admin.services.index')
                ->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }

    /**
     * Delete single image via AJAX
     */
    public function deleteImage(Request $request)
    {
        try {
            $imageId = $request->input('image_id');
            $serviceId = $request->input('service_id');

            $serviceImage = ServiceImage::where('id', $imageId)
                ->where('service_id', $serviceId)
                ->first();

            if (!$serviceImage) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gambar tidak ditemukan.'
                ], 404);
            }

            // Delete physical file
            $this->deleteImageFile($serviceImage->image, 'services');

            // Delete from database
            $serviceImage->delete();

            return response()->json([
                'success' => true,
                'message' => 'Gambar berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            Log::error('Error deleting image: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus gambar.'
            ], 500);
        }
    }

    /**
     * Validate service data
     */
    private function validateService(Request $request, $id = null)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'type_of_service' => 'required|in:Sewa Mobil,Paket Tour',
            'prolog' => 'required|string',
            'detail' => 'required|string',
            'price' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'travel_plan' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
            'has_variants' => 'nullable|boolean',
            'variant_names' => 'nullable|array',
            'variant_names.*' => 'nullable|string|max:255',
            'variant_prices' => 'nullable|array',
            'variant_prices.*' => 'nullable|integer|min:0',
            'includes' => 'nullable|array',
            'includes.*' => 'nullable|string|max:255',
            'excludes' => 'nullable|array',
            'excludes.*' => 'nullable|string|max:255',
            'requirements' => 'nullable|array',
            'requirements.*' => 'nullable|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'nullable|integer|exists:service_images,id'
        ];

        $messages = [
            'title.required' => 'Judul wajib diisi.',
            'title.string' => 'Judul harus berupa teks.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'type_of_service.required' => 'Jenis layanan wajib dipilih.',
            'type_of_service.in' => 'Jenis layanan harus Sewa Mobil atau Paket Tour.',
            'prolog.required' => 'Prolog wajib diisi.',
            'prolog.string' => 'Prolog harus berupa teks.',
            'prolog.max' => 'Prolog maksimal 255 karakter.',
            'detail.required' => 'Detail wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.integer' => 'Harga harus berupa angka.',
            'price.min' => 'Harga minimal 0.',
            'thumbnail.image' => 'Thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format thumbnail harus jpeg, png, jpg, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 2MB.',
            'variant_names.array' => 'Format nama varian tidak valid.',
            'variant_names.*.string' => 'Nama varian harus berupa teks.',
            'variant_names.*.max' => 'Nama varian maksimal 255 karakter.',
            'variant_prices.array' => 'Format harga varian tidak valid.',
            'variant_prices.*.integer' => 'Harga varian harus berupa angka.',
            'variant_prices.*.min' => 'Harga varian minimal 0.',
            'includes.array' => 'Format includes tidak valid.',
            'includes.*.string' => 'Setiap include harus berupa teks.',
            'includes.*.max' => 'Setiap include maksimal 255 karakter.',
            'excludes.array' => 'Format excludes tidak valid.',
            'excludes.*.string' => 'Setiap exclude harus berupa teks.',
            'excludes.*.max' => 'Setiap exclude maksimal 255 karakter.',
            'requirements.array' => 'Format requirements tidak valid.',
            'requirements.*.string' => 'Setiap requirement harus berupa teks.',
            'requirements.*.max' => 'Setiap requirement maksimal 255 karakter.',
            'images.array' => 'Format gambar tidak valid.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'images.*.max' => 'Ukuran gambar maksimal 2MB.',
            'delete_images.array' => 'Format delete images tidak valid.',
            'delete_images.*.integer' => 'ID gambar harus berupa angka.',
            'delete_images.*.exists' => 'Gambar tidak ditemukan.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }

    /**
     * Upload image to storage
     */
    private function uploadImage($file, $subfolder = 'images')
    {
        $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('assets/images/' . $subfolder);

        // Buat direktori jika belum ada
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $fileName);

        return $fileName;
    }

    /**
     * Delete image file from storage (renamed from deleteImage to avoid conflict)
     */
    private function deleteImageFile($fileName, $subfolder = 'images')
    {
        $filePath = public_path('assets/images/' . $subfolder . '/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
            return true;
        }

        return false;
    }

    /**
     * Get image URL
     */
    public function getImageUrl($fileName, $subfolder = 'services')
    {
        if ($fileName) {
            return asset('assets/images/' . $subfolder . '/' . $fileName);
        }

        return asset('assets/images/default-image.jpg');
    }
}
