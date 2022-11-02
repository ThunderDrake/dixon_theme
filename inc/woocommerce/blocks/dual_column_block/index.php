<?php
class VenusDualColumnBlock
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
				'name'              => 'dual-column',
				'title'             => 'Две колонки',
				'description'       => 'Две колонки',
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
		wp_enqueue_style('dual-column-block',$GS->theme_uri.$path.'/block.css',array(),3);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$title = get_field('title');
		$text = get_field('text');

		$payload = array(
			'block'        => $block,
			'content'      => $content,
			'title'        => $title,
			'text'         => $text,
			'is_preview'   => $is_preview,
			'block_id'     => $block['id']
		);

		extract($payload);
		include 'render.php';
	}
}

new VenusDualColumnBlock();
?>