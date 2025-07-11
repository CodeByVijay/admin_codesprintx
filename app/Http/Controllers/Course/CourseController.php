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
    public function index(Request $request)
    {
        $query = Course::orderByDesc('created_at');

        // Filter by status if provided
        if ($request->has('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->inactive();
            }
        }

        $courses = $query->get();
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
            'price_3_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'price_6_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'original_price_3_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'original_price_6_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'offer_end_at' => 'nullable|date|after:now',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ], [
            'price_3_month.regex' => 'The 3 month price must be a valid decimal number with up to 2 decimal places.',
            'price_6_month.regex' => 'The 6 month price must be a valid decimal number with up to 2 decimal places.',
            'original_price_3_month.regex' => 'The 3 month normal price must be a valid decimal number with up to 2 decimal places.',
            'original_price_6_month.regex' => 'The 6 month normal price must be a valid decimal number with up to 2 decimal places.',
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
                'price_3_month' => $validated['price_3_month'],
                'price_6_month' => $validated['price_6_month'],
                'original_price_3_month' => $validated['original_price_3_month'],
                'original_price_6_month' => $validated['original_price_6_month'],
                'offer_end_at' => $validated['offer_end_at'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'is_active' => $request->has('is_active') ? true : false,
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
            'price_3_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'price_6_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'original_price_3_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'original_price_6_month' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'offer_end_at' => 'nullable|date|after:now',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ], [
            'price_3_month.regex' => 'The 3 month price must be a valid decimal number with up to 2 decimal places.',
            'price_6_month.regex' => 'The 6 month price must be a valid decimal number with up to 2 decimal places.',
            'original_price_3_month.regex' => 'The 3 month normal price must be a valid decimal number with up to 2 decimal places.',
            'original_price_6_month.regex' => 'The 6 month normal price must be a valid decimal number with up to 2 decimal places.',
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
                'price_3_month' => $validated['price_3_month'],
                'price_6_month' => $validated['price_6_month'],
                'original_price_3_month' => $validated['original_price_3_month'],
                'original_price_6_month' => $validated['original_price_6_month'],
                'offer_end_at' => $validated['offer_end_at'] ?? null,
                'meta_description' => $validated['meta_description'] ?? null,
                'meta_keywords' => $validated['meta_keywords'] ?? null,
                'is_active' => $request->has('is_active') ? true : false,
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

    /**
     * Toggle the active status of the specified course.
     */
    public function toggleStatus(string $id)
    {
        try {
            $course = Course::findOrFail($id);
            $course->toggleStatus();

            $status = $course->is_active ? 'activated' : 'deactivated';
            return redirect()->route('courses.index')->with('success', "Course {$status} successfully.");
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred while updating course status.']);
        }
    }
}
