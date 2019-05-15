
<?php

/**
 * Template Name: Home Template
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();

$container = get_theme_mod( 'understrap_container_type' );

?>


	<div class="container-fluid p-0" id="content" tabindex="-1">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/main-header' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'home' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->


</div><!-- #page-wrapper -->

<?php get_footer(); ?>
