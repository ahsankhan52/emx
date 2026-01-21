/* ========================================
   Admin Sidebar Navigation Helper
   ======================================== */

$(document).ready(function () {

    // Sidebar Toggle (Mobile)
    $('#sidebar-toggle').on('click', function () {
        $('.admin-sidebar').toggleClass('show');
    });

    // Close sidebar on mobile after clicking a link
    $('.nav-item').on('click', function () {
        if ($(window).width() < 992) {
            $('.admin-sidebar').removeClass('show');
        }
    });

    // Logout Interaction
    $('#logout-btn').on('click', function () {
        if (confirm('Are you sure you want to logout?')) {
            // Create a hidden form and submit it
            const form = $('<form>', {
                'method': 'POST',
                'action': '/logout'
            });

            // Add CSRF token
            const token = $('meta[name="csrf-token"]').attr('content');
            if (token) {
                form.append($('<input>', {
                    'type': 'hidden',
                    'name': '_token',
                    'value': token
                }));
            }

            $('body').append(form);
            form.submit();
        }
    });

});
