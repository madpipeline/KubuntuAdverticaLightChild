<?php global $advertica_shortname; ?>
<?php
if ( 'page' == get_option( 'show_on_front' ) ) {
	global $shortname; 
?>
<?php get_header(); ?>

<?php include("template-front-page.php"); ?>

<?php get_footer(); ?>
<?php 
 } else {
	include( get_home_template() );
}
 ?>