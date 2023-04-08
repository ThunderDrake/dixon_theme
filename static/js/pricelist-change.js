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
                $('.tabs__nav-btn--active').addClass('tabs__nav-btn--hidden');
                $('.tabs__panel--active').find('.pricelist__grid').html(res);
                $('.pricelist__item').click(function(e) {
                    $('.pricelist__item').removeClass('pricelist__item--active');
                    $(this).addClass('pricelist__item--active');
                    $('.work-list').removeClass('active');
                    $(`[data-post-items=${$(this).attr('data-post-id')}]`).addClass('active');
                });
            },
            error: function(err) {
                    console.error(err);
            }
        })
    });

    $('[data-term-name]').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/wp-admin/admin-ajax.php',
            dataType: 'json',
            data: {
                    action: 'model_list',
                    term_name: $(this).data('term-name'),
            },
            success: function(res) {
                $('.tabs__panel--active').find('.pricelist__grid').html(res);
                $('.pricelist__item').click(function(e) {
                    $('.pricelist__item').removeClass('pricelist__item--active');
                    $(this).addClass('pricelist__item--active');
                    $('.work-list').removeClass('active');
                    $(`[data-post-items=${$(this).attr('data-post-id')}]`).addClass('active');
                });
            },
            error: function(err) {
                    console.error(err);
            }
        })
    });

    $('.tabs__nav-btn').each(function(){
        $(this).click(function(){
            $('.tabs__nav-btn--hidden').removeClass('tabs__nav-btn--hidden');
        })
    })
});