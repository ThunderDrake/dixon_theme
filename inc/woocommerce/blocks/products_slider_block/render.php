<?php
if($products && $products->ids)
{
	wc_setup_loop(
		array(
			'columns'      => wc_get_theme_support( 'product_blocks::default_columns', 3 ),
			'name'         => 'slider_block_'.$slider_id,
			'is_shortcode' => true,
			'is_search'    => false,
			'is_paginated' => false,
			'total'        => $products->total,
			'total_pages'  => $products->total_pages,
			'per_page'     => $products->per_page,
			'current_page' => $products->current_page,
		)
	);

	$original_post = $GLOBALS['post'];

	if(wc_get_loop_prop('total'))
	{
		add_filter('woocommerce_product_loop_start', '__return_empty_string');
		add_filter('woocommerce_product_loop_end', '__return_empty_string');
?>
<section class="product-slider-block">
	<div class="wrapper">
		<div class="products-slider-block">
			<div class="title-holder">
				<?php if($title) { ?>
				<div class="block-title"><?=$title?></div>
				<?php } ?>
				<a href="/catalog/">Смотреть всё</a>
			</div>
			<div class="slider-holder">
				<div id="slider-<?=$slider_id?>" class="swiper-container">
					<div class="swiper-wrapper items-grid">
						<?php
							wc_set_loop_prop('product_additional_classes','swiper-slide');

							woocommerce_product_loop_start();
							add_action( 'woocommerce_product_is_visible', array($this,'_set_product_as_visible') );
							foreach ( $products->ids as $product_id )
							{
								$GLOBALS['post'] = get_post( $product_id ); // WPCS: override ok.
								setup_postdata( $GLOBALS['post'] );

								// Set custom product visibility when quering hidden products.

								// Render product template.
								wc_get_template_part( 'content', 'product' );

								// Restore product visibility.
							}
							remove_action( 'woocommerce_product_is_visible', array($this,'_set_product_as_visible') );
							woocommerce_product_loop_end();
						?>
					</div>
				</div>
				<button type="button" class="swiper-button-prev"></button>
				<button type="button" class="swiper-button-next"></button>
			</div>
		</div>
	</div>
</section>



<?php
$script = "
if(typeof window['activeSliders'] != 'object'){window['activeSliders'] = {};}
window.addEventListener('load',function(){window.activeSliders['{$slider_id}'] = new Swiper('#slider-{$slider_id}',{$slider_id}_params)});
var {$slider_id}_slider_h = $('#slider-{$slider_id}').parent('.slider-holder');
var {$slider_id}_params = {
	loop: true,
	speed: 500,
	effect: 'slide',
	spaceBetween: 0,
	roundLengths: true,
	watchOverflow: true,
	slidesPerView: 'auto',
	preventInteractionOnTransition: true,
	navigation: {
		nextEl: {$slider_id}_slider_h.find('.swiper-button-next'),
		prevEl: {$slider_id}_slider_h.find('.swiper-button-prev')
	},
	breakpoints: {
		1439: {
			slidesPerView: 6
		},
		720: {
			slidesPerView: 4
		},
		440: {
			slidesPerView: 2
		},

		439: {
			slidesPerView: 1
		},
		250: {
			slidesPerView: 1
		}
	}
};
";
		wp_add_inline_script('swiper',$script,'after');
		remove_filter('woocommerce_product_loop_start', '__return_empty_string');
		remove_filter('woocommerce_product_loop_end', '__return_empty_string');
	}

$GLOBALS['post'] = $original_post; // WPCS: override ok.

wp_reset_postdata();
wc_reset_loop();

}
?>