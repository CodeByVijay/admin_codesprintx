<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::orderByDesc('created_at')->get();
        return view('pages.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.course.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100',
            'icon' => [
                'required',
                'string',
                'max:100',
                'regex:/^fa[a-z0-9\- ]+$/i', // basic FontAwesome class check
            ],
            'bg_color' => [
                'required',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/', // hex color
            ],
            'short_desc' => 'required|string|min:20|max:300',
            'long_desc' => 'required|string',
            'skills' => 'required|string', // comma separated, will be converted to array
            'projects' => 'required|array|min:1',
            'projects.*.name' => 'required|string|max:100',
            'projects.*.description' => 'required|string|max:255',
            'what_you_learn' => 'nullable|array',
            'what_you_learn.*' => 'required|string|max:255',
            'price_3_month' => 'nullable|numeric|min:0',
            'price_6_month' => 'nullable|numeric|min:0',
            'original_price_3_month' => 'nullable|numeric|min:0',
            'original_price_6_month' => 'nullable|numeric|min:0',
            'offer_end_at' => 'nullable|date|after:now',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);
        try {
            // Sanitize and prepare data
            $skills = array_map('trim', explode(',', $validated['skills']));
            $projects = $validated['projects'];
            $whatYouLearn = isset($validated['what_you_learn']) ? array_values(array_filter($validated['what_you_learn'], fn($v) => $v !== null && $v !== '')) : [];

            // Prevent XSS in descriptions
            $short_desc = strip_tags($validated['short_desc']);
            $long_desc = strip_tags($validated['long_desc']);

            Course::create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'icon' => $validated['icon'],
                'bg_color' => $validated['bg_color'],
                'short_desc' => $short_desc,
                'long_desc' => $long_desc,
                'skills' => json_encode($skills),
                'projects' => json_encode($projects),
                'what_you_learn' => json_encode($whatYouLearn),
                'price_3_month' => $validated['price_3_month'] ?? null,
                'price_6_month' => $validated['price_6_month'] ?? null,
                'original_price_3_month' => $validated['original_price_3_month'] ?? null,
                'original_price_6_month' => $validated['original_price_6_month'] ?? null,
                'offer_end_at' => $validated['offer_end_at'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
            ]);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while creating the course.' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::findOrFail($id);
        return view('pages.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = Course::findOrFail($id);
        return view('pages.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:5|max:100',
            'icon' => [
                'required',
                'string',
                'max:100',
                'regex:/^fa[a-z0-9\- ]+$/i',
            ],
            'bg_color' => [
                'required',
                'string',
                'regex:/^#[0-9A-Fa-f]{6}$/',
            ],
            'short_desc' => 'required|string|min:20|max:300',
            'long_desc' => 'required|string',
            'skills' => 'required|string',
            'projects' => 'required|array|min:1',
            'projects.*.name' => 'required|string|max:100',
            'projects.*.description' => 'required|string|max:255',
            'what_you_learn' => 'nullable|array',
            'what_you_learn.*' => 'required|string|max:255',
            'price_3_month' => 'nullable|numeric|min:0',
            'price_6_month' => 'nullable|numeric|min:0',
            'original_price_3_month' => 'nullable|numeric|min:0',
            'original_price_6_month' => 'nullable|numeric|min:0',
            'offer_end_at' => 'nullable|date|after:now',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ]);
        try {
            $course = Course::findOrFail($id);
            $skills = array_map('trim', explode(',', $validated['skills']));
            // Re-index projects to ensure sequential keys (prevents PHP array gaps)
            $projects = array_values($validated['projects']);
            $whatYouLearn = isset($validated['what_you_learn']) ? array_values(array_filter($validated['what_you_learn'], fn($v) => $v !== null && $v !== '')) : [];
            $short_desc = strip_tags($validated['short_desc']);
            $long_desc = strip_tags($validated['long_desc']);
            $course->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'icon' => $validated['icon'],
                'bg_color' => $validated['bg_color'],
                'short_desc' => $short_desc,
                'long_desc' => $long_desc,
                'skills' => json_encode($skills),
                'projects' => json_encode($projects),
                'what_you_learn' => json_encode($whatYouLearn),
                'price_3_month' => $validated['price_3_month'] ?? null,
                'price_6_month' => $validated['price_6_month'] ?? null,
                'original_price_3_month' => $validated['original_price_3_month'] ?? null,
                'original_price_6_month' => $validated['original_price_6_month'] ?? null,
                'offer_end_at' => $validated['offer_end_at'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
            ]);
            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating the course.' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
