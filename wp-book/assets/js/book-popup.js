jQuery(document).ready(function ($) {
    $('.wpb-book-popup').click(function (e) {
        e.preventDefault();
        var post_id = $(this).closest('.wpb-book-item').data('id');
        $.ajax({
            url: wpb_ajax.ajax_url,
            type: 'POST',
            data: { action: 'wpb_fetch_book', post_id: post_id },
            success: function (response) {
                $('.wpb-popup-inner').html(response);
                $('.wpb-popup-inner').fadeIn();
            }
        });
    });

    $(document).on('click', '.wpb-popup-inner button.close', function () {
        $('.wpb-popup-inner').fadeOut();
    });
});
