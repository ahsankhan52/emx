@extends('frontend.layouts.app')

@section('title', $page->seo_title ?? 'EMX Auto Diagnosis and Repair | Professional Auto Repair Services')

@section('content')
    <!-- Hero Section -->
    <section id="hero-section" class="hero-section"
        style="background-image: url('{{ asset('uploads/gallery/' . $page->content['hero_image']) ?? asset('uploads/gallery/hero.jpeg') }}');">
        <div class="container">
            <div class="hero-content">
                <h1>
                    @if (isset($page->content['hero_title']))
                        {!! str_replace(['{', '}'], ['<span class="accent">', '</span>'], e($page->content['hero_title'])) !!}
                    @else
                        Expert Auto Repair <span class="accent">You Can Trust</span>
                    @endif
                </h1>
                <p>
                    {{ $page->content['hero_description'] ?? 'Professional diagnosis and repair services for all makes and models. Fast, reliable, and affordable automotive solutions.' }}
                </p>
                <div class="hero-cta">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-large">
                        <i class="fas fa-phone"></i> Contact
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-secondary btn-large">
                        <i class="fas fa-wrench"></i> Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about-section" class="about-section section">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="{{ asset('uploads/gallery/' . $page->content['about_image']) ?? asset('uploads/gallery/about.avif') }}"
                        alt="EMX Auto Repair Workshop">
                </div>

                <div class="about-text">
                    <h2>
                        @if (isset($page->content['about_title']))
                            {!! str_replace(['{', '}'], ['<span class="highlight">', '</span>'], e($page->content['about_title'])) !!}
                        @else
                            Decades of <span class="highlight">Excellence</span> in Auto Repair
                        @endif
                    </h2>
                    <div class="about-description">
                        {!! $page->content['about_description'] ??
        '<p>At EMX Auto Diagnosis and Repair, we\'ve been serving our community with top-quality automotive services for over two decades.</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services-section" class="services-section section">
        <div class="container">
            <div class="section-title">
                <h2>{{ $page->content['services_title'] ?? 'Our Services' }}</h2>
                <p>{{ $page->content['services_description'] ?? 'Comprehensive automotive repair and maintenance services for all your vehicle needs' }}
                </p>
            </div>

            <div class="services-grid">
                @forelse($services as $service)
                    <div class="service-card">
                        <div class="service-img">
                            <img src="{{ asset('uploads/gallery/' . $service->image) }}" alt="{{ $service->title }}">
                        </div>
                        <div class="service-content">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ Str::limit(strip_tags($service->description), 120) }}</p>
                            <a href="{{ route('services') }}" class="service-link">
                                Learn More <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Our services will be listed here soon.</p>
                @endforelse
            </div>

            <div class="text-center margin-top-sm">
                <a href="{{ route('services') }}" class="btn btn-secondary">View All Services</a>
            </div>
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="reviews-section" class="reviews-section section section-bg-muted">
        <div class="container">
            <div class="section-title">
                <h2>{{ $page->content['reviews_title'] ?? 'What Our Customers Say' }}</h2>
                <p>{{ $page->content['reviews_description'] ?? 'Don\'t just take our word for it - hear from satisfied customers' }}
                </p>
            </div>

            <div class="reviews-swiper-wrapper">
                <div class="swiper reviews-swiper">
                    <div class="swiper-wrapper">
                        @forelse($reviews as $review)
                            <div class="swiper-slide">
                                <div class="review-card">
                                    <div class="review-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $review->stars ? '' : 'review-off' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="review-text">
                                        {{ $review->description }}
                                    </p>
                                    <div class="review-author">
                                        <div class="review-avatar">
                                            <!-- We will use initials of the name if ->user->image isn't there -->
                                            @if ($review->user->image)
                                                <img src="{{ asset('uploads/gallery/' . $review->user->image) }}"
                                                    alt="{{ $review->user->name }}">
                                            @else
                                                {{ strtoupper(substr($review->user->name, 0, 1)) }}{{ str_contains($review->user->name, ' ') ? strtoupper(substr(explode(' ', $review->user->name)[1], 0, 1)) : '' }}
                                            @endif
                                        </div>
                                        <div class="review-info">
                                            <h3>{{ $review->user->name }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <p class="text-center">No reviews yet. Be the first to leave one!</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="swiper-button-prev reviews-nav-prev" aria-label="Previous review"></div>
                <div class="swiper-button-next reviews-nav-next" aria-label="Next review"></div>
            </div>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location-section" class="location-section section">
        <div class="container">
            <div class="section-title">
                <h2>{{ $page->content['location_title'] ?? 'Visit Our Shop' }}</h2>
                <p>{{ $page->content['location_description'] ?? 'Located conveniently for easy access and quick service' }}
                </p>
            </div>

            <div class="location-content">
                <div class="location-map">
                    {!!
        ($settings['location_link'])
        ? '<iframe src="' . $settings['location_link'] . '" width="600" height="450" class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="EMX Auto Repair Location Map"></iframe>'
        : '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d347.09316260017414!2d-118.22366271239889!3d34.204610995785664!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2ea0dd8a7fe17%3A0x417c45b14f6cbe79!2sEMX%20AUTO!5e0!3m2!1sen!2s!4v1769371142676!5m2!1sen!2s" width="600" height="450" class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="EMX Auto Repair Location Map"></iframe>'
                                !!}
                </div>

                <div class="location-info">
                    <h3>Get In Touch</h3>

                    <div class="location-details">
                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Address</h4>
                                <p>{!! nl2br(e($settings['address'] ?? '2100 Verdugo Blvd, Montrose CA 91020')) !!}</p>
                            </div>
                        </div>

                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Phone</h4>
                                @if (isset($settings['phone_numbers']) && is_array($settings['phone_numbers']))
                                    @foreach ($settings['phone_numbers'] as $phone)
                                        <p><a href="tel:{{ $phone['number'] }}">{{ $phone['label'] }}:
                                                {{ $phone['number'] }}</a></p>
                                    @endforeach
                                @else
                                    <p><a href="tel:+18183309970">818-330-9970</a></p>
                                @endif
                            </div>
                        </div>

                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Email</h4>
                                <p><a href="mailto:{{ $settings['email'] ?? 'info@emxauto.com' }}">{{ $settings['email'] ??
                                        'info@emxauto.com' }}</a>
                                </p>
                            </div>
                        </div>

                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Business Hours</h4>
                                <p>
                                    @if (isset($settings['business_hours']) && is_array($settings['business_hours']))
                                        @foreach ($settings['business_hours'] as $day => $hours)
                                            {{ $day }}:
                                            {{ $hours['active'] ? $hours['start'] . ' - ' . $hours['end'] : 'Closed' }}<br>
                                        @endforeach
                                    @else
                                        Monday - Friday: 7:00 AM - 6:00 PM<br>
                                        Saturday: 8:00 AM - 4:00 PM<br>
                                        Sunday: Closed
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="location-cta">
                        <a href="{{ 'https://maps.google.com/?q=' . $settings['address'] ?? '' }}" target="_blank"
                            rel="noopener noreferrer" class="btn btn-primary btn-large">
                            <i class="fas fa-directions"></i> Get Directions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <!-- Reviews Swiper Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reviewsSwiper = new Swiper('.reviews-swiper', {
                loop: false,
                autoplay: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                centeredSlides: true,
                slidesPerView: 1,
                spaceBetween: 40,
                keyboard: {
                    enabled: true,
                    onlyInViewport: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
                navigation: {
                    nextEl: '.reviews-nav-next',
                    prevEl: '.reviews-nav-prev',
                },
                speed: 700,
                grabCursor: true,
                watchSlidesProgress: true,
            });

            // Pause on hover (desktop only)
            const swiperContainer = document.querySelector('.reviews-swiper');
            if (swiperContainer && window.innerWidth >= 1200) {
                swiperContainer.addEventListener('mouseenter', function () {
                    // Swiper doesn't have built-in autoplay, so this is for future enhancement
                    // Currently autoplay is disabled as per requirements
                });
            }

            // Handle reduced motion preference
            if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                reviewsSwiper.params.speed = 0;
                reviewsSwiper.update();
            }
        });
    </script>
@endsection