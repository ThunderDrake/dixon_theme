<?php

// 1. ADD FIELDS
 
add_action( 'woocommerce_register_form_start', 'bbloomer_add_name_woo_account_registration' );
 
function bbloomer_add_name_woo_account_registration() {
    ?>
 
 	<label class="form__field form__field--name" for="username">
		<svg class="form__field-icon" width="26" height="26">
			<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#name-input-icon"></use>
		</svg>
		<input class="form__input form__input--name woocommerce-Input woocommerce-Input--text input-text" type="text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>"  placeholder="Введите ваше имя">
	</label>
 
    <div class="clear"></div>
 
    <?php
}
 
///////////////////////////////
// 2. VALIDATE FIELDS
 
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
 
function bbloomer_validate_name_fields( $errors, $username, $email ) {
    if ( isset( $_POST['username'] ) && empty( $_POST['username'] ) ) {
        $errors->add( 'username_error', __( '<strong>Ошибка</strong>: Имя пользователя обязательно к заполнению!', 'woocommerce' ) );
    }
    if ( isset( $_POST['user_email'] ) && empty( $_POST['user_email'] ) ) {
        $errors->add( 'user_email_error', __( '<strong>Ошибка</strong>: E-mail обязательно к заполнению!', 'woocommerce' ) );
    }
    return $errors;
}
 
///////////////////////////////
// 3. SAVE FIELDS
 
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
 
function bbloomer_save_name_fields( $customer_id ) {
    if ( isset( $_POST['username'] ) ) {
        update_user_meta( $customer_id, 'username', sanitize_text_field( $_POST['username'] ) );
        update_user_meta( $customer_id, 'first_name', sanitize_text_field($_POST['username']) );
    }
    if ( isset( $_POST['user_email'] ) ) {
        update_user_meta( $customer_id, 'user_email', sanitize_text_field( $_POST['user_email'] ) );
    }
    if ( isset( $_POST['user_phone'] ) ) {
        update_user_meta( $customer_id, 'user_phone', sanitize_text_field( $_POST['user_phone'] ) );
    }
 
}