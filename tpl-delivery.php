<?php

/**
*	Template name: Оплата и доставка
**/

the_post();
get_header();
$thumbnail = get_the_post_thumbnail( $id, 'full' );
$payment = get_field('payment');
$delivery = get_field('delivery');
?>
<main id="main" class="base-page delivery-page">
	<div class="wrapper">
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php diamond_breadcrumbs(); ?>
				<div class="white-holder">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
				</div>
				<div class="block__content">
					<div class="content__item block__payment">
						<div class="block__title">
							Оплата
						</div>
						<?php foreach ($payment as $item => $value) { 
							$img = wp_get_attachment_image_url($value['item_icon'],'thumbnail'); ?>
							<div class="block__item payment__item">
								<div class="item__icon">
									<img src="<?php echo $img; ?>" alt="">
								</div>
								<div class="item__title">
									<?php echo $value['item_title']; ?>
								</div>
								<div class="item__desc">
									<?php echo $value['item_desc']; ?>
								</div>
							</div>
						<?php } ?>
					</div>
					<div class="content__item block__delivery">
						<div class="block__title">
							Доставка
						</div>
						<?php foreach ($delivery as $item => $value) { 
							$img = wp_get_attachment_image_url($value['item_icon'],'thumbnail'); ?>
							<div class="block__item delivery__item">
								<div class="item__icon">
									<img src="<?php echo $img; ?>" alt="">
								</div>
								<div class="item__title">
									<?php echo $value['item_title']; ?>
								</div>
								<div class="item__desc">
									<?php echo $value['item_desc']; ?>
								</div>
							</div>
						<?php } ?>	
					</div>
				</div>
				<div class="note-holder">
					<?php the_field('note');?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>