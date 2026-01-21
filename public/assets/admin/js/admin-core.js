$(document).ready(function () {

  // Navigation Handling
  $('.nav-item').on('click', function (e) {
    if ($(this).attr('href').startsWith('#')) {
      e.preventDefault();

      // Update sidebar state
      $('.nav-item').removeClass('active');
      $(this).addClass('active');

      // Show target content
      const target = $(this).data('target');
      $('.content-section').removeClass('active');
      $('#' + target).addClass('active');

      // On mobile, close sidebar after web view click
      if ($(window).width() < 992) {
        $('.admin-sidebar').removeClass('show');
      }
    }
  });

  // Sidebar Toggle (Mobile)
  $('#sidebar-toggle').on('click', function () {
    $('.admin-sidebar').toggleClass('show');
  });

  // Logout Interaction
  $('#logout-btn').on('click', function () {
    if (confirm('Are you sure you want to logout?')) {
      alert('Logged out successfully.');
      window.location.href = 'index.html';
    }
  });

  // Editor "Back" Button
  $('.back-to-pages').on('click', function () {
    $('#page-editor').addClass('hidden');
    $('#pages').removeClass('hidden active').addClass('active');
  });

  // Open Page Editor (Mockup)
  $('.edit-page-btn').on('click', function () {
    const pageName = $(this).data('page');
    // Hide list, show editor
    $('#pages').removeClass('active');
    $('#page-editor').removeClass('hidden').addClass('active');
    $('#editor-page-title').text('Edit Page: ' + pageName.charAt(0).toUpperCase() + pageName.slice(1));

    // Inject dynamic mock content
    let editorHtml = '';

    // Home Page - Custom Sections
    if (pageName === 'home') {
      editorHtml += `
        <!-- Hero Section -->
        <div class="card">
          <div class="card-header">Hero Section</div>
          <div class="card-body">
             <div class="form-group">
               <label>Title</label>
               <input type="text" class="form-control" value="Welcome to EMX Auto Repair">
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" rows="3" placeholder="Enter hero description..."></textarea>
             </div>
             <div class="form-group">
               <label>Hero Image/Video</label>
               <div class="file-upload-preview">
                  <div style="width: 100px; height: 60px; background: #eee;"></div>
                  <button class="btn btn-sm btn-secondary open-gallery-modal">Select Media</button>
               </div>
             </div>
          </div>
        </div>

        <!-- About Section -->
        <div class="card">
          <div class="card-header">About Section</div>
          <div class="card-body">
             <div class="form-group">
               <label>Image</label>
               <div class="file-upload-preview">
                  <div style="width: 100px; height: 60px; background: #eee;"></div>
                  <button class="btn btn-sm btn-secondary open-gallery-modal">Select Image</button>
               </div>
             </div>
             <div class="form-group">
               <label>Title</label>
               <input type="text" class="form-control" value="About Us">
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" rows="4" placeholder="Enter about description..."></textarea>
             </div>
          </div>
        </div>

        <!-- Services Section -->
        <div class="card">
          <div class="card-header">Services Section</div>
          <div class="card-body">
             <div class="form-group">
               <label>Title</label>
               <input type="text" class="form-control" value="Our Services">
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" rows="3" placeholder="Enter services description..."></textarea>
             </div>
          </div>
        </div>

        <!-- Reviews Section -->
        <div class="card">
          <div class="card-header">Reviews Section</div>
          <div class="card-body">
             <div class="form-group">
               <label>Title</label>
               <input type="text" class="form-control" value="Customer Reviews">
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" rows="3" placeholder="Enter reviews description..."></textarea>
             </div>
          </div>
        </div>

        <!-- Location Section -->
        <div class="card">
          <div class="card-header">Location Section</div>
          <div class="card-body">
             <div class="form-group">
               <label>Title</label>
               <input type="text" class="form-control" value="Visit Us">
             </div>
             <div class="form-group">
               <label>Description</label>
               <textarea class="form-control" rows="3" placeholder="Enter location description..."></textarea>
             </div>
          </div>
        </div>
      `;
    } else {
      // Default Banner Section for other pages
      editorHtml += `
        <div class="card">
          <div class="card-header">Banner Settings</div>
          <div class="card-body">
             <div class="form-group">
               <label>Banner Title</label>
               <input type="text" class="form-control" value="${pageName.charAt(0).toUpperCase() + pageName.slice(1)}">
             </div>
             <div class="form-group">
               <label>Banner Image</label>
               <div class="file-upload-preview">
                  <div style="width: 100px; height: 60px; background: #eee;"></div>
                  <button class="btn btn-sm btn-secondary open-gallery-modal">Select Image</button>
               </div>
             </div>
             <div class="form-group">
               <label>Description</label>
               <input type="text" class="form-control" placeholder="Enter page description...">
             </div>
          </div>
        </div>
      `;
    }

    // Rich Text Mock
    if (['about', 'contact', 'privacy', 'terms'].includes(pageName)) {
      editorHtml += `
        <div class="card">
          <div class="card-header">Main Content</div>
          <div class="card-body">
             <div class="form-group">
                <textarea class="form-control ckeditor-editor" rows="10"></textarea>
             </div>
          </div>
        </div>
      `;
    }

    $('#editor-content').html(editorHtml);

    // Initialize CKEditor on newly added textareas
    setTimeout(function () {
      $('.ckeditor-editor').each(function () {
        if (this.id && CKEDITOR.instances[this.id]) {
          CKEDITOR.instances[this.id].destroy();
        }
        CKEDITOR.replace(this);
      });
    }, 100);
  });

  // Initialize Data (Mock)
  loadMockUsers();
  loadMockReviews();
  loadMockServices();

});

