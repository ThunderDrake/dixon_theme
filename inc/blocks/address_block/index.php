<?php
class DiamondAddressBlock
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
				'name'              => 'address-block',
				'title'             => 'Адрес',
				'description'       => 'Адрес',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 296.999 296.999" xml:space="preserve"><path d="M141.914,185.802c1.883,1.656,4.234,2.486,6.587,2.486c2.353,0,4.705-0.83,6.587-2.486c2.385-2.101,58.391-52.021,58.391-103.793c0-35.842-29.148-65.002-64.977-65.002c-35.83,0-64.979,29.16-64.979,65.002C83.521,133.781,139.529,183.701,141.914,185.802z M148.501,65.025c9.302,0,16.845,7.602,16.845,16.984c0,9.381-7.543,16.984-16.845,16.984c-9.305,0-16.847-7.604-16.847-16.984C131.654,72.627,139.196,65.025,148.501,65.025z"/><path d="M273.357,185.773l-7.527-26.377c-1.222-4.281-5.133-7.232-9.583-7.232h-53.719c-1.942,2.887-3.991,5.785-6.158,8.699c-15.057,20.23-30.364,33.914-32.061,35.41c-4.37,3.848-9.983,5.967-15.808,5.967c-5.821,0-11.434-2.117-15.81-5.969c-1.695-1.494-17.004-15.18-32.06-35.408c-2.167-2.914-4.216-5.813-6.158-8.699h-53.72c-4.45,0-8.361,2.951-9.583,7.232l-8.971,31.436l200.529,36.73L273.357,185.773z"/><path d="M296.617,267.291l-19.23-67.396l-95.412,80.098h105.06c3.127,0,6.072-1.467,7.955-3.963C296.873,273.533,297.474,270.297,296.617,267.291z"/><path d="M48.793,209.888l-30.44-5.576L0.383,267.291c-0.857,3.006-0.256,6.242,1.628,8.738c1.883,2.496,4.828,3.963,7.955,3.963h38.827V209.888z"/><polygon points="62.746,212.445 62.746,279.992 160.273,279.992 208.857,239.207 "/></svg>',
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
		wp_enqueue_style('address-block',$GS->theme_uri.$path.'/block.css',array(),2);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$block_id = $block['id'];
		$map = get_field('map',$block_id);
		$photo = get_field('photo',$block_id);
		$address = get_field('address',$block_id);
		$clocks = get_field('clocks',$block_id);
		$phones = get_field('phones',$block_id);
		$emails = get_field('emails',$block_id);

		include 'render.php';
	}
}

new DiamondAddressBlock();
?>