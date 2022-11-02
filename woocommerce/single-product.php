<?php get_header(); ?>
<main id="main" class="base-page product-page">
	<div class="wrapper">
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php do_action('woocommerce_before_main_content'); ?>
				<?php
					while(have_posts())
					{
						the_post();
						wc_get_template_part( 'content', 'single-product' );
					}
				?>
				<?php do_action( 'woocommerce_after_main_content' ); ?>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>