<?php
class VenusFeaturedCategoryBlock
{
	public function __construct()
	{
		$this->blocks = array();

		add_action('acf/init', array($this, '_register'));
	}

	public function _register()
	{
		acf_register_block(
			array(
				'name'              => 'featured-category-block',
				'title'             => 'Категория',
				'description'       => 'Категория',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => file_get_contents(__DIR__.'/icon.svg'),
				'mode'              => 'edit',
				'align'             => 'full',
				'supports'          => array(
					'align'         => array('full'),
				),
				'enqueue_assets'    => array($this, '_enqueue_assets'),
			)
		);
	}

	public function _enqueue_assets()
	{
		global $GS;
		$tpath = get_template_directory();
		$cpath = __DIR__;
		$path = explode($tpath,$cpath)[1];
		wp_enqueue_style('featured-category-block',$GS->theme_uri.$path.'/block.css',array(),2);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$category = get_field('category');
		if($category)
		{
			$name = get_field('name');
			if(!$name)
			{
				$name = $category->name;
			}

			$image = get_field('image');
			if(!$image)
			{
				$image = get_term_meta( $category->term_id, 'thumbnail_id', true );
			}
			if(!$image)
			{
				$image = get_option( 'woocommerce_placeholder_image', false );
			}

			$payload = array(
				'block'        => $block,
				'content'      => $content,
				'category'     => $category,
				'name'         => $name,
				'image'        => $image,
				'is_preview'   => $is_preview,
				'block_id'     => $block['id']
			);

			extract($payload);
			include 'render.php';
		}
	}
}

new VenusFeaturedCategoryBlock();
?>