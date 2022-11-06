<?php 
/**
 * The template for displaying the checkout page.
 *
 * @package dixon_theme
 */
get_header(); 

$checkout = WC()->checkout();
?>
<main class="main" style="padding-top: var(--header-height);">
	<section class="checkout">
		<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
		<div class="container checkout__container">
		<?php ct()->template( '/checkout/parts/checkout__header.php' ) ?>
			<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>
			<?php 
			$checkout = WC()->checkout();
			do_action( 'woocommerce_before_checkout_billing_form', $checkout );
			?>
			<form name="checkout" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" method="post" enctype="multipart/form-data">
				<div class="checkout__form checkout-form">
					<?php if ( $checkout->get_checkout_fields() ) : ?>

						<?php ct()->template( '/checkout/parts/checkout__inputs.php' ) ?>
						<?php ct()->template( '/checkout/parts/checkout__total.php' ) ?>

					<?php endif; ?>
				</div>
			</form>
			<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
			<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
		</div>
		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
	</section>
</main>
<?php
get_footer();