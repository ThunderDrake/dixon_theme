<?php

/**
*	Template name: Контакты
**/

the_post();
get_header();

$phone = @settings('phones');
$email = @settings('emails');
$adress = @settings('addresses');
$social = array(
'yt' => @settings('youtube'),
'vk' => @settings('vk'),
'ig' => @settings('instagram'),
);
?>
<main id="main" class="base-page contact-page">
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
	<div class="contact__wall">
		<div class="wrapper">
			<div class="row main-row">
				<div class="content-holder col-xs-12 col-md-6">
					<div class="contact__block">
						<div class="block__info">
							<div class="item__info adress__block">
								<div class="item__icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/map.svg" alt=""></div>
								<div class="item__desc"><?php echo $adress[0]['value']; ?></div>
							</div>
							<div class="item__info phone__block">
								<?php foreach ($phone as $item => $value) { ?>
									<div class="item__icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/phone2.svg" alt=""></div>
									<div class="item__desc"><a href="tel:<?php echo $value['value']; ?>"><?php echo $value['value']; ?></a></div>
								<? } ?>
							</div>
							<div class="item__info email__block">
								<?php foreach ($email as $item => $value) { ?>
									<div class="item__icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/email2.svg" alt=""></div>
									<div class="item__desc"><a href="mailto:<?php echo $value['value']; ?>"><?php echo $value['value']; ?></a></div>
								<? } ?>
							</div>
							<div class="item__info requesites__block">
								<div class="item__icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/docs2.svg" alt=""></div>
								<div class="item__desc">
									<?php the_content(); ?>
								</div>
							</div>
							<div class="soc__links">
								<div class="links__title">Подписывайтесь на наши соцсети</div>
									<?php
									foreach ($social as $key => $link) {
										if($link) {
										?>
										<a href="<?=$link?>" class="social-link <?=$key?>" target="_blank"></a>
										<?php 	}
											}
									?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="block__map">
			<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A66e406b6a83cecacd5741bc2f15f33b6a5eebd89fc58af8fc1f4fe76d14871a7&amp;width=100%25&amp;height=100%&amp;lang=ru_RU&amp;scroll=true"></script>
		</div>
	</div>
</main>
<?php get_footer(); ?>