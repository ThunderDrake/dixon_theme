<?php 
/**
 * Template Name: Debug
 *
 * @package diamond_sky
 */

function rcinline($taxonomy,$depth=0,$return)
{
	$return[] = $taxonomy;
	$taxonomy->depth = $depth;
	if(count($taxonomy->childs)>0)
	{
		foreach($taxonomy->childs as $child)
		{
			$return = rcinline($child,$depth+1,$return);
		}
	}
	return $return;
}


global $GS;
$args = array(
  'hierarchical' => true,
  'taxonomy'     => 'product_cat',
  'hide_empty'   => false,
  'menu_order'   => 'asc',
);
$raw_taxonomies = $GS->get_cat_tree($args);
$taxonomies = array();
if($raw_taxonomies)
{
	foreach($raw_taxonomies as $taxonomy)
	{
		$taxonomies = rcinline($taxonomy,0,$taxonomies);
	}
}
echo "<pre>";
echo "{\n";
foreach($taxonomies as $tax)
{
	echo "\t".$tax->term_id.": '".str_repeat('— ',$tax->depth).$tax->name."',\n";
}
echo "}";
echo "</pre>";
?>