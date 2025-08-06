<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Content;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Booking;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class LandingPageController extends Controller
{
    /**
     * Display the landing page with dynamic data for index_old.blade.php
     */
    public function index()
    {
        try {
            // Get content data from database (single row)
            $content = $this->getContentData();

            // Get services data - separate by type
            $sewaMobilServices = Service::with(['images', 'variants'])
                ->where('status', 'active')
                ->where('type_of_service', 'Sewa Mobil')
                ->latest()
                ->limit(6)
                ->get();

            $paketTourServices = Service::with(['images', 'variants'])
                ->where('status', 'active')
                ->where('type_of_service', 'Paket Tour')
                ->latest()
                ->limit(6)
                ->get();

            // Get all active services for general display
            $allServices = Service::with(['images', 'variants'])
                ->where('status', 'active')
                ->latest()
                ->limit(12)
                ->get();

            // Get testimonials data for carousel (9 testimonials = 3 slides x 3 each)
            $testimonials = Testimonial::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->limit(9)
                ->get();

            // Group testimonials into slides of 3
            $testimonialSlides = $testimonials->chunk(3);

            // Get gallery images
            $galleryImages = Gallery::where('status', 'active')
                ->latest()
                ->limit(12)
                ->get();

            // Get statistics for hero section
            $statistics = $this->getStatistics();

            // Prepare view data for index_old.blade.php
            $viewData = [
                'title' => $content['meta_title'] ?? 'Beranda - Mega Santosa Tour',
                'activePage' => 'Beranda',
                'content' => $content,
                'sewaMobilServices' => $sewaMobilServices,
                'paketTourServices' => $paketTourServices,
                'allServices' => $allServices,
                'testimonials' => $testimonials,
                'testimonialSlides' => $testimonialSlides,
                'galleryImages' => $galleryImages,
                'statistics' => $statistics,
                'heroData' => $this->getHeroData($content),
                'aboutData' => $this->getAboutData($content),
                'contactData' => $this->getContactData($content),
            ];

            return view('home.index', $viewData);
        } catch (\Exception $e) {
            // Log error and return with default data
            Log::error('Landing page error: ' . $e->getMessage());

            return view('home.index', [
                'title' => 'Beranda - Mega Santosa Tour',
                'activePage' => 'Beranda',
                'content' => $this->getDefaultContent(),
                'sewaMobilServices' => collect(),
                'paketTourServices' => collect(),
                'allServices' => collect(),
                'testimonials' => collect(),
                'testimonialSlides' => collect(),
                'galleryImages' => collect(),
                'statistics' => $this->getDefaultStatistics(),
                'heroData' => $this->getDefaultHeroData(),
                'aboutData' => $this->getDefaultAboutData(),
                'contactData' => $this->getDefaultContactData(),
            ]);
        }
    }

    /**
     * Display services page with dynamic data
     */
    public function servicesIndex()
    {
        try {
            // Get content data from database
            $content = $this->getContentData();

            // Get services data with pagination - separate by type
            $sewaMobilServices = Service::with(['images', 'variants'])
                ->where('status', 'active')
                ->where('type_of_service', 'Sewa Mobil')
                ->latest()
                ->paginate(9, ['*'], 'sewa_mobil_page');

            $paketTourServices = Service::with(['images', 'variants'])
                ->where('status', 'active')
                ->where('type_of_service', 'Paket Tour')
                ->latest()
                ->paginate(9, ['*'], 'paket_tour_page');

            // Get testimonials data for carousel (9 testimonials = 3 slides x 3 each)
            $testimonials = Testimonial::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->limit(9)
                ->get();

            // Group testimonials into slides of 3
            $testimonialSlides = $testimonials->chunk(3);

            // Prepare view data
            $viewData = [
                'title' => 'Layanan Kami - ' . ($content['site_title'] ?? 'Mega Santosa Tour'),
                'activePage' => 'Layanan',
                'content' => $content,
                'sewaMobilServices' => $sewaMobilServices,
                'paketTourServices' => $paketTourServices,
                'testimonials' => $testimonials,
                'testimonialSlides' => $testimonialSlides,
                'sectionTitle' => $content['service_section_title'] ?? 'Layanan Kami',
                'contactData' => $this->getContactData($content),
            ];

            return view('services.index', $viewData);
        } catch (\Exception $e) {
            Log::error('Services page error: ' . $e->getMessage());

            return view('services.index', [
                'title' => 'Layanan Kami - Mega Santosa Tour',
                'activePage' => 'Layanan',
                'sectionTitle' => 'Layanan Kami',
                'content' => $this->getDefaultContent(),
                'sewaMobilServices' => collect(),
                'paketTourServices' => collect(),
                'testimonials' => collect(),
                'testimonialSlides' => collect(),
            ]);
        }
    }

    public function serviceDetail($id, Request $request)
    {
        $service = Service::with(['includes', 'excludes', 'requirements', 'images', 'variants'])
            ->where('status', 'active')
            ->findOrFail($id);

        // Get variant ID from request parameter if provided
        $variantId = $request->get('variant_id');
        $selectedVariant = null;

        // If variant ID is provided, find the specific variant
        if ($variantId && $service->variants->count() > 0) {
            $selectedVariant = $service->variants->find($variantId);
        }

        // If no specific variant selected, use the first variant if available
        if (!$selectedVariant && $service->variants->count() > 0) {
            $selectedVariant = $service->variants->first();
        }

        // Determine display title and price
        $displayTitle = $selectedVariant ? $selectedVariant->name : $service->title;
        $displayPrice = $selectedVariant ? $selectedVariant->price : $service->price;

        // Get other services for recommendations (exclude current service)
        $otherServices = Service::with(['images'])
            ->where('status', 'active')
            ->where('id', '!=', $id)
            ->latest()
            ->limit(6)
            ->get();

        $viewData = [
            'title' => 'Detail ' . $displayTitle,
            'sectionTitle' => 'Detail Layanan',
            'activePage' => 'Layanan',
            'service' => $service,
            'selectedVariant' => $selectedVariant,
            'displayTitle' => $displayTitle,
            'displayPrice' => $displayPrice,
            'otherServices' => $otherServices,
            'contactData' => $this->getDefaultContactData(),
        ];

        return view('services.detail', $viewData);
    }

    /**
     * Display galleries page with dynamic data
     */
    public function galleriesIndex()
    {
        try {
            // Get content data from database
            $content = $this->getContentData();

            // Get gallery images with pagination
            $galleryImages = Gallery::where('status', 'active')
                ->latest()
                ->paginate(16);

            // Get testimonials data for carousel (9 testimonials = 3 slides x 3 each)
            $testimonials = Testimonial::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->limit(9)
                ->get();

            // Group testimonials into slides of 3
            $testimonialSlides = $testimonials->chunk(3);

            // Prepare view data
            $viewData = [
                'title' => ($content['gallery_section_title'] ?? 'Galeri Kami') . ' - ' . ($content['site_title'] ?? 'Mega Santosa Tour'),
                'activePage' => 'Galeri',
                'content' => $content,
                'galleryImages' => $galleryImages,
                'sectionTitle' => $content['gallery_section_title'] ?? 'Galeri Kami',
                'testimonialSlides' => $testimonialSlides,
                'contactData' => $this->getContactData($content),
            ];

            return view('galleries.index', $viewData);
        } catch (\Exception $e) {
            Log::error('Galleries page error: ' . $e->getMessage());

            return view('galleries.index', [
                'title' => 'Galeri Kami - Mega Santosa Tour',
                'activePage' => 'Galeri',
                'content' => $this->getDefaultContent(),
                'galleryImages' => collect(),
                'sectionTitle' => 'Galeri Kami',
                'testimonialSlides' => collect(),
            ]);
        }
    }

    /**
     * Display contact page with dynamic data
     */
    public function contactIndex()
    {
        try {
            // Get content data from database
            $content = $this->getContentData();

            // Get contact data
            $contactData = $this->getContactData($content);

            // Prepare view data
            $viewData = [
                'title' => ($content['contact_section_title'] ?? 'Kontak Kami') . ' - ' . ($content['site_title'] ?? 'Mega Santosa Tour'),
                'activePage' => 'Kontak',
                'content' => $content,
                'contactData' => $contactData,
                'sectionTitle' => $content['contact_section_title'] ?? 'Kontak Kami',
            ];

            return view('contact.index', $viewData);
        } catch (\Exception $e) {
            Log::error('Contact page error: ' . $e->getMessage());

            return view('contact.index', [
                'title' => 'Kontak Kami - Mega Santosa Tour',
                'activePage' => 'Kontak',
                'content' => $this->getDefaultContent(),
                'contactData' => $this->getDefaultContactData(),
                'sectionTitle' => 'Kontak Kami',
            ]);
        }
    }

    /**
     * Get content data from database (single row from contents table)
     */
    private function getContentData()
    {
        try {
            // Get the single content row from database
            $contentRow = Content::first();

            if (!$contentRow) {
                return $this->getDefaultContent();
            }

            // Map database fields to content array
            return [
                'site_title' => $contentRow->meta_title ?? 'Mega Santosa Tour',
                'site_description' => $contentRow->meta_description ?? 'Layanan sewa mobil dan paket tour terbaik',
                'meta_title' => $contentRow->meta_title ?? 'Mega Santosa Tour',
                'meta_keywords' => $contentRow->meta_keyword ?? '',
                'jumbotron_title' => $contentRow->jumbotron_title ?? 'Sewa, Paket Murah & Nyaman',
                'jumbotron_description' => $contentRow->jumbotron_description ?? 'Selamat datang! Temukan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
                'jumbotron_image' => $contentRow->jumbotron_image ?? 'https://images.unsplash.com/photo-1603878062595-32f9e7eeb9ff?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bW91bnRhaW4lMjBqZWVwfGVufDB8fDB8fHww',
                'service_section_title' => $contentRow->service_section_title ?? 'Layanan Kami',
                'service_section_description' => $contentRow->service_section_description ?? 'Kami menyediakan layanan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
                'about_section_title' => $contentRow->about_section_title ?? 'Tentang Kami.',
                'about_section_text' => $contentRow->about_section_text ?? 'Kami adalah penyedia layanan sewa mobil dan paket tour terpercaya dengan pengalaman bertahun-tahun.',
                'about_image' => $contentRow->about_image ?? 'https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YWJvdXQlMjBzZXJ2aWNlfGVufDB8fDB8fHww',
                'testimonial_section_title' => $contentRow->testimonial_section_title ?? 'Apa Kata Klien Kami',
                'testimonial_description' => $contentRow->testimonial_description ?? 'Kami selalu berusaha memberikan layanan terbaik untuk kepuasan klien kami.',
                'gallery_section_title' => $contentRow->gallery_section_title ?? 'Galeri Kami',
                'gallery_section_description' => $contentRow->gallery_section_description ?? 'Lihat beberapa gambar dari mobil-mobil kami yang siap disewa.',
                'contact_section_title' => $contentRow->contact_section_title ?? 'Kontak Kami',
                'contact_section_description' => $contentRow->contact_section_description ?? 'Hubungi kami melalui beberapa metode di bawah ini.',
                'whatsapp' => $contentRow->whatsapp ?? '+62 812-3456-7890',
                'instagram' => $contentRow->instagram ?? '@megasantosatour',
                'email' => $contentRow->email ?? 'info@megasantosatour.com',
                'tiktok' => $contentRow->tiktok ?? '@megasantosatour',
                'google_maps' => $contentRow->google_maps ?? 'https://maps.google.com/maps?width=1024&amp;height=400&amp;hl=en&amp;q=Jalan%20Gunung%20Andakasa%20+(Mega%20Santosa%20Tour)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed',
                'address' => $contentRow->address ?? 'Jl. Alamat Kantor Pusat',
                'logo' => $contentRow->logo ?? null,
                'favicon' => $contentRow->favicon ?? null,
            ];
        } catch (\Exception $e) {
            Log::error('Error getting content data: ' . $e->getMessage());
            return $this->getDefaultContent();
        }
    }

    /**
     * Get hero section data
     */
    private function getHeroData($content)
    {
        return [
            'title' => $content['jumbotron_title'] ?? 'Sewa, Paket Murah & Nyaman',
            'subtitle' => $content['jumbotron_description'] ?? 'Selamat datang! Temukan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
            'background_image' => $content['jumbotron_image'] ?? 'https://images.unsplash.com/photo-1603878062595-32f9e7eeb9ff?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bW91bnRhaW4lMjBqZWVwfGVufDB8fDB8fHww',
            'cta_primary_text' => 'Layanan Kami',
            'cta_secondary_text' => 'Tentang Kami',
        ];
    }

    /**
     * Get about section data
     */
    private function getAboutData($content)
    {
        return [
            'title' => $content['about_section_title'] ?? 'Tentang Kami.',
            'description' => $content['about_section_text'] ?? 'Kami adalah penyedia layanan sewa mobil dan paket tour terpercaya.',
            'image' => $content['about_image'] ?? 'https://images.unsplash.com/photo-1506748686214-e9df14d4d9d0?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8YWJvdXQlMjBzZXJ2aWNlfGVufDB8fDB8fHww',
            'cta_text' => 'Layanan Kami',
        ];
    }

    /**
     * Get contact section data
     */
    private function getContactData($content)
    {
        return [
            'whatsapp' => $content['whatsapp'] ?? '+62 812-3456-7890',
            'instagram' => $content['instagram'] ?? '@megasantosatour',
            'email' => $content['email'] ?? 'info@megasantosatour.com',
            'address' => $content['address'] ?? 'Jl. Alamat Kantor Pusat',
            'tiktok' => $content['tiktok'] ?? '@megasantosatour',
            'facebook' => $content['facebook'] ?? 'https://www.facebook.com/megasantosatour',
            'youtube' => $content['youtube'] ?? 'https://www.youtube.com/channel/megasantosatour',
            'map_embed' => html_entity_decode($content['google_maps'] ?? 'https://maps.google.com/maps?width=1024&amp;height=400&amp;hl=en&amp;q=Jalan%20Gunung%20Andakasa%20+(Mega%20Santosa%20Tour)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed'),
        ];
    }

    /**
     * Get gallery images for API/AJAX calls
     */
    public function getGalleryImages(Request $request)
    {
        try {
            $limit = $request->get('limit', 12);

            $galleryImages = Gallery::where('status', 'active')
                ->latest()
                ->limit($limit)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $galleryImages,
                'count' => $galleryImages->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching gallery images: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Add new testimonial
     */
    public function addTestimonial(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'service' => 'required|string|max:255',
                'rating' => 'required|integer|min:1|max:5',
                'message' => 'required|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $testimonial = Testimonial::create([
                'name' => $request->name,
                'type_of_service' => $request->service,
                'rating' => $request->rating,
                'message' => $request->message,
                'status' => 'pending', // Needs admin verification
                'is_verified' => 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Testimoni berhasil dikirim! Akan ditampilkan setelah diverifikasi.',
                'data' => $testimonial
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding testimonial: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengirim testimoni.'
            ], 500);
        }
    }

    /**
     * Add new order and send Gmail notification to admin
     */
    public function addOrder(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'service_id' => 'required|exists:services,id',
                'variant_id' => 'nullable|exists:service_variants,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'whatsapp_number' => 'required|string|max:20',
                'number_of_participants' => 'required|integer|min:1',
                'pickup_location' => 'required|string|max:500',
                'start_date' => 'required|date|after_or_equal:today',
                'end_date' => 'required|date|after_or_equal:start_date',
                'message' => 'nullable|string|max:1000',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Create new order
            $order = Order::create([
                'service_id' => $request->service_id,
                'service_variant_id' => $request->variant_id,
                'name' => $request->name,
                'email' => $request->email,
                'whatsapp_number' => $request->whatsapp_number,
                'number_of_participants' => $request->number_of_participants,
                'pickup_location' => $request->pickup_location,
                'start_date' => Carbon::parse($request->start_date),
                'end_date' => Carbon::parse($request->end_date),
                'message' => $request->message,
                'status' => 'pending',
            ]);

            // Load service and variant relationships
            $order->load(['service', 'variant']);

            // Note: Email notification disabled as requested
            // $this->sendOrderNotificationToAdmin($order);

            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dibuat! Admin akan segera menghubungi Anda.',
                'data' => $order
            ]);
        } catch (\Exception $e) {
            Log::error('Error adding order: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat pesanan.'
            ], 500);
        }
    }

    /**
     * Send Gmail notification to admin when new order is received
     */
    private function sendOrderNotificationToAdmin($order)
    {
        try {
            $adminEmail = config('mail.admin_email', 'admin@megasantosatour.com');

            $mailData = [
                'order' => $order,
                'service' => $order->service,
                'customer_name' => $order->name,
                'customer_email' => $order->email,
                'customer_whatsapp' => $order->whatsapp_number,
                'participants' => $order->number_of_participants,
                'pickup_location' => $order->pickup_location,
                'start_date' => $order->formatted_start_date,
                'end_date' => $order->formatted_end_date,
                'duration' => $order->duration,
                'message' => $order->message,
                'order_date' => $order->created_at->format('d M Y H:i'),
            ];

            Mail::send('emails.new_order_notification', $mailData, function ($message) use ($adminEmail, $order) {
                $message->to($adminEmail)
                    ->subject('Pesanan Baru - ' . $order->service->title . ' - ' . $order->name)
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info('Order notification email sent to admin for order ID: ' . $order->id);
        } catch (\Exception $e) {
            Log::error('Failed to send order notification email: ' . $e->getMessage());
            // Don't throw exception here as order creation should still succeed
        }
    }

    /**
     * Get statistics for display
     */
    private function getStatistics()
    {
        try {
            return [
                'total_services' => Service::where('status', 'active')->count(),
                'total_orders' => Order::count(),
                'total_bookings' => Booking::count(),
                'total_testimonials' => Testimonial::where('status', 'active')->count(),
                'sewa_mobil_count' => Service::where('status', 'active')
                    ->where('type_of_service', 'Sewa Mobil')->count(),
                'paket_tour_count' => Service::where('status', 'active')
                    ->where('type_of_service', 'Paket Tour')->count(),
                'completed_orders' => Order::where('status', 'completed')->count(),
                'active_galleries' => Gallery::where('status', 'active')->count(),
            ];
        } catch (\Exception $e) {
            return $this->getDefaultStatistics();
        }
    }

    /**
     * Get services by type for API/AJAX calls
     */
    public function getServicesByType(Request $request)
    {
        try {
            $type = $request->get('type', 'all');
            $limit = $request->get('limit', 6);

            $query = Service::with(['images', 'variants'])
                ->where('status', 'active');

            if ($type !== 'all') {
                $query->where('type_of_service', $type);
            }

            $services = $query->latest()->limit($limit)->get();

            return response()->json([
                'success' => true,
                'data' => $services,
                'count' => $services->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching services: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get testimonials for carousel
     */
    public function getTestimonials(Request $request)
    {
        try {
            $limit = $request->get('limit', 9);

            $testimonials = Testimonial::where('status', 'active')
                ->where('is_verified', true)
                ->latest()
                ->limit($limit)
                ->get();

            $testimonialSlides = $testimonials->chunk(3);

            return response()->json([
                'success' => true,
                'data' => $testimonials,
                'slides' => $testimonialSlides,
                'count' => $testimonials->count()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error fetching testimonials: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Submit contact form via AJAX/API
     */
    public function submitContactForm(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
            ]);

            // Send contact form email to admin
            $this->sendContactFormToAdmin($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error sending message: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Submit contact form via regular form submission
     */
    public function submitContactFormWeb(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
            ], [
                'name.required' => 'Nama wajib diisi.',
                'name.max' => 'Nama maksimal 255 karakter.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.max' => 'Email maksimal 255 karakter.',
                'subject.required' => 'Subjek wajib diisi.',
                'subject.max' => 'Subjek maksimal 255 karakter.',
                'message.required' => 'Pesan wajib diisi.',
                'message.max' => 'Pesan maksimal 1000 karakter.',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Send contact form email to admin
            $this->sendContactFormToAdmin($request->all());

            return redirect()
                ->back()
                ->with('success', 'Pesan berhasil dikirim! Kami akan menghubungi Anda segera.')
                ->withInput(['name' => '', 'email' => '', 'subject' => '', 'message' => '']);
        } catch (\Exception $e) {
            Log::error('Contact form submission error: ' . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Send contact form to admin via Gmail
     */
    private function sendContactFormToAdmin($contactData)
    {
        try {
            $adminEmail = config('mail.admin_email', 'admin@megasantosatour.com');

            Mail::send('emails.contact_form', $contactData, function ($message) use ($adminEmail, $contactData) {
                $message->to($adminEmail)
                    ->subject('Pesan Kontak Baru - ' . $contactData['subject'])
                    ->replyTo($contactData['email'], $contactData['name'])
                    ->from(config('mail.from.address'), config('mail.from.name'));
            });

            Log::info('Contact form email sent to admin from: ' . $contactData['email']);
        } catch (\Exception $e) {
            Log::error('Failed to send contact form email: ' . $e->getMessage());
            throw $e;
        }
    }

    // Default fallback methods
    private function getDefaultContent()
    {
        return [
            'site_title' => 'Mega Santosa Tour',
            'site_description' => 'Layanan sewa mobil dan paket tour terbaik',
            'meta_title' => 'Mega Santosa Tour',
            'jumbotron_title' => 'Sewa, Paket Murah & Nyaman',
            'jumbotron_description' => 'Selamat datang! Temukan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
            'service_section_title' => 'Layanan Kami',
            'service_section_description' => 'Kami menyediakan layanan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
            'about_section_title' => 'Tentang Kami.',
            'testimonial_section_title' => 'Apa Kata Klien Kami',
            'testimonial_description' => 'Kami selalu berusaha memberikan layanan terbaik untuk kepuasan klien kami.',
            'gallery_section_title' => 'Galeri Kami',
            'gallery_section_description' => 'Lihat beberapa gambar dari mobil-mobil kami yang siap disewa.',
            'contact_section_title' => 'Kontak Kami',
            'contact_section_description' => 'Hubungi kami melalui beberapa metode di bawah ini.',
        ];
    }

    private function getDefaultStatistics()
    {
        return [
            'total_services' => 0,
            'total_orders' => 0,
            'total_bookings' => 0,
            'total_testimonials' => 0,
            'sewa_mobil_count' => 0,
            'paket_tour_count' => 0,
            'completed_orders' => 0,
            'active_galleries' => 0,
        ];
    }

    private function getDefaultHeroData()
    {
        return [
            'title' => 'Sewa, Paket Murah & Nyaman',
            'subtitle' => 'Selamat datang! Temukan sewa mobil dan paket tour terbaik untuk perjalanan nyaman dan seru bersama kami!',
            'background_image' => 'https://images.unsplash.com/photo-1603878062595-32f9e7eeb9ff?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bW91bnRhaW4lMjBqZWVwfGVufDB8fDB8fHww',
            'cta_primary_text' => 'Layanan Kami',
            'cta_secondary_text' => 'Tentang Kami',
        ];
    }

    private function getDefaultAboutData()
    {
        return [
            'title' => 'Tentang Kami.',
            'description_1' => 'Kami adalah penyedia layanan sewa mobil dan paket tour terpercaya.',
            'description_2' => 'Dengan pengalaman bertahun-tahun, kami siap memberikan pelayanan terbaik.',
            'image' => 'https://images.unsplash.com/photo-1626287305073-848bcc8e9819?w=900&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8bW91bnRhaW4lMjBqZWVwfGVufDB8fDB8fHww',
            'cta_text' => 'Cari Tahu Tentang Kami',
        ];
    }

    private function getDefaultContactData()
    {
        return [
            'whatsapp' => '+62 812-3456-7890',
            'instagram' => '@megasantosatour',
            'email' => 'info@megasantosatour.com',
            'address' => 'Jl. Alamat Kantor Pusat',
            'map_embed' => 'https://maps.google.com/maps?width=1024&amp;height=400&amp;hl=en&amp;q=Jalan%20Gunung%20Andakasa%20+(Mega%20Santosa%20Tour)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed',
        ];
    }
}
