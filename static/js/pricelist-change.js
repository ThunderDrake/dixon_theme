jQuery(document).ready(function($) {
    $('.pricelist__item').click(function(e) {
        $('.work-list').removeClass('active');
        $(`[data-post-items=${$(this).attr('data-post-id')}]`).addClass('active');
    });

    $('.tabs__search form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                    action: 'search_model',
                    search_value: $(this).find('#submenu-search').val(),
            },
            success: function(res) {
                $(e.currentTarget).closest('.header__search-block').find('.pricelist__grid').html(res);
                $('.pricelist__item').click(function(e) {
                    $('.work-list').removeClass('active');
                    $(`[data-post-items=${$(this).attr('data-post-id')}]`).addClass('active');
                });
            },
            error: function(err) {
                    console.error(err);
            }
        })
    });
});