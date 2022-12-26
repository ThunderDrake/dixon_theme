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
})