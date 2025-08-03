<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of testimonials.
     */
    public function index(Request $request)
    {
        $query = Testimonial::query();

        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('message', 'like', '%' . $request->search . '%');
        }

        $testimonials = $query->latest()->paginate(10);

        $viewData = [
            'title' => 'Testimonials',
            'testimonials' => $testimonials,
        ];

        return view('admin.testimonials.index', $viewData);
    }

    /**
     * Show the form for creating a new testimonial.
     */
    public function create()
    {
        $viewData = [
            'title' => 'Tambah Testimonial',
        ];

        return view('admin.testimonials.add', $viewData);
    }

    /**
     * Store a newly created testimonial in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->validateTestimonial($request);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'type_of_service',
            'rating',
            'name',
            'message',
            'status',
        ]);
        $data['is_verified'] = $request->has('is_verified') ? 1 : 0;

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    /**
     * Display the specified testimonial.
     */
    public function show($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $viewData = [
            'title' => 'Detail Testimonial',
            'testimonial' => $testimonial,
        ];

        return view('admin.testimonials.detail', $viewData);
    }

    /**
     * Show the form for editing the specified testimonial.
     */
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $viewData = [
            'title' => 'Edit Testimonial',
            'testimonial' => $testimonial,
        ];

        return view('admin.testimonials.edit', $viewData);
    }

    /**
     * Update the specified testimonial in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validateTestimonial($request, $id);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $testimonial->update([
            'type_of_service' => $request->type_of_service,
            'rating' => $request->rating,
            'name' => $request->name,
            'message' => $request->message,
            'is_verified' => $request->has('is_verified') ? 1 : 0,
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified testimonial from storage.
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted successfully.');
    }

    /**
     * Verify testimonial by changing status to active.
     */
    public function verify($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $data = [
            'status' => 'active',
            'is_verified' => 1
        ];

        $testimonial->update($data);

        return redirect()
            ->back()
            ->with('success', 'Testimonial verified and activated successfully.');
    }

    /**
     * Toggle testimonial status between active and inactive.
     */
    public function toggleStatus($id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if (!$testimonial) {
            return redirect()
                ->route('admin.testimonials.index')
                ->with('error', 'Testimonial not found.');
        }

        $newStatus = $testimonial->status == 'active' ? 'inactive' : 'active';
        $testimonial->update(['status' => $newStatus]);

        $statusText = $newStatus == 'active' ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "Testimonial berhasil {$statusText}.");
    }

    /**
     * Validate testimonial data.
     */
    private function validateTestimonial(Request $request, $id = null)
    {
        $rules = [
            'type_of_service' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'name' => 'required|string|max:255',
            'message' => 'required|string',
            'status' => 'required|in:pending,active,inactive'
        ];

        $messages = [
            'type_of_service.required' => 'Type of service is required.',
            'type_of_service.string' => 'Type of service must be a string.',
            'type_of_service.max' => 'Type of service must not exceed 255 characters.',
            'rating.required' => 'Rating is required.',
            'rating.integer' => 'Rating must be an integer.',
            'rating.min' => 'Rating must be at least 1.',
            'rating.max' => 'Rating must not exceed 5.',
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not exceed 255 characters.',
            'message.required' => 'Message is required.',
            'message.string' => 'Message must be a string.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be pending, active, or inactive.'
        ];

        return Validator::make($request->all(), $rules, $messages);
    }
}
