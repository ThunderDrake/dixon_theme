<?php
/*
 * Template Name: Оформление заказа
 */
global $GS;
$FS_path = $GS->theme.'/assets/js/checkout.js';
$URL_path = $GS->theme_uri.'/assets/js/checkout.js';
$version = $GS->asset_version($FS_path, 'js');
wp_enqueue_script('checkout',$URL_path,array('jquery'),$version);

get_header();
?>
<main id="main" class="base-page checkout-page">
	<div class="wrapper">
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<?php
					the_post();
					the_content();
				?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
?>