<?php

require 'widgets/categories.php';
require 'widgets/uni-filter/index.php';

function init_diamond_widgets()
{
    register_widget( 'categories_widget' );
    register_widget( 'universal_filter' );
}
add_action( 'widgets_init', 'init_diamond_widgets' );
 
?>