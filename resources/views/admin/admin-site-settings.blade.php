@extends('admin.layouts.app')

@section('title', 'Site Settings - EMX Auto Repair Admin')

@section('content')
    <div class="section-header">
        <h2>Site Settings</h2>
    </div>

    <form id="settings-form" class="admin-form">
        <!-- General Info -->
        <div class="card">
            <div class="card-header">General Info</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Company Name</label>
                    <input type="text" class="form-control" id="company_name">
                </div>
                <div class="form-group">
                    <label>Site Title</label>
                    <input type="text" class="form-control" id="site_title">
                </div>
                <div class="form-group">
                    <label>Site Description</label>
                    <input type="text" class="form-control" id="site_description">
                </div>
                <div class="form-group">
                    <label>Logo</label>
                    <div class="image-select-container">
                        <input type="hidden" id="logo">
                        <div class="preview-img-box" id="logo-preview"
                            style="width: 150px; height: 60px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <span class="text-muted small">No Logo</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary open-gallery-modal" data-input-target="#logo"
                            data-preview-target="#logo-preview">Change Logo</button>
                    </div>
                </div>
                <div class="form-group">
                    <label>Favicon</label>
                    <div class="image-select-container">
                        <input type="hidden" id="favicon">
                        <div class="preview-img-box" id="favicon-preview"
                            style="width: 40px; height: 40px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            <span class="text-muted small">icon</span>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary open-gallery-modal"
                            data-input-target="#favicon" data-preview-target="#favicon-preview">Change Favicon</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="card">
            <div class="card-header">Contact Information</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="email">
                </div>

                <div class="form-group">
                    <label>Phone Numbers</label>
                    <div id="phone-numbers-list">
                        <!-- Populated via JS -->
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="add-phone-btn">+ Add
                        Phone</button>
                </div>

                <div class="form-group mt-3">
                    <label>Address</label>
                    <input type="text" class="form-control" id="address">
                </div>

                <div class="form-group">
                    <label>Location Map Link</label>
                    <input type="url" class="form-control" id="location_link">
                </div>
            </div>
        </div>

        <!-- Business Hours -->
        <div class="card">
            <div class="card-header">Business Hours</div>
            <div class="card-body">
                <div class="business-hours-container">
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <div class="hours-row" data-day="{{ $day }}">
                            <div class="day-label">{{ $day }}</div>
                            <div class="day-toggle">
                                <label class="switch">
                                    <input type="checkbox" class="day-active" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="day-times">
                                <input type="time" class="form-control form-control-inline day-start" value="09:00">
                                <span>to</span>
                                <input type="time" class="form-control form-control-inline day-end" value="17:00">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Social Links -->
        <div class="card">
            <div class="card-header">Social Links</div>
            <div class="card-body">
                <div class="social-links-container">
                    @foreach(['Facebook' => 'facebook-f', 'Instagram' => 'instagram', 'LinkedIn' => 'linkedin-in', 'Twitter' => 'twitter', 'YouTube' => 'youtube'] as $platform => $icon)
                        <div class="social-row" data-platform="{{ $platform }}">
                            <div class="social-icon"><i class="fab fa-{{ $icon }}"></i></div>
                            <div class="social-label">{{ $platform }}</div>
                            <div class="social-input">
                                <input type="url" class="form-control social-url"
                                    placeholder="https://{{ strtolower($platform) }}.com/...">
                            </div>
                            <div class="social-toggle">
                                <label class="switch">
                                    <input type="checkbox" class="social-active">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer Text -->
        <div class="card">
            <div class="card-header">Footer Text</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Footer Content</label>
                    <textarea class="form-control" id="footer_text" rows="8"></textarea>
                </div>
            </div>
        </div>

        <div class="form-actions sticky-bottom">
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </div>
    </form>

    @include('admin.partials.gallery-modal')
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-gallery-modal.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-settings.js') }}"></script>
@endsection