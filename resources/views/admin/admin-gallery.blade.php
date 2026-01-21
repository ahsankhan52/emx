@extends('admin.layouts.app')

@section('title', 'Gallery - EMX Auto Repair Admin')

@section('styles')
    <style>
        .gallery-upload-area {
            display: none;
            /* Hidden by default, triggered by button */
        }

        .gallery-img {
            height: 200px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--color-bg-muted);
        }

        .gallery-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover .gallery-img img {
            transform: scale(1.05);
        }

        .loading-spinner {
            text-align: center;
            padding: 40px;
            font-size: 1.2rem;
            color: var(--color-text-secondary);
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: var(--color-text-secondary);
            grid-column: 1 / -1;
        }
    </style>
@endsection

@section('content')
    <div class="section-header">
        <h2>Media Gallery</h2>

        <div class="header-actions" style="display: flex; gap: 10px; align-items: center;">
            <select id="gallery-sort" class="form-control" style="width: auto; display: inline-block;">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
            </select>

            <input type="file" id="gallery-upload-input" class="gallery-upload-area" multiple
                accept="image/jpeg,image/png,image/jpg,image/webp">
            <button class="btn btn-primary" id="upload-media-btn">
                <i class="fas fa-cloud-upload-alt"></i> Upload Media
            </button>
        </div>
    </div>

    <div class="gallery-status-bar" id="upload-status-area" style="display:none; margin-bottom: 20px;">
        <!-- Upload progress items will be injected here -->
    </div>

    <div class="gallery-grid" id="gallery-container">
        <div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading gallery...</div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script>
        $(document).ready(function () {
            // Initial Load
            loadGallery();

            // Trigger Upload
            $('#upload-media-btn').click(function () {
                $('#gallery-upload-input').click();
            });

            // Handle File Selection
            $('#gallery-upload-input').change(function (e) {
                const files = Array.from(e.target.files);
                if (!files.length) return;

                // Clear input value so same files can be selected again if needed
                $(this).val('');

                // Validate and process each file
                files.forEach(file => {
                    // Simple validation
                    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                    if (!validTypes.includes(file.type)) {
                        console.warn(`Skipped invalid file type: ${file.name}`);
                        return;
                    }

                    if (file.size > 5 * 1024 * 1024) { // 5MB
                        console.warn(`Skipped too large file: ${file.name}`);
                        return;
                    }

                    uploadImage(file);
                });
            });

            // Handle Sort Change
            $('#gallery-sort').change(function () {
                loadGallery($(this).val());
            });

            // Handle Delete
            $(document).on('click', '.delete-image-btn', function () {
                if (!confirm('Are you sure you want to delete this image?')) {
                    return false;
                }
                const id = $(this).data('id');
                deleteImage(id);
            });

        });

        function loadGallery(sort = 'newest') {
            const container = $('#gallery-container');
            // Only show full loading spinner if container is empty or we are doing a full refresh
            if (container.children().length === 0) {
                container.html('<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading gallery...</div>');
            }

            $.ajax({
                url: '/api/gallery?sort=' + sort,
                method: 'GET',
                success: function (response) {
                    // Don't wipe out uploading placeholders if any
                    const placeholders = container.find('.uploading-placeholder').detach();

                    container.empty();

                    // Re-append placeholders first (or last depending on sort, but usually first for visibility)
                    container.append(placeholders);

                    if (response.length === 0 && placeholders.length === 0) {
                        container.html('<div class="empty-state"><i class="fas fa-images fa-3x mb-3"></i><p>No images found in gallery.</p></div>');
                        return;
                    }

                    response.forEach(function (image) {
                        // Check if not already added via upload success
                        if ($(`#gallery-item-${image.id}`).length === 0) {
                            const card = createGalleryItemHtml(image);
                            container.append(card);
                        }
                    });
                },
                error: function (xhr) {
                    console.error(xhr);
                    container.html('<div class="empty-state text-danger">Failed to load gallery.</div>');
                }
            });
        }

        function createGalleryItemHtml(image) {
            return `
                                        <div class="gallery-item" id="gallery-item-${image.id}">
                                            <div class="gallery-img">
                                                <img src="${image.url}" alt="${image.original_name}">
                                            </div>
                                            <div class="gallery-actions">
                                                <button class="btn-icon text-danger delete-image-btn" data-id="${image.id}" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    `;
        }

        function uploadImage(file) {
            const container = $('#gallery-container');

            // Remove empty state if present
            container.find('.empty-state').remove();

            // Create a temporary placeholder ID
            const tempId = 'upload-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);

            // Create Uploading Placeholder Card
            const placeholder = `
                                        <div class="gallery-item uploading-placeholder" id="${tempId}">
                                            <div class="gallery-img" style="flex-direction: column;">
                                                <div class="spinner-border text-primary" role="status" style="margin-bottom: 10px;">
                                                     <i class="fas fa-spinner fa-spin fa-2x"></i>
                                                </div>
                                                <small class="text-muted" style="font-size: 0.8rem; text-align: center; padding: 0 5px; word-break: break-all;">
                                                    Uploading...
                                                </small>
                                            </div>
                                        </div>
                                    `;

            // Prepend to show immediately
            container.prepend(placeholder);

            const formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url: '/api/gallery',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Replace placeholder with actual image card
                    const newCard = createGalleryItemHtml(response.data);
                    $(`#${tempId}`).replaceWith(newCard);
                    // Highlight new item briefly
                    const newItem = $(`#gallery-item-${response.data.id}`);
                    newItem.css('box-shadow', '0 0 10px var(--color-success)');
                    setTimeout(() => newItem.css('box-shadow', ''), 2000);
                },
                error: function (xhr) {
                    // Show error state in card
                    const msg = xhr.responseJSON?.message || 'Failed';
                    $(`#${tempId}`).find('.gallery-img').html(`
                                                <i class="fas fa-exclamation-circle text-danger fa-2x mb-2"></i>
                                                <small class="text-danger" style="font-size: 0.8rem; text-align: center;">${msg}</small>
                                            `);

                    // Auto remove error card after 5 seconds
                    setTimeout(() => {
                        $(`#${tempId}`).fadeOut(300, function () { $(this).remove(); });
                    }, 5000);
                }
            });
        }

        function deleteImage(id) {
            $.ajax({
                url: '/api/gallery/' + id,
                method: 'DELETE',
                success: function () {
                    $(`#gallery-item-${id}`).fadeOut(300, function () {
                        $(this).remove();

                        if ($('#gallery-container').children('.gallery-item').length === 0) {
                            $('#gallery-container').html('<div class="empty-state"><i class="fas fa-images fa-3x mb-3"></i><p>No images found in gallery.</p></div>');
                        }
                    });
                },
                error: function (xhr) {
                    alert('Failed to delete image.');
                }
            });
        }
    </script>
@endsection