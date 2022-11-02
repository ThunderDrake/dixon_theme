<?php
$addclass = isset($addclass) ? $addclass : '';
$mode = get_field('mode',$id);
$sizes = get_field('sizes',$id);
$duration = get_field('duration',$id);
$duration = floatval($duration)*1000;
$delay = get_field('delay',$id);
$delay = floatval($delay)*1000;
$slides = get_field('slides',$id);


$slides_count = count($slides);
if($slides_count > 0)
{
	global $GS;

	wp_enqueue_script('swiper', $GS->theme_uri.'/assets/js/swiper.js', array('jquery'));
	wp_enqueue_style('swiper', $GS->theme_uri.'/assets/css/addons/swiper.css', array());

	$slider_id = $GS->random_str(10,'abcdefghijklmnoprstuvwxyz');
	$size = [$sizes['width'],$sizes['height']];
?>
<div class="slider-holder">
	<div id="slider-<?=$slider_id?>" class="swiper-container <?=$addclass?>">
		<div class="swiper-wrapper">
			<?php foreach ($slides as $slide) { ?>
			<div class="swiper-slide">
				<div class="image">
					<?=get_image($slide['image'],$size,true)?>
				</div>
				<div class="content">
					<div class="halcircle"></div>
					<div class="text"><?=$slide['text']?></div>
					<?php if($button = get_button($slide)) { ?>
					<div class="button"><?=$button?></div>
					<?php } ?>
				</div>
			</div>
			<?php }	?>
		</div>
	</div>
	<?php #if($slides_count > 1) { ?>
	<button type="button" class="swiper-button-prev"></button>
	<button type="button" class="swiper-button-next"></button>
	<?php #} ?>
</div>
<?php
$script = "
if(typeof window['activeSliders'] != 'object'){window['activeSliders'] = {};}
window.addEventListener('load',function(){window.activeSliders['{$slider_id}'] = new Swiper('#slider-{$slider_id}',{$slider_id}_params)});
var {$slider_id}_slider_h = $('#slider-{$slider_id}').parent('.slider-holder');
var {$slider_id}_params = {
	loop: true,
	speed: 500,
	effect: '{$mode}',";
if($delay > 0)
{
	$script .= "
	autoplay:{
		delay:{$delay},
		disableOnInteraction:false
	},"; }
if($mode == 'cube')
{
	$script .= "
	cubeEffect:{
		shadow:false
	},";
}
	$script .= "
	spaceBetween: 0,
	roundLengths: true,
	watchOverflow: true,
	slidesPerView: 'auto',
	preventInteractionOnTransition: true,
	navigation: {
		nextEl: {$slider_id}_slider_h.find('.swiper-button-next'),
		prevEl: {$slider_id}_slider_h.find('.swiper-button-prev')
	}
};
";
	wp_add_inline_script('swiper',$script,'after');
} # if($slides_count > 0)
?>
