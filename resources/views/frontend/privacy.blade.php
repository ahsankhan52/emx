@extends('frontend.layouts.app')

@section('title', 'Privacy Policy | EMX Auto Diagnosis and Repair')
@section('description', 'Privacy Policy - EMX Auto Diagnosis and Repair. Learn how we collect, use, and protect your personal information.')

@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/page-hero.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/legal.css') }}">
@endsection

@section('content')
    <!-- Page Hero Banner -->
    <section class="page-hero page-hero-bg-home">
        <div class="container">
            <div class="page-hero-content">
                <h1>Privacy Policy</h1>
                <p>Your privacy is important to us. Learn how we protect your information.</p>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="section section-bg-main">
        <div class="legal-content">
            <p><strong>Last Updated:</strong> January 2026</p>

            <h2>1. Introduction</h2>
            <p>
                EMX Auto Diagnosis and Repair ("we," "our," or "us") is committed to protecting your privacy.
                This Privacy Policy explains how we collect, use, disclose, and safeguard your information when
                you visit our website. Please read this privacy policy carefully.
            </p>

            <h2>2. Information We Collect</h2>
            <p>We may collect information about you in a variety of ways. The information we may collect includes:</p>

            <h3>2.1 Personal Data</h3>
            <p>
                Personally identifiable information that you voluntarily give to us when registering with the
                service or when you choose to participate in various activities related to the service, such as:
            </p>
            <ul>
                <li>Name</li>
                <li>Email address</li>
                <li>Phone number</li>
                <li>Mailing address</li>
                <li>Vehicle information</li>
                <li>Service history</li>
            </ul>

            <h3>2.2 Automatically Collected Information</h3>
            <p>
                When you access our website, we automatically collect certain information about your device,
                including information about your web browser, IP address, time zone, and some of the cookies
                that are installed on your device.
            </p>

            <h2>3. How We Use Your Information</h2>
            <p>We use the information we collect or receive:</p>
            <ul>
                <li>To provide, operate, and maintain our service</li>
                <li>To improve, personalize, and expand our service</li>
                <li>To understand and analyze how you use our service</li>
                <li>To develop new products, services, features, and functionality</li>
                <li>To communicate with you for customer service and support</li>
                <li>To process your transactions and manage your orders</li>
                <li>To send you updates, marketing communications, and promotional materials</li>
                <li>To find and prevent fraud</li>
            </ul>

            <h2>4. Disclosure of Your Information</h2>
            <p>
                We may share your information in certain situations described in this section and/or with the
                following third parties:
            </p>
            <ul>
                <li><strong>Business Transfers:</strong> We may share or transfer your information in connection
                    with any merger, sale of company assets, financing, or acquisition of all or a portion of our
                    business to another company.</li>
                <li><strong>Service Providers:</strong> We may share your information with third-party vendors,
                    service providers, contractors, or agents who perform services for us or on our behalf.</li>
                <li><strong>Legal Requirements:</strong> We may disclose your information where we are legally
                    required to do so in order to comply with applicable law, governmental requests, a judicial
                    proceeding, court order, or legal process.</li>
            </ul>

            <h2>5. Data Security</h2>
            <p>
                We use administrative, technical, and physical security measures to help protect your personal
                information. While we have taken reasonable steps to secure the personal information you provide
                to us, please be aware that despite our efforts, no security measures are perfect or impenetrable,
                and no method of data transmission can be guaranteed against any interception or other type of misuse.
            </p>

            <h2>6. Your Privacy Rights</h2>
            <p>
                Depending on your location, you may have certain rights regarding your personal information.
                These may include the right to:
            </p>
            <ul>
                <li>Access and receive a copy of your personal data</li>
                <li>Rectify inaccurate or incomplete personal data</li>
                <li>Request deletion of your personal data</li>
                <li>Object to processing of your personal data</li>
                <li>Request restriction of processing your personal data</li>
                <li>Request transfer of your personal data</li>
                <li>Withdraw consent at any time</li>
            </ul>

            <h2>7. Cookies and Tracking Technologies</h2>
            <p>
                We may use cookies and similar tracking technologies to track the activity on our service and
                store certain information. You can instruct your browser to refuse all cookies or to indicate
                when a cookie is being sent.
            </p>

            <h2>8. Children's Privacy</h2>
            <p>
                Our service is not intended for children under the age of 13. We do not knowingly collect
                personally identifiable information from children under 13. If you become aware that a child
                has provided us with personal information, please contact us.
            </p>

            <h2>9. Changes to This Privacy Policy</h2>
            <p>
                We may update our Privacy Policy from time to time. We will notify you of any changes by posting
                the new Privacy Policy on this page and updating the "Last Updated" date.
            </p>

            <h2>10. Contact Us</h2>
            <p>
                If you have questions or comments about this Privacy Policy, please contact us:
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