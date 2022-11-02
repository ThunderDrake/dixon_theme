<?php
/**
 * Diamond WooCommerce hooks
 *
 * @package diamond
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10 );
remove_action( 'woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10 );
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
remove_action( 'woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);

remove_filter( 'woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories' );

/*
 * Products/Categories Loop
 */
// add_action( 'woocommerce_before_shop_loop', 'diamond_sorting_wrapper', 9 );
// add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10 );
// add_action( 'woocommerce_before_shop_loop', 'diamond_sorting_wrapper_close', 31 );
// add_action( 'woocommerce_before_shop_loop', 'diamond_category_num_init', 40 );

add_action( 'woocommerce_before_main_content', 'diamond_breadcrumbs', 20 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30 );
add_filter( 'woocommerce_display_product_attributes', 'diamond_display_product_attributes', 10, 2);
/*
 * Category in loop
 */
add_action( 'woocommerce_before_subcategory', 'diamond_template_loop_category_link_open', 10 );
add_action( 'woocommerce_before_subcategory_title', 'diamond_subcategory_thumbnail_wrapper', 5);
add_action( 'woocommerce_before_subcategory_title', 'diamond_subcategory_thumbnail', 10);
add_action( 'woocommerce_before_subcategory_title', 'diamond_subcategory_thumbnail_wrapper_end', 15);
add_action( 'woocommerce_shop_loop_subcategory_title', 'diamond_template_loop_category_title', 10 );

/*
 * Product in loop
 */
add_action( 'woocommerce_before_shop_loop_item', 'diamond_template_loop_product_wrapper_open', 5 );
add_action( 'woocommerce_before_shop_loop_item', 'diamond_template_loop_product_link_open', 10 );

add_action( 'woocommerce_before_shop_loop_item_title', 'diamond_template_loop_product_thumbnail_wrapper', 5);
// add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 6 );
// add_action( 'woocommerce_before_shop_loop_item_title', 'diamond_show_product_loop_badges', 6 );
add_action( 'woocommerce_before_shop_loop_item_title', 'diamond_template_loop_product_thumbnail', 10);
// add_action( 'woocommerce_before_shop_loop_item_title', 'diamond_template_loop_product_quick_view', 14);
add_action( 'woocommerce_before_shop_loop_item_title', 'diamond_template_loop_product_thumbnail_wrapper_end', 15);

add_action( 'woocommerce_shop_loop_item_title', 'diamond_template_loop_product_title', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'diamond_short_attributes', 1 );

add_action( 'woocommerce_after_shop_loop_item', 'diamond_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'diamond_template_loop_add_to_cart_wrapper', 9 );
add_action( 'woocommerce_after_shop_loop_item', 'diamond_template_loop_add_to_cart_wrapper_close', 11 );
add_action( 'woocommerce_after_shop_loop_item', 'diamond_template_loop_product_wrapper_close', 15 );

/*
 * Product
 */
add_action( 'diamond_single_product_information', 'woocommerce_output_product_data_tabs', 10);
add_filter( 'woocommerce_product_additional_information_heading', 'diamond_product_additional_information_heading' );
add_action( 'woocommerce_after_single_product_summary', 'diamond_output_related_products', 15);
add_action( 'woocommerce_before_quantity_input_field', 'diamond_before_quantity_input_field', 10);
add_action( 'woocommerce_after_quantity_input_field', 'diamond_after_quantity_input_field', 10);
add_action( 'woocommerce_quantity_input_min', 'diamond_quantity_input_min', 10, 2);
add_action( 'woocommerce_quantity_input_max', 'diamond_quantity_input_max', 10, 2);

// add_action( 'woocommerce_before_single_product_summary', 'diamond_show_product_loop_badges', 10 );
/*
 * Page
 */
add_action( 'diamond_content_top', 'diamond_shop_messages', 15 );
add_action( 'woocommerce_after_main_content', 'diamond_seo_text', 20);

add_action( 'diamond_footer', 'diamond_handheld_footer_bar', 999 );
add_filter( 'wc_price', 'formatted_price_only', 10, 4 );

add_action( 'woocommerce_review_comment_text', 'diamond_review_display_comment_text', 10 );
add_filter( 'woocommerce_product_get_rating_html', 'diamond_product_get_rating_html', 10, 3);

add_filter( 'woocommerce_add_to_cart_fragments', 'diamond_add_to_cart_fragments' );
add_filter( 'woocommerce_update_order_review_fragments', 'diamond_update_order_review_fragments', 10 );
add_filter( 'woocommerce_update_order_review_fragments', 'diamond_update_order_shipping_fragments', 15 );
add_filter( 'woocommerce_update_order_review_fragments', 'diamond_update_order_mobile_totals_fragments', 20 );

// add_filter( 'woocommerce_available_payment_gateways', 'diamond_disable_ondelivery_payment_for_local' );
// add_filter( 'woocommerce_cart_shipping_method_full_label', 'diamond_cart_totals_shipping_method_label', 10, 2 );
// add_filter( 'woocommerce_gateway_icon', 'diamond_gateway_icon', 10, 2 );
// add_filter( 'default_checkout_shipping_country', 'diamond_default_checkout_country' );
// add_filter( 'default_checkout_shipping_state', 'diamond_default_checkout_state' );
// add_filter( 'woocommerce_form_field_hidden', 'diamond_form_field_hidden', 10, 4 );
// add_action( 'woocommerce_checkout_update_user_meta', 'diamond_checkout_field_update_user_meta' );
// add_action( 'woocommerce_after_checkout_validation', 'diamond_checkout_validattion_errors', 9999, 2);
// add_action( 'woocommerce_checkout_get_value', 'diamond_checkout_get_value', 10, 2);

// add_action( 'woocommerce_checkout_get_value', 'diamond_checkout_get_value', 10, 2);
add_filter( 'woocommerce_product_tabs', 'diamond_product_tabs', 20, 2);
add_filter( 'subcategory_archive_thumbnail_size', 'diamond_archive_thumbnail_size', 20, 2);