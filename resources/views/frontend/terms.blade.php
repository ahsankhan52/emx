@extends('frontend.layouts.app')

@section('title', 'Terms & Conditions | EMX Auto Diagnosis and Repair')
@section('description', 'Terms and Conditions - EMX Auto Diagnosis and Repair. Please read our terms of service before using our website.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/legal.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-home">
        <div class="container">
            <div class="page-hero-content">
                <h1>Terms & Conditions</h1>
                <p>Please read our terms of service carefully</p>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="section section-bg-main">
        <div class="legal-content">
            <p><strong>Last Updated:</strong> January 2026</p>

            <h2>1. Acceptance of Terms</h2>
            <p>
                By accessing and using this website, you accept and agree to be bound by the terms
                and provision of this agreement. If you do not agree to abide by the above, please
                do not use this service.
            </p>

            <h2>2. Use License</h2>
            <p>
                Permission is granted to temporarily download one copy of the materials on EMX Auto
                Diagnosis and Repair's website for personal, non-commercial transitory viewing only.
                This is the grant of a license, not a transfer of title, and under this license you may not:
            </p>
            <ul>
                <li>Modify or copy the materials</li>
                <li>Use the materials for any commercial purpose or for any public display</li>
                <li>Attempt to decompile or reverse engineer any software contained on the website</li>
                <li>Remove any copyright or other proprietary notations from the materials</li>
            </ul>

            <h2>3. Service Disclaimer</h2>
            <p>
                The materials on EMX Auto Diagnosis and Repair's website are provided on an 'as is' basis.
                EMX Auto Diagnosis and Repair makes no warranties, expressed or implied, and hereby
                disclaims and negates all other warranties including, without limitation, implied warranties
                or conditions of merchantability, fitness for a particular purpose, or non-infringement of
                intellectual property or other violation of rights.
            </p>

            <h2>4. Limitations</h2>
            <p>
                In no event shall EMX Auto Diagnosis and Repair or its suppliers be liable for any damages
                (including, without limitation, damages for loss of data or profit, or due to business
                interruption) arising out of the use or inability to use the materials on EMX Auto Diagnosis
                and Repair's website, even if EMX Auto Diagnosis and Repair or a EMX Auto Diagnosis and Repair
                authorized representative has been notified orally or in writing of the possibility of such damage.
            </p>

            <h2>5. Accuracy of Materials</h2>
            <p>
                The materials appearing on EMX Auto Diagnosis and Repair's website could include technical,
                typographical, or photographic errors. EMX Auto Diagnosis and Repair does not warrant that
                any of the materials on its website are accurate, complete, or current. EMX Auto Diagnosis
                and Repair may make changes to the materials contained on its website at any time without notice.
            </p>

            <h2>6. Links</h2>
            <p>
                EMX Auto Diagnosis and Repair has not reviewed all of the sites linked to its website and is
                not responsible for the contents of any such linked site. The inclusion of any link does not
                imply endorsement by EMX Auto Diagnosis and Repair of the site. Use of any such linked website
                is at the user's own risk.
            </p>

            <h2>7. Modifications</h2>
            <p>
                EMX Auto Diagnosis and Repair may revise these terms of service for its website at any time
                without notice. By using this website you are agreeing to be bound by the then current version
                of these terms of service.
            </p>

            <h2>8. Governing Law</h2>
            <p>
                These terms and conditions are governed by and construed in accordance with the laws of
                California, United States, and you irrevocably submit to the exclusive jurisdiction of the
                courts in that state or location.
            </p>

            <h2>9. Contact Information</h2>
            <p>
                If you have any questions about these Terms & Conditions, please contact us:
            </p>
            <p>
                <strong>EMX Auto Diagnosis and Repair</strong><br>
                2100 Verdugo Blvd<br>
                Montrose, CA 91020<br>
                Phone: <a href="tel:+18183309970">818-330-9970</a><br>
                Email: <a href="mailto:info@emxauto.com">info@emxauto.com</a>
            </p>
        </div>
    </section>
@endsection