<?php

/**
 * @package WordPress
 * @subpackage Gentle
 */

get_header(); ?>

<?php 
global $post_type;
global $post;

$sidebar_position = '';

$mp_option = gentle_get_global_options();
$post_type = $post->post_type;

$sidebar_position = $mp_option['gentle_single_sidebar'];

if($post_type == 'portfolio'){
	$sidebar_position = $sidebar_position['radio_sb_portfolio'];
} else {
	$sidebar_position = $sidebar_position['radio_sb_blog'];
}

if($sidebar_position == '')
	$sidebar_position = 'right';

?>



<div id="mpc-content" role="main">
	<div id="mpc-page-wrap" class="sidebar-<?php echo $sidebar_position; ?>">
		<div id="mpc-page-content"  class="gentle-single-page gentle-single-<?php echo $post_type; ?> sidebar-<?php echo $sidebar_position; ?>">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) {
					the_post(); 

					$post_meta = '';
					$post_meta = get_post_custom($post->ID);

					/* Get post data */
					if(isset($post_meta['post_shortcode'][0]))
						$page_data['sh'] = $post_meta['post_shortcode'][0];
	        	 	
	        	 	/* lightbox parameters */
	        	 	if(isset($post_meta['lightbox_enable'][0]))
        	 			$page_data['lb'] = $post_meta['lightbox_enable'][0];

        	 		if(isset($post_meta['caption'][0]))
        	 			$page_data['lb_caption'] = $post_meta['caption'][0];

        	 		if(isset($post_meta['lightbox_src'][0]))
        	 			$page_data['lb_src'] = $post_meta['lightbox_src'][0];

					?>
					<article id="post-<?php the_ID(); ?>" class="post">
						<div class="mpc-post-thumbnail">	
							<?php if(isset($page_data['sh']) && $page_data['sh'] != '') { 
								$sh = $page_data['sh'];
								$search = substr($sh, 0, 1);

								if($search == '[') 
									echo do_shortcode($sh);
								else
									echo $sh;
							} ?>
						</div><!-- end post-thumbnail -->
				
						<h3 class="mpc-page-title"><?php the_title(); ?></h3>
						<small>
						<?php the_time('M d Y');?>

						<?php if($post_type == 'post') {
							echo '&middot;&nbsp;';
						comments_number('0 comments','1 comment','% comments');
						}?>

						<?php if($post_type == 'post') {
							echo '&middot;&nbsp;';
							the_category(', ');
						} else {
							echo '&middot;';
							$categories = get_the_terms(get_the_ID(), 'portfolio_cat');
							$length = count($categories);
							$i = 0;
							$return = ' ';

							foreach($categories as $category) {
								$return .= ' <a href="'.get_term_link($category->slug, 'portfolio_cat').'">';
								$return .= $category->name;
								$return .= '</a>';	
								if($i != $length - 1)
									$return .=', ';	
									
								$i++;
							}
							echo $return.' ';

						}?>
						
						
						<?php  if( function_exists('zilla_likes') ) {
							echo '&middot;';
							zilla_likes(); 
						}?>
						</small>
						<p class="mpc-post-content">
							<?php the_content(); ?>
						</p>

						<?php if(function_exists('zilla_share')) { ?>
							<div class="mpc-genlte-post-share-wrap">
								<span class="mpc-genlte-post-share"><span class="gentle-icon-share"></span></span>
								<?php zilla_share(); ?>	
							</div>
						<?php } ?>
					</article><!-- post -->

				<!-- If show related posts -->
				<div id="gentle_tags">
					 <?php 
					 _e('Tags: ', 'gentle');
					 the_tags('', ', ', '.'); ?>
				</div>
				
				<div class="gentle-related-posts">
					<?php if($post_type == 'portfolio' && $mp_option[$shortname.'_related_portfolio'] == "1") { ?> 
						<h3><? //php _e('Related Projects', 'gentle');?></h3>
						<?php 
						
						$postID = $post->ID;
						echo do_shortcode('[mpc_recent_portfolio number="6" post="'.$postID.'"]'); ?>
					<?php } else if($post_type != 'portfolio' && $mp_option[$shortname.'_related_posts'] == "1") { ?>
						<h3><?php _e('Related Posts', 'gentle'); ?></h3>
						<?php 
						
						$postID = $post->ID;
						echo do_shortcode('[mpc_recent_posts number="6" post="'.$postID.'"]'); ?>
					<?php } ?>
				</div>

				
				
				<?php if($post_type == "post") {?>
					<div class="post-comments">
						<?php comments_template('', true); ?>
					</div><!-- post_comments -->
				<?php } ?>
				
				<?php } ?>

			<?php } ?>
	
		</div>	<!-- end mpc-page-content-->	
		<?php if($sidebar_position != "none") 
			get_sidebar(); ?>	
	</div>  <!-- end mpc-page-wrap -->

</div><!-- end mpc-content --> 

<?php get_footer(); ?>