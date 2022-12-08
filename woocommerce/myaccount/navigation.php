<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul class="woocommerce-MyAccount-navigation-list list-reset">
		<li class="<?php echo wc_get_account_menu_item_classes( 'dashboard' ); ?> woocommerce-nav-list-item">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'dashboard' ) ); ?>"><?php echo esc_html( 'Личные данные' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'wishlist' ); ?> woocommerce-nav-list-item">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'wishlist' ) ); ?>"><?php echo esc_html( 'Список желаний' ); ?></a>
		</li>
		<li class="<?php echo wc_get_account_menu_item_classes( 'orders' ); ?> woocommerce-nav-list-item">
			<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>"><?php echo esc_html( 'Заказы' ); ?></a>
		</li>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
