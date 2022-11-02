<section class="repair">
	<div class="wrapper">
		<div class="title__holder">
			<div class="block__title">Основные неисправности</div>
		</div>		
	</div>
	<div class="wrapper_holder">
		<div class="wrapper">
			<div class="repair__block">
				<div class="phoneholder">
					<img src="<?php echo wp_get_attachment_image_url(get_field('repair_image'), 'full');?>" alt="">
				</div>
				<div class="repair__block-items">
					<?php $repair = get_field('defect'); ?>
					<?php foreach ($repair as $item => $value) { ?>
						<div class="block__item">
							<div class="item__title"><?php echo $value['item_title'];?>
							</div>
							<div class="item__list">
								<ul>
									<?php $replist = $value['item_causes']; ?>
									<?php foreach ($replist as $item => $value) { ?>
										<li><?php echo $value['item_cause']; ?></li>
									<? } ?>
								</ul>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="contactform__block">
					<div class="block__title">
						Оставить заявку на ремонт
					</div>
					<div class="block__subtitle">
						Оставьте заявку и наш менеджер пеоезвонит Вам через 15 минут!
					</div>
					<?php echo do_shortcode('[contact-form-7 id="34339" title="Оставить заявку"]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>