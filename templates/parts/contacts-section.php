<?php
$address = get_field('contact_address', 'option');
$work_time = get_field('contact_work_time', 'option');
$phone = get_field('contact_phone', 'option');
$email = get_field('contact_email', 'option');
$vk = get_field('contact_vk_link', 'option');
$tg = get_field('contact_tg_link', 'option');
$viber = get_field('contact_viber_link', 'option');
$whatsapp = get_field('contact_whatsapp_link', 'option');
?>
<section class="contacts">
	<div class="contacts__container container">
		<h2 class="contacts__title h2-title">Контакты</h2>
		<div class="contacts__content">
			<div class="contacts__info">
				<address class="contacts__text">Адрес: <?= $address ?></address>
				<p class="contacts__text">График работы: <?= $work_time ?></p>
				<p class="contacts__text">Телефон: <a class="contacts__phone" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $phone) ?>"><?= $phone ?></a></p>
				<p class="contacts__text">Эл. почта: <a class="contacts__mail" href="mailto:<?= $email ?>"><?= $email ?></a></p>
				<div class="contacts__socials">
					<a class="contacts__socials-link" href="<?= $vk ?>">
						<svg class="contacts__socials-icon" width="30" height="30">
							<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#vk-icon"></use>
						</svg>
					</a>
					<a class="contacts__socials-link" href="<?= $tg ?>">
						<svg class="contacts__socials-icon" width="30" height="30">
							<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#tg-icon"></use>
						</svg>
					</a>
					<a class="contacts__socials-link" href="<?= $viber ?>">
						<svg class="contacts__socials-icon" width="30" height="30">
							<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#viber-icon"></use>
						</svg>
					</a>
					<a class="contacts__socials-link" href="<?= $whatsapp ?>">
						<svg class="contacts__socials-icon" width="30" height="30">
							<use xlink:href="<?= ct()->get_static_url() ?>/img/sprite.svg#whatsapp-icon"></use>
						</svg>
					</a>
				</div>
			</div>
			<div class="contacts__map">
				<img loading="lazy" src="<?= ct()->get_static_url() ?>/img/contacts__map.jpg" class="contacts__map-image" width="860" height="535"
					alt="Карта проезда до нашего офиса">
			</div>
		</div>

		<div class="contacts__add-info">
			<?php the_content(); ?>
		</div>

	</div>
</section>