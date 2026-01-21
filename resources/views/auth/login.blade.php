@extends('frontend.layouts.app')

@section('title', 'Admin Login - EMX Auto Repair')
@section('meta_robots', 'noindex, nofollow')

@section('styles')
    <style>
        .login-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 70vh;
        }

        .login-card {
            background-color: var(--color-bg-main);
            padding: 50px 40px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-strong);
            width: 100%;
            max-width: 480px;
            border: 1px solid var(--color-border-subtle);
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            font-size: 2.25rem;
            font-weight: 800;
            margin-bottom: 12px;
            color: var(--color-text-primary);
        }

        .login-header p {
            color: var(--color-text-secondary);
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: var(--color-text-primary);
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 14px 18px;
            background-color: var(--color-bg-muted);
            border: 1px solid var(--color-border-subtle);
            border-radius: var(--radius-md);
            font-family: var(--font-primary);
            font-size: 1rem;
            color: var(--color-text-primary);
            transition: all var(--transition-fast);
        }

        .form-input:focus {
            outline: none;
            border-color: var(--color-accent-500);
            background-color: var(--color-bg-main);
            box-shadow: 0 0 0 3px var(--color-accent-100);

        }

        .btn-full {
            width: 100%;
            margin-top: 10px;
        }

        .login-alert {
            padding: 16px;
            border-radius: var(--radius-md);
            margin-bottom: 30px;
            font-weight: 500;
            font-size: 0.95rem;
            text-align: center;
            background-color: var(--color-accent-100);
            color: var(--color-accent-900);
            border: 1px solid var(--color-accent-300);
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 40px 25px;
            }

            .login-header h2 {
                font-size: 1.75rem;
            }

            .login-wrapper {
                min-height: auto;
                padding-top: 40px;
                padding-bottom: 40px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="section section-bg-muted">
        <div class="container login-wrapper">
            <div class="login-card fade-in-up">
                <div class="login-header">
                    <h2>Admin Login</h2>
                    <p>Secure access to the EMX portal</p>
                </div>

                @if ($errors->any())
                    <div class="login-alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required
                            autofocus placeholder="Email address">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-input" required
                            placeholder="Account password">
                    </div>

                    <button type="submit" class="btn btn-primary btn-full">Sign In to Dashboard</button>
                </form>
            </div>
        </div>
    </div>
@endsection