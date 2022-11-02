<?php
/**
 * Diamond query
 *
 * @package diamond
 */

function cpt_gallery_query(&$query)
{
	if(is_admin() or !$query->is_main_query()) { return; }

	if($query->is_post_type_archive('gallery'))
	{
		$query->set('posts_per_page',24);
	}
}

add_action( 'pre_get_posts', 'cpt_gallery_query', 1 );