<?php


include __DIR__.'/filter-price/index.php';
include __DIR__.'/filter-attr/index.php';

class universal_filter extends WC_Widget
{
	function __construct()
	{
		$this->widget_cssclass    = 'universal-filter';
		$this->widget_description = '[THEME] Фильтр товаров';
		$this->widget_id          = 'universal_filter';
		$this->widget_name        = 'Фильтр товаров';
		$this->before_widget      = '';
		$this->after_widget       = '';
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => 'Фильтр',
				'label' => 'Название',
			),
		);

		$this->version = '1.0.0';

		$this->used_filters = array();

		$tpath = get_template_directory();
		$cpath = __DIR__;
		$path = get_template_directory_uri().explode($tpath,$cpath)[1];

		wp_register_script( 'filter-nouislider', $path.'/assets/nouislider.js', array(), $this->version, true );
		wp_register_script( 'filter-wnumb', $path.'/assets/wNumb.min.js', array('filter-nouislider'), $this->version, true );
		wp_register_style( 'filter-nouislider', $path.'/assets/nouislider.css', array(), $this->version, 'all' );

		if ( is_customize_preview() ) {
			wp_enqueue_script( 'filter-nouislider' );
			wp_enqueue_script( 'filter-wnumb' );
			wp_enqueue_style( 'filter-nouislider' );
		}

		$this->init_price();
		$this->init_attr();

		add_action('woocommerce_widget_field_mselect', [$this,'render_mselect'],10, 4 );
		add_filter('woocommerce_widget_settings_sanitize_option', [$this,'apply_mselect'], 10, 4);

		parent::__construct();
	}

	public function render_mselect($key, $value, $setting, $instance)
	{
		$class = isset( $setting['class'] ) ? $setting['class'] : '';
?>
<p>
	<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
	<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>[]" multiple="multiple">
		<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
		<?php var_dump($option_key, $value); ?>
		<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( in_array($option_key,$value), true ); ?>><?php echo esc_html( $option_value ); ?></option>
		<?php endforeach; ?>
	</select>
</p>
<?php
	}

	public function apply_mselect($data, $new_instance, $key, $setting)
	{
		if($setting['type'] == 'mselect')
		{
			$data = isset( $new_instance[ $key ] ) ? $new_instance[ $key ] : $setting['std'];
		}
		return $data;
	}

	public function init_settings() {
		$attribute_array      = array(''=>'Выбрать для сброса');
		$std_attribute        = [];
		$attribute_taxonomies = wc_get_attribute_taxonomies();

		if ( ! empty( $attribute_taxonomies ) ) {
			foreach ( $attribute_taxonomies as $tax ) {
				if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) ) {
					$attribute_array[ $tax->attribute_name ] = $tax->attribute_label;
				}
			}
		}

		$this->settings = array(
			'title'        => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title', 'woocommerce' ),
			),
			'attributes'    => array(
				'type'    => 'mselect',
				'std'     => $std_attribute,
				'label'   => __( 'Attribute', 'woocommerce' ),
				'options' => $attribute_array,
			),
			// 'display_type' => array(
			// 	'type'    => 'select',
			// 	'std'     => 'list',
			// 	'label'   => __( 'Display type', 'woocommerce' ),
			// 	'options' => array(
			// 		'border' => 'Обводка',
			// 		'visual' => 'Индикатор цвета',
			// 	),
			// ),
		);
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * @see WP_Widget->update
	 *
	 * @param array $new_instance New Instance.
	 * @param array $old_instance Old Instance.
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$this->init_settings();
		return parent::update( $new_instance, $old_instance );
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @see WP_Widget->form
	 *
	 * @param array $instance Instance.
	 */
	public function form( $instance ) {
		$this->init_settings();
		parent::form( $instance );
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args     Arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		if ( ! is_shop() && ! is_product_taxonomy() ) {
			return;
		}
		$display_type = woocommerce_get_loop_display_mode();

		if ( 'subcategories' === $display_type) {
			return;
		}

		wp_enqueue_script( 'filter-nouislider' );
		wp_enqueue_script( 'filter-wnumb' );
		wp_enqueue_style( 'filter-nouislider' );

		$this->widget_start( $args, $instance );
		$this->universal_widget_start();
		$this->render_price($args, $instance);
		$this->render_attr($args, $instance);
		$this->universal_widget_end();
		$this->widget_end( $args );

	}

	public function universal_widget_start()
	{
?>
<form class="dropdown" method="get">
<?php
	}

	public function universal_widget_end()
	{
?>
	<div class="buttons">
		<button type="submit" class="show">Показать</button>
		<button type="reset" class="reset">Сбросить</button>
	</div>
	<?php
	$ignore = ['min_price', 'max_price', 'paged'];
	foreach($this->used_filters as $taxonomy_filter_name)
	{
		$ignore[] = 'cf_'.$taxonomy_filter_name;
	}
	echo wc_query_string_form_fields( null, $ignore, '', true );
	?>
	<input type="hidden" name="paged" value="1" />
</form>
<?php
	}

	use universal_filter_price;
	use universal_filter_attr;
}