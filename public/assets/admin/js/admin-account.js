$(document).ready(function () {
    loadProfile();

    $('#account-form').submit(function (e) {
        e.preventDefault();
        saveProfile();
    });
});

function loadProfile() {
    $.ajax({
        url: '/api/profile',
        method: 'GET',
        success: function (user) {
            $('#account-name').val(user.name);
            $('#account-email').val(user.email);

            if (user.image) {
                $('#account-image').val(user.image);
                updateProfilePreview(user.image);
            }
        },
        error: function (xhr) {
            console.error('Failed to load profile', xhr);
        }
    });
}

function saveProfile() {
    const data = {
        name: $('#account-name').val(),
        email: $('#account-email').val(),
        image: $('#account-image').val()
    };

    const pwd = $('#account-password').val();
    if (pwd) {
        data.password = pwd;
    }

    const $btn = $('button[type="submit"]');
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

    $.ajax({
        url: '/api/profile',
        method: 'POST',
        data: data,
        success: function (response) {
            alert('Profile updated successfully');
            $('#account-password').val(''); // Clear password
            // Optionally update global UI like sidebar user info if exists
        },
        error: function (xhr) {
            alert('Error: ' + (xhr.responseJSON.message || 'Failed to update profile'));
        },
        complete: function () {
            $btn.prop('disabled', false).text('Save Changes');
        }
    });
}

function updateProfilePreview(val) {
    if (!val) return;
    const imgUrl = val.startsWith('http') ? val : `/uploads/gallery/${val}`;
    $('#account-image-preview img').attr('src', imgUrl);
}
