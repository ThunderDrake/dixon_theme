<?php
/**
 * Diamond Template Functions.
 *
 * @package diamond
 */

function diamond_breadcrumbs()
{
	if(function_exists('bcn_display'))
	{
	?>
<div class="breadcrumbs-holder"><ol class="breadcrumbs"><?php bcn_display_list(); ?></ol></div>
	<?php
	}
}

function wrap_classic_editor($block_content, $block)
{
	if($block['blockName'] == null and trim($block['innerHTML']) != '')
	{
		$block_content = wptexturize($block_content);
		$block_content = wpautop($block_content);
		return '<div class="classic-editor-block">'.$block_content.'</div>';
	}
	return $block_content;
}

function diamond_remove_default_image_sizes($sizes)
{
	unset( $sizes['medium']);
	unset( $sizes['large']);
	// unset( $sizes['woocommerce_thumbnail']);
	unset( $sizes['woocommerce_single']);
	unset( $sizes['woocommerce_gallery_thumbnail']);
	unset( $sizes['shop_catalog']);
	unset( $sizes['shop_single']);
	unset( $sizes['shop_thumbnail']);
	return $sizes;
}


function diamond_pagination()
{
	include 'templates/pagination.php';
}

function diamond_disable_gutenberg($current_status, $post_type)
{
    if ($post_type === 'gallery') return false;
    return $current_status;
}