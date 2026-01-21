<!-- Gallery Modal -->
<div class="modal" id="gallery-modal">
    <div class="modal-content modal-lg">
        <div class="modal-header">
            <h3>Select Image</h3>
            <button class="close-modal"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <div class="gallery-controls mb-3">
                <select id="gallery-modal-sort" class="form-control" style="width: auto;">
                    <option value="newest">Newest First</option>
                    <option value="oldest">Oldest First</option>
                </select>
            </div>
            <div class="gallery-grid small-grid" id="modal-gallery-grid">
                <!-- Images loaded via AJAX -->
                <div class="loading-spinner"><i class="fas fa-spinner fa-spin"></i> Loading...</div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary close-modal">Cancel</button>
            <button class="btn btn-primary" id="confirm-gallery-selection" disabled>Select</button>
        </div>
    </div>
</div>

<style>
    #modal-gallery-grid {
        max-height: 400px;
        overflow-y: auto;
    }

    .gallery-item.selected {
        border: 3px solid var(--primary-color);
        position: relative;
    }

    .gallery-item.selected::after {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 5px;
        right: 5px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }
</style>