@extends('frontend.layouts.app')

@section('title', $page->seo_title ?? 'Location | EMX Auto Diagnosis and Repair')
@section('description', $page->seo_description ?? 'EMX Auto Repair Location - Visit our shop and get directions.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/location.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-location"
        style="background-image: url('uploads/gallery/{{ $page->content['banner_image'] ?? 'location-banner.jpg' }}');">
        <div class="container">
            <div class="page-hero-content">
                <h1>{{ $page->content['banner_title'] ?? 'Visit Our Shop' }}</h1>
                <p>{{ $page->content['banner_description'] ?? 'Located conveniently for easy access and quick service' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Location Content -->
    <section class="location-section section">
        <div class="container">
            <div class="location-content">
                <div class="location-map">
                    {!!
        $settings['location_link']
        ?
        '<iframe src="' . $settings['location_link'] . '" width="600" height="450" class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="EMX Auto Repair Location Map"></iframe>'
        :
        '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3301.8898272814595!2d-118.15274118939737!3d34.149160673008495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c33114b97839%3A0x421aae1db8562bf7!2sEMX%20Auto%20Repair!5e0!3m2!1sen!2s!4v1767919365751!5m2!1sen!2s" width="600" height="450" class="map-iframe" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="EMX Auto Repair Location Map"></iframe>'
                            !!}
                </div>

                <div class="location-info">
                    <h3>{{ $page->content['info_title'] ?? 'Get In Touch' }}</h3>

                    <div class="location-details">
                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Address</h4>
                                <p>{!! nl2br(e($settings['address'] ?? '2100 Verdugo Blvd, Montrose, CA 91020')) !!}</p>
                            </div>
                        </div>

                        <div class="location-detail">
                            <div class="location-detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="location-detail-content">
                                <h4>Phone</h4>
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

                    <div class="location-cta location-cta-buttons">
                        <a href="{{ $settings['location_link'] ?? 'https://maps.google.com/?q=EMX+AUTO,+2100+Verdugo+Blvd,+Montrose,+CA+91020' }}"
                            target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-large">
                            <i class="fas fa-directions"></i> Get Directions
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-secondary btn-large">
                            <i class="fas fa-envelope"></i> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection