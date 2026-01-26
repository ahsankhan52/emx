<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="@yield('description', $settings['site_description'] ?? 'EMX Auto Diagnosis and Repair - Professional automotive repair services. Expert mechanics, quality service, fast turnaround.')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    @if(isset($page) && $page->seo_title)
        <title>{{ $page->seo_title }}</title>
    @else
        <title>
            @yield('title', $settings['site_title'] ?? 'EMX Auto Diagnosis and Repair | Professional Auto Repair Services')
        </title>
    @endif

    @if(isset($settings['favicon']) && $settings['favicon'])
        <link rel="icon" href="{{ asset('uploads/gallery/' . $settings['favicon']) }}" type="image/x-icon">
    @endif

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/reviews.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/location.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @yield('styles')
</head>

<body>

    <!-- Top Contact Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        @php
                            $firstPhone = isset($settings['phone_numbers']) && count($settings['phone_numbers']) > 0
                                ? $settings['phone_numbers'][0]
                                : ['label' => 'Phone', 'number' => '818-330-9970'];
                        @endphp
                        <a href="tel:{{ $firstPhone['number'] }}">{{ $firstPhone['label'] }}:
                            {{ $firstPhone['number'] }}</a>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $settings['address'] ?? '2100 Verdugo Blvd, Montrose CA 91020' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <header class="main-header">
        <div class="container">
            <div class="header-content">
                <a href="{{ route('home') }}" class="logo">
                    @if(isset($settings['logo']) && $settings['logo'])
                        <img src="{{ asset('uploads/gallery/' . $settings['logo']) }}"
                            alt="{{ $settings['company_name'] ?? 'EMX Auto Logo' }}">
                    @else
                        <img src="{{ asset('uploads/gallery/1.png') }}" alt="EMX Auto Logo">
                    @endif
                </a>

                <nav id="nav-menu" class="nav-menu">
                    <a href="{{ route('home') }}"
                        class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('services') }}"
                        class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Services</a>
                    <a href="{{ route('about') }}"
                        class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                    <a href="{{ route('location') }}"
                        class="nav-link {{ request()->routeIs('location') ? 'active' : '' }}">Location</a>
                    <a href="{{ route('contact') }}"
                        class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                </nav>

                <div class="header-content__r">
                    <button id="mobile-nav-toggle" class="mobile-nav-toggle" aria-label="Toggle navigation"
                        aria-expanded="false">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="contact" class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <div class="footer-logo">
                        @if(isset($settings['logo']) && $settings['logo'])
                            <img src="{{ asset('uploads/gallery/' . $settings['logo']) }}"
                                alt="{{ $settings['company_name'] ?? 'EMX Auto Logo' }}" style="max-height: 50px;">
                        @else
                            <span class="accent">EMX</span> Auto
                        @endif
                    </div>
                    <div class="footer-about">
                        <p>
                            {{ $settings['footer_about_text'] ?? 'Your trusted partner for professional auto diagnosis and repair services. Excellence in every repair, every time.' }}
                        </p>
                    </div>
                    <div class="footer-social">
                        @if(isset($settings['social_links']) && is_array($settings['social_links']))
                            @foreach($settings['social_links'] as $platform => $data)
                                @if($data['active'] == "true")
                                    <a href="{{ $data['url'] }}" class="social-link" aria-label="{{ $platform }} (opens in new tab)"
                                        target="_blank" rel="noopener noreferrer">
                                        <i
                                            class="fab fa-{{ strtolower($platform) }}{{ strtolower($platform) === 'facebook' ? '-f' : '' }}"></i>
                                    </a>
                                @endif
                            @endforeach
                        @else
                            <a href="#" class="social-link" aria-label="Facebook (opens in new tab)" target="_blank"
                                rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram (opens in new tab)" target="_blank"
                                rel="noopener noreferrer"><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <nav class="footer-links">
                        <a href="{{ route('home') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Home
                        </a>
                        <a href="{{ route('about') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> About Us
                        </a>
                        <a href="{{ route('services') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Services
                        </a>
                        <a href="{{ route('location') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Location
                        </a>
                        <a href="{{ route('contact') }}" class="footer-link">
                            <i class="fas fa-chevron-right"></i> Contact
                        </a>
                    </nav>
                </div>

                <div class="footer-column">
                    <h4>Services</h4>
                    <nav class="footer-links">
                        @foreach($footerServices as $service)
                            <a href="{{ route('services') }}" class="footer-link">
                                <i class="fas fa-chevron-right"></i> {{ $service->title }}
                            </a>
                        @endforeach
                    </nav>
                </div>

                <div class="footer-column">
                    <h4>Contact Info</h4>
                    <div class="footer-contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            {!! nl2br(e($settings['address'] ?? '2100 Verdugo Blvd, Montrose CA 91020')) !!}
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            @if (isset($settings['phone_numbers']) && is_array($settings['phone_numbers']))
                                @foreach ($settings['phone_numbers'] as $phone)
                                    {{ $phone['label'] }}: <a href="tel:{{ $phone['number'] }}">{{ $phone['number'] }}</a><br>
                                @endforeach
                            @else
                                Office: <a href="tel:+18183309970">818-330-9970</a><br>
                            @endif
                        </div>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $settings['email'] ?? 'info@emxauto.com' }}">{{ $settings['email'] ??
                            'info@emxauto.com' }}</a>
                    </div>
                    <div class="footer-contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            @if (isset($settings['business_hours']) && is_array($settings['business_hours']))
                                @if(isset($settings['business_hours']['Monday']))
                                    Mon-Fri:
                                    {{ $settings['business_hours']['Monday']['start'] }}-{{ $settings['business_hours']['Monday']['end'] }}<br>
                                @endif
                                @if(isset($settings['business_hours']['Saturday']))
                                    Sat:
                                    {{ $settings['business_hours']['Saturday']['active'] ? $settings['business_hours']['Saturday']['start'] . '-' . $settings['business_hours']['Saturday']['end'] : 'Closed' }}
                                @endif
                            @else
                                Mon-Fri: 7AM-6PM<br>
                                Sat: 8AM-4PM
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        {!! $settings['footer_text'] ?? '&copy; ' . date('Y') . ' EMX Auto Diagnosis and Repair. All rights reserved.' !!}
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- JavaScript Files -->
    <script src="{{ asset('assets/js/mobile-nav.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>