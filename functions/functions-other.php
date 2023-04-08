<?php

/**
 * При регистрации CTP "ловит" и применяет параметры "Шаблон" и "Количество выводимых постов".
 */
add_action( 'registered_post_type', function ( $post_type, $ctp_object ) {

	add_filter( 'template_include', function ( $templates ) use ( $ctp_object ) {
		// Задаём шаблон одиночной записи.
		if ( ! empty( $ctp_object->template_item ) && is_singular( $ctp_object->name ) ) {
			$templates = locate_template( $ctp_object->template_item );
		}

		// Задаём шаблон архиву записей.
		if ( ! empty( $ctp_object->template_archive ) && is_post_type_archive( $ctp_object->name ) ) {
			$templates = locate_template( $ctp_object->template_archive );
		}

		return $templates;
	} );

	// Устанавливаем количество выводимых записей в архивах.
	add_action( 'pre_get_posts', function ( $query ) use ( $ctp_object ) {
		if (
			! empty( $ctp_object->posts_per_page )
			&& ! is_admin()
			&& $query->is_main_query()
			&& $query->is_post_type_archive( $ctp_object->name )
		) {
			$query->set( 'posts_per_page', $ctp_object->posts_per_page );
		}
	} );

	// Устанавливаем плейсхолдер в поле Заголовок на странице редактирования записи
	add_filter( 'enter_title_here', function ( $text, $post ) use ( $ctp_object ) {
		if ( isset( $ctp_object->labels->title_placeholder ) && $post->post_type === $ctp_object->name ) {
			$text = $ctp_object->labels->title_placeholder;
		}

		return $text;
	}, 11, 2 );

}, 10, 2 );

/**
 * При регистрации Таксономии "ловит" и применяет параметры "Шаблон" и "Количество выводимых постов".
 */
add_action( 'registered_taxonomy', function ( $taxonomy, $object_type, $taxonomy_object ) {
	add_filter( 'template_include', function ( $templates ) use ( $taxonomy, $taxonomy_object ) {
		// Задаём шаблон термину.
		if ( ! empty( $taxonomy_object['template_item'] ) && is_tax( $taxonomy ) ) {
			$templates = locate_template( $taxonomy_object['template_item'] );
		}

		return $templates;
	} );

	// Устанавливаем количество выводимых записей в архивах.
	add_action( 'pre_get_posts', function ( $query ) use ( $taxonomy, $taxonomy_object ) {
		if (
			! empty( $taxonomy_object['posts_per_page'] )
			&& ! is_admin()
			&& $query->is_main_query()
			&& $query->is_tax( $taxonomy )
		) {
			$query->set( 'posts_per_page', $taxonomy_object['posts_per_page'] );
		}
	} );

}, 10, 3 );

// Удаляет из админ-сайдбара пункты меню.
add_action( 'admin_menu', function () {
	remove_menu_page( 'edit.php' );          // Записи
} );

/**
 * Возвращает ссылку на следующую страницу пагинации на странице архивов без GET параметров.
 *
 * @return false|string
 */
function get_next_paged_url() {
	$url = get_next_posts_page_link( $GLOBALS['wp_query']->max_num_pages ?: 1 );

	return strtok( $url, '?' );
}

/**
 * Получение ID страницы по её slug.
 *
 * @param string $page_slug Slug страницы
 *
 * @return int
 */
function get_id_by_slug( $page_slug ) {
	return get_page_by_path( $page_slug )->ID ?? null;
}

/**
 * Выводит на экран стили для таблицы в ACF поле Message.
 *
 * @return void
 */
function _show_css_for_table_with_files_and_images() {
	static $show = true;

	if ( $show ) {
		?>
        <style>
            table.fff333ggg,
            table.fff333ggg th,
            table.fff333ggg td {
                border-collapse: collapse;
                border: 1px solid grey;
                text-align: left;
                padding: 0 5px;
            }
        </style>
		<?php
	}

	$show = false;
}


/**
 * Возвращает направление сортировки (ASC или DESC) на основе GET параметра "sort".
 *
 * Варианты: old-first или new-first
 *
 * @return string
 */
function get_param_sort_value_for_query() {
	$sort = $_GET['sort'] ?? '';

	return $sort === 'old-first' ? 'ASC' : 'DESC';
}

/**
 * Проверяет, является ли запрос основным и выполняем во фронте.
 *
 * @param WP_Query $query
 *
 * @return bool
 */
function is_main_query_in_front( $query ) {
	return ! is_admin() && $query->is_main_query();
}

/**
 * Добавляет класс тегу <a> в меню WP.
 */
function add_additional_class_to_anchor( $classes, $item, $args ) {
	if ( isset( $args->add_a_class ) ) {
		$classes['class'] = $args->add_a_class;
	}

	return $classes;
}

add_filter( 'nav_menu_link_attributes', 'add_additional_class_to_anchor', 1, 3 );

/**
 * Добавляет класс тегу <li> в меню WP.
 */
function add_additional_class_on_li( $classes, $item, $args ) {
	if ( isset( $args->add_li_class ) ) {
		$classes[] = $args->add_li_class;
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'add_additional_class_on_li', 1, 3 );

/**
 * Добавляет поддержку SVG.
 */
add_filter( 'upload_mimes', 'svg_upload_allow' );

# Добавляет SVG в список разрешенных для загрузки файлов.
function svg_upload_allow( $mimes ) {
	$mimes['svg'] = 'image/svg+xml';

	return $mimes;
}

/**
 *
 * Исправляет MIME SVG.
 *
 * fix_svg_mime_type
 *
 * @param mixed $data
 * @param mixed $file
 * @param mixed $filename
 * @param mixed $mimes
 * @param mixed $real_mime
 *
 * @return void
 */

add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );
function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ) {

	// WP 5.1 +
	if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
	} else {
		$dosvg = ( '.svg' === strtolower( substr( $filename, - 4 ) ) );
	}

	// mime тип был обнулен, поправим его
	// а также проверим право пользователя
	if ( $dosvg ) {

		// разрешим
		if ( current_user_can( 'manage_options' ) ) {

			$data['ext']  = 'svg';
			$data['type'] = 'image/svg+xml';
		} // запретим
		else {
			$data['ext']  = false;
			$data['type'] = false;
		}

	}

	return $data;
}


/**
 * show_svg_in_media_library
 *
 * @param mixed $response
 *
 * @return void
 */
add_filter( 'wp_prepare_attachment_for_js', 'show_svg_in_media_library' );
function show_svg_in_media_library( $response ) {

	if ( $response['mime'] === 'image/svg+xml' ) {

		// С выводом названия файла
		$response['image'] = [
			'src' => $response['url'],
		];
	}

	return $response;
}

/**
 * Возвращает миниатюру поста.
 *
 * @param array $args
 *
 * @return string
 */
function get_post_thumb( $args = [] ) {
	$args = array_merge( [ 'allow' => 'any' ], $args );

	return kama_thumb_src( $args );
}

/**
 * Возвращает записи по их ID.
 *
 * @param mixed $ids
 *
 * @return WP_Post[]
 */
function get_posts_by_ids( $ids ) {
	if ( empty( $ids ) ) {
		return [];
	}

	$ids = wp_parse_id_list( $ids );

	return $ids ? array_filter( array_map( 'get_post', $ids ) ) : [];
}
/**
 * Возвращает ID страницы по её слагу
 *
 * @param string $page_slug
 * @return number
 */
function get_page_id_by_slug($page_slug) {
	$page = get_page_by_path($page_slug);
	if ($page) {
		return $page->ID;
	} else {
		return null;
	}
}

/**
 * Возвращает данные для построения кнопки пагинации на основе глобальных данных wp_query.
 *
 * @param string $titles
 *
 * @return array|false
 */
