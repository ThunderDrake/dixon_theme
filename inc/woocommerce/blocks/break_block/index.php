<?php
class VenusBreakBlock
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
				'name'              => 'break-block',
				'title'             => 'Разрыв',
				'description'       => 'Разрыв',
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
		wp_enqueue_style('break-block',$bpath.'/block.css',array(),2);
		// wp_enqueue_script('break-block',$bpath.'/block.js',array());
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$bg = get_field('bg');

		if($bg)
		{
			$bg = get_image_src($bg,'full');
		}
		else
		{
			$bg = false;
		}

		$payload = array(
			'block'        => $block,
			'content'      => $content,
			'bg'           => $bg,
			'is_preview'   => $is_preview,
			'block_id'     => $block['id']
		);

		extract($payload);
		include 'render.php';
	}
}

new VenusBreakBlock();
?>