<?php
defined( 'ABSPATH' ) || exit;
the_post();
get_header();

$gallery = get_field('gallery');
if(!is_array($gallery))
{
	$gallery = array();
}
$size = [270,200];
?>
<main id="main" class="base-page gallery-page single">
	<div class="wrapper">
		<?php get_sidebar('quick'); ?>
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php diamond_breadcrumbs(); ?>
				<div class="white-holder">
					<?php the_title('<h1 class="page-title">','</h1>');?>
					<div class="gallery-grid row">
						<?php foreach ($gallery as $image) { ?>
						<div class="gallery-grid-holder col-xs-12 col-sm-6 col-md-3">
							<div class="gallery-grid-element">
								<?=get_image_lightbox($image,$size,true,'gallery')?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>