jQuery(document).ready(function($) {
    $('.pricelist__item').click(function(e) {
        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                    action: 'filter_model',
                    post_id: $(this).attr("data-post-id"),
            },
            success: function(res) {
                    $('.pricelist__works-list').html(res);
            },
            error: function(err) {
                    console.error(err);
            }
        })
    });
});