<?php
class VenusWidgetLineBlock
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
				'name'              => 'widget-line',
				'title'             => 'Полоса виджетов',
				'description'       => 'Полоса виджетов',
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
		// add_editor_style('widget-line',$bpath.'/block.css',array());
		wp_enqueue_style('widget-line',$bpath.'/block.css',array());
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		include 'render.php';
	}
}

new VenusWidgetLineBlock();
?>