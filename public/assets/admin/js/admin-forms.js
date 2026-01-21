$(document).ready(function () {

    // Generic Save Handling
    $('form').on('submit', function (e) {
        e.preventDefault();
        // Simulate API call
        const btn = $(this).find('button[type="submit"]');
        const originalText = btn.text();
        btn.text('Saving...').prop('disabled', true);

        /* setTimeout(() => {
            btn.text(originalText).prop('disabled', false);
            alert('Changes saved successfully!');
        }, 800); */
    });

    $('#save-item-btn').on('click', function () {
        // Simulate API call for modal forms
        const btn = $(this);
        const originalText = btn.text();
        btn.text('Saving...').prop('disabled', true);

        setTimeout(() => {
            btn.text(originalText).prop('disabled', false);
            alert('Item saved successfully!');
            $('.modal').removeClass('active');
            // Here you would refresh the table/list
        }, 800);
    });

    // Delete Confirmations
    /*  $(document).on('click', '.btn-outline-danger, .text-danger', function () {
         // Basic check to see if it looks like a delete action
         if ($(this).find('.fa-trash').length > 0) {
             if (!confirm('Are you sure you want to delete this item?')) {
                 return false;
             }
             // Simulate removal
             $(this).closest('tr, .service-card-admin, .gallery-item, .phone-item').fadeOut(300, function () {
                 $(this).remove();
             });
         }
     }); */

    // Upload Media Simulation
    // Upload Media Simulation - DISABLED (handled by specific page logic now)
    // $('#upload-media-btn').on('click', function () {
    //     // Create a dummy input to trigger file selection (visual only)
    //     const input = $('<input type="file" multiple accept="image/*,video/*" style="display:none">');
    //     $('body').append(input);
    //     input.click();

    //     input.on('change', function () {
    //         if (this.files.length > 0) {
    //             alert(`${this.files.length} file(s) selected for upload.`);
    //             // Simulate upload progress
    //             setTimeout(() => {
    //                 alert('Upload complete!');
    //                 // Refresh gallery...
    //             }, 1000);
    //         }
    //         input.remove();
    //     });
    // });

    // --- New Logic for Business Hours & Social Links ---

    // Business Hours Toggle
    $('.hours-row .day-toggle input[type="checkbox"]').on('change', function () {
        const isChecked = $(this).is(':checked');
        const timesDiv = $(this).closest('.hours-row').find('.day-times');

        if (isChecked) {
            timesDiv.removeClass('disabled');
            timesDiv.find('input').prop('disabled', false);
        } else {
            timesDiv.addClass('disabled');
            timesDiv.find('input').prop('disabled', true);
        }
    });

    // Social Links Toggle
    $('.social-row .social-toggle input[type="checkbox"]').on('change', function () {
        const isChecked = $(this).is(':checked');
        const inputDiv = $(this).closest('.social-row').find('.social-input input');

        if (isChecked) {
            inputDiv.prop('disabled', false).removeClass('disabled-input');
        } else {
            inputDiv.prop('disabled', true).addClass('disabled-input');
        }
    });

    // Initial State Check (run on load)
    $('.hours-row .day-toggle input[type="checkbox"], .social-row .social-toggle input[type="checkbox"]').trigger('change');

});
