<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $GS;
$FS_path = $GS->theme.'/assets/js/nouislider.js';
$URL_path = $GS->theme_uri.'/assets/js/nouislider.js';
$version = $GS->asset_version($FS_path, 'js');
wp_enqueue_script('nouislider',$URL_path,array('jquery'),$version);

$FS_path = $GS->theme.'/assets/js/category.js';
$URL_path = $GS->theme_uri.'/assets/js/category.js';
$version = $GS->asset_version($FS_path, 'js');
wp_enqueue_script('category',$URL_path,array('jquery','nouislider','extends'),$version);

get_header();
?>
<main id="main" class="base-page category-page">
	<div class="wrapper">
		<?php get_sidebar('quick'); ?>
		<div class="row main-row">
			<?php get_sidebar(); ?>
			<div class="content-holder col-xs-12 <?php if(!defined('NOSIDEBAR')) { ?>col-md-8<?php } ?>">
				<div class="breadcrumbs-holder">
					<ul class="breadcrumbs">
						<?php if(function_exists('bcn_display_list')) { bcn_display_list(); } ?>
					</ul>
				</div>
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
				<?php
				if(woocommerce_product_loop())
				{
					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 * @hooked venus_catalog_categories_styling - 40
					 */
					do_action( 'woocommerce_before_shop_loop' );

					woocommerce_product_loop_start();
					// if ( wc_get_loop_prop( 'total' ) )
					// {
						while ( have_posts() ) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					// }
					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
				}
				/**
				 * Hook: woocommerce_before_main_content.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 * @hooked WC_Structured_Data::generate_website_data() - 30
				 */
				do_action( 'woocommerce_before_main_content' );
				?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>