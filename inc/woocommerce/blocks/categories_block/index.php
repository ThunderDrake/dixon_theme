<?php
class VenusCategoriesWithSidebarBlock
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
				'name'              => 'categories-block',
				'title'             => 'Категории',
				'description'       => 'Категории',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => file_get_contents(__DIR__.'/icon.svg'),
				'mode'              => 'preview',
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
		// global $GS;
		// $tpath = get_template_directory();
		// $cpath = __DIR__;
		// $path = explode($tpath,$cpath)[1];
		// wp_enqueue_style('categories-block',$GS->theme_uri.$path.'/block.css',array());
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$payload = array(
			'block'        => $block,
			'content'      => $content,
			'with_sidebar' => get_field('with_sidebar'),
			'categories'   => $this->_queue(),
			'is_preview'   => $is_preview,
			'block_id'     => $block['id']
		);

		extract($payload);
		include 'render.php';
	}

	private function _queue()
	{
		$raw = get_field('grid');

		$ids = array();
		$names = array();

		foreach ($raw as $key => $value)
		{
			$ids[] = $value['category'];
			if($value['name'])
			{
				$names[$value['category']] = $value['name'];
			}
		}

		$ids = wp_parse_id_list($ids);
		$total = count($ids);

		$categories = (object) array(
			'ids'          => $ids,
			'names'        => $names,
			'total'        => $total,
			'total_pages'  => 1,
			'per_page'     => $total,
			'current_page' => 1,
		);

		return $categories;
	}
}

new VenusCategoriesWithSidebarBlock();
?>