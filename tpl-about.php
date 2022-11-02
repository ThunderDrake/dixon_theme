<?php

/**
*	Template name: О компании
**/

the_post();
get_header();
$thumbnail = get_the_post_thumbnail( $id, 'full' );
$num = get_field('we_can');
$sert = get_field('sert');
?>
<main id="main" class="base-page about-page">
	<div class="wrapper">
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php diamond_breadcrumbs(); ?>
				<div class="white-holder">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="about__wall">
		<div class="wrapper">
			<div class="content-holder col-xs-12 col-md-6">
				<?php the_content(); ?>
				<div class="numeral__block">
					<?php foreach ($num as $item => $value) { ?>
						<div class="numeral__item">
							<div class="item__title">
								<?php echo $value['item_title'];?>
							</div>
							<div class="item__desc">
								<?php echo $value['item_desc'];?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="image__holder col-md-6">
				<?php echo $thumbnail; ?>	
			</div>
		</div>
	</div>
	<div class="wrapper">
		<div class="sert__title">Сертификаты</div>
		<div class="sertificats">
			<?php foreach ($sert as $key => $value) { 
				$img = $value['item_image'];
				?>
				<div class="sert__item">
					<a href="<?php echo wp_get_attachment_image_url($img, 'full');?>" rel="lightbox">
						<img src="<?php echo wp_get_attachment_image_url($img, 'medium');?>" alt="">
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>