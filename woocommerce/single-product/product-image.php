<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$main_image_id = $product->get_image_id();
$attachment_ids = $product->get_gallery_image_ids();

$images = array();
$thumbs = array();
$img_size = 'full';
$thumb_size = [200,450];

if($main_image_id)
{
	array_unshift($attachment_ids, $main_image_id);
	$attachment_ids = array_unique($attachment_ids);
}
else
{
	$images[] = sprintf( '<img src="%s"/>', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ));
}

if($attachment_ids)
{
	foreach($attachment_ids as $attachment_id)
	{
		$images[] = get_image_lightbox($attachment_id, $img_size, true, 'gallery');
		$thumbs[] = get_image($attachment_id, $thumb_size, true);
	}
}
?>
<div class="product-gallery-wrapper">
	<div class="product-gallery-images <?php if(count($thumbs) > 1) { ?> halfwidth <?php } ?>">
		<button class="swiper-button-prev"></button>
		<button class="swiper-button-next"></button>
		<div class="product-images swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ($images as $image) { ?>
				<div class="product-gallery-image swiper-slide"><?=$image?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
	if(count($thumbs) > 1)
	{
	?>
	<div class="product-gallery-thumbnails">
		<div class="product-thumbnails swiper-container">
			<div class="swiper-wrapper">
				<?php foreach ($thumbs as $thumb) { ?>
				<div class="product-gallery-thumbnail swiper-slide"><?=$thumb?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div>