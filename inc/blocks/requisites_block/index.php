<?php
class DiamondRequisitesBlock
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
				'name'              => 'requisites-block',
				'title'             => 'Реквизиты',
				'description'       => 'Реквизиты',
				'post_types'        => array('post', 'page'),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 31.939 31.939" xml:space="preserve"><path d="M15.58,18.332h-0.777c-0.403,0-0.73-0.326-0.73-0.729c0-0.149,0.06-0.293,0.167-0.397c0.452-0.439,0.832-1.03,1.107-1.667c0.056,0.041,0.116,0.071,0.184,0.071c0.436,0,0.95-0.964,0.95-1.621c0-0.657-0.061-1.19-0.498-1.19c-0.052,0-0.106,0.009-0.162,0.023c-0.031-1.782-0.481-4.005-3.202-4.005c-2.839,0-3.17,2.219-3.202,3.999c-0.04-0.008-0.08-0.017-0.117-0.017c-0.437,0-0.497,0.533-0.497,1.19c0,0.657,0.512,1.621,0.949,1.621c0.054,0,0.104-0.015,0.151-0.042c0.274,0.627,0.649,1.206,1.094,1.641c0.107,0.104,0.167,0.246,0.167,0.396c0,0.403-0.327,0.73-0.73,0.73H9.656c-1.662,0-3.009,1.347-3.009,3.009v0.834c0,0.524,0.425,0.95,0.95,0.95h10.042c0.524,0,0.949-0.426,0.949-0.95v-0.834C18.589,19.68,17.242,18.332,15.58,18.332z"/><path d="M24.589,10.077h-8.421c0.243,0.538,0.417,1.2,0.489,2.019c0.18,0.111,0.315,0.29,0.425,0.506h7.507c0.39,0,0.704-0.315,0.704-0.704v-1.117C25.293,10.393,24.979,10.077,24.589,10.077z"/><path d="M24.589,14.678h-7.335c-0.199,0.752-0.689,1.539-1.368,1.749c-0.02,0.037-0.043,0.069-0.064,0.106v0.67h8.766c0.389,0,0.704-0.315,0.704-0.705v-1.116C25.293,14.993,24.979,14.678,24.589,14.678z"/><path d="M24.589,19.279h-5.726c0.378,0.598,0.6,1.303,0.6,2.062v0.463h5.126c0.39,0,0.704-0.315,0.704-0.704v-1.117C25.293,19.594,24.979,19.279,24.589,19.279z"/><path d="M27.615,3.057H4.325C1.936,3.057,0,4.993,0,7.382v17.176c0,2.39,1.936,4.325,4.325,4.325h23.29c2.389,0,4.324-1.936,4.324-4.325V7.382C31.939,4.993,30.004,3.057,27.615,3.057z M29.898,24.558c0,1.259-1.024,2.283-2.283,2.283H4.325c-1.259,0-2.283-1.024-2.283-2.283V7.382c0-1.259,1.024-2.283,2.283-2.283h23.29c1.259,0,2.283,1.024,2.283,2.283V24.558z"/></svg>',
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
		wp_enqueue_style('requisites-block',$GS->theme_uri.$path.'/block.css',array(),2);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$label = get_field('label');
		$requisites = get_field('requisites');
		$file = get_field('file');

		include 'render.php';
	}
}

new DiamondRequisitesBlock();
?>