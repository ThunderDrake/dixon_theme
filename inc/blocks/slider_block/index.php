<?php
class SliderBlock
{
	public function __construct()
	{
		add_action('acf/init', array($this, '_register'));
		add_action('acf/init', array($this,'_init_fields'));
	}

	public function _register()
	{
		acf_register_block_type(
			array(
				'name'              => 'slider',
				'title'             => 'Слайдер',
				'description'       => 'Слайдер',
				// 'post_types'        => array(),
				'render_callback'   => array($this, '_render'),
				'category'          => 'diamond-template-blocks',
				'icon'              => '',
				'mode'              => 'edit',
				'align'             => 'full',
				'supports'          => array(
					'align' => array('full','wide'),
					'mode'  => true,
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
		wp_enqueue_script('swiper', $GS->theme_uri.'/assets/js/swiper.js', array('jquery'));
		wp_enqueue_style('swiper', $GS->theme_uri.'/assets/css/addons/swiper.css', array());
		wp_enqueue_style('slider',$GS->theme_uri.$path.'/block.css',array('main'),2);
		return;
	}

	public function _render($block, $content = '', $is_preview = false)
	{
		$id = $block['id'];
		include 'render.php';
	}

	public function _button($params)
	{
		$result = false;
		switch ($params['action'])
		{
			case 'button':
				$result = '<button type="button" data-target="modal" data-action="';
				if($params['button'] != 'another')
				{
					$result .= $params['button'].'">';
				}
				else
				{
					$result .= $params['another'].'">';
				}
				$result .= $params['action-title'].'</button>';
				break;
			
			case 'link':
				if($params['link'] != '')
				{
					$result = '<a href="'.$params['link'].'">'.$params['action-title'].'</a>';
				}
				break;
		}
		return $result;
	}

	public function _init_fields()
	{
		acf_add_local_field_group(array(
			'key' => 'group_slider_block',
			'title' => 'Параметры слайдера',
			'fields' => array(
				array(
					'key' => 'field_settings_tab',
					'label' => 'Настройки',
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'left',
					'endpoint' => 0,
				),
				array(
					'key' => 'field_settings_title',
					'label' => 'Заголовок',
					'name' => 'title',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
				array(
					'key' => 'field_settings_classes',
					'label' => 'Доп. классы',
					'name' => 'classes',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => '',
					'max' => '',
					'step' => '',
				),
				array(
					'key' => 'field_settings_mode',
					'label' => 'Анимация',
					'name' => 'mode',
					'type' => 'button_group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array(
						'slide' => 'Сдвиг',
						'fade' => 'Исчезновение',
						// 'cube' => 'Куб',
						'coverflow' => 'Перекрытие',
					),
					'allow_null' => 0,
					'default_value' => 'slide',
					'layout' => 'horizontal',
					'return_format' => 'value',
				),
				array(
					'key' => 'field_settings_duration',
					'label' => 'Длительность анимации',
					'name' => 'duration',
					'type' => 'range',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 1,
					'min' => '0.5',
					'max' => 3,
					'step' => '0.5',
					'prepend' => '',
					'append' => 'с',
				),
				array(
					'key' => 'field_settings_delay',
					'label' => 'Время автопереключения слайдера',
					'name' => 'delay',
					'type' => 'range',
					'instructions' => '0 - слайды переключаются вручную',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => 3,
					'min' => 0,
					'max' => 6,
					'step' => 1,
					'prepend' => '',
					'append' => 'с',
				),
				array(
					'key' => 'field_settings_sizes',
					'label' => 'Размеры',
					'name' => 'sizes',
					'type' => 'group',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'layout' => 'table',
					'sub_fields' => array(
						array(
							'key' => 'field_settings_sizes_width',
							'label' => 'Ширина',
							'name' => 'width',
							'type' => 'number',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
						array(
							'key' => 'field_settings_sizes_height',
							'label' => 'Высота',
							'name' => 'height',
							'type' => 'number',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'default_value' => '',
							'placeholder' => '',
							'prepend' => '',
							'append' => '',
							'min' => '',
							'max' => '',
							'step' => '',
						),
					),
				),
				array(
					'key' => 'field_slides_tab',
					'label' => 'Слайды',
					'name' => '',
					'type' => 'tab',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'placement' => 'left',
					'endpoint' => 0,
				),
				array(
					'key' => 'field_slides',
					'label' => '',
					'name' => 'slides',
					'type' => 'repeater',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'collapsed' => 'field_slides_image',
					'min' => 0,
					'max' => 0,
					'layout' => 'block',
					'button_label' => '',
					'sub_fields' => array(
						array(
							'key' => 'field_slides_image',
							'label' => 'Изображение',
							'name' => 'image',
							'type' => 'image',
							'instructions' => '',
							'required' => 0,
							'conditional_logic' => 0,
							'wrapper' => array(
								'width' => '',
								'class' => '',
								'id' => '',
							),
							'return_format' => 'id',
							'preview_size' => 'full',
							'library' => 'all',
							'min_width' => '',
							'min_height' => '',
							'min_size' => '',
							'max_width' => '',
							'max_height' => '',
							'max_size' => '',
							'mime_types' => '',
						),
						// array(
						// 	'key' => 'field_slides_text',
						// 	'label' => 'Текст',
						// 	'name' => 'text',
						// 	'type' => 'wysiwyg',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => 0,
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'default_value' => '',
						// 	'tabs' => 'visual',
						// 	'toolbar' => 'full',
						// 	'media_upload' => 0,
						// 	'delay' => 0,
						// ),
						// array(
						// 	'key' => 'field_slides_action',
						// 	'label' => 'Действие',
						// 	'name' => 'action',
						// 	'type' => 'button_group',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => 0,
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'choices' => array(
						// 		'none' => 'Нет',
						// 		'button' => 'Кнопка',
						// 		'page' => 'Страница',
						// 		'link' => 'Ссылка',
						// 	),
						// 	'allow_null' => 0,
						// 	'default_value' => 0,
						// 	'layout' => 'horizontal',
						// 	'return_format' => 'value',
						// ),
						// array(
						// 	'key' => 'field_slides_action_title',
						// 	'label' => 'Название кнопки',
						// 	'name' => 'action-title',
						// 	'type' => 'text',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => array(
						// 		array(
						// 			array(
						// 				'field' => 'field_slides_action',
						// 				'operator' => '!=',
						// 				'value' => 'none',
						// 			),
						// 		),
						// 	),
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'default_value' => '',
						// 	'placeholder' => '',
						// 	'prepend' => '',
						// 	'append' => '',
						// 	'maxlength' => '',
						// ),
						// array(
						// 	'key' => 'field_slides_button',
						// 	'label' => 'Кнопка',
						// 	'name' => 'button',
						// 	'type' => 'button_group',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => array(
						// 		array(
						// 			array(
						// 				'field' => 'field_slides_action',
						// 				'operator' => '==',
						// 				'value' => 'button',
						// 			),
						// 		),
						// 	),
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'choices' => array(
						// 		'call' => 'Звонок',
						// 		'request' => 'Заявка',
						// 		'another' => 'Произвольно',
						// 	),
						// 	'allow_null' => 0,
						// 	'default_value' => 'call',
						// 	'layout' => 'horizontal',
						// 	'return_format' => 'value',
						// ),
						// array(
						// 	'key' => 'field_slides_another',
						// 	'label' => 'Произвольно',
						// 	'name' => 'another',
						// 	'type' => 'text',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => array(
						// 		array(
						// 			array(
						// 				'field' => 'field_slides_action',
						// 				'operator' => '==',
						// 				'value' => 'another',
						// 			),
						// 		),
						// 	),
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'default_value' => '',
						// 	'placeholder' => '',
						// 	'prepend' => '',
						// 	'append' => '',
						// 	'maxlength' => '',
						// ),
						// array(
						// 	'key' => 'field_slides_page',
						// 	'label' => 'Страница',
						// 	'name' => 'page',
						// 	'type' => 'page_link',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => array(
						// 		array(
						// 			array(
						// 				'field' => 'field_slides_action',
						// 				'operator' => '==',
						// 				'value' => 'page',
						// 			),
						// 		),
						// 	),
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'post_type' => array(
						// 		0 => 'page',
						// 		1 => 'post',
						// 		2 => 'service',
						// 	),
						// 	'taxonomy' => '',
						// 	'allow_null' => 0,
						// 	'allow_archives' => 1,
						// 	'multiple' => 0,
						// ),
						// array(
						// 	'key' => 'field_slides_link',
						// 	'label' => 'Ссылка',
						// 	'name' => 'link',
						// 	'type' => 'url',
						// 	'instructions' => '',
						// 	'required' => 0,
						// 	'conditional_logic' => array(
						// 		array(
						// 			array(
						// 				'field' => 'field_slides_action',
						// 				'operator' => '==',
						// 				'value' => 'link',
						// 			),
						// 		),
						// 	),
						// 	'wrapper' => array(
						// 		'width' => '',
						// 		'class' => '',
						// 		'id' => '',
						// 	),
						// 	'default_value' => '',
						// 	'placeholder' => '',
						// ),
					),
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'block',
						'operator' => '==',
						'value' => 'acf/slider',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => 1,
			'description' => '',
			)
		);
	}
}

return new SliderBlock();
?>