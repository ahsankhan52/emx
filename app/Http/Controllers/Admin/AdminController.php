<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Review;
use App\Models\User;
use App\Models\Gallery;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_services' => Service::count(),
            'total_reviews' => Review::count(),
            'average_rating' => Review::avg('stars') ?: 0,
            'total_users' => User::count(),
            'total_media' => Gallery::count(),
        ];

        $latestReviews = Review::with('user')->latest()->take(5)->get();
        $allServices = Service::latest()->take(5)->get();

        return view('admin.admin-dashboard', compact('stats', 'latestReviews', 'allServices'));
    }

    public function siteSettings()
    {
        return view('admin.admin-site-settings');
    }

    public function gallery()
    {
        return view('admin.admin-gallery');
    }

    public function services()
    {
        return view('admin.admin-services');
    }

    public function pages()
    {
        return view('admin.admin-pages');
    }

    public function users()
    {
        return view('admin.admin-users');
    }

    public function reviews()
    {
        return view('admin.admin-reviews');
    }

    public function account()
    {
        return view('admin.admin-account');
    }

    // Individual Page Editors
    public function pagesHome()
    {
        return view('admin.admin-pages__home');
    }

    public function pagesAbout()
    {
        return view('admin.admin-pages__about');
    }

    public function pagesContact()
    {
        return view('admin.admin-pages__contact');
    }

    public function pagesLocation()
    {
        return view('admin.admin-pages__location');
    }

    public function pagesPrivacy()
    {
        return view('admin.admin-pages__privacy');
    }

    public function pagesServices()
    {
        return view('admin.admin-pages__services');
    }

    public function pagesTerms()
    {
        return view('admin.admin-pages__terms');
    }
}
