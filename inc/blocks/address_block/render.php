<?php
if(is_admin()) return;
?>
<div class="address-block">
	<div class="top-line <?php if($photo) { ?>dual<?php } ?>">
		<div class="map-side">
			<?php
				global $GS;
				$coordinates = $map;

				$lat = '';
				$lng = '';
				$zoom = 16;
				$script = '';
				$markers = array();

				if($coordinates != '')
				{
					wp_localize_script('map','yandex_api_key',@settings('yandex-key'));
					$FS_path = $GS->theme.'/assets/js/map.js';
					$URL_path = $GS->theme_uri.'/assets/js/map.js';
					$version = $GS->asset_version($FS_path, 'js');
					wp_enqueue_script('map', $URL_path, array('jquery'), $version);

					$coordinates = json_decode($coordinates,true);
					$lat = $coordinates['center_lat'];
					$lng = $coordinates['center_lng'];
					$zoom = $coordinates['zoom'];

					$markers = $coordinates['marks'];

					// if(count($markers) == 1)
					// {
					// 	$lat = $markers[0]['coords'][0];
					// 	$lng = $markers[0]['coords'][1];
					// }

					$script = "if(typeof window['MapData'] != 'object'){window['MapData'] = {};}
					window.MapData['#map-".$block_id."'] = {'type': 'yandex','zoom': '".$zoom."','center': '".$lat.",".$lng."','markers': ".json_encode($markers)."};";
					wp_add_inline_script('map',$script,'before');
			?>
			<div class="map-holder">
				<div id="map-<?=$block_id?>" class="map-object"></div>
			</div>
			<?php
				}
			?>
		</div>
		<?php if($photo) { ?>
		<div class="photo-side"><?=get_image($photo,[360,260],true)?></div>
		<?php } ?>
	</div>
	<?php if($address or $clocks or $phones or $emails) { ?>
	<div class="bottom-line">
		<?php if($address) { ?>
		<div class="line address">
			<div class="icon"></div>
			<div class="text">Мы находимся по адресу: <?=$address?></div>
		</div>
		<?php } ?>
		<?php if($clocks) { ?>
		<div class="line clocks">
			<div class="icon"></div>
			<div class="text">Наш режим работы: <?=$clocks?></div>
		</div>
		<?php } ?>
		<?php if($phones) { ?>
		<div class="line phones">
			<div class="icon"></div>
			<?php
			$str = [];
			foreach($phones as $phone)
			{
				$phone = $phone['phone'];
				$str[] = '<a href="'.f('phone',$phone).'">'.$phone.'</a>';
			}
			?>
			<div class="text">Позвоните нам: <?=implode(', ',$str)?></div>
		</div>
		<?php } ?>
		<?php if($emails) { ?>
		<div class="line emails">
			<div class="icon"></div>
			<?php
			$str = [];
			foreach($emails as $email)
			{
				$email = $email['email'];
				$str[] = '<a href="'.f('email',$email).'">'.$email.'</a>';
			}
			?>
			<div class="text">Напишите нам: <?=implode(', ',$str)?></div>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>