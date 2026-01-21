<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Service;
use App\Models\Review;

class FrontendController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->firstOrFail();
        $services = Service::latest()->take(6)->get();
        $reviews = Review::latest()->get();

        return view('frontend.index', compact('page', 'services', 'reviews'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->firstOrFail();
        return view('frontend.about', compact('page'));
    }

    public function services()
    {
        $page = Page::where('slug', 'services')->firstOrFail();
        $services = Service::latest()->get();
        return view('frontend.services', compact('page', 'services'));
    }

    public function contact()
    {
        $page = Page::where('slug', 'contact')->firstOrFail();
        return view('frontend.contact', compact('page'));
    }

    public function location()
    {
        $page = Page::where('slug', 'location')->firstOrFail();
        return view('frontend.location', compact('page'));
    }

    public function terms()
    {
        $page = Page::where('slug', 'terms')->firstOrFail();
        return view('frontend.terms', compact('page'));
    }

    public function privacyPolicy()
    {
        $page = Page::where('slug', 'privacy')->firstOrFail();
        return view('frontend.privacy', compact('page'));
    }
}
