$(document).ready(function () {
    loadSettings();

    // Initialize CKEditor
    if ($('#footer_text').length) {
        CKEDITOR.replace('footer_text');
    }

    // Phone Numbers - Add Row
    $('#add-phone-btn').click(function () {
        const row = `
            <div class="phone-item mb-2" style="display: flex; gap: 10px;">
                <input type="text" class="form-control form-control-inline phone-label" placeholder="Label (e.g. Office)" style="width: 150px;">
                <input type="text" class="form-control form-control-inline phone-number" placeholder="Number">
                <button type="button" class="btn btn-sm btn-danger remove-phone-btn"><i class="fas fa-trash"></i></button>
            </div>
        `;
        $('#phone-numbers-list').append(row);
    });

    // Phone Numbers - Remove Row
    $(document).on('click', '.remove-phone-btn', function () {
        $(this).closest('.phone-item').remove();
    });

    // Save Settings
    $('#settings-form').submit(function (e) {
        e.preventDefault();
        saveSettings();
    });
});

function loadSettings() {
    $.ajax({
        url: '/api/settings',
        method: 'GET',
        success: function (response) {
            // Simple Fields
            const simpleFields = ['company_name', 'site_title', 'site_description', 'email', 'address', 'location_link'];
            simpleFields.forEach(field => {
                if (response[field]) $(`#${field}`).val(response[field]);
            });

            // Images
            if (response.logo) {
                $('#logo').val(response.logo);
                updateImagePreview('#logo', response.logo);
            }
            if (response.favicon) {
                $('#favicon').val(response.favicon);
                updateImagePreview('#favicon', response.favicon);
            }

            // Footer Text
            if (response.footer_text && CKEDITOR.instances.footer_text) {
                CKEDITOR.instances.footer_text.setData(response.footer_text);
            }

            // Phone Numbers
            if (response.phone_numbers) {
                const phones = typeof response.phone_numbers === 'string' ? JSON.parse(response.phone_numbers) : response.phone_numbers;
                $('#phone-numbers-list').empty();
                phones.forEach(p => {
                    const row = `
                        <div class="phone-item mb-2" style="display: flex; gap: 10px;">
                            <input type="text" class="form-control form-control-inline phone-label" value="${p.label}" placeholder="Label" style="width: 150px;">
                            <input type="text" class="form-control form-control-inline phone-number" value="${p.number}" placeholder="Number">
                            <button type="button" class="btn btn-sm btn-danger remove-phone-btn"><i class="fas fa-trash"></i></button>
                        </div>
                    `;
                    $('#phone-numbers-list').append(row);
                });
            }

            // Business Hours
            if (response.business_hours) {
                const hours = typeof response.business_hours === 'string' ? JSON.parse(response.business_hours) : response.business_hours;
                for (const [day, data] of Object.entries(hours)) {
                    const $row = $(`.hours-row[data-day="${day}"]`);
                    if ($row.length) {
                        // Handle string 'true'/'false' or boolean
                        const isActive = data.active === true || data.active === 'true';

                        $row.find('.day-active').prop('checked', isActive);
                        $row.find('.day-start').val(data.start);
                        $row.find('.day-end').val(data.end);

                        if (!isActive) {
                            $row.find('.day-times input').prop('disabled', true);
                            $row.find('.day-times').addClass('disabled');
                        } else {
                            $row.find('.day-times input').prop('disabled', false);
                            $row.find('.day-times').removeClass('disabled');
                        }
                    }
                }
            }

            // Social Links
            if (response.social_links) {
                const social = typeof response.social_links === 'string' ? JSON.parse(response.social_links) : response.social_links;
                for (const [platform, data] of Object.entries(social)) {
                    const $row = $(`.social-row[data-platform="${platform}"]`);
                    if ($row.length) {
                        const isActive = data.active === true || data.active === 'true';

                        $row.find('.social-active').prop('checked', isActive);
                        $row.find('.social-url').val(data.url);

                        // Disable if inactive
                        if (!isActive) {
                            $row.find('.social-input input').prop('disabled', true);
                        } else {
                            $row.find('.social-input input').prop('disabled', false);
                        }
                    }
                }
            }
        },
        error: function () {
            alert('Failed to load settings.');
        }
    });

    // Business Hours Toggle Logic
    $(document).on('change', '.day-active', function () {
        const $row = $(this).closest('.hours-row');
        const isActive = $(this).is(':checked');
        $row.find('.day-times input').prop('disabled', !isActive);
        if (!isActive) $row.find('.day-times').addClass('disabled');
        else $row.find('.day-times').removeClass('disabled');
    });

    // Social Links Toggle Logic
    $(document).on('change', '.social-active', function () {
        const $row = $(this).closest('.social-row');
        const isActive = $(this).is(':checked');
        $row.find('.social-input input').prop('disabled', !isActive);
    });
}

function saveSettings() {
    const data = {};

    // Simple Fields
    ['company_name', 'site_title', 'site_description', 'email', 'address', 'location_link', 'logo', 'favicon'].forEach(f => {
        data[f] = $(`#${f}`).val();
    });

    // Footer Text
    if (CKEDITOR.instances.footer_text) {
        data['footer_text'] = CKEDITOR.instances.footer_text.getData();
    }

    // Phone Numbers
    const phones = [];
    $('#phone-numbers-list .phone-item').each(function () {
        const label = $(this).find('.phone-label').val();
        const number = $(this).find('.phone-number').val();
        if (number) phones.push({ label, number });
    });
    data['phone_numbers'] = phones;

    // Business Hours
    const hours = {};
    $('.hours-row').each(function () {
        const day = $(this).data('day');
        hours[day] = {
            active: $(this).find('.day-active').is(':checked'),
            start: $(this).find('.day-start').val(),
            end: $(this).find('.day-end').val()
        };
    });
    data['business_hours'] = hours;

    // Social Links
    const social = {};
    $('.social-row').each(function () {
        const platform = $(this).data('platform');
        social[platform] = {
            active: $(this).find('.social-active').is(':checked'),
            url: $(this).find('.social-url').val()
        };
    });
    data['social_links'] = social;

    // Submit
    const $btn = $('button[type="submit"]');
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: '/api/settings',
        method: 'POST',
        data: data,
        success: function () {
            alert('Settings saved successfully!');
        },
        error: function (xhr) {
            alert('Error: ' + (xhr.responseJSON.message || 'Failed to save settings'));
        },
        complete: function () {
            $btn.prop('disabled', false).text('Save Changes');
        }
    });
}

function updateImagePreview(inputSelector, val) {
    if (!val) return;
    const imgUrl = val.startsWith('http') ? val : `/uploads/gallery/${val}`;
    const $container = $(inputSelector).closest('.image-select-container');
    // Check if there is an img tag inside .preview-img-box
    const $img = $container.find('.preview-img-box img');
    if ($img.length) {
        $img.attr('src', imgUrl);
    } else {
        $container.find('.preview-img-box').html(`<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover;">`);
    }
}
