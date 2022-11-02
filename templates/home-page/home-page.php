<?php 
/**
 * The template for displaying the homepage.
 *
 * @package dixon_theme
 */
get_header(); 
?>

<main class="main">
	<?php ct()->template( '/home-page/parts/home-page__hero.php' ) ?>
	<?php ct()->template( '/home-page/parts/home-page__advantages.php' ) ?>
	<?php ct()->template( '/home-page/parts/home-page__bestsellers.php' ) ?>
	<?php ct()->template( '/home-page/parts/home-page__recently.php' ) ?>
	<?php ct()->template( '/home-page/parts/home-page__callback.php' ) ?>
	<?php ct()->template( '/home-page/parts/home-page__contacts.php' ) ?>
</main>
<?php get_footer(); ?>