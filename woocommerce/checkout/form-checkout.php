<h1 class="page-title">Оформление заказа</h1>
<div class="white-holder">
<?php
defined( 'ABSPATH' ) || exit;
global $GS;

do_action( 'woocommerce_before_checkout_form', $checkout );

if(!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in())
{
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

// wp_enqueue_script('pickpoint','https://pickpoint.ru/select/postamat.js',array('jquery'),false);
$script = "
jQuery(function(i) {i.scroll_to_notices = function(){
	var o = $('.form-row.woocommerce-invalid'); 
	o.length && i(\"html, body\").animate({
            scrollTop: o.eq(0).offset().top - 100
        }, 1e3)
    }
});
";
wp_add_inline_script('woocommerce',$script,'after');
?>
	<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">
		<div class="row">
			<div class="col-xs-12 col-md-8 form-side">
				<?php
					if($checkout->get_checkout_fields())
					{
					do_action( 'woocommerce_checkout_before_customer_details' );
				?>
				<div class="vertical-tabs" id="customer_details">
					<?php do_action( 'woocommerce_checkout_billing' ); ?>
					<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				</div>
				<?php
					do_action( 'woocommerce_checkout_after_customer_details' );
					}
				?>
				<div class="woocommerce-shipping-fields">
					<div class="checkout-block">
						<div class="checkout-block-header">Оплата</div>
						<div class="checkout-block-content">
							<?php woocommerce_checkout_payment(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-3 order-side">
				<div class="order-side-title">
					<img src="<?php echo get_template_directory_uri();?>/assets/images/shopping-cart.png" alt="">
					Ваш заказ
					<a class="cart-link" href="<?php echo get_site_url('','/cart', '');?>">Изменить</a>
				</div>
				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>
				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</form>
	<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>