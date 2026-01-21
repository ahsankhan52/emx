/**
 * Shared Admin Gallery Modal Logic
 * Usage:
 * 1. Include 'admin.partials.gallery-modal' in your blade view.
 * 2. Include this script.
 * 3. Add class 'open-gallery-modal' to your trigger button.
 * 4. Add data attributes to trigger button:
 *    - data-input-target="#id-of-hidden-input"
 *    - data-preview-target="#id-of-preview-container"
 */

$(document).ready(function () {
    let activeInputTarget = null;
    let activePreviewTarget = null;
    let removeBtnTarget = null;

    // Open Gallery
    $(document).on('click', '.open-gallery-modal', function (e) {
        e.preventDefault();

        const btn = $(this);
        activeInputTarget = $(btn.data('input-target'));
        activePreviewTarget = $(btn.data('preview-target'));
        removeBtnTarget = btn.siblings('.btn-outline-danger'); // Assuming remove button is sibling

        // Reset state
        $('#modal-gallery-grid').html('<div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div>');
        $('#confirm-gallery-selection').prop('disabled', true);

        // Open Modal
        $('#gallery-modal').addClass('active');

        // Load Images
        loadGalleryImages('newest');
    });

    // Sort Gallery
    $('#gallery-modal-sort').on('change', function () {
        loadGalleryImages($(this).val());
    });

    // Select Image
    $(document).on('click', '#modal-gallery-grid .gallery-item', function () {
        $('#modal-gallery-grid .gallery-item').removeClass('selected');
        $(this).addClass('selected');
        $('#confirm-gallery-selection').prop('disabled', false);
    });

    // Confirm Selection
    $('#confirm-gallery-selection').on('click', function () {
        const selected = $('#modal-gallery-grid .gallery-item.selected');
        if (selected.length === 0) return;

        const url = selected.data('url');
        const filename = selected.data('filename');

        if (activeInputTarget) {
            activeInputTarget.val(filename).trigger('change');
        }

        if (activePreviewTarget) {
            activePreviewTarget.html(`<img src="${url}" style="width:100%; height:100%; object-fit:cover;">`);
        }

        if (removeBtnTarget) {
            removeBtnTarget.show();
        }

        $('#gallery-modal').removeClass('active');
    });

    // Load API Data
    function loadGalleryImages(sort) {
        const container = $('#modal-gallery-grid');

        $.ajax({
            url: '/api/gallery?sort=' + sort,
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                if (!response || response.length === 0) {
                    container.html('<div class="empty-state text-center p-4"><p class="text-muted">No images found in gallery.</p></div>');
                    return;
                }

                let html = '';
                response.forEach(img => {
                    html += `
                        <div class="gallery-item" data-url="${img.url}" data-filename="${img.file_name}">
                            <div class="gallery-img">
                                <img src="${img.url}" alt="${img.original_name}" loading="lazy">
                            </div>
                        </div>
                    `;
                });
                container.html(html);
            },
            error: function (xhr, status, error) {
                console.error('Gallery Load Error:', error);
                container.html(`
                    <div class="empty-state text-center p-4">
                        <p class="text-danger">Failed to load images.</p>
                        <button class="btn btn-sm btn-outline-secondary mt-2" onclick="loadGalleryImages('newest')">Try Again</button>
                    </div>
                `);
            }
        });
    }

    // Helper: Close modal triggers (if not already handled by admin-modals.js or similar)
    $('.close-modal').on('click', function () {
        $('#gallery-modal').removeClass('active');
    });
});
