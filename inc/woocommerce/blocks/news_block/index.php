<?php
class DiamondPagesSpoilerBlock
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
				'name'              => 'news',
				'title'             => 'Блок новостей',
				'description'       => 'Блок новостей',
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
		$bpath = $GS->theme_uri.$path;
		wp_enqueue_style('posts-spoiler-block',$bpath.'/block.css',array());
		wp_enqueue_script('posts-spoiler-block',$bpath.'/block.js',array('jquery'));
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$type = get_field('post-type');
		$count = get_field('count');

		$payload = array(
			'posts' => $this->_queue($type,$count),
			'type' => get_post_type_object($type),
			'icon' => file_get_contents(__DIR__.'/read-all.svg'),
		);

		extract($payload);
		include 'render.php';
	}

	private function _queue($type,$count)
	{
		$query_args = array(
			'post_type'           => $type,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'no_found_rows'       => false,
			'posts_per_page'      => $count,
		);

		$query = new WP_Query($query_args);

		return $query->posts;
	}
}

new DiamondPagesSpoilerBlock();
?>