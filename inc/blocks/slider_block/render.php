<?php
$classes = get_field('classes',$id);
$mode = get_field('mode',$id);
$sizes = get_field('sizes',$id);
$duration = get_field('duration',$id);
$duration = floatval($duration)*1000;
$delay = get_field('delay',$id);
$delay = floatval($delay)*1000;
$slides = get_field('slides',$id);
$title = get_field('title', $id);

$slides_count = count($slides);
if($slides_count > 0)
{
	$slider_id = $id;
	$size = [$sizes['width'],$sizes['height']];

	$script = "
if(typeof window['activeBlocks'] != 'object'){window['activeBlocks'] = {};}
$(document).ready(function(){
	window.{$slider_id}_slider = $('#slider-{$slider_id}');
	window.{$slider_id}_slider_h = window.{$slider_id}_slider.parent('.slider-holder');
	window.{$slider_id}_params = {
		loop: true,
		spaceBetween: 0,
		roundLengths: true,
		watchOverflow: true,
		slidesPerView: '4',
		speed: {$duration},
		effect: '{$mode}',
		cubeEffect:{shadow:false,slideShadows:false},";
	if($delay > 0)
	{
		$script .= "
		autoplay:{
			delay: {$delay},
			disableOnInteraction: false
		},";
	}
	$script .= "
		loop: true,
		spaceBetween: 22,
		roundLengths: false,
		watchOverflow: true,
		slidesPerView: 'auto',
		navigation: {
			nextEl: {$slider_id}_slider_h.find('.swiper-button-next'),
			prevEl: {$slider_id}_slider_h.find('.swiper-button-prev')
		}
	};
	window.activeBlocks['{$slider_id}'] = new Swiper(window.{$slider_id}_slider,window.{$slider_id}_params);
});
";
?>
<div class="slider-block">
	<div class="wrapper">
		<div class="title-holder">
			<?php if($title) { ?>
			<div class="block-title"><?=$title?></div>
			<?php } ?>
		</div>
		<div class="slider-holder <?=$classes?>">
			<div id="slider-<?=$slider_id?>" class="swiper-container">
				<div class="swiper-wrapper">
					<?php foreach ($slides as $slide) { ?>
					<div class="swiper-slide">
						<div class="image">
							<?=get_image_lightbox($slide['image'],$size,true,$slider_id)?>
						</div>
						<?php /*
						<div class="content">
							<div class="wrapper">
								<div class="text"><?=$slide['text']?></div>
								<?php if($button = $this->_button($slide)) { ?>
								<div class="button"><?=$button?></div>
								<?php } ?>
							</div>
						</div>
						*/ ?>
					</div>
					<?php }	?>
				</div>
			</div>
			<?php #if($slides_count > 1) { ?>
	<!-- 		<div class="swiper-controls">
				<div class="wrapper">
					<button type="button" class="swiper-button-prev"></button>
					<button type="button" class="swiper-button-next"></button>
				</div>
			</div> -->
			<?php #} ?>
		</div>
	</div>
</div>
<?php
	wp_add_inline_script('swiper',$script,'after');
} # if($slides_count > 0)
?>