jQuery(document).ready(function ($) {
    setTimeout(function() {
        $('.product-header__sort-elem .option-item').on('click', function (e) {

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: $('.product-header__sort').attr('data-url'),
                data: {
                    action: "product_sort",
                    sort_type: $(this).attr('data-select-value')
                },
                success: function(res) {
                    console.log(res);
                },
                error: function(err) {
                        console.error(err);
                }
            });
        });    
    }, 500);
});