<?php
	
/**
* Home
*
* Template Name: Home
* @package WordPress
* @subpackage Gentle
*/	
	
	
get_header();

global $page_id;
$page_id = get_the_ID();
$mp_option = gentle_get_global_options();

$sidebar_position = '';

if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
}

if($sidebar_position == '')
	$sidebar_position = 'right';


$post_values = get_post_custom($page_id);
if( isset($post_values['home_sc'][0]) )
	$sc = $post_values['home_sc'][0];
else
	$sc = '';

$search = substr($sc, 0, 1);
?>

<div id="mpc-content" role="main">
	<div id="mpc-slider-shortcode">
		<?php if($search == '[') 
			echo do_shortcode($sc);
		else
			echo $sc; ?>
	</div>
	<div id="mpc-page-wrap">
		<div id="mpc-page-content" class="sidebar-<?php echo $sidebar_position; ?>">
			<?php if(have_posts()){
				while(have_posts()){
					the_post(); ?>
		      			<?php the_content('', TRUE, ''); ?>
		      			<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>
		      				<a href="<?php the_permalink();?>" class="mpc-more-link">read more</a>
		      			<?php } ?>
		    	<?php } ?>
		    	<div id="post_navigation">
		     	 <?php previous_posts_link(); ?>
		     	 <?php next_posts_link(); ?>
		    	</div> <!-- end post_navigation -->
		    <?php } else { ?>
		    	<article id="post-0" class="post no-results not-found">
					<header class="entry-header search-result">
						<h3 class="entry-title"><?php _e( 'Nothing Found', 'gentle' ); ?></h3>
					</header><!-- .entry-header -->
		
					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'gentle' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
		    <?php } ?>
		    <?php wp_link_pages(); ?>

		    <!-- Sidebar -->
		</div><!-- end page-content -->

	<?php 
	    if($sidebar_position != 'none')
		    get_sidebar(); ?>
	</div> <!-- page wrap -->
</div> <!-- end mpc-content -->

<?php get_footer(); ?>