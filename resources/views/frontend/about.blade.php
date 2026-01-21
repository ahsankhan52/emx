@extends('frontend.layouts.app')

@section('title', $page->seo_title ?? 'About Us | EMX Auto Diagnosis and Repair')
@section('description', $page->seo_description ?? 'About EMX Auto Repair - Decades of excellence in automotive repair.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-about"
        style="background-image: url(uploads/gallery/{{ $page->content['banner_image'] ?? 'about-banner.jpg' }});">
        <div class="container">
            <div class="page-hero-content">
                <h1>{{ $page->content['banner_title'] ?? 'About EMX Auto' }}</h1>
                <p>{{ $page->content['banner_description'] ?? 'Decades of excellence in automotive repair and customer service' }}
                </p>
            </div>
        </div>
    </section>

    <!-- About Content -->
    <section class="about-section section">
        <div class="container">
            <div class="about-dynamic-content">
                @if (isset($page->content))
                    {!! $page->content['main_content'] !!}
                @else
                    <p>Add some content to show here.</p>
                @endif
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section">
        <div class="container">
            <div class="cta-section">
                <h2>{{ $page->content['cta_title'] ?? 'Ready to Experience Quality Service?' }}</h2>
                <p>
                    {{ $page->content['cta_description'] ?? 'Contact us today to schedule your appointment. We\'re here to help keep your vehicle running smoothly.' }}
                </p>
                <div class="cta-buttons">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-large">
                        <i class="fas fa-calendar-check"></i> Contact Us
                    </a>
                    @php
                        $phone = isset($settings['phone_numbers']) && count($settings['phone_numbers']) > 0 ? $settings['phone_numbers'][0]['number'] : '818-330-9970';
                    @endphp
                    <a href="tel:{{ $phone }}" class="btn btn-secondary btn-large">
                        <i class="fas fa-phone"></i> Call Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection