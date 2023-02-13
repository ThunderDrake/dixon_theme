<?php
$address = get_field('contact_address', 'option');
$work_time = get_field('contact_work_time', 'option');
$phone = get_field('contact_phone', 'option');
$phone_service = get_field('contact_phone_service', 'option');
$email = get_field('contact_email', 'option');
$email_service = get_field('contact_email_service', 'option');
$vk = get_field('contact_vk_link', 'option');
$tg = get_field('contact_tg_link', 'option');
$viber = get_field('contact_viber_link', 'option');
$whatsapp = get_field('contact_whatsapp_link', 'option');
$info = get_field('contact_info', 'option');
?>
<section class="contacts">
	<div class="contacts__container container">
		<h2 class="contacts__title h2-title">Контакты</h2>
		<div class="contacts__content">
			<div class="contacts__info">
				<div class="contacts__info-wrapper" style="padding: 20px; background-color: #E6E7FF; border-radius: 20px;">
					<address class="contacts__text">Адрес: <?= $address ?></address>
					<p class="contacts__text" style="margin: 0;">График работы: <?= $work_time ?></p>
				</div>
				<div class="contact__text-group">
					<p class="contacts__text contacts__text--title">Продажи:</p>
					<p class="contacts__text">Телефон: <a class="contacts__phone" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $phone) ?>"><?= $phone ?></a></p>
					<p class="contacts__text">Эл. почта: <a class="contacts__mail" href="mailto:<?= $email ?>"><?= $email ?></a></p>
				</div>
				<div class="contact__text-group">
					<p class="contacts__text contacts__text--title">Ремонт и сервис:</p>
					<p class="contacts__text">Телефон: <a class="contacts__phone" href="tel:<?= str_replace([' ', '(', ')', '-'], '', $phone_service) ?>"><?= $phone_service ?></a></p>
					<p class="contacts__text">Эл. почта: <a class="contacts__mail" href="mailto:<?= $email_service ?>"><?= $email_service ?></a></p>
				</div>
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
			<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A2d4165812b983c9d4dbc52cbc6907cdaaaaa8741428882e9b3ae34dd5d0f76a4&amp;width=860&amp;height=535&amp;lang=ru_RU&amp;scroll=true"></script>
			</div>
		</div>
	</div>
</section>