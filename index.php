<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
    $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full'); 
	$featured_image = $img[0];
	
get_header();


$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="camera-banner">

		<div class="text-camera-box">
			<h1>Find your favourite camera today</h1>
		</div>
		<img class="camera-banner-image" src="<?php echo $featured_image?>">
	
</div>


<div class="container-fluid text-center">
  <div class="row">
    <div class="col-lg-12">
    <div class="portfolioFilter clearfix">
      <a style="cursor:pointer;" data-filter="*" class="current">All Cameras</a>
      <a style="cursor:pointer;" data-filter=".category-dslr">DSLR Cameras</a>
      <a style="cursor:pointer;" data-filter=".category-mirrorless">Mirrorless Cameras</a>
      <a style="cursor:pointer;" data-filter=".category-compact">Compact Cameras</a>
	  <a style="cursor:pointer;" data-filter=".category-cinema">Cinema Cameras</a>
      <a style="cursor:pointer;" data-filter=".category-speedlite">Speedlite Flashes</a>
      <a style="cursor:pointer;" data-filter=".category-accessories">Camera Accessories</a>
      <a style="cursor:pointer;" data-filter=".category-travel">Travel Cameras</a>
    </div>
      </div>
  </div>
</div>


<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero' ); ?>
<?php endif; ?>

<div class="wrapper p-0" id="index-wrapper">

			
	<?php
	$args = array( 'post_type' => 'movies');
	$loop = new WP_Query( $args );
	?>

	<div class="<?php echo esc_attr( $container ); ?> mt-5" id="content" tabindex="-1">

			<!-- Do the left sidebar check and opens the primary div -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

			<main class="site-main row" id="main">


				<?php if ( $loop->have_posts() ) : ?>

					<?php /* Start the Loop */ ?>

					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>



						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', 'cameras' );
						?>

					<?php endwhile; ?>

				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

	</div><!-- #content -->

</div><!-- #index-wrapper -->

<?php get_footer(); ?>
