<?php
add_filter('block_categories', 'diamond_add_blocks_category', 10, 2 );
add_action('enqueue_block_editor_assets', 'diamond_block_editor_assets' );

function diamond_add_blocks_category($categories, $post)
{
	return array_merge(
		$categories,
		array(
			array(
				'slug'  => 'diamond-template-blocks',
				'title' => 'Блоки Diamond',
				'icon'  => null,
			),
		)
	);
}

function diamond_block_editor_assets()
{
	global $diamond_version;
	wp_enqueue_style('diamond-template-blocks-grid', get_theme_file_uri( '/assets/css/admin/grid.css' ), array(), $diamond_version, 'all');
	wp_add_inline_script('jquery','if(typeof window.$ == "undefined"){window.$ = jQuery}','after');
	wp_enqueue_script('diamond-template-blocks', get_theme_file_uri( '/assets/js/admin/gutenberg-blocks.js' ), array( 'jquery','wp-blocks' ), $diamond_version, 'all');
}

include 'blocks/address_block/index.php';
include 'blocks/requisites_block/index.php';
include 'blocks/slider_block/index.php';
include 'blocks/about_block/index.php';
include 'blocks/advant_block/index.php';
include 'blocks/repair_block/index.php';