function get_archive_pagination_data( $titles ) {
	$next_url = get_next_paged_url();

	if ( ! $next_url ) {
		return false;
	}

	$per_page    = $GLOBALS['wp_query']->query_vars['posts_per_page'];
	$paged_now   = get_query_var( 'paged' ) ?: 1;
	$found_posts = $GLOBALS['wp_query']->found_posts;

	return get_pagination_data( $found_posts, $paged_now, $per_page, $titles, $next_url );
}

/**
 * Возвращает данные для кнопки "Показать ещё".
 *
 * @param int          $found_items Общее количество найденных элементов.
 * @param int          $paged_now   Текущая страница пагинации.
 * @param int          $per_page    Количество выводимых элементов на странице.
 * @param string|array $titles      Список слов для текста кнопки "Показать ещё".
 * @param string       $next_url    Ссылка на следующую страницу пагинации.
 *
 * @return array
 */
function get_pagination_data( $found_items, $paged_now, $per_page, $titles, $next_url ) {
	$remaining_all   = $found_items - $paged_now * $per_page;
	$remaining_paged = $remaining_all >= $per_page ? $per_page : $remaining_all;

	$remaining_paged_text = cth()->plural_form( $remaining_paged, $titles );

	return [
		'next_url'             => $next_url,
		'remaining_paged_text' => $remaining_paged_text,
		'remaining_all'        => $remaining_all,
	];
}

/**
 * Возвращает переданных с +1 по значению и "0" в начале по необходимости для списков.
 *
 * @param int $index
 *
 * @return string
 */
function get_index_increment_formating( $index ) {
	return (string) ( $index + 1 ) > 9 ? ( $index + 1 ) : '0' . ( $index + 1 );
}

/**
 * Добавляет параграфам в контенте указанные css классы.
 *
 * @param string $content
 * @param string $classes
 *
 * @return string
 */
function add_classes_to_tag_p( $content, $classes ) {
	return preg_replace( "/<p([> ])/", sprintf( '<p class="%s"$1', $classes ), $content );
}


/**
 * Избавляется от дубликатов записей.
 *
 * @param WP_Post[] $posts
 *
 * @return WP_Post[]
 */
function remove_duplicate_posts( $posts ) {
	$ids = array_map( static function ( WP_Post $post ) {
		return $post->ID;
	}, $posts );

	$unique_ids = array_unique( $ids, SORT_NUMERIC );

	return array_values( array_intersect_key( $posts, $unique_ids ) );
}

/**
 * Возвращает значение GET параметра в виде массива числовых данных.
 *
 * @param string $key
 *
 * @return int[]
 */
function get_param_ids_for_filter( $key ) {
	return array_filter( wp_parse_id_list( get_param_for_filter( $key ) ) );
}

/**
 * Возвращает значение GET параметра в виде массива строковых данных.
 *
 * @param string $key
 *
 * @return string[]
 */
function get_param_strings_for_filter( $key ) {
	return array_filter( wp_parse_slug_list( get_param_for_filter( $key ) ) );
}

/**
 * Возвращает значение GET параметра.
 *
 * @param string $key
 * @param string $default
 *
 * @return mixed
 */
function get_param_for_filter( $key, $default = '' ) {
	return $_GET[ $key ] ?? $default;
}


add_action( 'template_redirect', 'truemisha_recently_viewed_product_cookie', 20 );
 
function truemisha_recently_viewed_product_cookie() {
 
	// если находимся не на странице товара, ничего не делаем
	if ( ! is_product() ) {
		return;
	}
 
 
	if ( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}
 
	// добавляем в массив текущий товар
	if ( ! in_array( get_the_ID(), $viewed_products ) ) {
		$viewed_products[] = get_the_ID();
	}
 
	// нет смысла хранить там бесконечное количество товаров
	if ( sizeof( $viewed_products ) > 15 ) {
		array_shift( $viewed_products ); // выкидываем первый элемент
	}
 
 	// устанавливаем в куки
	wc_setcookie( 'woocommerce_recently_viewed_2', join( '|', $viewed_products ) );
 
}

/**
 * Возвращает последние просмотренные товары
 *
 * @return void
 */
function truemisha_recently_viewed_products() {
 
	if( empty( $_COOKIE[ 'woocommerce_recently_viewed_2' ] ) ) {
		$viewed_products = array();
	} else {
		$viewed_products = (array) explode( '|', $_COOKIE[ 'woocommerce_recently_viewed_2' ] );
	}
 
	if ( empty( $viewed_products ) ) {
		return;
	}
 
	// надо ведь сначала отображать последние просмотренные
	$viewed_products = array_reverse( array_map( 'absint', $viewed_products ) );
 
	return $viewed_products;
 
}

/**
 * Change woocommerce select to radio button 
 */
function variation_radio_buttons($html, $args) {
	$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
	  'options'          => false,
	  'attribute'        => false,
	  'product'          => false,
	  'selected'         => false,
	  'name'             => '',
	  'id'               => '',
	  'class'            => '',
	  'show_option_none' => __('Choose an option', 'woocommerce'),
	));
  
	if(false === $args['selected'] && $args['attribute'] && $args['product'] instanceof WC_Product) {
	  $selected_key     = 'attribute_'.sanitize_title($args['attribute']);
	  $args['selected'] = isset($_REQUEST[$selected_key]) ? wc_clean(wp_unslash($_REQUEST[$selected_key])) : $args['product']->get_variation_default_attribute($args['attribute']);
	}
  
	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_'.sanitize_title($attribute);
	$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
	$class                 = $args['class'];
	$show_option_none      = (bool)$args['show_option_none'];
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'woocommerce');
  
	if(empty($options) && !empty($product) && !empty($attribute)) {
	  $attributes = $product->get_variation_attributes();
	  $options    = $attributes[$attribute];
	}
  
	$radios = '';
  
	if(!empty($options)) {
	  if($product && taxonomy_exists($attribute)) {
		$terms = wc_get_product_terms($product->get_id(), $attribute, array(
		  'fields' => 'all',
		  'orderby' => 'id'
		));
		foreach($terms as $term) {
		  if(in_array($term->slug, $options, true)) {
			$id = $name.'-'.$term->slug;
			$radios .= '<div class="product__details-radio"><input class="product__details-input visually-hidden" type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($term->slug).'" '.checked(sanitize_title($args['selected']), $term->slug, false).'><label class="product__details-button" for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $term->name)).'</label></div>';
			
		  }
		}
	  } else {
		foreach($options as $option) {
		  $id = $name.'-'.$option;
		  $checked    = sanitize_title($args['selected']) === $args['selected'] ? checked($args['selected'], sanitize_title($option), false) : checked($args['selected'], $option, false);
		  $radios    .= '<div class="product-card__size-item"><input class="product-card__radio visually-hidden" type="radio" id="'.esc_attr($id).'" name="'.esc_attr($name).'" value="'.esc_attr($option).'" id="'.sanitize_title($option).'" '.$checked.'><label class="product-card__size-label" for="'.esc_attr($id).'">'.esc_html(apply_filters('woocommerce_variation_option_name', $option)).'</label></div>';
		}
	  }
	}
	  
	return $html.$radios;
  }
  add_filter('woocommerce_dropdown_variation_attribute_options_html', 'variation_radio_buttons', 20, 2);
  
  function variation_check($active, $variation) {
	if(!$variation->is_in_stock() && !$variation->backorders_allowed()) {
	  return false;
	}
	return $active;
  }
  add_filter('woocommerce_variation_is_active', 'variation_check', 10, 2);

  add_action('woocommerce_add_to_cart_redirect', 'resolve_dupes_add_to_cart_redirect');
/**
 * Предотвращаем дублирование ссылки для вариативных товаров
 */
