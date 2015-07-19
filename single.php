<?php 
/**
 * The Template for displaying all single posts.
 */

get_header(); ?>

<?php global $advertica_shortname; ?>
<div class="main-wrapper-item">
<?php if(have_posts()) : ?>
<?php while(have_posts()) : the_post(); ?>
	<div class="bread-title-holder">
		<div class="bread-title-bg-image full-bg-breadimage-fixed"></div>
		<div class="container">
			<div class="row-fluid">
				<div class="container_inner clearfix">
					<h1 class="title"><?php the_title(); ?></h1>
					<?php  if(sketch_get_option($advertica_shortname."_hide_bread") == 'true') {
						if ((class_exists('advertica_breadcrumb_class'))) {$advertica_breadcumb->custom_breadcrumb();}
					}
					?>
				</div>
			</div>
		</div>
	</div>

<div class="container post-wrap">
	<div class="row-fluid">
		<div id="container" class="span8">
			<div id="content">  
					<div class="post" id="post-<?php the_ID(); ?>">
				
						<?php //if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
<!-- 						<div class="featured-image-shadow-box"> -->
							<?php //the_post_thumbnail('full'); ?>
<!-- 						</div> -->
						<?php //} ?>

<!-- 						<div class="bread-title"> -->
<!-- 							<h2 class="title"> -->
								<?php //the_title(); ?>
<!-- 							</h2> -->
<!-- 							<div class="clearfix"></div> -->
<!-- 						</div> -->

						<div class="skepost clearfix">
							<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'advertica-lite' ) ); ?>
							<?php wp_link_pages(__('<p><strong>Pages:</strong> ','advertica-lite'), '</p>', __('number','advertica-lite')); ?>
						</div>
						<!-- skepost -->

                        <div class="skepost-meta clearfix">
                            <span class="date"><?php _e('On','advertica-lite');?> <?php the_time('F j, Y') ?></span><?php _e(',','advertica-lite');?>
<!--                             <span class="author-name"><?php //_e('Posted by ','advertica-lite'); the_author_posts_link(); ?> </span><?php //_e(',','advertica-lite');?> -->
                            <?php if (has_category()) { ?><span class="category"><?php _e('Category ','advertica-lite');?><?php the_category(','); ?></span><?php _e(',','advertica-lite');?><?php } ?>
                            <?php the_tags('<span class="tags">Tags ',', ','</span>'); ?>
<!--                             <span class="comments"><?php //_e('With ','advertica-lite');?><?php //comments_popup_link(__('No Comments ','advertica-lite'), __('1 Comment ','advertica-lite'), __('% Comments ','advertica-lite')) ; ?></span> -->
                        </div>
                        <!-- skepost-meta -->

						<div class="navigation"> 
							<span class="nav-previous"><?php previous_post_link( __('&larr; %link','advertica-lite')); ?></span>
							<span class="nav-next"><?php next_post_link( __('%link &rarr;','advertica-lite')); ?></span> 
						</div>
						<div class="clearfix"></div>
						<div class="comments-template">
							<?php comments_template( '', true ); ?>
						</div>
					</div>
				<!-- post -->
				<?php endwhile; ?>
				<?php else :  ?>

				<div class="post">
					<h2><?php _e('Post Does Not Exist','advertica-lite'); ?></h2>
				</div>
				<?php endif; ?>
			</div><!-- content --> 
		</div><!-- container --> 

		<!-- Sidebar -->
		<div id="sidebar" class="span3">
			<?php get_sidebar(); ?>
		</div>
		<!-- Sidebar --> 

	</div>
 </div>
</div>
<?php get_footer(); ?>
