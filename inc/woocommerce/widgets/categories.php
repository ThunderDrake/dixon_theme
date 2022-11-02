<?php
class categories_widget extends WP_Widget
{
	/**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	public $settings;

	function __construct()
	{
		$this->settings = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( 'Product categories', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'orderby' => array(
				'type'    => 'select',
				'std'     => 'order',
				'label'   => __( 'Order by', 'woocommerce' ),
				'options' => array(
					'order' => __( 'Category order', 'woocommerce' ),
					'name'  => __( 'Name', 'woocommerce' ),
				),
			),
			'exclude' => array(
				'type'    => 'mselect2',
				'std'     => [],
				'label'   => 'Исключить',
				'options' => [],
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Hide empty categories', 'woocommerce' ),
			),
			'max_depth' => array(
				'type'  => 'text',
				'std'   => '2',
				'label' => __( 'Maximum depth', 'woocommerce' ),
			)
		);
		parent::__construct(
			// Base ID of your widget
			'categories_widget',
			'[DIAMOND] Категории',
			// Widget description
			array( 'description' => 'Список категорий' )
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance )
	{
		global $wp_query, $post, $GS;

		$orderby            = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
		$hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
		$exclude            = isset( $instance['exclude'] ) ? $instance['exclude'] : $this->settings['exclude']['std'];
		$max_depth          = absint( isset( $instance['max_depth'] ) ? $instance['max_depth'] : $this->settings['max_depth']['std'] );

		$list_args          = array(
			'hierarchical' => 1,
			'taxonomy'     => 'product_cat',
			'hide_empty'   => $hide_empty,
			// 'number'       => -1,
		);

		if('order' == $orderby)
		{
			$list_args['menu_order'] = 'asc';
		}
		else
		{
			$list_args['orderby'] = 'title';
		}

		if($exclude)
		{
			$list_args['exclude'] = $exclude;
		}

		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if(is_tax('product_cat'))
		{
			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
		}
		elseif(is_singular('product'))
		{
			$terms = wc_get_product_terms(
				$post->ID, 'product_cat', apply_filters(
					'woocommerce_product_categories_widget_product_terms_args', array(
						'orderby' => 'parent',
						'order'   => 'DESC',
					)
				)
			);

			if($terms)
			{
				$main_term           = apply_filters( 'woocommerce_product_categories_widget_main_term', $terms[0], $terms );
				$this->current_cat   = $main_term;
				$this->cat_ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
			}
		}

		$modVars = array(
			'current_cat' => $this->current_cat,
			'cat_ancestors' => $this->cat_ancestors
		);
		$mod = (function(){
			$params = func_get_args()[0];
			if($params['current_cat'])
			{
				$current = $params['current_cat']->term_id;
				$iter = false;

				if(array_key_exists($current,$params['RAW']))
				{
					$iter = $params['RAW'][$current];
				}

				while($iter)
				{
					$iter->active = true;
					if(property_exists($iter, 'parent'))
					{
						if($iter->parent != 0)
						{
							$iter = $params['RAW'][$iter->parent];
						}
						else
						{
							$iter = false;
						}
					}
					else
					{
						$iter = false;
					}
				}
			}
		});
		$elements = $GS->get_cat_tree($list_args,$mod,$modVars);
		
		if($elements)
		{
			$this->start($instance);
			echo $this->render($elements,$max_depth);
			$this->end();
		}
	}

	private function rcinline($taxonomy,$depth=0,$return)
	{
		$return[] = $taxonomy;
		$taxonomy->depth = $depth;
		if(count($taxonomy->childs)>0)
		{
			foreach($taxonomy->childs as $child)
			{
				$return = $this->rcinline($child,$depth+1,$return);
			}
		}
		return $return;
	}

	public function form( $instance )
	{
		if(empty($this->settings))
		{
			return;
		}


		foreach($this->settings as $key => $setting)
		{
			$class = isset( $setting['class'] ) ? $setting['class'] : '';
			$value = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];

			if($key == 'exclude')
			{
				global $GS;
				$args = array(
				  'hierarchical' => true,
				  'taxonomy'     => 'product_cat',
				  'hide_empty'   => false,
				  'menu_order'   => 'asc',
				);
				$raw_taxonomies = $GS->get_cat_tree($args);
				$taxonomies = array();
				if($raw_taxonomies)
				{
					foreach($raw_taxonomies as $taxonomy)
					{
						$taxonomies = $this->rcinline($taxonomy,0,$taxonomies);
					}
				}
				foreach($taxonomies as $tax)
				{
					$setting['options'][$tax->term_id] = str_repeat('— ',$tax->depth).$tax->name;
				}
			}

			switch($setting['type'])
			{

				case 'text':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; ?></label><?php // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped ?>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
					break;

				case 'number':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<input class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					</p>
					<?php
					break;

				case 'select':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
					break;

				case 'select2':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php selected( $option_key, $value ); ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<script>jQuery(document).ready(function(){jQuery('#<?php echo esc_attr( $this->get_field_id( $key ) ); ?>').select2({'width':'100%'});});</script>
					<?php
					break;

				case 'mselect':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>[]" multiple="multiple">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php if( in_array($option_key, $value) ) { echo 'selected="selected"'; } ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<?php
					break;

				case 'mselect2':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>[]" multiple="multiple">
							<?php foreach ( $setting['options'] as $option_key => $option_value ) : ?>
								<option value="<?php echo esc_attr( $option_key ); ?>" <?php if( in_array($option_key, $value) ) { echo 'selected="selected"'; } ?>><?php echo esc_html( $option_value ); ?></option>
							<?php endforeach; ?>
						</select>
					</p>
					<script>jQuery(document).ready(function(){jQuery('#<?php echo esc_attr( $this->get_field_id( $key ) ); ?>').select2({'width':'100%'});});</script>
					<?php
					break;

				case 'textarea':
					?>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
						<textarea class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" cols="20" rows="3"><?php echo esc_textarea( $value ); ?></textarea>
						<?php if ( isset( $setting['desc'] ) ) : ?>
							<small><?php echo esc_html( $setting['desc'] ); ?></small>
						<?php endif; ?>
					</p>
					<?php
					break;

				case 'checkbox':
					?>
					<p>
						<input class="checkbox <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( $key ) ); ?>" type="checkbox" value="1" <?php checked( $value, 1 ); ?> />
						<label for="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>"><?php echo $setting['label']; /* phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped */ ?></label>
					</p>
					<?php
					break;

