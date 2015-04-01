<?php get_header(); ?>

<?php global $advertica_shortname; ?>

<!-- FEATURED BOXES SECTION -->
<?php include("includes/front-featured-boxes-section.php"); ?>

<!-- AWESOME PARALLAX SECTION -->
<?php include("includes/front-parallax-section.php"); ?>

<!-- PAGE EDITER CONTENT -->
<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
		<div id="front-content-box" class="skt-section">
			<div class="container">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>
<?php endif; ?>


<!-- CLIENTS-LOGO SECTION -->
<?php include("includes/front-client-logo-section.php"); ?>

<?php get_footer(); ?>