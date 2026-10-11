@extends('frontend.layouts.app')

@section('title', 'Accessibility Statement | EMX Auto Diagnosis and Repair')
@section('description', 'Our commitment to digital accessibility. EMX Auto Diagnosis and Repair aims to conform to WCAG 2.2 Level AA.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/legal.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-home">
        <div class="container">
            <div class="page-hero-content">
                <h1>Accessibility Statement</h1>
                <p>We are committed to making our website accessible to everyone.</p>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="section section-bg-main">
        <div class="legal-content">
            <p><strong>Last Updated:</strong> {{ date('F Y') }}</p>

            <h2>Our Commitment</h2>
            <p>
                EMX Auto Diagnosis and Repair is committed to ensuring digital accessibility for people with
                disabilities. We are continually improving the user experience for everyone and applying the
                relevant accessibility standards.
            </p>

            <h2>Conformance Status</h2>
            <p>
                We aim to conform to the <strong>Web Content Accessibility Guidelines (WCAG) 2.2, Level AA</strong>.
                These guidelines explain how to make web content more accessible for people with a wide range of
                disabilities, and are the standard referenced by the U.S. Department of Justice and the courts under
                the Americans with Disabilities Act (ADA).
            </p>

            <h2>Measures We Take</h2>
            <ul>
                <li>Clear, consistent navigation and a "skip to main content" link on every page</li>
                <li>Full keyboard operability with visible focus indicators</li>
                <li>Color contrast that meets WCAG AA ratios for text and interactive elements</li>
                <li>Meaningful text alternatives for images and controls</li>
                <li>Semantic headings and page structure so assistive technology works correctly</li>
                <li>Layouts that reflow and remain usable when text is enlarged up to 200%</li>
                <li>Support for users who prefer reduced motion</li>
            </ul>

            <h2>Known Limitations</h2>
            <p>
                Some content is provided by third parties (for example, the embedded Google Map). While we work to
                choose accessible providers, we may not have full control over such content. If you encounter a
                barrier, please let us know and we will provide the information in an alternative format.
            </p>

            <h2>Feedback &amp; Contact</h2>
            <p>
                We welcome your feedback on the accessibility of our website. If you experience any difficulty
                accessing any part of this site, or need assistance, please contact us:
            </p>
            <p>
                <strong>EMX Auto Diagnosis and Repair</strong><br>
                {!! nl2br(e($settings['address'] ?? '2100 Verdugo Blvd, Montrose, CA 91020')) !!}<br>
                @php
                    $phone = isset($settings['phone_numbers']) && is_array($settings['phone_numbers']) && count($settings['phone_numbers']) > 0
                        ? $settings['phone_numbers'][0]['number']
                        : '818-330-9970';
                @endphp
                Phone: <a href="tel:{{ $phone }}">{{ $phone }}</a><br>
                Email:
                <a href="mailto:{{ $settings['email'] ?? 'info@emxauto.com' }}">{{ $settings['email'] ?? 'info@emxauto.com' }}</a>
            </p>
            <p>
                We aim to respond to accessibility feedback within 5 business days.
            </p>
        </div>
    </section>
@endsection
