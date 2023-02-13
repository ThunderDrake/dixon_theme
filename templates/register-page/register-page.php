<?php 
// User registration page template
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if(is_user_logged_in()){
	wp_redirect(get_permalink(get_option('woocommerce_myaccount_page_id')));
}
get_header();
?>
<main class="main">
	<section class="callback callback-page">
		<div class="callback__container container">
		<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

		<form method="post" class="woocommerce-form woocommerce-form-register register callback__form form" <?php do_action( 'woocommerce_register_form_tag' ); ?> style="margin: 0 auto; padding: 4em 2em;" id="register_form">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide" style="width: 100%;">
				<label class="form__field form__field--email" for="reg_email">
				<!-- <label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label> -->
				<svg class="form__field-icon" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M14.9596 11.5C14.9596 13.4071 13.4071 14.9596 11.5 14.9596C9.59292 14.9596 8.04042 13.4071 8.04042 11.5C8.04042 9.59292 9.59292 8.04042 11.5 8.04042C13.4071 8.04042 14.9596 9.59292 14.9596 11.5ZM11.5 0C5.15871 0 0 5.15871 0 11.5C0 17.8413 5.15871 23 11.5 23C13.823 23 16.0626 22.3081 17.9783 21L18.0109 20.977L16.4613 19.1763L16.4354 19.1925C14.964 20.1405 13.2504 20.644 11.5 20.6425C6.45917 20.6425 2.3575 16.5408 2.3575 11.5C2.3575 6.45917 6.45917 2.3575 11.5 2.3575C16.5408 2.3575 20.6425 6.45917 20.6425 11.5C20.6412 12.1607 20.5689 12.8193 20.4269 13.4646C20.1384 14.652 19.3066 15.0152 18.6827 14.9672C18.056 14.9165 17.3219 14.4689 17.3161 13.3755V11.5C17.3146 9.95785 16.7014 8.47928 15.611 7.38872C14.5206 6.29816 13.0422 5.68469 11.5 5.68292C9.95768 5.68444 8.47897 6.2978 7.38838 7.38838C6.2978 8.47897 5.68444 9.95768 5.68292 11.5C5.68444 13.0423 6.2978 14.521 7.38838 15.6116C8.47897 16.7022 9.95768 17.3156 11.5 17.3171C12.2665 17.3189 13.0257 17.168 13.7333 16.8732C14.4408 16.5783 15.0825 16.1454 15.6208 15.5997C15.9611 16.1341 16.4316 16.5732 16.9882 16.8757C17.5447 17.1783 18.169 17.3345 18.8025 17.3295C19.6401 17.3295 20.47 17.0497 21.138 16.5427C21.827 16.0185 22.3416 15.2624 22.6262 14.353C22.6713 14.2054 22.7556 13.87 22.7556 13.8671L22.7575 13.8546C22.9252 13.1263 23 12.398 23 11.5C23 5.15871 17.8413 0 11.5 0" fill="#ACACAC" fill-opacity="0.4"/>
				</svg>
				<input type="email" class="woocommerce-Input woocommerce-Input--text input-text form__input form__input--email" placeholder="Введите ваш e-mail" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
				</label>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
				</p>

			<?php endif; ?>
			<label class="form__field form__field--tel" for="user_phone">
					<svg class="form__field-icon" width="26" height="26">
						<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
					</svg>
					<input class="form__input form__input--phone" type="tel" name="user_phone" id="reg_phone" autocomplete="user_phone" value="<?php echo ( ! empty( $_POST['user_phone'] ) ) ? esc_attr( wp_unslash( $_POST['user_phone'] ) ) : ''; ?>"   placeholder="Введите ваш телефон">
				</label>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-form-row form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn btn--main form__button btn-reset" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>">Зарегистрироваться</button>
				<label class="custom-checkbox form__policy" style="margin: 0 auto;">
					<input type="checkbox" name="form_policy" class="custom-checkbox__field form__input--policy">
					<span class="custom-checkbox__content">Согласен на обработку <a href="<?= get_privacy_policy_url() ?>">персональных данных</a></span>
				</label>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

			<!-- <form method="post" class="woocommerce-form woocommerce-form-register register callback__form form" <?php do_action( 'woocommerce_register_form_tag' ); ?> style="margin: 0 auto; padding: 4em 2em;">

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<label class="form__field form__field--name" for="username">
						<svg class="form__field-icon" width="26" height="26">
							<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
						</svg>
						<input class="form__input form__input--name woocommerce-Input woocommerce-Input--text input-text" type="text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"  placeholder="Введите ваше имя">
					</label>

				<?php endif; ?>
				<label class="form__field form__field--email" for="user_email">
					<svg class="form__field-icon" width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M14.9596 11.5C14.9596 13.4071 13.4071 14.9596 11.5 14.9596C9.59292 14.9596 8.04042 13.4071 8.04042 11.5C8.04042 9.59292 9.59292 8.04042 11.5 8.04042C13.4071 8.04042 14.9596 9.59292 14.9596 11.5ZM11.5 0C5.15871 0 0 5.15871 0 11.5C0 17.8413 5.15871 23 11.5 23C13.823 23 16.0626 22.3081 17.9783 21L18.0109 20.977L16.4613 19.1763L16.4354 19.1925C14.964 20.1405 13.2504 20.644 11.5 20.6425C6.45917 20.6425 2.3575 16.5408 2.3575 11.5C2.3575 6.45917 6.45917 2.3575 11.5 2.3575C16.5408 2.3575 20.6425 6.45917 20.6425 11.5C20.6412 12.1607 20.5689 12.8193 20.4269 13.4646C20.1384 14.652 19.3066 15.0152 18.6827 14.9672C18.056 14.9165 17.3219 14.4689 17.3161 13.3755V11.5C17.3146 9.95785 16.7014 8.47928 15.611 7.38872C14.5206 6.29816 13.0422 5.68469 11.5 5.68292C9.95768 5.68444 8.47897 6.2978 7.38838 7.38838C6.2978 8.47897 5.68444 9.95768 5.68292 11.5C5.68444 13.0423 6.2978 14.521 7.38838 15.6116C8.47897 16.7022 9.95768 17.3156 11.5 17.3171C12.2665 17.3189 13.0257 17.168 13.7333 16.8732C14.4408 16.5783 15.0825 16.1454 15.6208 15.5997C15.9611 16.1341 16.4316 16.5732 16.9882 16.8757C17.5447 17.1783 18.169 17.3345 18.8025 17.3295C19.6401 17.3295 20.47 17.0497 21.138 16.5427C21.827 16.0185 22.3416 15.2624 22.6262 14.353C22.6713 14.2054 22.7556 13.87 22.7556 13.8671L22.7575 13.8546C22.9252 13.1263 23 12.398 23 11.5C23 5.15871 17.8413 0 11.5 0" fill="#ACACAC" fill-opacity="0.4"/>
					</svg>

					<input class="form__input form__input--email" type="email" name="user_email" id="reg_email" autocomplete="user_email" value="<?php echo ( ! empty( $_POST['user_email'] ) ) ? esc_attr( wp_unslash( $_POST['user_email'] ) ) : ''; ?>"  placeholder="Введите вашу почту" style="margin-bottom: 27px">
				</label>
				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
					</p>

				<?php else : ?>
				<label class="form__field form__field--tel" for="user_phone">
					<svg class="form__field-icon" width="26" height="26">
						<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#phone-input-icon"></use>
					</svg>
					<input class="form__input form__input--phone" type="tel" name="user_phone" id="reg_phone" autocomplete="user_phone" value="<?php echo ( ! empty( $_POST['user_phone'] ) ) ? esc_attr( wp_unslash( $_POST['user_phone'] ) ) : ''; ?>"   placeholder="Введите ваш телефон">
				</label>

				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="woocommerce-FormRow form-row" style="text-align: center">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit btn btn--main form__button btn-reset" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>" style="margin-top: 0">Зарегистрироваться</button>
					<label class="custom-checkbox form__policy" style="margin: 0 auto;">
						<input type="checkbox" name="form_policy" class="custom-checkbox__field form__input--policy">
						<span class="custom-checkbox__content">Согласен на обработку <a href="<?= get_privacy_policy_url() ?>">персональных данных</a></span>
					</label>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form> -->

		<?php //do_action( 'woocommerce_after_customer_login_form' ); ?>

		</div>
	</section>
</main>
<?php get_footer(); ?>
