/* ========================================
   CKEditor 4 Integration (Free, Open-Source)
   ======================================== */

$(document).ready(function () {

    // CKEditor Configuration
    CKEDITOR.config.height = 500;
    CKEDITOR.config.width = '100%';

    // Toolbar Configuration - All Free Features
    CKEDITOR.config.toolbar = [
        { name: 'document', items: ['Source', '-', 'Preview'] },
        { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },
        { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll'] },
        '/',
        { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'] },
        { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] },
        { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
        { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar'] },
        '/',
        { name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize'] },
        { name: 'colors', items: ['TextColor', 'BGColor'] },
        { name: 'tools', items: ['Maximize', 'ShowBlocks'] }
    ];

    // Font Configuration - Match Admin Panel
    CKEDITOR.config.font_names =
        'Montserrat/Montserrat, sans-serif;' +
        'Arial/Arial, Helvetica, sans-serif;' +
        'Times New Roman/Times New Roman, Times, serif;' +
        'Courier New/Courier New, Courier, monospace;' +
        'Georgia/Georgia, serif;' +
        'Verdana/Verdana, Geneva, sans-serif;';

    CKEDITOR.config.font_defaultLabel = 'Montserrat';
    CKEDITOR.config.fontSize_defaultLabel = '16px';

    // Content Styling - Match Admin Panel
    CKEDITOR.config.contentsCss = [
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap'
    ];

    CKEDITOR.config.bodyClass = 'ckeditor-content';

    // Additional Styling via extraCss
    CKEDITOR.config.extraCss =
        'body { font-family: "Montserrat", sans-serif; font-size: 16px; line-height: 1.6; color: #333; }';

    // Image Upload Handler (Frontend Placeholder)
    CKEDITOR.config.filebrowserUploadUrl = '/placeholder-upload';
    CKEDITOR.config.filebrowserImageUploadUrl = '/placeholder-upload';

    // Remove elements that might cause issues
    CKEDITOR.config.removePlugins = 'elementspath';
    CKEDITOR.config.resize_enabled = true;
    CKEDITOR.config.resize_dir = 'vertical';

    // Auto-save content to textarea
    CKEDITOR.config.autoUpdateElement = true;

    // Initialize CKEditor on all textareas with the ckeditor-editor class
    $('.ckeditor-editor').each(function () {
        // Generate unique ID if not present
        if (!this.id) {
            this.id = 'ckeditor-' + Math.random().toString(36).substr(2, 9);
        }

        // Initialize CKEditor
        CKEDITOR.replace(this.id);
    });

});

// Helper function to get CKEditor content
function getCKEditorContent(editorId) {
    if (CKEDITOR.instances[editorId]) {
        return CKEDITOR.instances[editorId].getData();
    }
    return '';
}

// Helper function to set CKEditor content
function setCKEditorContent(editorId, content) {
    if (CKEDITOR.instances[editorId]) {
        CKEDITOR.instances[editorId].setData(content);
    }
}

// Helper function to destroy all CKEditor instances (useful for cleanup)
function destroyAllCKEditors() {
    for (var instance in CKEDITOR.instances) {
        CKEDITOR.instances[instance].destroy();
    }
}
