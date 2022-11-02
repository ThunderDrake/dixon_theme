<?php
class RepairBlock
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
				'name'              => 'repair-block',
				'title'             => 'Неисправности',
				'description'       => 'Неисправности',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => '',
				'mode'              => 'edit',
				'align'             => 'full',
				'supports'          => array(
					'align' => false,
					'mode'  => false,
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
		wp_enqueue_style('repair_block',$GS->theme_uri.$path.'/block.css',array(),2);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{

		include 'render.php';
	}
}

new RepairBlock();
?>