				// Default: run an action.
				default:
					do_action( 'woocommerce_widget_field_' . $setting['type'], $key, $value, $setting, $instance );
					break;
			}
		}
	}

	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['orderby'] = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
		$instance['hide_empty'] = ( ! empty( $new_instance['hide_empty'] ) ) ? strip_tags( $new_instance['hide_empty'] ) : '';
		$instance['max_depth'] = ( ! empty( $new_instance['max_depth'] ) ) ? strip_tags( $new_instance['max_depth'] ) : '';
		$instance['exclude'] = ( ! empty( $new_instance['exclude'] ) ) ? $new_instance['exclude'] : [];
		return $instance;
	}

	private function start($instance)
	{
		// echo '<div class="sidebar-block sidebar-menu">';
		// if($instance['title'])
		// {
		// 	$catalog = wc_get_page_id('catalog');
		// 	echo '<a href="'.get_permalink($catalog).'" class="sidebar-block-title">'.$instance['title'].'</a>';
		// }
	}

	private function end()
	{
		// echo '</div>';
	}

	private function render($elements,$maxDepth)
	{
		$currentDepth = 1;
		$nextDepth = 2;
		$return = '<ul class="nav-menu">';
		$f = true;
		// for ($i=0; $i < 6; $i++) {
		////////////////////////////
		foreach ($elements as $element)
		{
			$hc = boolval($nextDepth<=$maxDepth and @count($element->childs) > 0);
			$extClasses = '';
			if(@count($element->childs)>0)
			{
				$extClasses .= ' has-childs';
			}
			if($element->active)
			{
				$extClasses .= ' active';
				if($hc)
				{
					$extClasses .= ' open';
				}
			}
			if(!$f)
			{
				$return .= '<li class="nav-menu-splitter"></li>';
			}
			if($f)
			{
				$f = false;
			}
			$return .= '<li class="nav-menu-element'.$extClasses.'"><a href="'.get_term_link($element).'">'.$element->name.'</a>';
			if($hc)
			{
				$return .= '<div class="toggler"></div>';
				$return .= $this->renderNested($element->childs,$nextDepth,$maxDepth);
			}
			$return .= '</li>';
		}
		////////////////////////////
		// }
		$return .= '</ul>';
		return $return;
	}

	private function renderNested($elements,$currentDepth,$maxDepth)
	{
		$nextDepth = $currentDepth+1;
		$return = '<ul class="sub-menu">';
		// for ($i=0; $i < 6; $i++) {
		////////////////////////////
		foreach ($elements as $element)
		{
			$hc = boolval($nextDepth<=$maxDepth and @count($element->childs) > 0);
			$extClasses = '';
			if($hc)
			{
				$extClasses .= ' has-childs';
			}
			if($element->active)
			{
				$extClasses .= ' active';
				if($hc)
				{
					$extClasses .= ' opened';
				}
			}

			$return .= '<li class="nav-menu-element'.$extClasses.'"><a href="'.get_term_link($element).'">'.$element->name.'</a>';
			if($hc)
			{
				$return .= '<div class="toggler"></div>';
				$return .= $this->renderNested($element->childs,$nextDepth,$maxDepth);
			}
			$return .= '</li>';
		}
		////////////////////////////
		// }
		$return .= '</ul>';
		return $return;
	}
}
?>