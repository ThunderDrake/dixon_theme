<section class="about">
	<div class="wrapper">
		<div class="about__block">
			<div class="about__text-block">
				<div class="text-block__title">
					<?php the_field('about_title');?>
				</div>
				<div class="text-block__subtitle">
					<?php the_field('about_subtitle');?>
				</div>
				<div class="text-block__desc">
					<?php the_field('about_desc');?>
				</div>
				<a class="text-block__link" href="#">Подробнее</a>
			</div>
			<div class="about__image-block">
				<img src="<?php echo wp_get_attachment_image_url(get_field('about_image'), 'full');?>" alt="">
			</div>
		</div>
	</div>
</section>