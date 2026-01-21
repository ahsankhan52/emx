@extends('admin.layouts.app')
@section('title', 'Reviews - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <h2>Reviews Management</h2>
        <button class="btn btn-primary" id="add-review-btn"><i class="fas fa-plus"></i> Add Review</button>
    </div>

    <div class="table-container">
        <table class="table" id="reviews-table">
            <thead>
                <tr>
                    <th style="width: 80px;">Image</th>
                    <th>User</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loaded via AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Review Modal -->
    <div class="modal" id="item-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Add Review</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="item-form">
                    <input type="hidden" id="review-id">

                    <div class="form-group">
                        <label>User (Search by Email/Name)</label>
                        <input type="text" id="review-user-input" class="form-control" list="users-datalist"
                            placeholder="Type email or name..." autocomplete="off" required>
                        <datalist id="users-datalist"></datalist>
                        <!-- Hidden input to store Actual User ID -->
                        <!-- Actually we can just find it on save, but for safety lets verify -->
                    </div>

                    <div class="form-group">
                        <label>Rating (1-5)</label>
                        <select id="review-stars" class="form-control">
                            <option value="5">5 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="2">2 Stars</option>
                            <option value="1">1 Star</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="review-desc" class="form-control" rows="3" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close-modal">Cancel</button>
                <button class="btn btn-primary" id="save-review-btn">Save</button>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/admin/js/admin-modals.js') }}"></script>
    <script src="{{ asset('assets/admin/js/admin-forms.js') }}"></script>
    <script>
        $(document).ready(function () {
            let cachedUsers = [];

            // Initial Load
            loadUsersList();
            loadReviews();

            // Load Users for Autosuggest
            function loadUsersList() {
                $.ajax({
                    url: '/api/users',
                    method: 'GET',
                    success: function (response) {
                        cachedUsers = response;
                        let options = '';
                        response.forEach(u => {
                            // Format: email (Name)
                            options += `<option value="${u.email} (${u.name})"></option>`;
                        });
                        $('#users-datalist').html(options);
                    }
                });
            }

            // Load Reviews
            function loadReviews() {
                const tbody = $('#reviews-table tbody');
                tbody.html('<tr><td colspan="5" class="text-center p-4"><div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div></td></tr>');

                $.ajax({
                    url: '/api/reviews',
                    method: 'GET',
                    success: function (response) {
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.html('<tr><td colspan="5" class="text-center text-muted p-4">No reviews found.</td></tr>');
                            return;
                        }

                        let html = '';
                        response.forEach(r => {
                            let stars = '';
                            for (let i = 1; i <= 5; i++) {
                                stars += `<i class="fas fa-star ${i <= r.stars ? 'review-on' : 'review-off'}"></i>`;
                            }

                            // User info from relationship
                            const user = r.user || {};
                            const userName = user.name || 'Unknown User';
                            const userImage = user.image;

                            // Image path handling
                            const imgUrl = userImage ? (userImage.startsWith('http') ? userImage : `/uploads/gallery/${userImage}`) : null;
                            const imgDisplay = imgUrl ?
                                `<img src="${imgUrl}" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">` :
                                `<div style="width:40px; height:40px; background:var(--color-bg-muted); border-radius:50%; display:flex; align-items:center; justify-content:center; color:var(--color-text-muted);"><i class="fas fa-user"></i></div>`;

                            html += `
                                                <tr>
                                                    <td>${imgDisplay}</td>
                                                    <td>
                                                        <div style="line-height:1.2;">
                                                            <span style="font-weight:bold;">${userName}</span><br>
                                                            <span class="text-muted" style="font-size:0.8rem;">${user.email || ''}</span>
                                                        </div>
                                                    </td>
                                                    <td>${stars}</td>
                                                    <td>${r.description.substring(0, 50)}${r.description.length > 50 ? '...' : ''}</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-secondary edit-review-btn" data-id="${r.id}" data-json='${JSON.stringify(r).replace(/'/g, "&#39;")}'><i class="fas fa-edit"></i></button>
                                                        <button class="btn btn-sm btn-danger delete-review-btn" data-id="${r.id}"><i class="fas fa-trash"></i></button>
                                                    </td>
                                                </tr>
                                            `;
                        });
                        tbody.html(html);
                    },
                    error: function () {
                        tbody.html('<tr><td colspan="5" class="text-center text-danger p-4">Failed to load reviews.</td></tr>');
                    }
                });
            }

            // Open Add Modal
            $('#add-review-btn').click(function () {
                $('#modal-title').text('Add Review');
                $('#item-form')[0].reset();
                $('#review-id').val('');
                $('#item-modal').addClass('active');
            });

            // Open Edit Modal
            $(document).on('click', '.edit-review-btn', function () {
                const data = $(this).data('json');
                $('#modal-title').text('Edit Review');
                $('#review-id').val(data.id);
                $('#review-stars').val(data.stars);
                $('#review-desc').val(data.description);

                // Set User Input
                if (data.user) {
                    $('#review-user-input').val(`${data.user.email} (${data.user.name})`);
                } else {
                    $('#review-user-input').val('');
                }

                $('#item-modal').addClass('active');
            });

            // Save Review
            $('#save-review-btn').click(function (e) {
                e.preventDefault();

                // Find User ID
                const inputVal = $('#review-user-input').val();
                const matchedUser = cachedUsers.find(u => `${u.email} (${u.name})` === inputVal);

                if (!matchedUser) {
                    alert('Please select a valid user from the suggestion list.');
                    return;
                }

                const id = $('#review-id').val();
                const data = {
                    user_id: matchedUser.id,
                    stars: $('#review-stars').val(),
                    description: $('#review-desc').val(),
                };

                const method = id ? 'PUT' : 'POST';
                const url = id ? `/api/reviews/${id}` : '/api/reviews';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function () {
                        $('#item-modal').removeClass('active');
                        loadReviews();
                    },
                    error: function (xhr) {
                        alert('Error: ' + (xhr.responseJSON.message || 'Failed to save review'));
                    }
                });
            });

            // Delete Review
            $(document).on('click', '.delete-review-btn', function () {
                if (confirm('Are you sure you want to delete this review?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: `/api/reviews/${id}`,
                        method: 'DELETE',
                        success: function () {
                            loadReviews();
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON.message || 'Failed to delete review'));
                        }
                    });
                }
            });
        });
    </script>
@endsection