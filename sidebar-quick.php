<?php
	$quick = wp_nav_menu(
		array(
		'echo'           => false,
		'theme_location' => 'quick',
		'container'      => '',
		'menu_class'     => 'nav-menu swiper-wrapper',
		'items_wrap'     => '<div class="%2$s">%3$s</div>',
		'depth'          => 1,
		'fallback_cb'    => '__return_empty_string',
		'item_spacing'   => false,
		'walker'         => new QL_Menu_Walker(),
		)
	);
	if($quick)
	{
		global $GS;
		wp_enqueue_script('swiper', $GS->theme_uri.'/assets/js/swiper.js', array('jquery'));
		wp_enqueue_style('swiper', $GS->theme_uri.'/assets/css/addons/swiper.css', array());
		$random_id = 'quick_links';
?>
<div class="quick-links-row slider-holder">
	<div id="slider-<?=$random_id?>" class="swiper-container quick-links">
		<?php echo $quick; ?>
	</div>
	<button class="swiper-button-prev"></button>
	<button class="swiper-button-next"></button>
</div>
<?php
$script = "
if(typeof window['activeSliders'] != 'object'){window['activeSliders'] = {};}
window.addEventListener('load',function(){window.activeSliders['{$random_id}'] = new Swiper('#slider-{$random_id}',{$random_id}_params)});
var {$random_id}_slider_h = $('#slider-{$random_id}').parent('.slider-holder');
var {$random_id}_params = {
	loop: true,
	speed: 500,
	effect: 'slide',
	autoplay: {
		delay: 2000,
		disableOnInteraction: false
	},
	spaceBetween: 0,
	slidesPerView: 2,
	// roundLengths: true,
	watchOverflow: true,
	preventInteractionOnTransition: true,
	breakpoints: {
		320: {
			slidesPerView: 3,
		},
		480: {
			slidesPerView: 4,
		},
		768: {
			slidesPerView: 5,
		},
		991: {
			slidesPerView: 6,
		},
	},
	navigation: {
		nextEl: {$random_id}_slider_h.find('.swiper-button-next'),
		prevEl: {$random_id}_slider_h.find('.swiper-button-prev')
	}
};
";
wp_add_inline_script('swiper',$script,'after');
	}
?>