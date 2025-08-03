<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    /**
     * Display the content management page
     */
    public function index()
    {
        $content = Content::first() ?? new Content();

        $viewData = [
            'title' => 'Content Management',
            'content' => $content,
            'activePage' => 'Content Management',
        ];

        return view('admin.contents.index', $viewData);
    }

    /**
     * Update Home/Jumbotron content
     */
    public function updateHome(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumbotron_title' => 'required|string|max:255',
            'jumbotron_description' => 'required|string',
            'jumbotron_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();

            // Handle jumbotron image upload
            if ($request->hasFile('jumbotron_image')) {
                // Delete old image if exists
                if ($content->jumbotron_image) {
                    $this->deleteImageFile($content->jumbotron_image, 'jumbotron');
                }
                $content->jumbotron_image = $this->uploadImage($request->file('jumbotron_image'), 'jumbotron');
            }

            $content->jumbotron_title = $request->jumbotron_title;
            $content->jumbotron_description = $request->jumbotron_description;
            $content->save();

            return redirect()->back()->with('success', 'Konten Jumbotron berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update Services section content
     */
    public function updateServices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_section_title' => 'required|string|max:255',
            'service_section_description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();
            $content->service_section_title = $request->service_section_title;
            $content->service_section_description = $request->service_section_description;
            $content->save();

            return redirect()->back()->with('success', 'Konten Services berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update About section content
     */
    public function updateAbout(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'about_section_title' => 'required|string|max:255',
            'about_section_text' => 'required|string',
            'about_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();

            // Handle about image upload
            if ($request->hasFile('about_image')) {
                // Delete old image if exists
                if ($content->about_image) {
                    $this->deleteImageFile($content->about_image, 'about');
                }
                $content->about_image = $this->uploadImage($request->file('about_image'), 'about');
            }

            $content->about_section_title = $request->about_section_title;
            $content->about_section_text = $request->about_section_text;
            $content->save();

            return redirect()->back()->with('success', 'Konten About berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update Testimonials section content
     */
    public function updateTestimonials(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'testimonial_section_title' => 'required|string|max:255',
            'testimonial_description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();
            $content->testimonial_section_title = $request->testimonial_section_title;
            $content->testimonial_description = $request->testimonial_description;
            $content->save();

            return redirect()->back()->with('success', 'Konten Testimonials berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update Gallery section content
     */
    public function updateGallery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gallery_section_title' => 'required|string|max:255',
            'gallery_section_description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();
            $content->gallery_section_title = $request->gallery_section_title;
            $content->gallery_section_description = $request->gallery_section_description;
            $content->save();

            return redirect()->back()->with('success', 'Konten Gallery berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update Contact section content
     */
    public function updateContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'contact_section_title' => 'required|string|max:255',
            'contact_section_description' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'google_maps' => 'nullable|url',
            'address' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();
            $content->contact_section_title = $request->contact_section_title;
            $content->contact_section_description = $request->contact_section_description;
            $content->whatsapp = $request->whatsapp;
            $content->instagram = $request->instagram;
            $content->email = $request->email;
            $content->google_maps = $request->google_maps;
            $content->address = $request->address;

            $content->save();

            return redirect()->back()->with('success', 'Konten Contact berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update SEO & Meta content
     */
    public function updateSeo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'meta_title' => 'required|string|max:255',
            'meta_keyword' => 'nullable|string',
            'meta_description' => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali data yang dimasukkan.');
        }

        try {
            $content = Content::first() ?? new Content();
            $content->meta_title = $request->meta_title;
            $content->meta_keyword = $request->meta_keyword;
            $content->meta_description = $request->meta_description;
            $content->save();

            return redirect()->back()->with('success', 'SEO & Meta berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Update Branding (Logo & Favicon)
     */
    public function updateBranding(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png,jpg|max:1024'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Validasi gagal. Silakan periksa kembali file yang diupload.');
        }

        try {
            $content = Content::first() ?? new Content();

            // Handle logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($content->logo) {
                    $this->deleteImageFile($content->logo, 'logo');
                }
                $content->logo = $this->uploadImage($request->file('logo'), 'logo');
            }

            // Handle favicon upload
            if ($request->hasFile('favicon')) {
                // Delete old favicon if exists
                if ($content->favicon) {
                    $this->deleteImageFile($content->favicon, 'favicon');
                }
                $content->favicon = $this->uploadImage($request->file('favicon'), 'favicon');
            }

            $content->save();

            return redirect()->back()->with('success', 'Logo dan Favicon berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Get content data for API or AJAX requests
     */
    public function getContentAJAX()
    {
        try {
            $content = Content::first();

            if (!$content) {
                return response()->json([
                    'success' => false,
                    'message' => 'Content not found'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'jumbotron' => [
                        'title' => $content->jumbotron_title,
                        'description' => $content->jumbotron_description,
                        'image' => $content->jumbotron_image
                    ],
                    'services' => [
                        'title' => $content->service_section_title,
                        'description' => $content->service_section_description
                    ],
                    'about' => [
                        'title' => $content->about_section_title,
                        'text' => $content->about_section_text,
                        'image' => $content->about_image
                    ],
                    'testimonials' => [
                        'title' => $content->testimonial_section_title,
                        'description' => $content->testimonial_description
                    ],
                    'gallery' => [
                        'title' => $content->gallery_section_title,
                        'description' => $content->gallery_section_description
                    ],
                    'contact' => [
                        'title' => $content->contact_section_title,
                        'description' => $content->contact_section_description,
                        'whatsapp' => $content->whatsapp,
                        'instagram' => $content->instagram,
                        'email' => $content->email,
                        'google_maps' => $content->google_maps
                    ],
                    'meta' => [
                        'title' => $content->meta_title,
                        'keyword' => $content->meta_keyword,
                        'description' => $content->meta_description
                    ],
                    'branding' => [
                        'logo' => $content->logo,
                        'favicon' => $content->favicon
                    ]
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving content: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get content data for public view
     */
    public function getContent()
    {
        try {
            $content = Content::first();

            if (!$content) {
                return new Content([
                    'jumbotron_title' => 'Welcome to Our Website',
                    'jumbotron_description' => 'Discover our services and offerings.',
                    'about_section_text' => 'We are a leading company in our industry.',
                    'meta_title' => 'Home - Our Company',
                    'meta_keyword' => 'company, services, about us',
                    'meta_description' => 'Learn more about our company and services.'
                ]);
            }

            return $content;
        } catch (\Exception $e) {
            return new Content([
                'jumbotron_title' => 'Error',
                'jumbotron_description' => 'Unable to retrieve content at this time.',
                'about_section_text' => '',
                'meta_title' => 'Error',
                'meta_keyword' => '',
                'meta_description' => $e->getMessage()
            ]);
        }
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
     * Delete image file from storage
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
    public function getImageUrl($fileName, $subfolder = 'images')
    {
        if ($fileName) {
            return asset('assets/images/' . $subfolder . '/' . $fileName);
        }

        return asset('assets/images/default-image.jpg');
    }
}
