@extends('frontend.layouts.app')

@section('title', $page->seo_title ?? 'Contact Us | EMX Auto')
@section('description', $page->seo_description ?? 'Contact EMX Auto Diagnosis and Repair.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">
@endsection

@section('content')
    <section class="page-hero page-hero-bg-contact"
        style="background-image: url('uploads/gallery/{{ $page->content['banner_image'] ?? 'contact-banner.jpg' }}');">
        <div class="container">
            <div class="page-hero-content">
                <h1>{{ $page->content['banner_title'] ?? 'Contact Us' }}</h1>
                <p>{{ $page->content['banner_description'] ?? 'Get in touch with our team - we\'re here to help with all your automotive needs' }}
                </p>
            </div>
        </div>
    </section>

    <section class="contact-section section">
        <div class="container">
            <div class="contact-content centered-layout">
                <div class="contact-header">
                    <h2>{{ $page->content['form_title'] ?? 'Get In Touch' }}</h2>
                    <p>{{ $page->content['form_subtitle'] ?? 'We are here to help. Reach out to us via phone, email, or visit our shop.' }}
                    </p>
                </div>

                <div class="contact-info-centered">
                    <div class="contact-item-row">
                        <div class="contact-icon-circle">
                            <i class="fas fa-phone" aria-hidden="true"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Phone</h3>
                            <p>
                                @if (isset($settings['phone_numbers']) && is_array($settings['phone_numbers']))
                                    @foreach ($settings['phone_numbers'] as $phone)
                                        <a href="tel:{{ $phone['number'] }}">{{ $phone['label'] }}:
                                            {{ $phone['number'] }}</a><br>
                                    @endforeach
                                @else
                                    <a href="tel:+18183309970">Office: 818-330-9970</a>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="contact-item-row">
                        <div class="contact-icon-circle">
                            <i class="fas fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Email</h3>
                            <p><a href="mailto:{{ $settings['email'] ?? 'info@emxauto.com' }}">{{ $settings['email'] ??
                                    'info@emxauto.com' }}</a>
                            </p>
                        </div>
                    </div>

                    <div class="contact-item-row">
                        <div class="contact-icon-circle">
                            <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                        </div>
                        <div class="contact-text">
                            <h3>Address</h3>
                            <p>{!! nl2br(e($settings['address'] ?? '2100 Verdugo Blvd, Montrose, CA 91020')) !!}</p>
                        </div>
                    </div>
                </div>

                <div class="contact-social-centered">
                    <h3>Follow Us</h3>
                    <div class="social-icons-list">
                        @if (isset($settings['social_links']) && is_array($settings['social_links']))
                            @foreach ($settings['social_links'] as $platform => $data)
                                @if ($data['active'])
                                    <a href="{{ $data['url'] }}" class="social-icon-btn" aria-label="{{ $platform }} (opens in new tab)"
                                        target="_blank" rel="noopener noreferrer">
                                        <i aria-hidden="true"
                                            class="fab fa-{{ strtolower($platform) }}{{ strtolower($platform) === 'facebook' ? '-f' : '' }}"></i>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <a href="#" class="social-icon-btn" aria-label="Facebook"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                            <a href="#" class="social-icon-btn" aria-label="Instagram"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection