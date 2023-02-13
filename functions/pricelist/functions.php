<?php
function filter_products() {
	global $post;
    $post_id = $_POST['post_id']; // Associative array of taxonomy=>taxonomy term slugs passed from the Ajax call
    // Default arguments array
    $args = array(
        'post_type' => 'models',
		'include' => $post_id
    );

    $ajaxposts = get_posts($args);
    $response = ""; // Initialize empty response string

    if ($ajaxposts) {
		ob_start(); // Start the buffer
        foreach($ajaxposts as $post) {
			setup_postdata($post); ?>
			<?php $item_works = get_field('pricelist_item') ?>
			<?php if($item_works): ?>
				<?php foreach($item_works as $item): ?>
					<div class="work-list__item">
						<img loading="lazy" src="<?= wp_get_attachment_url($item['icon']) ?>" class="work-list__icon" width="62" height="62" alt="">
						<h3 class="work-list__title"><?= $item['name'] ?></h3>
						<div class="work-list__price"><?= $item['cost'] ?>Р.</div>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="work-list__item">
					Ничего не найдено :(
				</div>
			<?php endif; ?>
			<?php
        }
        $response = ob_get_contents(); // Add the buffer contents to $response
        ob_end_clean(); // Clear the buffer
    } else {
        $response = "No products found.";
    }

    echo json_encode($response); // Echo the response
    wp_reset_postdata();
    exit; // this is required to terminate immediately and return a proper response
  }

add_action('wp_ajax_filter_model', 'filter_products');
add_action('wp_ajax_nopriv_filter_model', 'filter_products');
  
function search_model() {
	global $post;
	$search = $_POST['search_value'];
    $args = array(
        'post_type' => 'models',
		's' => $search
    );

    $ajaxposts = get_posts($args);
    $response = ""; // Initialize empty response string

    if ($ajaxposts) {
		ob_start(); // Start the buffer
        foreach($ajaxposts as $post) {
			setup_postdata($post); ?>
			<div class="pricelist__item" data-post-id="<?= get_the_ID() ?>"><?php the_title(); ?></div>
			<?php
        }
        $response = ob_get_contents(); // Add the buffer contents to $response
        ob_end_clean(); // Clear the buffer
    } else {
        $response = "Ничего не найдено";
    }

    echo json_encode($response); // Echo the response
    wp_reset_postdata();
    exit; // this is required to terminate immediately and return a proper response
  }

  add_action('wp_ajax_search_model', 'search_model');
  add_action('wp_ajax_nopriv_search_model', 'search_model');

function model_list() {
	global $post;
	$term_name = $_POST['term_name'];
    $args = [
		'post_type' => 'models',
		'numberposts' => -1,
		'tax_query' => array(
			array(
				'taxonomy' => 'model_type',
				'field'    => 'slug',
				'terms'    => $term_name
			)
		)
	];

    $ajaxposts = get_posts($args);
    $response = ""; // Initialize empty response string

    if ($ajaxposts) {
		ob_start(); // Start the buffer
        foreach($ajaxposts as $post) {
			setup_postdata($post); ?>
			<div class="pricelist__item" data-post-id="<?= get_the_ID() ?>"><?php the_title(); ?></div>
			<?php
        }
        $response = ob_get_contents(); // Add the buffer contents to $response
        ob_end_clean(); // Clear the buffer
    } else {
        $response = "Ничего не найдено";
    }

    echo json_encode($response); // Echo the response
    wp_reset_postdata();
    exit; // this is required to terminate immediately and return a proper response
  }

  add_action('wp_ajax_model_list', 'model_list');
  add_action('wp_ajax_nopriv_model_list', 'model_list');