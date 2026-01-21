@extends('admin.layouts.app')
@section('title', 'Edit Home Page - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <a href="{{ route('admin.pages') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h2>Edit Page: Home</h2>
        <button class="btn btn-primary" id="save-page-btn">Save Changes</button>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Hero Section -->
            <div class="card mb-4">
                <div class="card-header">Hero Section</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="hero_title" data-page-key="hero_title"
                            placeholder="Welcome to EMX Auto Repair">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="hero_description" data-page-key="hero_description"
                            placeholder="Enter hero description..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Hero Image/Video</label>
                        <div class="image-select-container">
                            <input type="hidden" id="hero_image" data-page-key="hero_image">
                            <div id="hero_image_preview"
                                style="width: 150px; height: 100px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px;">
                                <span class="text-muted">No Image</span>
                            </div>
                            <button class="btn btn-sm btn-secondary open-gallery-modal" data-input-target="#hero_image"
                                data-preview-target="#hero_image_preview">Select Media</button>
                            <button class="btn btn-sm btn-outline-danger remove-image-btn"
                                onclick="$('#hero_image').val(''); $('#hero_image_preview').html('<span class=\'text-muted\'>No Image</span>'); $(this).hide();"
                                style="display:none;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="card mb-4">
                <div class="card-header">About Section</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Section Title</label>
                        <input type="text" class="form-control" id="about_title" data-page-key="about_title"
                            placeholder="About Us">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" id="about_description" data-page-key="about_description"
                            placeholder="Enter about description..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <div class="image-select-container">
                            <input type="hidden" id="about_image" data-page-key="about_image">
                            <div id="about_image_preview"
                                style="width: 150px; height: 100px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px;">
                                <span class="text-muted">No Image</span>
                            </div>
                            <button class="btn btn-sm btn-secondary open-gallery-modal" data-input-target="#about_image"
                                data-preview-target="#about_image_preview">Select Image</button>
                            <button class="btn btn-sm btn-outline-danger remove-image-btn"
                                onclick="$('#about_image').val(''); $('#about_image_preview').html('<span class=\'text-muted\'>No Image</span>'); $(this).hide();"
                                style="display:none;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="card mb-4">
                <div class="card-header">Services Section (Front Page)</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="services_title" data-page-key="services_title"
                            placeholder="Our Services">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="services_description"
                            data-page-key="services_description" placeholder="Enter services description..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="card mb-4">
                <div class="card-header">Reviews Section</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="reviews_title" data-page-key="reviews_title"
                            placeholder="Customer Reviews">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="reviews_description" data-page-key="reviews_description"
                            placeholder="Enter reviews description..."></textarea>
                    </div>
                </div>
            </div>

            <!-- Location/Contact Section -->
            <div class="card mb-4">
                <div class="card-header">Location/Footer CTA</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" id="location_title" data-page-key="location_title"
                            placeholder="Visit Us">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" id="location_description"
                            data-page-key="location_description" placeholder="Enter location description..."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- SEO Settings -->
            <div class="card mb-4">
                <div class="card-header">SEO Settings</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Meta Title</label>
                        <input type="text" class="form-control" id="seo_title" placeholder="Home - EMX Auto Repair">
                    </div>
                    <div class="form-group">
                        <label>Meta Description</label>
                        <textarea class="form-control" rows="4" id="seo_description"
                            placeholder="Page description for search engines..."></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.partials.gallery-modal')

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-gallery-modal.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-page-manager.js') }}"></script>
    <script>
        $(document).ready(function () {
            PageManager.init('home');
        });
    </script>
@endsection