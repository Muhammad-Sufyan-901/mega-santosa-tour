<?php

use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderController;

// Public Routes
Route::get('/', [LandingPageController::class, 'index'])->name('home.index');

// API Routes for Landing Page
Route::prefix('api/landing')->name('api.landing.')->group(function () {
    Route::get('/services', [LandingPageController::class, 'getServicesByType'])->name('services');
    Route::get('/testimonials', [LandingPageController::class, 'getTestimonials'])->name('testimonials');
    Route::get('/gallery', [LandingPageController::class, 'getGalleryImages'])->name('gallery');
    Route::post('/contact', [LandingPageController::class, 'submitContactForm'])->name('contact');
});

Route::get('/services', [LandingPageController::class, 'servicesIndex'])->name('services.index');

Route::get('/services/{id}/detail', [LandingPageController::class, 'serviceDetail'])->name('services.detail');

Route::get('/galleries', [LandingPageController::class, 'galleriesIndex'])->name('galleries.index');

Route::get('/contact', [LandingPageController::class, 'contactIndex'])->name('contact.index');

// Public API routes for testimonials and orders
Route::prefix('api/public')->name('api.public.')->group(function () {
    Route::post('/testimonials', [LandingPageController::class, 'addTestimonial'])->name('testimonials.store');
    Route::post('/orders', [LandingPageController::class, 'addOrder'])->name('orders.store');
});

// Auth Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', function () {
        $viewData = [
            'title' => 'Login',
        ];

        return view('auth.login', $viewData);
    })->name('login');
});


// Admin Routes Group
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard - Updated to use DashboardController
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    // Content Management
    Route::prefix('content')->name('content.')->group(function () {
        // Display content management dashboard
        Route::get('/', [ContentController::class, 'index'])->name('index');

        // Show form to edit home content
        Route::put('/home', [ContentController::class, 'updateHome'])->name('update.home');

        // Show form to edit services content
        Route::put('/services', [ContentController::class, 'updateServices'])->name('update.services');

        // Show form to edit about content
        Route::put('/about', [ContentController::class, 'updateAbout'])->name('update.about');

        // Show form to edit testimonials content
        Route::put('/testimonials', [ContentController::class, 'updateTestimonials'])->name('update.testimonials');

        // Show form to edit gallery content
        Route::put('/gallery', [ContentController::class, 'updateGallery'])->name('update.gallery');

        // Show form to edit contact content
        Route::put('/contact', [ContentController::class, 'updateContact'])->name('update.contact');

        // Show form to edit SEO settings
        Route::put('/seo', [ContentController::class, 'updateSeo'])->name('update.seo');

        // Show form to edit branding settings
        Route::put('/branding', [ContentController::class, 'updateBranding'])->name('update.branding');

        // AJAX route for getting content data
        Route::get('/ajax', [ContentController::class, 'getContentAJAX'])->name('ajax');
    });

    // Orders - Using OrderController with full CRUD operations
    Route::prefix('orders')->name('orders.')->group(function () {
        // Display list of orders
        Route::get('/', [OrderController::class, 'index'])->name('index');

        // Show form to create new order
        Route::get('/create', [OrderController::class, 'create'])->name('create');

        // Store new order
        Route::post('/', [OrderController::class, 'store'])->name('store');

        // AJAX route for getting order data - MUST BE BEFORE {id} routes
        Route::get('/{id}/ajax', [OrderController::class, 'getOrderAJAX'])->name('ajax');

        // Update order status via AJAX - MUST BE BEFORE {id} routes  
        Route::patch('/{id}/status', [OrderController::class, 'updateStatus'])->name('updateStatus');

        // Show specific order detail
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');

        // Show form to edit order
        Route::get('/{id}/edit', [OrderController::class, 'edit'])->name('edit');

        // Update specific order
        Route::put('/{id}', [OrderController::class, 'update'])->name('update');

        // Delete specific order
        Route::delete('/{id}', [OrderController::class, 'destroy'])->name('destroy');
    });

    // Services - Using ServiceController with full CRUD operations
    Route::prefix('services')->name('services.')->group(function () {
        // Display list of services
        Route::get('/', [ServiceController::class, 'index'])->name('index');

        // Show form to create new service
        Route::get('/create', [ServiceController::class, 'create'])->name('create');

        // Store new service
        Route::post('/', [ServiceController::class, 'store'])->name('store');

        // Show specific service detail
        Route::get('/{id}', [ServiceController::class, 'show'])->name('show');

        // Show form to edit service
        Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('edit');

        // Update specific service
        Route::put('/{id}', [ServiceController::class, 'update'])->name('update');

        // Delete specific service
        Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('destroy');

        // AJAX route for deleting individual images
        Route::delete('/image/delete', [ServiceController::class, 'deleteImage'])->name('deleteImage');
    });

    // Testimonials - Using TestimonialController with full CRUD operations
    Route::prefix('testimonials')->name('testimonials.')->group(function () {
        // Display list of testimonials
        Route::get('/', [TestimonialController::class, 'index'])->name('index');

        // Show form to create new testimonial
        Route::get('/create', [TestimonialController::class, 'create'])->name('create');

        // Store new testimonial
        Route::post('/', [TestimonialController::class, 'store'])->name('store');

        // Show specific testimonial detail
        Route::get('/detail/{id}', [TestimonialController::class, 'show'])->name('show');

        // Show form to edit testimonial
        Route::get('/{id}/edit', [TestimonialController::class, 'edit'])->name('edit');

        // Update specific testimonial
        Route::put('/{id}', [TestimonialController::class, 'update'])->name('update');

        // Delete specific testimonial
        Route::delete('/{id}', [TestimonialController::class, 'destroy'])->name('destroy');

        // Verify testimonial
        Route::patch('/{id}/verify', [TestimonialController::class, 'verify'])->name('verify');

        // Toggle testimonial status
        Route::patch('/{id}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('toggleStatus');
    });

    // Galleries - Using GalleryController with full CRUD operations
    Route::prefix('galleries')->name('galleries.')->group(function () {
        // Display list of galleries
        Route::get('/', [GalleryController::class, 'index'])->name('index');

        // Show form to create new gallery
        Route::get('/create', [GalleryController::class, 'create'])->name('create');

        // Store new gallery
        Route::post('/', [GalleryController::class, 'store'])->name('store');

        // Show specific gallery detail
        Route::get('/detail/{id}', [GalleryController::class, 'show'])->name('detail');

        // Show form to edit gallery
        Route::get('/{id}/edit', [GalleryController::class, 'edit'])->name('edit');

        // Update specific gallery
        Route::put('/{id}', [GalleryController::class, 'update'])->name('update');

        // Delete specific gallery
        Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('destroy');
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