function loadMockUsers() {
  const users = [
    { name: 'Admin User', email: 'admin@emxauto.com', role: 'Admin' },
    { name: 'John Doe', email: 'john@example.com', role: 'Customer' },
    { name: 'Jane Smith', email: 'jane@test.com', role: 'Customer' }
  ];

  let html = '';
  users.forEach(u => {
    html += `<tr>
      <td>${u.name}</td>
      <td>${u.email}</td>
      <td><span class="badge ${u.role === 'Admin' ? 'bg-primary' : 'bg-secondary'}" style="padding: 2px 6px; border-radius: 4px; color: white;">${u.role}</span></td>
      <td>
        <button class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></button>
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
      </td>
    </tr>`;
  });
  $('#users-table tbody').html(html);
}

function loadMockReviews() {
  const reviews = [
    { user: 'John Doe', rating: 5, desc: 'Great service!' },
    { user: 'Mike Ross', rating: 4, desc: 'Good, but busy.' }
  ];
  let html = '';
  reviews.forEach(r => {
    let stars = '';
    for (let i = 0; i < 5; i++) {
      stars += `<i class="fas fa-star ${i < r.rating ? 'text-warning' : 'text-secondary'}"></i>`;
    }
    html += `<tr>
      <td>${r.user}</td>
      <td>${stars}</td>
      <td>${r.desc}</td>
      <td>
        <button class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></button>
        <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
      </td>
    </tr>`;
  });
  $('#reviews-table tbody').html(html);
}

function loadMockServices() {
  const services = [
    { title: 'Engine Repair', desc: 'Complete engine diagnostics...' },
    { title: 'Brake Service', desc: 'Safety first brake checks...' },
    { title: 'Oil Change', desc: 'Quick oil change service...' }
  ];
  let html = '';
  services.forEach(s => {
    html += `
      <div class="service-card-admin">
        <div class="service-card-img" style="background-color: #ddd;"></div>
        <div class="service-card-body">
           <h4>${s.title}</h4>
           <p>${s.desc}</p>
        </div>
        <div class="service-card-actions">
           <button class="btn btn-sm btn-secondary">Edit</button>
           <button class="btn btn-sm btn-outline-danger">Delete</button>
        </div>
      </div>
    `;
  });
  $('.services-list').html(html);
}
