@extends('admin.layouts.app')
@section('title', 'Edit Terms & Conditions - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <a href="{{ route('admin.pages') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
        <h2>Edit Page: Terms & Conditions</h2>
        <button class="btn btn-primary" id="save-page-btn">Save Changes</button>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Banner Settings -->
            <div class="card mb-4">
                <div class="card-header">Banner Settings</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Banner Title</label>
                        <input type="text" class="form-control" id="banner_title" data-page-key="banner_title"
                            placeholder="Terms & Conditions">
                    </div>
                    <div class="form-group">
                        <label>Banner Description</label>
                        <input type="text" class="form-control" id="banner_description" data-page-key="banner_description"
                            placeholder="Enter page description...">
                    </div>
                    <div class="form-group">
                        <label>Banner Image</label>
                        <div class="image-select-container">
                            <input type="hidden" id="banner_image" data-page-key="banner_image">
                            <div id="banner_image_preview"
                                style="width: 150px; height: 100px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 4px;">
                                <span class="text-muted">No Image</span>
                            </div>
                            <button class="btn btn-sm btn-secondary open-gallery-modal" data-input-target="#banner_image"
                                data-preview-target="#banner_image_preview">Select Image</button>
                            <button class="btn btn-sm btn-outline-danger remove-image-btn"
                                onclick="$('#banner_image').val(''); $('#banner_image_preview').html('<span class=\'text-muted\'>No Image</span>'); $(this).hide();"
                                style="display:none;">Remove</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="card mb-4">
                <div class="card-header">Terms Content</div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control" id="terms_content" data-page-key="terms_content"
                            rows="20"></textarea>
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
                        <input type="text" class="form-control" id="seo_title" placeholder="Terms - EMX Auto Repair">
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
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-gallery-modal.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-page-manager.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('terms_content');
            PageManager.init('terms');
        });
    </script>
@endsection