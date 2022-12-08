<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



?>
<section class="callback callback-page">
	<div class="callback__container container">
	<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

		<form method="post" class="woocommerce-form woocommerce-form-login login callback__form form" style="margin: 0 auto; padding: 4em 2em;">

			<?php do_action( 'woocommerce_login_form_start' ); ?>
			
			<label class="form__field form__field--name" for="username">
				<svg class="form__field-icon" width="26" height="26">
					<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
				</svg>
				<input class="form__input form__input--name woocommerce-Input woocommerce-Input--text input-text" type="text" name="username" id="username" autocomplete="username" placeholder="Ваш e-mail" style="margin-bottom: 27px">
			</label>

			<label class="form__field form__field--name" for="password">
				<input class="form__input form__input--name woocommerce-Input woocommerce-Input--text input-text" type="text" name="password" id="password" autocomplete="current-password" placeholder="Введите ваш пароль">
			</label>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="woocommerce-FormRow form-row" style="width: 100%">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-form-login__submit btn btn--main form__button btn-reset" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>" style="margin-top: 0">Войти</button>
			</p>

			<!-- <p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p> -->

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

	<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
	</div>
</section>

