<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //   // Example: Fetch some data for the dashboard
        //     $totalUsers = User::count();
        //     $totalPosts = Post::count();
        //     $latestPosts = Post::orderBy('created_at', 'desc')->take(5)->get();

        //     // You can also define breadcrumbs and page title here
        //     $breadcrumbs = [
        //         ['label' => 'Home', 'url' => route('home')],
        //         ['label' => 'Dashboard', 'url' => '']
        //     ];
        //     $pageTitle = 'Admin Dashboard';

        //     // Return the dashboard view, passing any necessary data
        //     return view('dashboard.index', compact('totalUsers', 'totalPosts', 'latestPosts', 'breadcrumbs', 'pageTitle'));
        return view('pages.dashboard');
    }
}
