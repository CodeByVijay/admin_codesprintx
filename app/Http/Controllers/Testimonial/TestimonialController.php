<?php

namespace App\Http\Controllers\Testimonial;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderByDesc('created_at')->get();
        return view('pages.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|min:2|max:100',
            'client_position' => 'nullable|string|max:100',
            'client_company' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:1000',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        try {
            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('client_image')) {
                $imagePath = $request->file('client_image')->store('testimonials', 'public');
            }

            // Sanitize message to prevent XSS
            $message = strip_tags($validated['message']);

            Testimonial::create([
                'client_name' => $validated['client_name'],
                'client_position' => $validated['client_position'] ?? null,
                'client_company' => $validated['client_company'] ?? null,
                'message' => $message,
                'client_image' => $imagePath,
                'rating' => $validated['rating'],
                'is_featured' => $request->has('is_featured'),
                'is_active' => $request->has('is_active') ? true : true, // Default to true
            ]);

            return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while creating the testimonial: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('pages.testimonial.show', compact('testimonial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('pages.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|min:2|max:100',
            'client_position' => 'nullable|string|max:100',
            'client_company' => 'nullable|string|max:100',
            'message' => 'required|string|min:10|max:1000',
            'client_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'rating' => 'required|integer|min:1|max:5',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        try {
            $testimonial = Testimonial::findOrFail($id);

            // Handle image upload
            $imagePath = $testimonial->client_image;
            if ($request->hasFile('client_image')) {
                // Delete old image if exists
                if ($testimonial->client_image && Storage::disk('public')->exists($testimonial->client_image)) {
                    Storage::disk('public')->delete($testimonial->client_image);
                }
                $imagePath = $request->file('client_image')->store('testimonials', 'public');
            }

            // Sanitize message to prevent XSS
            $message = strip_tags($validated['message']);

            $testimonial->update([
                'client_name' => $validated['client_name'],
                'client_position' => $validated['client_position'] ?? null,
                'client_company' => $validated['client_company'] ?? null,
                'message' => $message,
                'client_image' => $imagePath,
                'rating' => $validated['rating'],
                'is_featured' => $request->has('is_featured'),
                'is_active' => $request->has('is_active') ? true : true,
            ]);

            return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating the testimonial: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);

            // Delete image if exists
            if ($testimonial->client_image && Storage::disk('public')->exists($testimonial->client_image)) {
                Storage::disk('public')->delete($testimonial->client_image);
            }

            $testimonial->delete();
            return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while deleting the testimonial: ' . $e->getMessage()]);
        }
    }
}
