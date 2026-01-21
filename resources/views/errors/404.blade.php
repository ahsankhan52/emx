@extends('frontend.layouts.app')

@section('title', 'Page Not Found - EMX Auto Repair')

@section('styles')
    <style>
        .error-section {
            padding: 150px 0;
            text-align: center;
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .error-code {
            font-size: 8rem;
            font-weight: 900;
            color: var(--color-overlay-darkest);
            line-height: 1;
            margin-bottom: 20px;
        }

        .error-title {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--color-text-main);
        }

        .error-message {
            font-size: 1.2rem;
            color: var(--color-text-secondary);
            max-width: 600px;
            margin: 0 auto 40px;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--color-accent-500);
            color: var(--color-text-white);
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-home:hover {
            background-color: var(--color-accent-600);
            color: var(--color-text-white);
        }
    </style>
@endsection

@section('content')
    <section class="error-section">
        <div class="container">
            <div class="error-code">404</div>
            <h1 class="error-title">Page Not Found</h1>
            <p class="error-message">
                The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.
            </p>
            <a href="{{ route('home') }}" class="btn-home">Go Back Home</a>
        </div>
    </section>
@endsection