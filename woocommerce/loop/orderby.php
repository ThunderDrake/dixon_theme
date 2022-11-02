<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if(isset($_SESSION['sorting']))
{
	$current_sorting = $_SESSION['sorting'];
}
else
{
	$current_sorting = array(
		'orderby' => apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby', 'popularity' ) ),
		'order' => 'DESC'
	);
}
$sl = array(
	'popularity' => array(
		'name' => 'популярности',
		'active' => false,
		'direction' => 'asc',
		'class' => 'asc',
	),
	'price' => array(
		'name' => 'цене',
		'active' => false,
		'direction' => 'asc',
		'class' => 'asc',
	),
	'date' => array(
		'name' => 'новизне',
		'active' => false,
		'direction' => 'asc',
		'class' => 'asc',
	),
);

switch ($current_sorting['orderby']) {
	case 'popularity':
		$sl['popularity']['active'] = true;
		$sl['popularity']['direction'] = ($current_sorting['order'] == 'ASC') ? 'desc' : 'asc';
		$sl['popularity']['class'] = ($current_sorting['order'] == 'ASC') ? 'asc' : 'desc';
		break;
	case 'price':
		$sl['price']['active'] = true;
		$sl['price']['direction'] = ($current_sorting['order'] == 'ASC') ? 'desc' : 'asc';
		$sl['price']['class'] = ($current_sorting['order'] == 'ASC') ? 'asc' : 'desc';
		break;
	case 'date':
		$sl['date']['active'] = true;
		$sl['date']['direction'] = ($current_sorting['order'] == 'ASC') ? 'desc' : 'asc';
		$sl['date']['class'] = ($current_sorting['order'] == 'ASC') ? 'asc' : 'desc';
		break;
}

?>
<div class="items-grid-controls-ordering">
	<div class="ordering-label">Сортировать по:</div>
	<?php
	foreach ($sl as $key => $params)
	{
		$query = '?'.http_build_query( array_merge( $_GET, array('sorting' => $key.'_'.$params['direction']) ) );
	?>
	<a class="ordering-by <?=$params['class']?><?=($params['active'] ? ' active' : '')?>" href="<?=$query?>"><?=$params['name']?></a>
	<?php
	}
	?>
</div>
