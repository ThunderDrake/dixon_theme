<?php
the_post();
get_header();
?>
<main id="main" class="base-page">
	<div class="wrapper">
		<div class="row main-row">
			<div class="content-holder col-xs-12">
				<div class="white-holder">
					<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
					<?php the_content() ?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php get_footer(); ?>