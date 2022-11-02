<?php
$product = wc_get_product( get_the_ID() );
$attributes = $product->get_attributes();
$comments = get_comments(array (
	'post_type' => 'product', 
	'post_id' => get_the_ID(),
	'status' => "approve",
	'number' => ''
));

if(!$attributes && !$comments) {
	return;
}
?>

<section class="product__tabs">
	<div class="tabs" data-tabs="productTabs">
		<ul class="tabs__nav list-reset">
			<?php if($attributes): ?>
				<li class="tabs__nav-item"><button class="tabs__nav-btn btn-reset" type="button">Характеристики</button></li>
			<?php endif; ?>

			<?php if($comments): ?>
				<li class="tabs__nav-item"><button class="tabs__nav-btn btn-reset" type="button">Отзывы</button></li>
			<?php endif; ?>
		</ul>
		<div class="tabs__content">
			<?php if($attributes): ?>
				<div class="tabs__panel">
					<div class="product__characteristic characteristic-grid">
						<?php foreach($attributes as $attribute): ?>
							<?php $attr_str = $product->get_attribute($attribute->get_name()) ?>
							<div class="characteristic-grid__item">
								<div class="characteristic-grid__item-title"><?= wc_attribute_label($attribute->get_name()) ?></div>
								<div class="characteristic-grid__item-value"><?= $attr_str ?></div>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php if($comments): ?>
				<div class="tabs__panel">
					<div class="product__reviews">
						<?php foreach($comments as $comment): ?>
							<article class="product-review">
								<div class="product-review__header">
									<?php if(get_comment_meta( $comment->comment_ID, 'rating', true)): ?>
									<div class="product-review__rate">
										Рейтинг:
										<div class="product-card__rating"
											style="<?php echo '--rating-width: '. ( (get_comment_meta( $comment->comment_ID, 'rating', true)) / 5 ) * 100 . '%' ?>">
										</div>
									</div>
									<?php endif; ?>
									<div class="product-review__author"><?= $comment->comment_author ?></div>
								</div>
								<div class="product-review__content">
									<div class="product-review__content-item">
										<div class="product-review__content-title">Комментарий</div>
										<div class="product-review__content-value"><?= $comment->comment_content ?></div>
									</div>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>