jQuery(document).ready(function($) {
    // Color picker
    $('.color-picker').wpColorPicker();
    
    // Logo upload
    $('.upload-logo').click(function(e) {
        e.preventDefault();
        
        var button = $(this),
            custom_uploader = wp.media({
                title: 'Choose Logo',
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Choose Logo'
                },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                button.prev('input').val(attachment.url);
            }).open();
    });
});