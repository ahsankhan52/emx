@extends('admin.layouts.app')
@section('title', 'Services - EMX Auto Repair Admin')
@section('content')
    <div class="section-header">
        <h2>Services Management</h2>
        <button class="btn btn-primary" id="add-service-btn"><i class="fas fa-plus"></i> Add Service</button>
    </div>

    <div class="table-container">
        <table class="table" id="services-table">
            <thead>
                <tr>
                    <th style="width: 100px;">Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loaded via AJAX -->
                <tr>
                    <td colspan="4" class="text-center p-4">
                        <div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Service Modal -->
    <div class="modal" id="item-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">Add Service</h3>
                <button class="close-modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body">
                <form id="item-form">
                    <input type="hidden" id="service-id">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="service-title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="service-desc" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Service Image</label>
                        <div class="image-select-container">
                            <input type="hidden" id="service-image">
                            <div id="service-image-preview"
                                style="width: 100%; height: 150px; background: var(--color-bg-muted); margin-bottom: 10px; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 8px;">
                                <span class="text-muted">No Image Selected</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary open-gallery-modal"
                                data-input-target="#service-image" data-preview-target="#service-image-preview">Choose
                                Image</button>
                            <button type="button" class="btn btn-sm btn-outline-danger" id="remove-service-image"
                                style="display: none;">Remove</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary close-modal">Cancel</button>
                <button class="btn btn-primary" id="save-service-btn">Save</button>
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
            loadServices();

            // Remove Image
            $('#remove-service-image').click(function () {
                $('#service-image').val('');
                $('#service-image-preview').html('<span class="text-muted">No Image Selected</span>');
                $(this).hide();
            });


            // --- Services CRUD ---

            // Load Services
            function loadServices() {
                $.ajax({
                    url: '/api/services',
                    method: 'GET',
                    success: function (response) {
                        const tbody = $('#services-table tbody');
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.html('<tr><td colspan="4" class="text-center text-muted">No services found.</td></tr>');
                            return;
                        }

                        let html = '';
                        response.forEach(s => {
                            const imgUrl = s.image ? (s.image.startsWith('http') ? s.image : `/uploads/gallery/${s.image}`) : null;
                            const imgDisplay = imgUrl ?
                                `<img src="${imgUrl}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">` :
                                `<div style="width: 50px; height: 50px; background: var(--color-bg-muted); border-radius: 4px; display: flex; align-items: center; justify-content: center; color: var(--color-text-muted);"><i class="fas fa-wrench"></i></div>`;

                            html += `
                                        <tr>
                                            <td>${imgDisplay}</td>
                                            <td class="font-weight-bold">${s.title}</td>
                                            <td>${s.description.substring(0, 100)}${s.description.length > 100 ? '...' : ''}</td>
                                            <td>
                                                <button class="btn btn-sm btn-secondary edit-service-btn" data-json='${JSON.stringify(s).replace(/'/g, "&#39;")}'><i class="fas fa-edit"></i></button>
                                                <button class="btn btn-sm btn-outline-danger delete-service-btn" data-id="${s.id}"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    `;
                        });
                        tbody.html(html);
                    }
                });
            }

            // Open Add Modal
            $('#add-service-btn').click(function () {
                $('#modal-title').text('Add Service');
                $('#item-form')[0].reset();
                $('#service-id').val('');
                $('#service-image').val('');
                $('#service-image-preview').html('<span class="text-muted">No Image Selected</span>');
                $('#remove-service-image').hide();
                $('#item-modal').addClass('active');
            });

            // Open Edit Modal
            $(document).on('click', '.edit-service-btn', function () {
                const data = $(this).data('json');
                $('#modal-title').text('Edit Service');
                $('#service-id').val(data.id);
                $('#service-title').val(data.title);
                $('#service-desc').val(data.description);

                if (data.image) {
                    const imgUrl = data.image.startsWith('http') ? data.image : `/uploads/gallery/${data.image}`;
                    $('#service-image').val(data.image);
                    $('#service-image-preview').html(`<img src="${imgUrl}" style="width:100%; height:100%; object-fit:cover;">`);
                    $('#remove-service-image').show();
                } else {
                    $('#service-image').val('');
                    $('#service-image-preview').html('<span class="text-muted">No Image Selected</span>');
                    $('#remove-service-image').hide();
                }

                $('#item-modal').addClass('active');
            });

            // Save Service
            $('#save-service-btn').click(function (e) {
                e.preventDefault();
                const id = $('#service-id').val();
                const data = {
                    title: $('#service-title').val(),
                    description: $('#service-desc').val(),
                    image: $('#service-image').val()
                };
                console.log(data);


                const method = id ? 'PUT' : 'POST';
                const url = id ? `/api/services/${id}` : '/api/services';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    success: function () {
                        $('#item-modal').removeClass('active');
                        loadServices();
                    },
                    error: function (xhr) {
                        alert('Error: ' + (xhr.responseJSON.message || 'Failed to save service'));
                    }
                });
            });

            // Delete Service
            $(document).on('click', '.delete-service-btn', function () {
                if (confirm('Are you sure you want to delete this service?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: `/api/services/${id}`,
                        method: 'DELETE',
                        success: function () {
                            loadServices();
                        },
                        error: function (xhr) {
                            alert('Error: ' + (xhr.responseJSON.message || 'Failed to delete service'));
                        }
                    });
                }
            });
        });
    </script>
@endsection