<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="woocommerce-form-coupon-toggle">
	<a href="#" class="showcoupon">Ввести купон</a>
</div>
<form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">
	<div class="checkout-block">
		<div class="checkout-block-header"><?php esc_html_e( 'If you have a coupon code, please apply it below.', 'woocommerce' ); ?></div>
		<div class="checkout-block-content">
			<p class="form-row">
				<span class="woocommerce-input-wrapper">
					<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
				</span>
			</p>
			<p class="form-row">
				<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
			</p>
		</div>
	</div>
</form>
