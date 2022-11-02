<?php if(!defined('ABSPATH')){ exit; } ?>
<?php
if(wc_get_loop_prop('additional_title', false) and wc_get_loop_prop('total'))
{
?>
<div class="page-title">Товары из этой категории</div>
<?php
}
?>
<div class="items-grid row">