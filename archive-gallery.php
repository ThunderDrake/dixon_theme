<?php
defined( 'ABSPATH' ) || exit;
get_header();
?>
<main id="main" class="base-page gallery-page">
	<div class="wrapper">
		<?php get_sidebar('quick'); ?>
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php diamond_breadcrumbs(); ?>
				<div class="white-holder">
					<h1 class="page-title"><?=post_type_archive_title( '', false )?></h1>
					<div class="galleries-grid row">
						<?php
							global $post;
							$size = [270,200];
							while(have_posts())
							{
								the_post();
						?>
						<div class="galleries-grid-holder col-xs-12 col-sm-6 col-md-3">
							<a href="<?php the_permalink(); ?>" class="galleries-grid-element">
								<div class="image"><?=get_thumb($post,$size)?></div>
								<div class="title"><?php the_title(); ?></div>
							</a>
						</div>
						<?php
							}
							wp_reset_query();
						?>
					</div>
				</div>
				<?php diamond_pagination(); ?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>