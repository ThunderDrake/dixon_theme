jQuery(document).ready(function ($) {
    $(document).on('change', '.variation-radios input', function () {
        $('.variation-radios input:checked').each(function (index, element) {
            var $el = $(element);
            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');
            $('select[name="' + thisName + '"]').val(thisVal).trigger('change');
        });
    });
    $(document).on('woocommerce_update_variation_values', function () {
        $('.variation-radios input').each(function (index, element) {
            var $el = $(element);
            var thisName = $el.attr('name');
            var thisVal = $el.attr('value');
            $el.removeAttr('disabled');
            if ($('select[name="' + thisName + '"] option[value="' + thisVal + '"]').is(':disabled')) {
                $el.prop('disabled', true);
            }
        });
    });
    $(".single_variation_wrap").on("show_variation", function (event, variation) {
        $('.product-card__prices-current').text(function () {
            return variation.display_price.toLocaleString().replace(/,/g, " ", ) + 'Р.'
        })
    });
    $(".product__information .product-card__button").on('click', function (e) {
        e.preventDefault();
        $('.single_add_to_cart_button').click();
    })

    $( document.body ).on( 'added_to_cart', function(){
        $('.product__cart-link').addClass('active');
    });
});