function resolve_dupes_add_to_cart_redirect($url = false) {

     // If another plugin beats us to the punch, let them have their way with the URL
     if(!empty($url)) { return $url; }

     // Redirect back to the original page, without the 'add-to-cart' parameter.
     // We add the 'get_bloginfo' part so it saves a redirect on https:// sites.
     return get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart'));

}
/**
 * Вывод кратких данных из корзины
 * 
 */
if ( ! function_exists( 'cart_link' ) ) {
	function cart_link() {
		?>
		<div class="header__cart-count cart-contents"><?=WC()->cart->get_cart_contents_count()?></div>
		<?php
	}
}

//Ajax Обновление кратких данных из корзины
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="header__cart-count cart-contents"><?=WC()->cart->get_cart_contents_count()?></div>
	<?php
	$fragments['.header__cart-count.cart-contents'] = ob_get_clean();
	return $fragments;
}

//Ajax Обновление модальной корзины
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_modal_cart_fragment' );

function woocommerce_modal_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="cart__list cart__list--modal">
        <div class="cart__list-content">
		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
			<?php 
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
          <article class="cart-grid__item cart-item cart-grid">

            <div class="cart-grid__col">
              <div class="cart-item__image-wrapper">
                <img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="cart-item__image" width="120" height="150" alt="">
              </div>
            </div>

            <div class="cart-grid__col">
              <div class="cart-item__title"><?= $_product->get_title() ?></div>
            </div>

            <div class="cart-grid__col">
				<?php
				if ( $_product->is_sold_individually() ) {
					$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
				} else {
					$product_quantity = woocommerce_quantity_input(
						array(
							'input_name'   => "cart[{$cart_item_key}][qty]",
							'input_value'  => $cart_item['quantity'],
							'max_value'    => $_product->get_max_purchase_quantity(),
							'min_value'    => '0',
							'product_name' => $_product->get_name(),
						),
						$_product,
						false
					);
				}

				echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
				?>
			</div>

            <div class="cart-grid__col">
              <div class="cart-item__price">
			  <?= $cart_item['data']-> get_price(); ?> Р.
              </div>
            </div>

            <div class="cart-grid__col">
				<div class="cart-item__delete">
					<a class="cart-item__delete-button" href="<?= esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" data-product_id="<?= esc_attr( $product_id ) ?>" data-product_sku="<?= esc_attr( $_product->get_sku() ) ?>" data-cart_item_key="<?= esc_attr( $cart_item_key ) ?>">
						<svg class="cart-item__delete-icon" width="20" height="24">
							<use xlink:href="#delete-icon"></use>
						</svg>
					</a>
				</div>
			</div>

          </article>
		  <?php endif; ?>
		<?php endforeach; ?>
        </div>
		<?php 
		
		if(WC()->cart->get_cart()):
		?>
			<div class="cart__footer">
				<div class="cart__button">
					<a class="cart__button-to-cart" href="/cart/">Просмотр корзины</a>
				</div>
				<div class="cart__info">
					<div class="cart__info-text">
						<div class="cart__total">
							Итого <?= WC()->cart->get_cart_contents_count() ?> товара
						</div>
						<div class="cart__total-amount"><?= WC()->cart->get_cart_subtotal() ?> Р.</div>
					</div>
					<a class="cart__checkout-btn btn-reset btn btn--main" href="/checkout/">Оформить покупку</a>
				</div>
			</div>
		<?php else: ?>
			<p class="modal__cart-empty" style="margin: 0; font-size: 18px;">Ваша корзина пуста</p>
		<?php endif; ?>
      </div>
	<?php
	$fragments['.cart__list.cart__list--modal'] = ob_get_clean();
	return $fragments;
}


// AJAX product remove
function warp_ajax_product_remove()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    ?>
        <div class="cart__list-content">
		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
			<?php 
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
          <article class="cart-grid__item cart-item cart-grid">

            <div class="cart-grid__col">
              <div class="cart-item__image-wrapper">
                <img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="cart-item__image" width="120" height="150" alt="">
              </div>
            </div>

            <div class="cart-grid__col">
              <div class="cart-item__title"><?= $_product->get_title() ?></div>
            </div>

            <div class="cart-grid__col">
				<?php
				if ( $_product->is_sold_individually() ) {
					$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
				} else {
					$product_quantity = woocommerce_quantity_input(
						array(
							'input_name'   => "cart[{$cart_item_key}][qty]",
							'input_value'  => $cart_item['quantity'],
							'max_value'    => $_product->get_max_purchase_quantity(),
							'min_value'    => '0',
							'product_name' => $_product->get_name(),
						),
						$_product,
						false
					);
				}

				echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
				?>
			</div>

            <div class="cart-grid__col">
              <div class="cart-item__price">
			  <?= $cart_item['data']-> get_price(); ?> Р.
              </div>
            </div>

            <div class="cart-grid__col">
				<div class="cart-item__delete">
					<a class="cart-item__delete-button" href="<?= esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>" data-product_id="<?= esc_attr( $product_id ) ?>" data-product_sku="<?= esc_attr( $_product->get_sku() ) ?>" data-cart_item_key="<?= esc_attr( $cart_item_key ) ?>">
						<svg class="cart-item__delete-icon" width="20" height="24">
							<use xlink:href="#delete-icon"></use>
						</svg>
					</a>
				</div>
			</div>

          </article>
		  <?php endif; ?>
		<?php endforeach; ?>
        </div>
		<?php 
		
		if(WC()->cart->get_cart()):
		?>
			<div class="cart__footer">
				<div class="cart__button">
					<a class="cart__button-to-cart" href="/cart/">Просмотр корзины</a>
				</div>
				<div class="cart__info">
					<div class="cart__info-text">
						<div class="cart__total">
							Итого <?= WC()->cart->get_cart_contents_count() ?> товара
						</div>
						<div class="cart__total-amount"><?= WC()->cart->get_cart_subtotal() ?> Р.</div>
					</div>
					<a class="cart__checkout-btn btn-reset btn btn--main" href="/checkout/">Оформить покупку</a>
				</div>
			</div>
		<?php else: ?>
			<p class="modal__cart-empty" style="margin: 0; font-size: 18px;">Ваша корзина пуста</p>
		<?php endif; ?>
	<?php

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.cart__list.cart__list--modal' => '<div class="cart__list cart__list--modal">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

// add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove' );
// add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove' );

