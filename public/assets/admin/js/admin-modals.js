$(document).ready(function () {

    // --- Modal Utilities ---
    function openModal(modalId) {
        $(modalId).addClass('active');
    }

    function closeModal(modalId) {
        $(modalId).removeClass('active');
    }

    // Close triggers
    $('.close-modal').on('click', function () {
        $(this).closest('.modal').removeClass('active');
    });

    // Close on clicking outside
    $('.modal').on('click', function (e) {
        if ($(e.target).hasClass('modal')) {
            $(this).removeClass('active');
        }
    });


    /* LEGACY/MOCK LOGIC DISABLED - HANDLED BY SPECIFIC PAGE SCRIPTS NOW
    // --- Gallery Modal Logic ---

    // Mock Images
    const mockImages = [
        'assets/images/about/about.avif',
        'assets/images/logos/1.png',
        // Placeholders
        'https://via.placeholder.com/300?text=Image+1',
        'https://via.placeholder.com/300?text=Image+2',
        'https://via.placeholder.com/300?text=Image+3',
        'https://via.placeholder.com/300?text=Image+4'
    ];

    function loadGalleryImages() {
        let html = '';
        mockImages.forEach(src => {
            html += `
        <div class="gallery-item">
           <img src="${src}" alt="Media">
           <div class="gallery-actions">
             <button class="btn-icon text-white"><i class="fas fa-check"></i></button>
           </div>
        </div>
      `;
        });
        $('#modal-gallery-grid, #gallery-container').html(html);

        // Add delete button to main gallery
        $('#gallery-container .gallery-item').each(function () {
            $(this).find('.gallery-actions').html('<button class="btn-icon text-danger delete-media"><i class="fas fa-trash"></i></button>');
        });
    }

    // loadGalleryImages(); // Disabled to allow real API data loading

    // Open Gallery Modal
    // Use event delegation for dynamically added buttons
    $(document).on('click', '.open-gallery-modal', function () {
        openModal('#gallery-modal');
    });

    // Select Image in Modal
    $(document).on('click', '#modal-gallery-grid .gallery-item', function () {
        $('#modal-gallery-grid .gallery-item').removeClass('selected');
        $(this).addClass('selected');
    });

    $('#confirm-selection').on('click', function () {
        const selected = $('#modal-gallery-grid .gallery-item.selected img').attr('src');
        if (selected) {
            alert('Image selected: ' + selected);
            closeModal('#gallery-modal');
            // Logic to update the invoking field would go here (using a closure or global var to track context)
        }
    });


    // --- Add/Edit Item Modals ---

    $('#add-user-btn').on('click', function () {
        $('#modal-title').text('Add New User');
        $('#item-form').html(`
       <div class="form-group"><label>Name</label><input class="form-control" type="text" placeholder="Full Name"></div>
       <div class="form-group"><label>Email</label><input class="form-control" type="email" placeholder="Email"></div>
       <div class="form-group"><label>Role</label>
         <select class="form-control">
           <option>Customer</option>
           <option>Admin</option>
         </select>
       </div>
       <div class="form-group"><label>Password</label><input class="form-control" type="password" placeholder="Password"></div>
    `);
        openModal('#item-modal');
    });

    $('#add-service-btn').on('click', function () {
        $('#modal-title').text('Add Service');
        $('#item-form').html(`
       <div class="form-group"><label>Service Title</label><input class="form-control" type="text" placeholder="Engine Repair"></div>
       <div class="form-group"><label>Description</label><textarea class="form-control" rows="3"></textarea></div>
       <div class="form-group">
         <label>Image</label>
         <button type="button" class="btn btn-secondary open-gallery-modal">Select Image</button>
       </div>
    `);
        openModal('#item-modal');
    });

    $('#add-review-btn').on('click', function () {
        $('#modal-title').text('Add Review');
        $('#item-form').html(`
       <div class="form-group"><label>Customer Email</label><input class="form-control" type="email" placeholder="Search user..."></div>
       <div class="form-group"><label>Rating</label><input class="form-control" type="number" min="1" max="5" value="5"></div>
       <div class="form-group"><label>Review Text</label><textarea class="form-control" rows="3"></textarea></div>
    `);
        openModal('#item-modal');
    });
    */

});
