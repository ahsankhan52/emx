const PageManager = {
    slug: null,

    init: function (slug) {
        this.slug = slug;
        this.loadPage();
        this.bindEvents();
    },

    loadPage: function () {
        const self = this;
        // Show loading state if needed

        $.ajax({
            url: `/api/pages/${this.slug}`,
            method: 'GET',
            success: function (response) {
                if (response.content) {
                    self.populateFields(response.content);
                }
                if (response.seo_title) $('#seo_title').val(response.seo_title);
                if (response.seo_description) $('#seo_description').val(response.seo_description);
            },
            error: function () {
                alert('Failed to load page data.');
            }
        });
    },

    populateFields: function (content) {
        $('[data-page-key]').each(function () {
            const key = $(this).data('page-key');
            if (content[key] !== undefined) {
                const value = content[key];
                const $el = $(this);

                $el.val(value);

                // CKEditor handling
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances[$el.attr('id')]) {
                    CKEDITOR.instances[$el.attr('id')].setData(value);
                }

                // Image Preview Logic
                const inputId = $el.attr('id');
                if (inputId) {
                    const $btn = $(`.open-gallery-modal[data-input-target="#${inputId}"]`);
                    if ($btn.length) {
                        const previewSelector = $btn.data('preview-target');
                        if (previewSelector) {
                            const $preview = $(previewSelector);
                            if (value) {
                                const imgUrl = value.startsWith('http') ? value : `/uploads/gallery/${value}`;
                                $preview.html(`<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover;">`);
                                const $removeBtn = $btn.siblings('.remove-image-btn');
                                if ($removeBtn.length) $removeBtn.show();
                            }
                        }
                    }
                }
            }
        });
    },

    bindEvents: function () {
        const self = this;
        $('#save-page-btn').click(function () {
            // Sync CKEditor instances if present
            if (typeof CKEDITOR !== 'undefined') {
                for (const instance in CKEDITOR.instances) {
                    CKEDITOR.instances[instance].updateElement();
                }
            }

            const data = {
                content: {},
                seo_title: $('#seo_title').val(),
                seo_description: $('#seo_description').val()
            };

            $('[data-page-key]').each(function () {
                const key = $(this).data('page-key');
                data.content[key] = $(this).val();
            });

            // Prevent double click
            const $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

            $.ajax({
                url: `/api/pages/${self.slug}`,
                method: 'PUT',
                data: data,
                success: function () {
                    alert('Page saved successfully!');
                },
                error: function (xhr) {
                    alert('Error: ' + (xhr.responseJSON.message || 'Failed to save page'));
                },
                complete: function () {
                    $btn.prop('disabled', false).text('Save Changes');
                }
            });
        });
    }
};
