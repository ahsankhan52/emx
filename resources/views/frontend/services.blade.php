@extends('frontend.layouts.app')

@section('title', $page->seo_title ?? 'Our Services | EMX Auto Diagnosis and Repair')
@section('description', $page->seo_description ?? 'EMX Auto Repair Services - Professional automotive repair and maintenance services.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-services"
        style="background-image: url('{{ asset('uploads/gallery') }}/{{ $page->content['banner_image'] ?? 'services-banner.jpg' }}');">
        <div class="container">
            <div class="page-hero-content">
                <h1>{{ $page->content['banner_title'] ?? 'Our Services' }}</h1>
                <p>{{ $page->content['banner_description'] ?? 'Comprehensive automotive repair and maintenance services for all your vehicle needs' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Services Content -->
    <section class="services-section section">
        <div class="container">
            <div class="services-grid">
                @forelse($services as $service)
                    <div class="service-card">
                        <div class="service-img">
                            <img src="{{ asset('uploads/gallery') }}/{{ $service->image ?? 'services-banner.jpg' }}"
                                alt="{{ $service->title }}">
                        </div>
                        <div class="service-content">
                            <h3>{{ $service->title }}</h3>
                            <div class="service-description">
                                {!! $service->description !!}
                            </div>
                            <a href="{{ route('contact') }}" class="service-link">
                                Book Service <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Our detailed services will be listed here soon.</p>
                @endforelse
            </div>

            <!-- CTA Section -->
            <div class="cta-section">
                <h2>{{ $page->content['cta_title'] ?? 'Ready to Schedule Service?' }}</h2>
                <p>
                    {{ $page->content['cta_description'] ?? 'Contact us today to schedule an appointment. Our experienced team is ready to help keep your vehicle running smoothly.' }}
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