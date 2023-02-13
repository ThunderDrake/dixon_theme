jQuery(document).ready(function($) {
    $(document).on('click', '.cart-item a.cart-item__delete-button', function (e)
    {
        e.preventDefault();
    
        var product_id = $(this).attr("data-product_id"),
            cart_item_key = $(this).attr("data-cart_item_key"),
            product_container = $(this).parents('.cart-item');
    
        // Add loader
        product_container.block({
            message: null,
            overlayCSS: {
                cursor: 'none'
            }
        });
    
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: wc_add_to_cart_params.ajax_url,
            data: {
                action: "product_remove",
                product_id: product_id,
                cart_item_key: cart_item_key
            },
            success: function(response) {
                if ( ! response || response.error )
                    return;
    
                var fragments = response.fragments;
    
                // Replace fragments
                if ( fragments ) {
                  console.log(fragments);
                    $.each( fragments, function( key, value ) {
                      console.log(key);
                        $( key ).replaceWith( value );
                    });
                }
            }
        });
    });

    $('body').on('change', '.woocommerce-checkout-review-order-table', function () {
        var method = woocommerce_params.chosen_shipping_method;
        $('select.shipping_method, input[name^=shipping_method][type=radio]:checked, input[name^=shipping_method][type=hidden]').each(
            function (index, input) {
                method = $(this).val();
            });
        if (method.indexOf('local_pickup') >= 0) {
            //Если самовывоз
            $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"]').addClass('hidden'); //Прячем адрес
            $('.checkout__pickup').removeClass('hidden');
        } else {
            // Для всех остальных методов
            $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"]').removeClass(
            'hidden'); //Показываем адрес
            $('.checkout__pickup').addClass('hidden');
        }
    });
})