function warp_ajax_product_remove_cart()
{
    // Get mini cart
    ob_start();

    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item)
    {
        if($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key'] )
        {
            WC()->cart->remove_cart_item($cart_item_key);
        }
    }

    WC()->cart->calculate_totals();
    WC()->cart->maybe_set_cart_cookies();

    ?>
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="cart__list cart__list--page">
		<div class="cart__list-header cart-grid cart-grid--header">
			<div class="cart__col-title">Товар:</div>
			<div class="cart__col-title">Количество:</div>
			<div class="cart__col-title">Цена:</div>
			<div class="cart__col-title"></div>
		</div>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>
		<div class="cart__list-content">
			<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
			<?php
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ):
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
			<article
				class="woocommerce-cart-form__cart-item cart-grid__item cart-item cart-grid <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
				<div class="cart-grid__col">
					<div class="cart-item__image-wrapper">
						<img loading="lazy" src="<?= wp_get_attachment_image_url( $_product->get_image_id(), 'full' ) ?>" class="cart-item__image"
							width="120" height="150" alt="">
					</div>
					<a class="cart-item__title" href="<?= $_product->get_permalink() ?>"><?= $_product->get_title() ?></a>
				</div>
				<div class="cart-grid__col">
					<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}
						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
				</div>
				<div class="cart-grid__col">
					<div class="cart-item__price">
						<?= $cart_item['data']-> get_price(); ?> Р.
					</div>
				</div>
				<div class="cart-grid__col">
					<div class="cart-item__delete">
						<a class="cart-item__delete-button" href="<?= esc_url( wc_get_cart_remove_url( $cart_item_key ) ) ?>"
							data-product_id="<?= esc_attr( $product_id ) ?>" data-product_sku="<?= esc_attr( $_product->get_sku() ) ?>"
							data-cart_item_key="<?= esc_attr( $cart_item_key ) ?>">
							<svg class="cart-item__delete-icon" width="20" height="24">
								<use xlink:href="#delete-icon"></use>
							</svg>
						</a>
					</div>
				</div>
			</article>
			<?php endif; ?>
			<?php endforeach; ?>
		</div>
		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</div>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
	<?php do_action( 'woocommerce_after_cart' ); ?>
	<button type="submit" class="cart__refresh btn-reset" name="update_cart"
		value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

	<?php do_action( 'woocommerce_cart_actions' ); ?>
	<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
	</form>
	<div class="cart__footer">
		<!-- <div class="cart__coupon">
		<form class="cart__coupon-form">
			<input class="cart__coupon-input" type="text" placeholder="Ваш промокод">
			<button class="cart__coupon-button btn-reset btn btn--main">применить промокод</button>
		</form>
	</div> -->
		<div class="cart__info">
			<div class="cart__info-text">
				<?php if(WC()->cart->get_cart_contents_count()!=0): ?>
				<div class="cart__total">
					Итого <?= WC()->cart->get_cart_contents_count() ?> товара
				</div>
				<?php endif; ?>
				<div class="cart__total-amount"><?php echo WC()->cart->get_total(); ?></div>
			</div>
			<a class="cart__checkout-btn btn-reset btn btn--main" href="/checkout/">Оформить покупку</a>
		</div>
	</div>
	<?php

    $mini_cart = ob_get_clean();

    // Fragments and mini cart are returned
    $data = array(
        'fragments' => apply_filters( 'woocommerce_add_to_cart_fragments', array(
                'div.cart__ajax-content' => '<div class="cart__ajax-content">' . $mini_cart . '</div>'
            )
        ),
        'cart_hash' => apply_filters( 'woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5( json_encode( WC()->cart->get_cart_for_session() ) ) : '', WC()->cart->get_cart_for_session() )
    );

    wp_send_json( $data );

    die();
}

add_action( 'wp_ajax_product_remove', 'warp_ajax_product_remove_cart' );
add_action( 'wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove_cart' );

/**
 * Форматирует цену в человекопонятный формат
 *
 * @param string $divider
 * @param string $raw_price
 * @return string
 */
function price_format($divider, $raw_price) {
	$regex = "/\B(?=(\d{3})+(?!\d))/i";
	return preg_replace($regex, $divider, $raw_price);
}

add_filter( 'woocommerce_gateway_title', 'rudr_change_payment_gateway_title', 25, 2 );

function rudr_change_payment_gateway_title( $title, $gateway_id ){
	
	if( 'rsbpayment' === $gateway_id ) {
		$title = 'Оплата банковской картой';
	}

	return $title;
}

/**
 * @snippet       Основные города России по регионам через плагин WC City Select
 * @sourcecode    https://wpruse.ru/my-plugins/dobavit-regiony-dostavki-v-woocommerce/
 * @testedwith    WooCommerce 3.8
 * @author        Artem Abramovich
 * @see           https://ru.wordpress.org/plugins/wc-city-select/
 */
