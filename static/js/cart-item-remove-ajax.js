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
                    $.each( fragments, function( key, value ) {
                      console.log(key);
                        $( key ).replaceWith( value );
                    });
                }
            }
        });
    });

    $('.choose-pickup input').each(function(el){
        $(this).on('change', function(){
            if($(this).val().indexOf('delivery_local') >= 0) {
                $('.choose-pickup').hide();
                $('.checkout__packages').removeClass('hidden');
                $('.checkout__pickup--additional').removeClass('hidden');
                $('.checkout__pickup--default').addClass('hidden');
            }
            if($(this).val().indexOf('delivery_only') >= 0) {
                $('.choose-pickup').hide();
                $('.checkout__packages').removeClass('hidden');
                $('.checkout__inputs').removeClass('hidden');
                $('.checkout__pickup--default').addClass('hidden');
            }
        })
    })

    // $('input[name^=shipping_method][type=radio]:checked').each(function(el) {
    //     if($(this).val().indexOf('local_pickup') >= 0) {
    //         // $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"], label[for="billing_state"]').addClass('hidden'); //Прячем адрес
    //         $('.checkout__pickup').removeClass('hidden');
    //     } else {
    //         // Для всех остальных методов
    //         // $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"], label[for="billing_state"]').removeClass(
    //         // 'hidden'); //Показываем адрес
    //         $('.checkout__pickup').addClass('hidden');
    //     };
    // });

    // $('body').on('change', '.woocommerce-checkout-review-order-table', function () {
    //     var method = woocommerce_params.chosen_shipping_method;
    //     $('select.shipping_method, input[name^=shipping_method][type=radio]:checked, input[name^=shipping_method][type=hidden]').each(
    //         function (index, input) {
    //             method = $(this).val();
    //         });
    //     // if (method.indexOf('local_pickup') >= 0) {
    //     //     console.log(method);
    //     //     //Если самовывоз
    //     //     // $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"], label[for="billing_state"]').addClass('hidden'); //Прячем адрес
    //     //     $('.checkout__pickup').removeClass('hidden');
    //     // } else {
    //     //     // Для всех остальных методов
    //     //     // $('label[for="billing_postcode"], label[for="billing_address_1"], label[for="billing_city"], label[for="billing_state"]').removeClass(
    //     //     // 'hidden'); //Показываем адрес
    //     //     $('.checkout__pickup').addClass('hidden');
    //     // }

    //     if (method.indexOf('local_pickup') < 0) {
    //         console.log(method);
    //         $('.local-pickup').addClass('hidden');
    //     }
    // });
});

document.addEventListener('DOMContentLoaded', ()=>{
    const inputMask = new Inputmask('+7 (999) 999-99-99');

    inputMask.mask(document.querySelector('.checkout-form__input[type="tel"]'));

})

