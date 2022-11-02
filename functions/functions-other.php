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
 * Возвращает массив ссылок (с названиями) на файлы в старой структуре сайта на Drupal.
 *
 * @return array - [ [ 'title' => 'название', 'file' => 'ссылка', ], [...], ... ]
 */
function get_drupal_old_images() {
	$_items = get_post_meta( get_the_ID(), 'drupal_old_images', true );
	$items  = [];
	$base   = get_drupal_files_dir_url();

	if ( $_items && is_array( $items ) ) {
		foreach ( $_items as $item ) {
			$items[] = [ 'title' => $item['desc'] ?? '', 'file' => $base . $item['uri'], ];
		}
	}

	return $items;
}

/**
 * Возвращает массив ссылок (с названиями) на файлы в старой структуре сайта на Drupal.
 *
 * @return array - [ [ 'title' => 'название', 'file' => 'ссылка', ], [...], ... ]
 */
function get_drupal_old_files() {
	$_items = get_post_meta( get_the_ID(), 'drupal_old_files', true );
	$items  = [];
	$base   = get_drupal_files_dir_url();

	if ( $_items && is_array( $items ) ) {
		foreach ( $_items as $item ) {
			$items[] = [ 'title' => $item['desc'] ?? '', 'file' => $base . $item['uri'], ];
		}
	}

	return $items;
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
 * my_wp_nav_menu_objects
 *
 * @param mixed $items
 * @param mixed $args
 *
 * @return void
 */
add_filter( 'wp_nav_menu_objects', 'school_wp_nav_menu_objects', 10, 2 );
function school_wp_nav_menu_objects( $items, $args ) {

	// loop
	foreach ( $items as &$item ) {

		// vars
		$icon_arr = get_field( 'menu_icon', $item );

		// append icon
		if ( $icon_arr && strpos( $icon_arr, '.svg' ) !== false ) {
			$icon = str_replace( site_url(), '', $icon_arr );
			$svg  = file_get_contents( ABSPATH . $icon );

			$item->title = $svg . $item->title;

		}

		if ( 'Dixon_publishing_header' == $args->theme_location || 'Dixon_socials_header' == $args->theme_location ) {
			$item->title .= '<span>&rarr;</span>';
		}

		if ( 'Dixon_socials_mobile_header' == $args->theme_location ) {
			$item->title = '<span>' . $item->title . '</span><span class="icon-arrow">&rarr;</span>';
		}

		if ( 'socials_footer' == $args->theme_location ) {
			$item->title = '<span>' . $item->title . '</span><svg width="13" height="14" aria-hidden="true"><use xlink:href="#arrow-right-up"></use></svg>';
		}

		if ( 'publishing_footer' == $args->theme_location ) {
			$item->title = $item->title . ' <svg width="13" height="14" aria-hidden="true"><use xlink:href="#arrow-right-up"></use></svg>';
		}

	}


	// return
	return $items;

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
 * Получает соседние (по дате) записи.
 *
 * @param array $args         {
 *                            Массив аргументов:
 *
 * @type int    $limit        По сколько соседних записей нужно получить.
 * @type bool   $in_same_term Получать записи только из тех же терминов в кторых находится текущая запись.
 * @type string $taxonomy     Название таксы. Когда $in_same_term = true, нужно знать с какой таксой работать.
 * @type int/WP_Post $post         Пост от которого идет отсчет. По умолчанию: текущий.
 * @type string $order        Порядок сортировки. При DESC - элемент 'prev' будет содержать новые записи, а 'next' старые. При ASC наоборот...
 * @type bool   $cache_result Нужно ли кэшировать результат в объектный кэш?
 * }
 *
 * @return array Массив вида array( 'prev'=>array(посты), 'next'=>array(посты) ) или array() если не удалось получить записи или в запросе есть ошибка.
 *
 * @ver 1.0
 */
function get_post_adjacents( $args = [] ) {
	global $wpdb;

	$args = (object) array_merge( [
		'limit'        => 3,
		'in_same_term' => false,
		'taxonomy'     => 'category',
		'post'         => $GLOBALS['post'],
		'order'        => 'DESC',
		'cache_result' => false,
	], $args );

	$post = is_numeric( $args->post ) ? get_post( $args->post ) : $args->post;

	// in_same_term
	$join = $where = '';
	if ( $args->in_same_term ) {
		$join  .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";
		$where .= $wpdb->prepare( "AND tt.taxonomy = %s", $args->taxonomy );

		if ( ! is_object_in_taxonomy( $post->post_type, $args->taxonomy ) ) {
			return [];
		}

		$term_array = wp_get_object_terms( $post->ID, $args->taxonomy, [ 'fields' => 'ids' ] );

		// Remove any exclusions from the term array to include.
		//$term_array = array_diff( $term_array, (array) $excluded_terms );

		if ( ! $term_array || is_wp_error( $term_array ) ) {
			return [];
		}

		$term_array = array_map( 'intval', $term_array );

		$where .= " AND tt.term_id IN (" . implode( ',', $term_array ) . ")";
	}

	$query = "
	(
		SELECT p.* FROM $wpdb->posts p $join
		WHERE
			p.post_date   > '" . esc_sql( $post->post_date ) . "' AND
			p.post_type   = '" . esc_sql( $post->post_type ) . "' AND
			p.post_status = 'publish' $where
		ORDER BY p.post_date ASC
		LIMIT " . intval( $args->limit ) . "
	)
	UNION
	( SELECT * FROM $wpdb->posts WHERE ID = $post->ID )
	UNION
	(
		SELECT p.* FROM $wpdb->posts p $join
		WHERE
			p.post_date   < '" . esc_sql( $post->post_date ) . "' AND
			p.post_type   = '" . esc_sql( $post->post_type ) . "' AND
			p.post_status = 'publish' $where
		ORDER BY p.post_date DESC
		LIMIT " . intval( $args->limit ) . "
	)
	ORDER by post_date " . ( $args->order === 'DESC' ? 'DESC' : 'ASC' ) . "
	";

	// пробуем получить кэш...
	if ( $args->cache_result ) {
		$query_key = 'post_adjacents_' . md5( $query );
		$result    = wp_cache_get( $query_key, 'counts' );
		if ( false === $result ) {
			$result = $wpdb->get_results( $query, OBJECT_K );
		}

		// кэшируем запрос...
		if ( ! $result ) {
			$result = [];
		}
		wp_cache_set( $query_key, $result, 'counts' );
	} else {
		$result = $wpdb->get_results( $query, OBJECT_K );
	}

	// соберем prev/next массивы
	if ( $result ) {

		$adjacents = [ 'prev' => [], 'next' => [] ];
		$indx      = 'prev';
		foreach ( $result as $pst ) {
			//unset($pst->post_content); // для дебага

			// текущий пост
			if ( $pst->ID == $post->ID ) {
				$indx = 'next';
				continue;
			}

			$adjacents[ $indx ][ $pst->ID ] = get_post( $pst ); // создадим объекты WP_Post
		}

	}

	return $adjacents;
}

/**
 * Возвращает домен из переданной ссылки.
 *
 * @param string $url
 *
 * @return string
 */
function get_domain_from_url( $url ) {
	return parse_url( $url )['host'];
}

/**
 * Возвращает домен из переданной ссылки. Не учитывается www.
 *
 * @param string $url
 *
 * @return string
 */
function get_domain_from_url_to_point( $url ) {
	return explode( '.', str_replace( 'www.', '', get_domain_from_url( $url ) ) )[0] ?? '';
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

function language_switcher_data() {
	if ( ! function_exists( 'wpml_get_active_languages_filter' ) ) {
		return [];
	}

	$langs = array_map( function ( $lang ) {
		$anchor = $lang['language_code'] === 'zh-hans' ? 'ch' : $lang['language_code'];
		$anchor = ucfirst( $anchor );

		$lang['anchor'] = $anchor;
		$lang['class']  = $lang['active'] ? 'lang__link lang__link--active' : 'lang__link';

		return $lang;
	}, wpml_get_active_languages_filter( '' ) );

	return $langs;
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

function resolve_dupes_add_to_cart_redirect($url = false) {

     // If another plugin beats us to the punch, let them have their way with the URL
     if(!empty($url)) { return $url; }

     // Redirect back to the original page, without the 'add-to-cart' parameter.
     // We add the 'get_bloginfo' part so it saves a redirect on https:// sites.
     return get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart'));

}