add_filter( 'wc_city_select_cities', 'awrr_regions_cities' );
function awrr_regions_cities( $cities ) {

	$cities['RU'] = array(
		'01' => array(
			'г. Майкоп',
			'пгт Яблоновский',
			'пгт Энем',
			'ст-ца Гиагинская',
			'г. Адыгейск',
			'ст-ца Ханская',
		),
		'02' => array(
			'г. Уфа',
			'г. Стерлитамак',
			'г. Салават',
			'г. Нефтекамск',
			'г. Октябрьский',
			'г. Белорецк',
			'г. Туймазы',
			'г. Ишимбай',
			'г. Кумертау',
			'г. Сибай',
			'г. Мелеуз',
			'г. Белебей',
			'г. Бирск',
			'г. Учалы',
			'г. Благовещенск',
			'г. Дюртюли',
			'г. Янаул',
			'г. Давлеканово',
			'пгт Чишмы',
			'пгт Приютово',
		),
		'03' => array(
			'г. Улан-Удэ',
			'г. Северобайкальск',
			'г. Гусиноозёрск',
			'г. Кяхта',
			'пгт Селенгинск',
			'г. Закаменск',
			'п. Онохой',
			'г. Бабушкин',
		),
		'04' => array(
			'г. Горно-Алтайск',
			'с. Майма',
		),
		'05' => array(
			'г. Махачкала',
			'г. Хасавюрт',
			'г. Дербент',
			'г. Каспийск',
			'г. Буйнакск',
			'г. Избербаш',
			'г. Кизляр',
			'г. Кизилюрт',
			'г. Дагестанские Огни',
			'с. Карабудахкент',
			'пгт Ленинкент',
			'с. Бабаюрт',
			'пгт Тарки',
			'пгт Семендер',
			'с. Нижнее Казанище',
			'с. Ахты',
			'с. Касумкент',
			'пгт Альбурикент',
			'с. Ботлих',
			'пгт Шамхал',
		),
		'06' => array(
			'г. Назрань',
			'г. Сунжа',
			'г. Карабулак',
			'г. Малгобек',
			'ст-ца Нестеровская',
			'с. Экажево',
			'ст-ца Троицкая',
			'с. Кантышево',
			'с. Плиево',
			'с. Сурхахи',
			'с. Сагопши',
			'с. Барсуки',
			'г. Магас',
		),
		'07' => array(
			'г. Нальчик',
			'г. Прохладный',
			'г. Баксан',
			'г. Нарткала',
			'г. Майский',
			'г. Тырныауз',
			'с. Дыгулыбгей',
			'г. Терек',
			'г. Чегем',
			'с. Нартан',
			'с. Исламей',
			'с. Заюково',
			'с. Чегем Второй',
			'с. Шалушка',
			'с. Хасанья',
		),
		'08' => array(
			'г. Элиста',
			'г. Лагань',
			'с. Троицкое',
			'г. Городовиковск',
		),
		'09' => array(
			'г. Черкесск',
			'г. Усть-Джегута',
			'г. Карачаевск',
			'ст-ца Зеленчукская',
			'с. Учкекен',
			'г. Теберда',
		),
		'10' => array(
			'г. Петрозаводск',
			'г. Кондопога',
			'г. Сегежа',
			'г. Костомукша',
			'г. Сортавала',
			'г. Медвежьегорск',
			'г. Кемь',
			'г. Питкяранта',
			'г. Беломорск',
			'г. Суоярви',
			'г. Пудож',
			'г. Олонец',
			'г. Лахденпохья',
		),
		'11' => array(
			'г. Сыктывкар',
			'г. Ухта',
			'г. Воркута',
			'г. Печора',
			'г. Усинск',
			'г. Инта',
			'г. Сосногорск',
			'г. Емва',
			'г. Вуктыл',
			'с. Выльгорт',
			'г. Микунь',
			'пгт Воргашор',
		),
		'12' => array(
			'г. Йошкар-Ола',
			'г. Волжск',
			'г. Козьмодемьянск',
			'пгт Медведево',
			'г. Звенигово',
			'пгт Советский',
		),
		'13' => array(
			'г. Саранск',
			'г. Рузаевка',
			'г. Ковылкино',
			'пгт Комсомольский',
			'г. Краснослободск',
			'пгт Зубова Поляна',
			'г. Ардатов',
			'г. Инсар',
			'г. Темников',
		),
		'14' => array(
			'г. Якутск',
			'г. Нерюнгри',
			'г. Мирный',
			'г. Ленск',
			'г. Алдан',
			'пгт Айхал',
			'г. Удачный',
			'г. Вилюйск',
			'г. Нюрба',
			'г. Покровск',
			'г. Олёкминск',
			'г. Томмот',
			'г. Среднеколымск',
			'г. Верхоянск',
		),
		'15' => array(
			'г. Владикавказ',
			'г. Моздок',
			'г. Беслан',
			'г. Алагир',
			'г. Ардон',
			'пгт Заводской',
			'с. Эльхотово',
			'с. Сунжа',
			'с. Ногир',
			'с. Кизляр',
			'г. Дигора',
			'с. Октябрьское',
		),
		'16' => array(
			'г. Казань',
			'г. Набережные Челны',
			'г. Нижнекамск',
			'г. Альметьевск',
			'г. Зеленодольск',
			'г. Бугульма',
			'г. Елабуга',
			'г. Лениногорск',
			'г. Чистополь',
			'г. Заинск',
			'г. Азнакаево',
			'г. Нурлат',
			'г. Бавлы',
			'г. Менделеевск',
			'г. Буинск',
			'г. Агрыз',
			'г. Арск',
			'г. Кукмор',
			'пгт Васильево',
			'г. Мензелинск',
		),
		'17' => array(
			'г. Кызыл',
			'пгт Каа-Хем',
			'г. Ак-Довурак',
			'г. Шагонар',
			'г. Чадан',
			'г. Туран',
		),
		'18' => array(
			'г. Ижевск',
			'г. Сарапул',
			'г. Воткинск',
			'г. Глазов',
			'г. Можга',
			'п. Игра',
			'п. Ува',
			'п. Балезино',
			'г. Камбарка',
			'п. Кез',
		),
		'19' => array(
			'г. Абакан',
			'г. Черногорск',
			'г. Саяногорск',
			'г. Абаза',
			'пгт Усть-Абакан',
			'г. Сорск',
			'с. Белый Яр',
		),
		'20' => array(
			'г. Грозный',
			'г. Урус-Мартан',
			'г. Шали',
			'г. Гудермес',
			'г. Аргун',
			'г. Курчалой',
			'с. Ачхой-Мартан',
			'с. Цоци-Юрт',
			'с. Бачи-Юрт',
			'с. Гойты',
			'с. Автуры',
			'с. Катыр-Юрт',
			'с. Гехи',
			'с. Гелдагана',
			'с. Майртуп',
			'ст-ца Шелковская',
			'с. Аллерой',
			'с. Самашки',
			'с. Герменчук',
			'с. Алхан-Кала',
		),
		'21' => array(
			'г. Чебоксары',
			'г. Новочебоксарск',
			'г. Канаш',
			'г. Алатырь',
			'г. Шумерля',
			'г. Цивильск',
			'п. Кугеси',
			'г. Козловка',
			'г. Мариинский Посад',
			'г. Ядрин',
		),
		'22' => array(
			'г. Барнаул',
			'г. Бийск',
			'г. Рубцовск',
			'г. Новоалтайск',
			'г. Заринск',
			'г. Камень-на-Оби',
			'г. Славгород',
			'г. Алейск',
			'пгт Южный',
			'пгт Тальменка',
			'г. Яровое',
			'г. Белокуриха',
			'с. Павловск',
			'с. Кулунда',
			'с. Алтайское',
			'г. Горняк',
			'с. Шипуново',
			'с. Поспелиха',
			'п. Сибирский',
			'пгт Благовещенка',

		),
		'23' => array(
			'г. Краснодар',
			'г. Сочи',
			'г. Новороссийск',
			'г. Армавир',
			'г. Ейск',
			'г. Кропоткин',
			'г. Славянск-на-Кубани',
			'г. Туапсе',
			'г. Лабинск',
			'г. Тихорецк',
			'г. Анапа',
			'г. Крымск',
			'г. Геленджик',
			'г. Тимашёвск',
			'г. Белореченск',
			'г. Курганинск',
			'ст-ца Каневская',
			'г. Усть-Лабинск',
			'г. Кореновск',
			'г. Апшеронск',
		),
		'24' => array(
			'г. Красноярск',
			'г. Норильск',
			'г. Ачинск',
			'г. Канск',
			'г. Железногорск',
			'г. Минусинск',
			'г. Зеленогорск',
			'г. Лесосибирск',
			'г. Назарово',
			'г. Шарыпово',
			'г. Сосновоборск',
			'г. Дивногорск',
			'г. Дудинка',
			'г. Боготол',
			'пгт Берёзовка',
			'г. Енисейск',
			'г. Бородино',
			'пгт Шушенское',
			'г. Иланский',
			'г. Ужур',
		),
		'25' => array(
			'г. Владивосток',
			'г. Находка',
			'г. Уссурийск',
			'г. Артём',
			'г. Арсеньев',
			'г. Спасск-Дальний',
			'г. Большой Камень',
			'г. Партизанск',
			'г. Дальнегорск',
			'г. Лесозаводск',
			'г. Дальнереченск',
			'г. Фокино',
			'пгт Лучегорск',
			'п. Трудовое',
			'с. Черниговка',
			'пгт Славянка',
			'с. Чугуевка',
			'с. Камень-Рыболов',
			'с. Хороль',
		),
		'26' => array(
			'г. Ставрополь',
			'г. Пятигорск',
			'г. Кисловодск',
			'г. Невинномысск',
			'г. Ессентуки',
			'г. Минеральные Воды',
			'г. Георгиевск',
			'г. Михайловск',
			'г. Будённовск',
			'г. Изобильный',
			'г. Светлоград',
			'пгт Горячеводский',
			'г. Зеленокумск',
			'г. Благодарный',
			'г. Нефтекумск',
			'пгт Иноземцево',
			'с. Александровское',
			'г. Новоалександровск',
			'г. Новопавловск',
			'г. Ипатово',
		),
		'27' => array(
			'г. Хабаровск',
			'г. Комсомольск-на-Амуре',
			'г. Амурск',
			'г. Советская Гавань',
			'г. Николаевск-на-Амуре',
			'г. Бикин',
			'пгт Ванино',
			'г. Вяземский',
			'пгт Чегдомын',
			'пгт Солнечный',
			'пгт Эльбан',
		),
		'28' => array(
			'г. Благовещенск',
			'г. Белогорск',
			'г. Свободный',
			'г. Тында',
			'г. Зея',
			'г. Райчихинск',
			'г. Шимановск',
			'г. Завитинск',
			'пгт Прогресс',
			'пгт Магдагачи',
			'г. Сковородино',
			'г. Циолковский',
		),
		'29' => array(
			'г. Архангельск',
			'г. Северодвинск',
			'г. Котлас',
			'г. Новодвинск',
			'г. Коряжма',
			'г. Мирный',
			'г. Вельск',
			'г. Няндома',
			'г. Онега',
			'пгт Вычегодский',
			'пгт Коноша',
			'пгт Плесецк',
			'г. Каргополь',
			'г. Шенкурск',
			'г. Мезень',
		),
		'30' => array(
			'г. Астрахань',
			'г. Ахтубинск',
			'г. Знаменск',
			'г. Харабали',
			'г. Камызяк',
			'с. Красный Яр',
			'г. Нариманов',
			'п. Володарский',
			'с. Икряное',
		),
		'31' => array(
			'г. Белгород',
			'г. Старый Оскол',
			'г. Губкин',
			'г. Шебекино',
			'г. Алексеевка',
			'г. Валуйки',
			'г. Строитель',
			'г. Новый Оскол',
			'пгт Разумное',
			'пгт Чернянка',
			'пгт Борисовка',
			'пгт Ровеньки',
			'пгт Волоконовка',
			'пгт Северный',
			'пгт Ракитное',
			'г. Бирюч',
			'г. Грайворон',
			'г. Короча',
		),
		'32' => array(
			'г. Брянск',
			'г. Клинцы',
			'г. Новозыбков',
			'г. Дятьково',
			'г. Унеча',
			'г. Карачев',
			'г. Стародуб',
			'г. Жуковка',
			'г. Сельцо',
			'г. Почеп',
			'г. Трубчевск',
			'пгт Навля',
			'г. Фокино',
			'п. Климово',
			'пгт Климово',
			'пгт Клетня',
			'г. Сураж',
			'г. Мглин',
			'г. Севск',
			'г. Злынка',
		),
		'33' => array(
			'г. Владимир',
			'г. Ковров',
			'г. Муром',
			'г. Александров',
			'г. Гусь-Хрустальный',
			'г. Кольчугино',
			'г. Вязники',
			'г. Киржач',
			'г. Юрьев-Польский',
			'г. Собинка',
			'г. Радужный',
			'г. Покров',
			'г. Лакинск',
			'г. Меленки',
			'г. Петушки',
			'г. Карабаново',
			'г. Струнино',
			'г. Гороховец',
			'г. Камешково',
			'г. Судогда',
		),
		'34' => array(
			'г. Волгоград',
			'г. Волжский',
			'г. Камышин',
			'г. Михайловка',
			'г. Урюпинск',
			'г. Фролово',
			'г. Калач-на-Дону',
			'г. Котово',
			'пгт Городище',
			'г. Суровикино',
			'г. Котельниково',
			'г. Новоаннинский',
			'г. Жирновск',
			'г. Краснослободск',
			'г. Палласовка',
			'г. Ленинск',
			'г. Николаевск',
			'пгт Средняя Ахтуба',
			'г. Дубовка',
			'пгт Елань',
		),
		'35' => array(
			'г. Вологда',
			'г. Череповец',
			'г. Сокол',
			'г. Великий Устюг',
			'пгт Шексна',
			'г. Грязовец',
			'г. Бабаево',
			'пгт Кадуй',
			'г. Вытегра',
			'г. Харовск',
			'г. Тотьма',
			'г. Белозерск',
			'г. Устюжна',
			'г. Никольск',
			'г. Кириллов',
			'г. Красавино',
			'г. Кадников',
		),
		'36' => array(
			'г. Воронеж',
			'г. Борисоглебск',
			'г. Россошь',
			'г. Лиски',
			'г. Острогожск',
			'г. Нововоронеж',
			'с. Новая Усмань',
			'г. Бутурлиновка',
			'г. Семилуки',
			'г. Павловск',
			'г. Калач',
			'г. Бобров',
			'г. Поворино',
			'пгт Анна',
			'пгт Грибановский',
			'г. Богучар',
			'пгт Таловая',
			'г. Эртиль',
			'пгт Кантемировка',
			'г. Новохопёрск',
		),
		'37' => array(
			'г. Иваново',
			'г. Кинешма',
			'г. Шуя',
			'г. Вичуга',
			'г. Фурманов',
			'г. Тейково',
			'г. Кохма',
			'г. Родники',
			'г. Приволжск',
			'г. Южа',
			'г. Заволжск',
			'г. Наволоки',
			'г. Юрьевец',
			'г. Комсомольск',
			'г. Пучеж',
			'г. Гаврилов Посад',
			'г. Плёс',
		),
		'38' => array(
			'г. Иркутск',
			'г. Братск',
			'г. Ангарск',
			'г. Усть-Илимск',
			'г. Усолье-Сибирское',
			'г. Черемхово',
			'г. Шелехов',
			'г. Усть-Кут',
			'г. Тулун',
			'г. Саянск',
			'г. Нижнеудинск',
			'г. Тайшет',
			'г. Зима',
			'г. Железногорск-Илимский',
			'пгт Маркова',
			'г. Вихоревка',
			'г. Слюдянка',
			'г. Бодайбо',
			'п. Усть-Ордынский',
			'пгт Чунский',
		),
		'39' => array(
			'г. Калининград',
			'г. Советск',
			'г. Черняховск',
			'г. Балтийск',
			'г. Гусев',
			'г. Светлый',
			'г. Гвардейск',
			'г. Зеленоградск',
			'г. Гурьевск',
			'г. Неман',
			'г. Пионерский',
			'г. Светлогорск',
			'г. Мамоново',
			'г. Полесск',
			'г. Багратионовск',
			'г. Озёрск',
			'г. Славск',
			'г. Нестеров',
			'г. Правдинск',
			'г. Ладушкин',
		),
		'40' => array(
			'г. Калуга',
			'г. Обнинск',
			'г. Людиново',
			'г. Киров',
			'г. Малоярославец',
			'г. Балабаново',
			'г. Козельск',
			'г. Кондрово',
			'г. Сухиничи',
			'пгт Товарково',
			'г. Сосенский',
			'г. Боровск',
			'г. Жуков',
			'г. Кремёнки',
			'п. Воротынск',
			'г. Ермолино',
			'г. Таруса',
			'г. Белоусово',
			'г. Медынь',
			'г. Юхнов',
		),
		'41' => array(
			'г. Петропавловск-Камчатский',
			'г. Елизово',
			'г. Вилючинск',
		),
		'42' => array(
			'г. Новокузнецк',
			'г. Кемерово',
			'г. Прокопьевск',
			'г. Междуреченск',
			'г. Ленинск-Кузнецкий',
			'г. Киселёвск',
			'г. Юрга',
			'г. Белово',
			'г. Анжеро-Судженск',
			'г. Берёзовский',
			'г. Осинники',
			'г. Мыски',
			'г. Мариинск',
			'г. Топки',
			'г. Полысаево',
			'г. Тайга',
			'г. Гурьевск',
			'г. Таштагол',
			'г. Калтан',
			'пгт Промышленная',
		),
		'43' => array(
			'г. Киров',
			'г. Кирово-Чепецк',
			'г. Вятские Поляны',
			'г. Слободской',
			'г. Котельнич',
			'г. Омутнинск',
			'г. Яранск',
			'г. Советск',
			'г. Сосновка',
			'г. Луза',
			'г. Белая Холуница',
			'г. Зуевка',
			'г. Кирс',
			'г. Уржум',
			'г. Нолинск',
			'г. Малмыж',
			'г. Орлов',
			'г. Мураши',
		),
		'44' => array(
			'г. Кострома',
			'г. Буй',
			'г. Шарья',
			'г. Нерехта',
			'г. Мантурово',
			'г. Галич',
			'г. Волгореченск',
			'пгт Ветлужский',
			'г. Нея',
			'г. Макарьев',
			'г. Солигалич',
			'г. Чухлома',
			'г. Кологрив',
		),
		'45' => array(
			'г. Курган',
			'г. Шадринск',
			'г. Шумиха',
			'г. Куртамыш',
			'г. Катайск',
			'г. Далматово',
			'г. Петухово',
			'г. Щучье',
			'г. Макушино',
		),
		'46' => array(
			'г. Курск',
			'г. Железногорск',
			'г. Курчатов',
			'г. Льгов',
			'г. Щигры',
			'г. Рыльск',
			'г. Обоянь',
			'г. Дмитриев',
			'г. Суджа',
			'г. Фатеж',
		),
		'47' => array(
			'г. Гатчина',
			'г. Выборг',
			'г. Сосновый Бор',
			'г. Всеволожск',
			'г. Тихвин',
			'г. Кириши',
			'г. Кингисепп',
			'г. Сертолово',
			'г. Волхов',
			'г. Тосно',
			'г. Луга',
			'г. Сланцы',
			'г. Кировск',
			'г. Кудрово',
			'г. Отрадное',
			'г. Пикалёво',
			'г. Лодейное Поле',
			'г. Коммунар',
			'г. Мурино',
			'г. Никольское',
		),
		'48' => array(
			'г. Липецк',
			'г. Елец',
			'г. Грязи',
			'г. Данков',
			'г. Лебедянь',
			'г. Усмань',
			'г. Чаплыгин',
			'г. Задонск',
		),
		'49' => array(
			'г. Магадан',
			'г. Сусуман',
		),
		'50' => array(
			'г. Балашиха',
			'г. Подольск',
			'г. Химки',
			'г. Королёв',
			'г. Мытищи',
			'г. Люберцы',
			'г. Электросталь',
			'г. Коломна',
			'г. Одинцово',
			'г. Серпухов',
			'г. Орехово-Зуево',
			'г. Красногорск',
			'г. Сергиев Посад',
			'г. Щёлково',
			'г. Пушкино',
			'г. Жуковский',
			'г. Ногинск',
			'г. Раменское',
			'г. Домодедово',
			'г. Воскресенск',
		),
		'51' => array(
			'г. Мурманск',
			'г. Апатиты',
			'г. Североморск',
			'г. Мончегорск',
			'г. Кандалакша',
			'г. Кировск',
			'г. Оленегорск',
			'г. Ковдор',
			'г. Полярный',
			'г. Заполярный',
			'г. Полярные Зори',
			'пгт Мурмаши',
			'г. Снежногорск',
			'пгт Никель',
			'г. Заозёрск',
			'г. Гаджиево',
			'г. Кола',
			'г. Островной',
		),
		'52' => array(
			'г. Нижний Новгород',
			'г. Дзержинск',
			'г. Арзамас',
			'г. Саров',
			'г. Бор',
			'г. Кстово',
			'г. Павлово',
			'г. Выкса',
			'г. Балахна',
			'г. Заволжье',
			'г. Кулебаки',
			'г. Городец',
			'г. Богородск',
			'г. Семёнов',
			'г. Лысково',
			'г. Сергач',
			'г. Шахунья',
			'г. Навашино',
			'г. Лукоянов',
			'г. Первомайск',
		),
		'53' => array(
			'г. Великий Новгород',
			'г. Боровичи',
			'г. Старая Русса',
			'г. Чудово',
			'г. Валдай',
			'г. Пестово',
			'г. Окуловка',
			'г. Малая Вишера',
			'г. Сольцы',
			'г. Холм',
		),
		'54' => array(
			'г. Новосибирск',
			'г. Бердск',
			'г. Искитим',
			'г. Куйбышев',
			'г. Барабинск',
			'г. Карасук',
			'г. Обь',
			'г. Татарск',
			'пгт Краснообск',
			'г. Тогучин',
			'г. Черепаново',
			'пгт Линёво',
			'г. Болотное',
			'пгт Коченёво',
			'пгт Кольцово',
			'пгт Сузун',
			'г. Купино',
			'пгт Маслянино',
			'пгт Колывань',
			'г. Чулым',
		),
		'55' => array(
			'г. Омск',
			'г. Тара',
			'г. Исилькуль',
			'г. Калачинск',
			'пгт Таврическое',
			'г. Называевск',
			'г. Тюкалинск',
			'пгт Черлак',
			'пгт Любинский',
			'пгт Большеречье',
			'пгт Муромцево',
		),
		'56' => array(
			'г. Оренбург',
			'г. Орск',
			'г. Новотроицк',
			'г. Бузулук',
			'г. Бугуруслан',
			'г. Гай',
			'г. Сорочинск',
			'г. Медногорск',
			'г. Соль-Илецк',
			'г. Кувандык',
			'г. Абдулино',
			'п. Саракташ',
			'г. Ясный',
			'п. Акбулак',
			'п. Новосергиевка',
			'с. Тоцкое Второе',
			'п. Новоорск',
		),
		'57' => array(
			'г. Орёл',
			'г. Ливны',
			'г. Мценск',
			'пгт Знаменка',
			'г. Болхов',
			'пгт Нарышкино',
			'г. Дмитровск',
			'г. Малоархангельск',
			'г. Новосиль',
		),
		'58' => array(
			'г. Пенза',
			'г. Кузнецк',
			'г. Заречный',
			'г. Каменка',
			'г. Сердобск',
			'г. Нижний Ломов',
			'г. Никольск',
			'пгт Мокшан',
			'с. Бессоновка',
			'пгт Башмаково',
			'г. Белинский',
			'г. Городище',
			'г. Спасск',
			'г. Сурск',
		),
		'59' => array(
			'г. Пермь',
			'г. Березники',
			'г. Соликамск',
			'г. Чайковский',
			'г. Кунгур',
			'г. Лысьва',
			'г. Краснокамск',
			'г. Чусовой',
			'г. Добрянка',
			'г. Чернушка',
			'г. Кудымкар',
			'г. Губаха',
			'г. Верещагино',
			'г. Оса',
			'г. Кизел',
			'г. Нытва',
			'г. Красновишерск',
			'г. Александровск',
			'г. Очёр',
			'пгт Полазна',
		),
		'60' => array(
			'г. Псков',
			'г. Великие Луки',
			'г. Остров',
			'г. Невель',
			'г. Печоры',
			'г. Опочка',
			'г. Порхов',
			'г. Дно',
			'г. Новосокольники',
			'г. Себеж',
			'г. Пыталово',
			'г. Пустошка',
			'г. Гдов',
			'г. Новоржев',
		),
		'61' => array(
			'г. Ростов-на-Дону',
			'г. Таганрог',
			'г. Шахты',
			'г. Волгодонск',
			'г. Новочеркасск',
			'г. Батайск',
			'г. Новошахтинск',
			'г. Каменск-Шахтинский',
			'г. Азов',
			'г. Гуково',
			'г. Сальск',
			'г. Донецк',
			'г. Белая Калитва',
			'г. Аксай',
			'г. Красный Сулин',
			'г. Миллерово',
			'г. Морозовск',
			'г. Зерноград',
			'г. Семикаракорск',
			'г. Зверев',
		),
		'62' => array(
			'г. Рязань',
			'г. Касимов',
			'г. Скопин',
			'г. Сасово',
			'г. Ряжск',
			'г. Новомичуринск',
			'г. Рыбное',
			'пгт Шилово',
			'г. Кораблино',
			'г. Михайлов',
			'г. Спасск-Рязанский',
			'г. Шацк',
			'г. Спас-Клепики',
		),
		'63' => array(
			'г. Самара',
			'г. Тольятти',
			'г. Сызрань',
			'г. Новокуйбышевск',
			'г. Чапаевск',
			'г. Жигулёвск',
			'г. Отрадный',
			'г. Кинель',
			'г. Похвистнево',
			'г. Октябрьск',
			'пгт Безенчук',
			'г. Нефтегорск',
			'с. Кинель-Черкассы',
			'пгт Суходол	',
			'пгт Усть-Кинельский',
			'пгт Алексеевка',
			'пгт Рощинский',
		),
		'64' => array(
			'г. Саратов',
			'г. Энгельс',
			'г. Балаково',
			'г. Балашов',
			'г. Вольск',
			'г. Пугачёв',
			'г. Ртищево',
			'пгт Приволжский',
			'г. Маркс',
			'г. Петровск',
			'г. Аткарск',
			'г. Красноармейск',
			'г. Ершов',
			'г. Новоузенск',
			'г. Калининск',
			'г. Красный Кут',
			'г. Хвалынск',
			'г. Аркадак',
			'пгт Светлый',
			'пгт Степное',
		),
		'65' => array(
			'г. Южно-Сахалинск',
			'г. Корсаков',
			'г. Холмск',
			'г. Оха',
			'г. Поронайск',
			'г. Долинск',
			'г. Углегорск',
			'г. Невельск',
			'г. Александровск-Сахалинский',
			'пгт Ноглики',
			'г. Анива',
			'г. Шахтёрск',
			'г. Макаров',
			'г. Томари',
			'г. Северо-Курильск',
			'г. Курильск',
		),
		'66' => array(
			'г. Екатеринбург',
			'г. Нижний Тагил',
			'г. Каменск-Уральский',
			'г. Первоуральск',
			'г. Серов',
			'г. Новоуральск',
			'г. Асбест',
			'г. Полевской',
			'г. Ревда',
			'г. Краснотурьинск',
			'г. Верхняя Пышма',
			'г. Лесной',
			'г. Берёзовский',
			'г. Верхняя Салда',
			'г. Качканар',
			'г. Красноуфимск',
			'г. Реж',
			'г. Ирбит',
			'г. Алапаевск',
			'г. Тавда',
		),
		'67' => array(
			'г. Смоленск',
			'г. Вязьма',
			'г. Рославль',
			'г. Ярцево',
			'г. Сафоново',
			'г. Гагарин',
			'г. Десногорск',
			'пгт Верхнеднепровский',
			'г. Дорогобуж',
			'г. Ельня',
			'г. Рудня',
			'г. Починок',
			'г. Сычёвка',
			'г. Велиж',
			'г. Демидов',
			'г. Духовщина',
		),
		'68' => array(
			'г. Тамбов',
			'г. Мичуринск',
			'г. Рассказово',
			'г. Моршанск',
			'г. Котовск',
			'г. Уварово',
			'п. Строитель',
			'г. Кирсанов',
			'г. Жердевка',
			'пгт Первомайский',
		),
		'69' => array(
			'г. Тверь',
			'г. Ржев',
			'г. Вышний Волочёк',
			'г. Кимры',
			'г. Торжок',
			'г. Конаково',
			'г. Удомля',
			'г. Бежецк',
			'г. Бологое',
			'г. Нелидово',
			'г. Осташков',
			'г. Кашин',
			'г. Калязин',
			'г. Торопец',
			'г. Лихославль',
			'пгт Редкино',
			'пгт Озёрный',
			'г. Кувшиново',
			'г. Западная Двина',
			'г. Старица',
		),
		'70' => array(
			'г. Томск',
			'г. Северск',
			'г. Стрежевой',
			'г. Асино',
			'г. Колпашево',
			'г. Кедровый',
		),
		'71' => array(
			'г. Тула',
			'г. Новомосковск',
			'г. Донской',
			'г. Алексин',
			'г. Щёкино',
			'г. Узловая',
			'г. Ефремов',
			'г. Богородицк',
			'г. Кимовск',
			'г. Киреевск',
			'г. Суворов',
			'г. Ясногорск',
			'г. Плавск',
			'г. Венёв',
			'г. Белёв',
			'г. Болохово',
			'г. Липки',
			'г. Советск',
			'г. Чекалин',
		),
		'72' => array(
			'г. Тюмень',
			'г. Тобольск',
			'г. Ишим',
			'г. Ялуторовск',
			'г. Заводоуковск',
			'п. Нижнесортымский',
			'п. Солнечный',
		),
		'73' => array(
			'г. Ульяновск',
			'г. Димитровград',
			'г. Инза',
			'г. Барыш',
			'г. Новоульяновск',
			'пгт Чердаклы',
			'пгт Ишеевка',
			'пгт Новоспасское',
			'г. Сенгилей',
		),
		'74' => array(
			'г. Челябинск',
			'г. Магнитогорск',
			'г. Златоуст',
			'г. Миасс',
			'г. Копейск',
			'г. Озёрск',
			'г. Троицк',
			'г. Снежинск',
			'г. Сатка',
			'г. Чебаркуль',
			'г. Кыштым',
			'г. Коркино',
			'г. Южноуральск',
			'г. Трёхгорный',
			'г. Аша',
			'г. Верхний Уфалей',
			'г. Еманжелинск',
			'г. Карталы',
			'г. Усть-Катав',
			'г. Бакал',
		),
		'75' => array(
			'г. Чита',
			'г. Краснокаменск',
			'г. Борзя',
			'г. Петровск-Забайкальский',
			'пгт Агинское',
			'г. Нерчинск',
			'г. Шилка',
			'г. Могоча',
			'пгт Забайкальск',
			'пгт Чернышевск',
			'пгт Карымское',
			'г. Балей',
			'пгт Шерловая Гора',
			'г. Хилок',
			'пгт Горный',
			'пгт Первомайский',
			'пгт Могойтуй',
			'пгт Атамановка',
			'пгт Новокручининск',
			'г. Сретенск',
		),
		'76' => array(
			'г. Ярославль',
			'г. Рыбинск',
			'г. Переславль-Залесский',
			'г. Тутаев',
			'г. Углич',
			'г. Ростов',
			'г. Гаврилов-Ям',
			'г. Данилов',
			'г. Пошехонье',
			'г. Мышкин',
			'г. Любим',
		),
		'77' => array(
			'г. Москва',
			'г. Троицк',
			'г. Щербинка',
			'г. Московский',
			'пгт Кокошкино',
			'пгт Киевский',
		),
		'78' => array(
			'г. Санкт-Петербург',
			'г. Колпино',
			'г. Пушкин',
			'г. Петергоф',
			'г. Красное Село',
			'г. Ломоносов',
			'г. Кронштадт',
			'г. Сестрорецк',
			'г. Павловск',
			'г. Зеленогорск',
		),
		'79' => array(
			'г. Биробиджан',
			'г. Облучье',
		),
		'82' => array(
			'г. Симферополь',
			'г. Керчь',
			'г. Евпатория',
			'г. Ялта',
			'г. Феодосия',
			'г. Джанкой',
			'г. Алушта',
			'г. Красноперекопск',
			'г. Саки',
			'г. Бахчисарай',
			'г. Армянск',
			'г. Белогорск',
			'г. Судак',
			'г. Щелкино',
			'пгт Черноморское',
			'пгт Октябрьское',
			'пгт Советский',
			'г. Старый Крым',
			'г. Алупка',
		),
		'83' => array(
			'г. Нарьян-Мар',
		),
		'86' => array(
			'г. Сургут',
			'г. Нижневартовск',
			'г. Нефтеюганск',
			'г. Ханты-Мансийск',
			'г. Когалым',
			'г. Нягань',
			'г. Мегион',
			'г. Радужный',
			'г. Лангепас',
			'г. Пыть-Ях',
			'г. Урай',
			'г. Лянтор',
			'г. Югорск',
			'пгт Пойковский',
			'г. Советский',
			'пгт Фёдоровский',
			'г. Белоярский',
			'пгт Излучинск',
			'пгт Белый Яр',
			'г. Покачи',
		),
		'87' => array(
			'г. Анадырь',
			'г. Билибино',
			'г. Певек',
		),
		'89' => array(
			'г. Ноябрьск',
			'г. Новый Уренгой',
			'г. Надым',
			'г. Салехард',
			'г. Муравленко',
			'г. Лабытнанги',
			'г. Губкинский',
			'г. Тарко-Сале',
			'пгт Пангоды',
			'пгт Уренгой',
		),
		'92' => array(
			'г. Севастополь',
			'нп Балаклава',
			'г. Инкерман',
		),
	);

	return $cities;
}

add_filter('woocommerce_checkout_get_value','__return_empty_string',10);