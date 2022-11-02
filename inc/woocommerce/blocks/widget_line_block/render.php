<?php
if(is_active_sidebar('widget-line'))
{
?>
<div class="widget-line">
	<div class="wrapper">
		<div class="row"><?php dynamic_sidebar('widget-line'); ?></div>
	</div>
</div>
<?php
}
?>