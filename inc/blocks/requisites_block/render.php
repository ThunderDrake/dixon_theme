<?php if($label or $requisites or $file) { ?>
<div class="requisites-block">
	<?php if($label) { ?>
	<div class="requisites-label"><?=$label?></div>
	<?php } ?>
	<?php if($requisites) { ?>
	<div class="requisites-content"><?=$requisites?></div>
	<?php } ?>
	<?php if($file) { ?>
	<a class="requisites-download" href="<?=$file?>" download>Скачать реквизиты</a>
	<?php } ?>
</div>
<?php } ?>