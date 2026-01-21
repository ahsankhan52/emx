@extends('admin.layouts.app')
@section('title', 'My Account - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <h2>My Account</h2>
    </div>

    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body">
            <form id="account-form">
                <div class="form-group text-center mb-4">
                    <!-- Image Selection -->
                    <div class="image-select-container d-flex flex-column align-items-center">
                        <input type="hidden" id="account-image">
                        <div class="profile-avatar mb-2 preview-img-box" id="account-image-preview"
                            style="width: 100px; height: 100px; border-radius: 50%; overflow: hidden; background: var(--color-bg-muted);">
                            <img src="https://ui-avatars.com/api/?name=Admin" alt="Profile"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-secondary open-gallery-modal"
                                data-input-target="#account-image" data-preview-target="#account-image-preview">Change
                                Photo</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" id="account-name" required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" id="account-email" required>
                </div>

                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" class="form-control" id="account-password"
                        placeholder="Leave blank to keep current">
                    <small class="text-muted">Min 8 characters</small>
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    @include('admin.partials.gallery-modal')

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-gallery-modal.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-account.js') }}"></script>
@endsection