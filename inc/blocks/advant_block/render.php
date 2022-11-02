<section class="advantages">
	<div class="wrapper">
		<div class="advantages__block">
			<?php $advant = get_field('advant'); ?>
			<?php foreach ($advant as $item => $value) { ?>
				<div class="block__item">
					<div class="item__icon">
						<img src="<?php echo wp_get_attachment_image_url($value['item_image'], 'thumbnail'); ?>" alt="">
					</div>
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
</section>