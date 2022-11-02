<?php
/**
 * Diamond WooCommerce Template Functions.
 *
 * @package diamond
 */

if(!function_exists('formatted_price_only'))
{
	function formatted_price_only($return, $price, $args, $unformatted_price)
	{
		$price = $unformatted_price;
		$args = apply_filters(
			'wc_price_args', wp_parse_args(
				$args, array(
					'ex_tax_label'       => false,
					'currency'           => '',
					'decimal_separator'  => wc_get_price_decimal_separator(),
					'thousand_separator' => wc_get_price_thousand_separator(),
					'decimals'           => wc_get_price_decimals(),
					'price_format'       => get_woocommerce_price_format(),
				)
			)
		);

		$negative          = $price < 0;
		$price             = apply_filters('raw_woocommerce_price', floatval($negative ? $price * -1 : $price));
		$price             = apply_filters('formatted_woocommerce_price', number_format($price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator']), $price, $args['decimals'], $args['decimal_separator'], $args['thousand_separator']);

		if(apply_filters('woocommerce_price_trim_zeros', false) && $args['decimals'] > 0)
		{
			$price = wc_trim_zeros($price);
		}

		# $price = preg_replace('/(\.[1-9]*)[0]*$/', '$1', $price);
		$price = preg_replace('/\.[0]+$/', '', $price);

		$formatted_price = ($negative ? '-' : '') . sprintf($args['price_format'], '' . get_woocommerce_currency_symbol($args['currency']) . '', $price);
		return $formatted_price;
	};
}

# ▼▼▼▼
# Category in loop
# ▼▼▼▼
if(!function_exists('diamond_maybe_show_product_subcategories'))
{
	function diamond_maybe_show_product_subcategories()
	{
		$categories = woocommerce_maybe_show_product_subcategories();
		if($categories != '')
		{
			wc_get_template( 'loop/loop-start-categories.php' );

			echo $categories;

			wc_get_template( 'loop/loop-end-categories.php' );

			wc_set_loop_prop( 'additional_title', true );
		}
	}
}

if(!function_exists('diamond_template_loop_category_link_open'))
{
	function diamond_template_loop_category_link_open($category)
	{
		echo '<a class="categories-grid-category" href="' . esc_url(get_term_link($category, 'product_cat')) . '">';
	}
}

if(!function_exists('diamond_subcategory_thumbnail_wrapper'))
{
	function diamond_subcategory_thumbnail_wrapper()
	{
		echo '<div class="categories-grid-category-thumbnail">';
	}
}

if(!function_exists('diamond_subcategory_thumbnail'))
{
	function diamond_subcategory_thumbnail($category)
	{
		$small_thumbnail_size = apply_filters( 'subcategory_archive_thumbnail_size', 'woocommerce_thumbnail' );
		$placeholder_image = get_option( 'woocommerce_placeholder_image', 0 );
		$thumbnail_id      = get_term_meta( $category->term_id, 'thumbnail_id', true );

		if ( $thumbnail_id ) {
			$image        = get_image( $thumbnail_id, 'full' );
		} else {
			$image        = get_image( $placeholder_image, $small_thumbnail_size );
		}

		echo $image;
	}
}

if(!function_exists('diamond_subcategory_thumbnail_wrapper_end'))
{
	function diamond_subcategory_thumbnail_wrapper_end()
	{
		echo '</div>';
	}
}

if(!function_exists('diamond_template_loop_category_title'))
{
	function diamond_template_loop_category_title($category)
	{
		$helper = esc_html($category->name);
		$cutted = (mb_strlen($category->name) > 60) ? esc_html(mb_strcut($category->name, 0, 57).'...') : $helper;

		?>
		<div class="categories-grid-category-title" title="<?=$helper?>">
			<?=$cutted?> 
			<p>перейти &#8594;</p>
		</div>
		<?php
	}
}

if(!function_exists('diamond_seo_text'))
{
	function diamond_seo_text()
	{
		$page = get_queried_object();
		$seotext = get_field('seo-text',$page);
		if($seotext)
		{
		?>
		<div class="seo-text"><?=$seotext?></div>
		<?php
		}
	}
}

# ▲▲▲▲
# Category in loop
# ▲▲▲▲

# ▼▼▼▼
# Product in loop
# ▼▼▼▼

if(!function_exists('diamond_template_loop_product_wrapper_open'))
{
	function diamond_template_loop_product_wrapper_open()
	{
		echo '<div class="items-grid-item">';
	}
}

if(!function_exists('diamond_template_loop_product_link_open'))
{
	function diamond_template_loop_product_link_open()
	{
		global $product;

		$link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

		echo '<a class="items-grid-item-link" href="' . esc_url($link) . '">';
	}
}

if(!function_exists('diamond_template_loop_product_link_close'))
{
	function diamond_template_loop_product_link_close()
	{
		echo '</a>';
	}
}

if(!function_exists('diamond_template_loop_add_to_cart_wrapper'))
{
	function diamond_template_loop_add_to_cart_wrapper()
	{
		echo '<div class="add-to-cart-holder">';
	}
}

if(!function_exists('diamond_template_loop_add_to_cart_wrapper_close'))
{
	function diamond_template_loop_add_to_cart_wrapper_close()
	{
		echo '</div>';
	}
}

if(!function_exists('diamond_template_loop_product_wrapper_close'))
{
	function diamond_template_loop_product_wrapper_close()
	{
		echo '</div>';
	}
}

if(!function_exists('diamond_template_loop_product_thumbnail_wrapper'))
{
	function diamond_template_loop_product_thumbnail_wrapper()
	{
		echo '<div class="items-grid-item-thumbnail">';
	}
}

if(!function_exists('diamond_show_product_loop_badges'))
{
	function diamond_show_product_loop_badges()
	{
		echo '<div class="badges">';
		wc_get_template( 'loop/sale-flash.php' );
		wc_get_template( 'loop/featured-flash.php' );
		wc_get_template( 'loop/new-flash.php' );
		echo '</div>';
	}
}

if(!function_exists('diamond_template_loop_product_thumbnail'))
{
	function diamond_template_loop_product_thumbnail()
	{
		global $product;
		$image_size = [205,205];
		$image = get_thumb($product->get_id(),$image_size,false);
		if(!$image)
		{
			$placeholder_image = get_option( 'woocommerce_placeholder_image', 0 );
			$image = get_image($placeholder_image,$image_size,false);
		}
		echo $image;
	}
}
 
if(!function_exists('diamond_template_loop_product_quick_view'))
{
	function diamond_template_loop_product_quick_view()
	{
		wc_get_template( 'loop/quick-view.php' );
	}
}

if(!function_exists('diamond_template_loop_product_thumbnail_wrapper_end'))
{
	function diamond_template_loop_product_thumbnail_wrapper_end()
	{
		echo '</div>';
	}
}

if(!function_exists('diamond_template_loop_product_title'))
{
	function diamond_template_loop_product_title()
	{
		$helper = get_the_title();
		// $cutted = (mb_strlen($helper) > 47) ? mb_strcut($helper, 0, 44).'...' : $helper;
		echo '<div class="items-grid-item-title" title="'.$helper.'">'.$helper.'</div>';
	}
}

# ▲▲▲▲
# Product in loop
# ▲▲▲▲

# ▼▼▼▼
# Single product styling
# ▼▼▼▼

if(!function_exists('diamond_before_quantity_input_field'))
{
	function diamond_before_quantity_input_field()
	{
?>
<button type="button" class="qty-minus"></button>
<?php
	}
}
if(!function_exists('diamond_after_quantity_input_field'))
{
	function diamond_after_quantity_input_field()
	{
?>
<button type="button" class="qty-plus"></button>
<?php
	}
}

if(!function_exists('diamond_quantity_input_min'))
{
	function diamond_quantity_input_min($count,$product)
	{
		if($count == -1)
		{
			$count = 1;
		}
		return $count;
	}
}
if(!function_exists('diamond_quantity_input_max'))
{
	function diamond_quantity_input_max($count,$product)
	{
		if($count == -1)
		{
			$count = 100;
		}
		return $count;
	}
}

if(!function_exists('diamond_output_related_products'))
{
	function diamond_output_related_products()
	{
		$args = array(
			'posts_per_page' => 6,
			'columns'        => 3,
		);

		woocommerce_related_products( $args );
	}
}

if(!function_exists('diamond_upsell_and_related_start'))
{
	function diamond_upsell_and_related_start()
	{
		global $GS;
		wp_enqueue_script('swiper', $GS->theme_uri.'/assets/js/swiper.js', array('jquery'));
		wp_enqueue_style('swiper', $GS->theme_uri.'/assets/css/addons/swiper.css', array());
		
		$columns = wc_get_loop_prop( 'columns' );
		$slider_id = wc_get_loop_prop( 'slider_id' );
		if($columns > 5){ $columns = 5; }
		if($columns < 2){ $columns = 2; }
?>
<div id="slider-<?=$slider_id?>" class="swiper-container swiper-bottom-navs row">
	<div class="swiper-wrapper items-grid columns-<?php echo esc_attr( $columns ); ?>">
<?php
	}
}

if(!function_exists('diamond_upsell_and_related_end'))
{
	function diamond_upsell_and_related_end()
	{
?>
	</div>
	<div class="swiper-controls">
		<button type="button" class="swiper-button-prev">
			<?=inline('assets/svg/slider-button.svg')?>
		</button>
		<div class="swiper-numbers">
			<div class="swiper-numbers-current">1</div>
			<div class="swiper-numbers-delimiter"></div>
			<div class="swiper-numbers-total"><?=wc_get_loop_prop( 'total' )?></div>
		</div>
		<button type="button" class="swiper-button-next">
			<?=inline('assets/svg/slider-button.svg')?>
		</button>
	</div>
</div>
<?php
	$slider_id = wc_get_loop_prop( 'slider_id' );
	$script = "
		if(typeof window['activeSliders'] != 'object')
		{
			window['activeSliders'] = {};
		}
		var {$slider_id}_params = {
			speed:1000,
			effect:'slide',
			spaceBetween:0,
			slidesPerView:'auto',
			loop:true,
			preventInteractionOnTransition:true,
			navigation: {
				nextEl:'.swiper-button-next',
				prevEl:'.swiper-button-prev'
			},
			on: {
				init:function() {
					this.\$currentSlideNum = this.\$el.find('.swiper-numbers-current');
				},
				slideChange:function() {
					if(this.\$currentSlideNum)
					{
						index = this.realIndex+1;
						this.\$currentSlideNum.html(''+index);
					}
				}
			}
		};
		window.addEventListener('load',function(){
			window.activeSliders['{$slider_id}'] = new Swiper('#slider-{$slider_id}',{$slider_id}_params);
		});
		";
		wp_add_inline_script('swiper',$script,'after');
	}
}

if(!function_exists('diamond_review_display_comment_text'))
{
	function diamond_review_display_comment_text()
	{
		comment_text();
	}
}

if(!function_exists('diamond_product_get_rating_html'))
{
	function diamond_product_get_rating_html($html, $rating, $count)
	{
		if($count == 0)
		{
			return '<div class="rating has-'.$rating.'-stars"></div>';
		}
		return $html;
	}
}

if(!function_exists('diamond_product_tabs'))
{
	function diamond_product_tabs($tabs)
	{
		// var_dump($tabs);
		// unset($tabs['reviews']);
		// var_dump($tabs);
		// global $product;
		// if(get_field('prd-video',$product->get_id()))
		// {
		// 	$tabs['video'] = array(
		// 		'title' => 'Видео',
		// 		'priority' => 25,
		// 		'callback' => 'diamond_product_video',
		// 	);
		// }
		$tabs['additional_information']['title'] = '';
		return $tabs;
	}
}

if(!function_exists('diamond_product_video'))
{
	function diamond_product_video()
	{
		global $product;
		$src = get_field('prd-video',$product->get_id());
		if(substr($src, 0, 25) == 'https://andrey-company.ru')
		{
			$src = get_site_url().'/video-proxy.php?src='.urlencode($src);
		}
		echo '<div class="embed-container"><iframe src="'.$src.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
	}
}

if(!function_exists('diamond_product_additional_information_heading'))
{
	function diamond_product_additional_information_heading($title)
	{
		return '';
	}
}

# ▲▲▲▲
# Single product styling
# ▲▲▲▲

if(!function_exists('diamond_sorting_wrapper'))
{
	function diamond_sorting_wrapper()
	{
		echo '<div class="items-grid-controls">';
	}
}

if(!function_exists('diamond_sorting_wrapper_close'))
{
	function diamond_sorting_wrapper_close()
	{
		echo '</div>';
	}
}

if(!function_exists('diamond_shop_messages'))
{
	function diamond_shop_messages()
	{
		if(!is_checkout())
		{
			echo wp_kses_post(do_shortcode('woocommerce_messages'));
		}
	}
}

if(!function_exists('diamond_add_to_cart_fragments'))
{
	function diamond_add_to_cart_fragments($fragments)
	{
		unset($fragments['div.widget_shopping_cart_content']);

		ob_start();
		wc_get_template('cart/mini-cart.php');
		$cart = ob_get_clean();
		$fragments['#cart-content-fragment'] = $cart;

		// ob_start();
		// wc_get_template('cart/widget-mobile.php');
		// $cart_mobile = ob_get_clean();
		// $fragments['#mobile-cart'] = $cart_mobile;

		return $fragments;
	}
}


if(!function_exists('diamond_update_order_review_fragments'))
{
	function diamond_update_order_review_fragments($fragments)
	{
		ob_start();
		diamond_woocommerce_shipping_methods();
		$diamond_woocommerce_shipping_methods = ob_get_clean();
		$fragments['.woocommerce-checkout-shipping'] = $diamond_woocommerce_shipping_methods;
		return $fragments;
	}
}
if(!function_exists('diamond_woocommerce_shipping_methods'))
{
	function diamond_woocommerce_shipping_methods($deprecated = false)
	{
		wc_get_template('checkout/shipping-methods.php', array(
			'checkout' => WC()->checkout(),
		));
	}
}

if(!function_exists('diamond_update_order_shipping_fragments'))
{
	function diamond_update_order_shipping_fragments($fragments)
	{
		ob_start();
		diamond_woocommerce_shipping_method_fields();
		$diamond_woocommerce_shipping_method_fields = ob_get_clean();
		$fragments['.woocommerce-checkout-shipping-special'] = $diamond_woocommerce_shipping_method_fields;
		return $fragments;
	}
}
if(!function_exists('diamond_update_order_mobile_totals'))
{
	function diamond_update_order_mobile_totals($deprecated = false)
	{
		wc_get_template('checkout/mobile-totals.php', array(
			'checkout' => WC()->checkout(),
		));
	}
}

if(!function_exists('diamond_update_order_mobile_totals_fragments'))
{
	function diamond_update_order_mobile_totals_fragments($fragments)
	{
		ob_start();
		diamond_update_order_mobile_totals();
		$diamond_update_order_mobile_totals = ob_get_clean();
		$fragments['.mobile-totals'] = $diamond_update_order_mobile_totals;
		return $fragments;
	}
}


if(!function_exists('diamond_woocommerce_shipping_method_fields'))
{
	function diamond_woocommerce_shipping_method_fields()
	{
		wc_get_template('checkout/shipping-method-fields.php', array(
			'checkout' => WC()->checkout()
		));
	}
}
 
if(!function_exists('diamond_disable_ondelivery_payment_for_local'))
{
	function diamond_disable_ondelivery_payment_for_local($available_gateways)
	{
		if(!is_admin())
		{
			$chosen_methods = WC()->session->get('chosen_shipping_methods');

			$chosen_shipping = $chosen_methods[0];

			if(isset($available_gateways['cod']) && 0 === strpos($chosen_shipping, 'local_pickup'))
			{
				unset($available_gateways['cod']);
			}

			if(isset($available_gateways['cod']) && 0 === strpos($chosen_shipping, 'rfmail'))
			{
				unset($available_gateways['cod']);
			}
		}
		return $available_gateways;
	}
}

if(!function_exists('diamond_cart_totals_shipping_method_label'))
{
	function diamond_cart_totals_shipping_method_label($ignored, $method)
	{
		$label     = $method->get_label();
		$has_cost  = 0 < $method->cost;
		$hide_cost = ! $has_cost && in_array($method->get_method_id(), array('free_shipping', 'local_pickup'), true);

		if($has_cost && ! $hide_cost)
		{
			if(WC()->cart->display_prices_including_tax())
			{
				$label .= ' (' . wc_price($method->cost + $method->get_shipping_tax()) . ')';
				if($method->get_shipping_tax() > 0 && ! wc_prices_include_tax())
				{
					$label .= ' <small class="tax_label">' . WC()->countries->inc_tax_or_vat() . '</small>';
				}
			}
			else
			{
				$label .= ' (' . wc_price($method->cost) . ')';
				if($method->get_shipping_tax() > 0 && wc_prices_include_tax())
				{
					$label .= ' <small class="tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
				}
			}
		}

		return $label;
	}
}

if(!function_exists('diamond_gateway_icon'))
{
	function diamond_gateway_icon($icon,$id)
	{
		$uri = get_template_directory_uri();
		$has = array(
			'rbspayment' => $uri.'/assets/images/gateway/sberbank.png',
			'ym_api_epl' => $uri.'/assets/images/gateway/yandex.png',
			'cod' => $uri.'/assets/images/gateway/local.png',
			'colp' => $uri.'/assets/images/gateway/local.png',
		);
		if(!array_key_exists($id, $has))
		{
			return $icon;
		}
		preg_match('/alt="([^"]*)"/', $icon, $title);
		if($title)
		{
			$title = $title[1];
		}
		else
		{
			$title = '';
		}
		$icon = '<img src="'.WC_HTTPS::force_https_url($has[$id]).'" alt="'.$title.'" title="'.$title.'" />';
		return $icon;
	}
}


function diamond_default_checkout_country($country)
{
	return $country ? $country : 'RU';
}

function diamond_default_checkout_state($state)
{
	return $state ? $state : 'САНКТ-ПЕТЕРБУРГ';
}

function diamond_form_field_hidden($field,  $key,  $args,  $value)
{
	$attr = '';
	if($args['required'])
	{
		$attr .= 'required="required"';
	}
	$field_container = '<p class="form-row %1$s" id="%2$s">%3$s</p>'; //  style="display: none"
	$field_html = '<input type="hidden" class="input-text ' . esc_attr( implode( ' ', $args['input_class'] ) ) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . esc_attr($value) . '" '.$attr.'/>';
	$container_class = esc_attr( implode( ' ', $args['class'] ) );
	$container_id    = esc_attr( $args['id'] ) . '_field';
	$field           = sprintf( $field_container, $container_class, $container_id, $field_html );
	return $field;
}

function diamond_checkout_field_update_user_meta( $user_id )
{
	$_SESSION['asd'] = 'asd';
	if(isset($_POST['shipping_state']))
	{
		if($user_id)
		{
			update_user_meta( $user_id, 'shipping_state', esc_attr($_POST['shipping_state']) );
		}
		WC()->session->set('shipping_state', esc_attr($_POST['shipping_state']) );
	}
	if(isset($_POST['shipping_first_name']))
	{
		if($user_id)
		{
			update_user_meta( $user_id, 'shipping_first_name', esc_attr($_POST['shipping_first_name']) );
		}
		WC()->session->set('shipping_first_name', esc_attr($_POST['shipping_first_name']) );
	}
	if(isset($_POST['shipping_postcode']))
	{
		if($user_id)
		{
			update_user_meta( $user_id, 'shipping_postcode', esc_attr($_POST['shipping_postcode']) );
		}
		WC()->session->set('shipping_postcode', esc_attr($_POST['shipping_postcode']) );
	}
	if(isset($_POST['shipping_address_1']))
	{
		WC()->session->set('shipping_address_1', esc_attr($_POST['shipping_address_1']) );

		if($user_id)
		{
			update_user_meta( $user_id, 'shipping_address_1', esc_attr($_POST['shipping_address_1']) );
		}
	}
}

function diamond_checkout_validattion_errors( $fields, $errors )
{
	// // if any validation errors
	// if( !empty( $errors->get_error_codes() ) ) {
 
	// 	// remove all of them
	// 	foreach( $errors->get_error_codes() as $code ) {
	// 		$errors->remove( $code );
	// 	}
 
	// 	// add our custom one
	// 	$errors->add( 'validation', 'Please fill the fields!' );
 
	// }
}

// function diamond_checkout_get_value($ignore=null,$key)
// {
// 	if($key == 'shipping_address_1')
// 	{
// 		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
// 		$chosen_shipping = $chosen_methods[0];
// 		$chosen_shipping = preg_split('/\:/', $chosen_shipping);
// 		$chosen_shipping = array_shift($chosen_shipping);

// 		if($chosen_shipping == 'pickpoint')
// 		{
// 			return '';
// 		}
// 	}
// 	$val = WC()->session->get($key,null);
// 	if($val)
// 	{
// 		return $val;
// 	}
// 	return null;
// }

function diamond_archive_thumbnail_size($size)
{
	return [150,150];
}

function diamond_display_product_attributes($product_attributes, $product)
{
	$sku = $product->get_sku();
	if($sku)
	{
		array_unshift($product_attributes, array(
			'label' => 'Артикул',
			'value' => $sku,
		));
	}
	return $product_attributes;
}

function diamond_short_attributes()
{
	global $product;
	$usable = [12,15,16];
	$attributes = $product->get_attributes();
	echo '<div class="items-grid-item-attributes">';
	$sku = $product->get_sku();
	if($sku)
	{
		echo '<div class="items-grid-item-attributes-attribute">';
			echo '<div class="items-grid-item-attribute-label">Артикул</div>';
			echo '<div class="items-grid-item-attribute-values">'.$sku.'</div>';
		echo '</div>';
	}
	foreach($attributes as $attribute)
	{
		if(in_array($attribute->get_id(),$usable))
		{
			$attr = $attribute->get_name();
			$label = wc_attribute_label($attr,$product);
			// var_dump($label);
			$terms = wc_get_product_terms(
				$product->get_id(),
				$attr,
				array(
					'fields' => 'all',
				)
			);
			$values = [];
			foreach($terms as $term)
			{
				$values[] = $term->name;
			}
			if(!empty($values))
			{
				echo '<div class="items-grid-item-attributes-attribute">';
					echo '<div class="items-grid-item-attribute-label">'.$label.'</div>';
					echo '<div class="items-grid-item-attribute-values">'.implode(',', $values).'</div>';
				echo '</div>';
			}
		}
	}
	echo '</div>';
}