@extends('admin.layouts.app')
@section('title', 'Users - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <h2>Users Management</h2>
        <button class="btn btn-primary" id="add-user-btn"><i class="fas fa-user-plus"></i> Add User</button>
    </div>

    <div class="table-container">
        <table class="table" id="users-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Image</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loaded via AJAX -->
                <tr>
                    <td colspan="5" class="text-center p-4">
                        <div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- User Modal -->
    <div class="modal" id="item-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Add User</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="item-form">
                    <input type="hidden" id="user-id">

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="user-name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" id="user-email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Password <small class="text-muted" id="password-hint" style="display:none;">(Leave blank to
                                keep current)</small></label>
                        <input type="password" id="user-password" class="form-control" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select id="user-role" class="form-control">
                            <option value="Customer">Customer</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Profile Image</label>
                        <div class="image-select-container">
                            <input type="hidden" id="user-image">
                            <div id="user-image-preview"
                                style="width: 60px; height: 60px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 50%;">
                                <span class="text-muted" style="font-size: 0.8rem;">No Img</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary open-gallery-modal"
                                data-input-target="#user-image" data-preview-target="#user-image-preview">Choose
                                Image</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="remove-user-image"
                                style="display: none;">Remove</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close-modal">Cancel</button>
                <button class="btn btn-primary" id="save-user-btn">Save</button>
            </div>
        </div>
    </div>

    @include('admin.partials.gallery-modal')

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-gallery-modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            loadUsers();

            // Remove Image
            $('#remove-user-image').click(function () {
                $('#user-image').val('');
                $('#user-image-preview').html('<span class="text-muted" style="font-size: 0.8rem;">No Img</span>');
                $(this).hide();
            });

            // Load Users
            function loadUsers() {
                const tbody = $('#users-table tbody');
                tbody.html('<tr><td colspan="5" class="text-center p-4"><div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div></td></tr>');

                $.ajax({
                    url: '/api/users',
                    method: 'GET',
                    success: function (response) {
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.html('<tr><td colspan="5" class="text-center text-muted p-4">No users found.</td></tr>');
                            return;
                        }

                        let html = '';
                        response.forEach(u => {
                            // Image handling
                            const imgUrl = u.image ? (u.image.startsWith('http') ? u.image : `/uploads/gallery/${u.image}`) : null;
                            const imgDisplay = imgUrl ?
                                `<img src="${imgUrl}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">` :
                                `<div style="width:40px; height:40px; background:var(--color-bg-muted); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--color-text-muted);"><i class="fas fa-user"></i></div>`;

                            const roleBadge = u.role === 'Admin' ?
                                '<span class="badge bg-primary text-white" style="padding: 4px 8px; border-radius: 4px;">Admin</span>' :
                                '<span class="badge bg-secondary text-white" style="padding: 4px 8px; border-radius: 4px;">Customer</span>';

                            html += `<tr>
                                                <td>${imgDisplay}</td>
                                                <td>${u.name}</td>
                                                <td>${u.email}</td>
                                                <td>${roleBadge}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-secondary edit-user-btn" data-json='${JSON.stringify(u).replace(/'/g, "&#39;")}'><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-sm btn-outline-danger delete-user-btn" data-id="${u.id}"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>`;
                        });
                        tbody.html(html);
                    },
                    error: function () {
                        tbody.html('<tr><td colspan="5" class="text-center text-danger p-4">Failed to load users.</td></tr>');
                    }
                });
            }

            // Open Add Modal
            $('#add-user-btn').click(function () {
                $('#modal-title').text('Add User');
                $('#item-form')[0].reset();
                $('#user-id').val('');
                $('#password-hint').hide();
                $('#user-password').attr('placeholder', 'Enter password');

                $('#user-image').val('');
                $('#user-image-preview').html('<span class="text-muted" style="font-size: 0.8rem;">No Img</span>');
                $('#remove-user-image').hide();

                $('#item-modal').addClass('active');
            });

            // Open Edit Modal
            $(document).on('click', '.edit-user-btn', function () {
                const data = $(this).data('json');
                $('#modal-title').text('Edit User');
                $('#user-id').val(data.id);
                $('#user-name').val(data.name);
                $('#user-email').val(data.email);
                $('#user-role').val(data.role);

                // Password handling
                $('#user-password').val('');
                $('#password-hint').show();
                $('#user-password').attr('placeholder', 'New Password (Optional)');

                if (data.image) {
                    const imgUrl = data.image.startsWith('http') ? data.image : `/uploads/gallery/${data.image}`;
                    $('#user-image').val(data.image);
                    $('#user-image-preview').html(`<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover;">`);
                    $('#remove-user-image').show();
                } else {
                    $('#user-image').val('');
                    $('#user-image-preview').html('<span class="text-muted" style="font-size: 0.8rem;">No Img</span>');
                    $('#remove-user-image').hide();
                }

                $('#item-modal').addClass('active');
            });

            // Save User
            $('#save-user-btn').click(function (e) {
                e.preventDefault();
                const id = $('#user-id').val();

                const data = {
                    name: $('#user-name').val(),
                    email: $('#user-email').val(),
                    role: $('#user-role').val(),
                    image: $('#user-image').val()
                };

                const password = $('#user-password').val();
                // If creating new user, password is required
                if (!id && !password) {
                    alert('Password is required for new users.');
                    return;
                }
                if (password) {
                    data.password = password;
                }

                const method = id ? 'PUT' : 'POST';
                const url = id ? `/api/users/${id}` : '/api/users';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function () {
                        $('#item-modal').removeClass('active');
                        loadUsers();
                    },
                    error: function (xhr) {
                        alert('Error: ' + (xhr.responseJSON.message || 'Failed to save user'));
                    }
                });
            });

            // Delete User
            $(document).on('click', '.delete-user-btn', function () {
                if (confirm('Are you sure you want to delete this user?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: `/api/users/${id}`,
                        method: 'DELETE',
                        success: function () {
                            loadUsers();
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON.message || 'Failed to delete user'));
                        }
                    });
                }
            });
        });
    </script>
@endsection