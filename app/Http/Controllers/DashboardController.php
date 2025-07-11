<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Fetch dashboard statistics
        $totalCourses = Course::count();
        $activeCourses = Course::active()->count();
        $inactiveCourses = Course::inactive()->count();
        $totalTestimonials = Testimonial::count();
        $recentCourses = Course::orderBy('created_at', 'desc')->take(5)->get();
        $featuredTestimonials = Testimonial::where('is_featured', true)->take(3)->get();

        return view('pages.dashboard', compact(
            'totalCourses',
            'activeCourses',
            'inactiveCourses',
            'totalTestimonials',
            'recentCourses',
            'featuredTestimonials'
        ));
    }
}
