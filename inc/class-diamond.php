<?php
/**
 * Diamond Class
 *
 * @since    2.0.0
 * @package  diamond
 */

if(!defined('ABSPATH'))
{
	exit;
}

if(!class_exists('Diamond'))
{
	class Diamond
	{
		public function __construct()
		{
			add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
			add_action( 'widgets_init', array( $this, 'theme_widgets' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'theme_assets') );
			add_filter( 'woocommerce_email_order_items_table', array( $this, 'sww_add_images_woocommerce_emails'), 10, 2 );
		}

		function sww_add_images_woocommerce_emails( $output, $order ) {
			
			// set a flag so we don't recursively call this filter
			static $run = 0;
		  
			// if we've already run this filter, bail out
			if ( $run ) {
				return $output;
			}
		  
			$args = array(
				'show_image'   	=> true,
				'image_size'    => array( 100, 100 ),
			);
		  
			// increment our flag so we don't run again
			$run++;
		  
			// if first run, give WooComm our updated table
			return $order->email_order_items_table( $args );
		}

		public function theme_setup()
		{
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'customize-selective-refresh-widgets' );
			add_theme_support( 'wp-block-styles' );
			add_theme_support( 'editor-styles' );
			add_theme_support( 'responsive-embeds' );

			register_nav_menus(
				apply_filters(
					'diamond_register_nav_menus', array(
						'header'  => 'Верхнее',
						'quick'   => 'Быстрые ссылки',
						'sidebar' => 'Боковое',
					)
				)
			);

			add_theme_support(
				'html5', apply_filters(
					'diamond_html5_args', array(
						'search-form',
						'comment-form',
						'comment-list',
						'gallery',
						'caption',
						'widgets',
					)
				)
			);

		}

		public function theme_widgets()
		{
			$sidebar_args['sidebar'] = array(
				'name'        => 'Сайдбар',
				'id'          => 'sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => "</div>",
				'description' => '',
			);
			$sidebar_args['filter'] = array(
				'name'        => 'Фильтр',
				'id'          => 'filter',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => "</div>",
				'description' => '',
			);

			$sidebar_args = apply_filters( 'diamond_sidebar_args', $sidebar_args );

			foreach ( $sidebar_args as $sidebar => $args )
			{
				$widget_tags = array();
				$filter_hook = sprintf( 'diamond_%s_widget_tags', $sidebar );
				$widget_tags = apply_filters( $filter_hook, $widget_tags );

				if ( is_array( $widget_tags ) ) {
					register_sidebar( $args + $widget_tags );
				}
			}
		}

		public function theme_assets()
		{
			global $GS;

			$FS_path = $GS->theme.'/assets/css/main.css';
			$URL_path = $GS->theme_uri.'/assets/css/main.css';
			$version = $GS->asset_version($FS_path, 'css');
			wp_enqueue_style('main', $URL_path, array(), $version);

			// if(is_tax() or is_post_type_archive('product'))
			// {
				$FS_path = $GS->theme.'/assets/css/filter.css';
				$URL_path = $GS->theme_uri.'/assets/css/filter.css';
				$version = $GS->asset_version($FS_path, 'css');
				wp_enqueue_style('universal-filter', $URL_path, array(), $version);
			// }

			wp_enqueue_style('font-proxima-nova', 'https://storage.redvps.webtm.ru/css?family=Proxima+Nova&weights=100,300,400,500,600,700,800,900', array('main'), false);
			// wp_enqueue_style('font-roboto', 'https://storage.redvps.webtm.ru/css?family=Roboto&weights=100,300,400,500,600,700,800,900', array('main'), false);

			wp_deregister_script('jquery');

			$FS_path = $GS->theme.'/assets/js/jquery.js';
			$URL_path = $GS->theme_uri.'/assets/js/jquery.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('jquery', $URL_path, array(), $version);

			$FS_path = $GS->theme.'/assets/js/extends.js';
			$URL_path = $GS->theme_uri.'/assets/js/extends.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('extends', $URL_path, array('jquery'), $version);

			$FS_path = $GS->theme.'/assets/js/modal.js';
			$URL_path = $GS->theme_uri.'/assets/js/modal.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('modal', $URL_path, array('jquery'), $version);

			$FS_path = $GS->theme.'/assets/js/vtm.js';
			$URL_path = $GS->theme_uri.'/assets/js/vtm.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('vtm', $URL_path, array('jquery'), $version);

			$FS_path = $GS->theme.'/assets/js/lightbox.js';
			$URL_path = $GS->theme_uri.'/assets/js/lightbox.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('lightbox', $URL_path, array('jquery'), $version);

			$FS_path = $GS->theme.'/assets/js/main.js';
			$URL_path = $GS->theme_uri.'/assets/js/main.js';
			$version = $GS->asset_version($FS_path, 'js');
			wp_enqueue_script('main', $URL_path, array('jquery','extends','modal','vtm','lightbox'), $version, true);

		}
	}
}

return new Diamond();