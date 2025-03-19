jQuery(document).ready(function ($) {
    var mediaUploader;

    $('.wpb-upload-image').click(function (e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media({
            title: 'Choose a Book Cover',
            button: {
                text: 'Use this Image'
            },
            multiple: false
        });

        mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#book_second_cover').val(attachment.url);
            $('#book_second_cover_preview').attr('src', attachment.url).show();
            $('.wpb-remove-image').show();
        });

        mediaUploader.open();
    });

    $('.wpb-remove-image').click(function () {
        $('#book_second_cover').val('');
        $('#book_second_cover_preview').hide();
        $(this).hide();
    });
});
