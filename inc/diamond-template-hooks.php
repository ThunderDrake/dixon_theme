<?php
/**
 * Diamond hooks
 *
 * @package diamond
 */

// add_filter('render_block', 'wrap_classic_editor', 9999 , 2);
add_filter('use_block_editor_for_post_type', 'diamond_disable_gutenberg', 10, 2);