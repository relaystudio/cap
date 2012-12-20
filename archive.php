<?php

/**
 *
 * Archive 
 *
 * @package WordPress
 * @subpackage Gentle
 *
 * Archive.php is a fallback for: tag.php, category.php, 
 * author.php and (month,day,year).php Instead of having 
 * multiple files we handle all of them here.
 *
 */

global $page_id;
global $post;
global $mp_option;
global $more;

$page_id = $page->ID;

get_header(); 

$mp_option = gentle_get_global_options();
$page_id = $wp_query->get_queried_object_id();

$sidebar_position = 'right';

if(get_query_var('author_name'))
	$author = get_user_by('login', get_query_var('author_name'));
else 
	$author = get_userdata(get_query_var('author'));
?>


<script>

	jQuery(document).ready(function($) {
		var $container = $('#mpc-page-content');
		$container.imagesLoaded( function() {
		    $container.isotope({
		    	resizable: false,
		    	animationEngine: 'best-available',
		    	masonry: { columnWidth: 1 }
		   });
		});

		$(window).resize(function(){
			$container.isotope({ masonry: { columnWidth: 1 } });
		});
	});

</script>

<div id="mpc-content" role="main">
	<div id="mpc-page-wrap" class="sidebar-<?php echo $sidebar_position; ?> archive">
		<h2 class="mpc-home-header left">
			<?php if (is_author()) { 
				echo $author->display_name; 		
			} elseif(is_category()) {
				single_cat_title('');
			} elseif(is_tag()) {
				single_tag_title('');
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				 _e('Archive', 'gentle');
			} elseif(is_year() || is_month() || is_day()){ 
				 _e('Archive', 'gentle');
			} elseif( is_tax() ) {
			    global $wp_query;
			    $term = $wp_query->get_queried_object();
			    $title = $term->name;
			    echo $title;
			} ?>
		</h2>
		<h4 class="mpc-home-header left">
			<?php if (is_author()) { 
				_e('posts by author', 'gentle'); 		
			} elseif(is_category()) {
				_e('posts displayed by category ', 'gentle');
			} elseif(is_tag()) {
				_e('posts displayed by tag ', 'gentle');
			} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { 
				_e('for ', 'gentle');
				the_time('F, Y'); 
			} elseif(is_year()) { 
				_e('for ', 'gentle');
				the_time('Y'); 
			} elseif(is_month()) { 
				_e('for ', 'gentle');
				the_time('F, Y'); 
			} elseif(is_day()) { 
				_e('for ', 'gentle');
				the_time('F jS, Y'); 
			} elseif( is_tax() ) {
				_e('posts displayed by category', 'gentle');
			}?>
		</h4>		
	<div id="mpc-page-content"  class="archive blog blog1 sidebar-<?php echo $sidebar_position; ?>">
		<?php while (have_posts()) {
			the_post(); 
			global $more;
			$more = 0;
        	$post_meta = '';
        	$page_data = '';
		
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
        	 	
        	 	<div id="post-<?php the_ID(); ?>"  <?php post_class('blog-post, post'); ?> >
        	 		<div class="mpc-post-thumbnail">
		        		<?php if(isset($page_data['lb']) && $page_data['lb'] != 'off' ) {
		        	 		mpc_gentle_add_lightbox($page_data); ?>
		        	 	<span class="mpc-gentle-post-hover"></span>
		        	 	<?php } ?>
			        	<?php if( isset($page_data['sh']) && $page_data['sh'] != '') { 
							$sh = $page_data['sh'];
							$search = substr($sh, 0, 1);

							if($search == '[') 
								echo do_shortcode($sh);
							else
								echo $sh;
								
						} elseif(has_post_thumbnail()) {
							the_post_thumbnail(); 
						} ?>	
                	</div>
				
					<h4 class="mpc-page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
					</a></h4>
					<small>
						<?php the_time('M d Y');?>
					
					<?php  if(function_exists('zilla_likes')) {
						echo ' &middot';
						zilla_likes(); 
					}?>
					</small>   
				<?php the_content('', TRUE, ''); ?>
      			<span class="gentle-deco-line"></span>
    			</div><!-- end blog-post -->
    		<?php } ?>
    	</div> <!-- end mpc-page-content -->
    	<?php do_action('mpc_post_loop', $wp_query); ?>
	    
	    <div id="mpc-gentle-nav">
	    	<div class="mpc-next-page"><?php next_posts_link(); ?></div>
			<div class="mpc-previous-page"><?php previous_posts_link(); ?></div>
    	</div>
    	<?php if($sidebar_position != 'none')
			get_sidebar(); ?>
	</div> <!-- end mpc-page-wrap --> 
	<div id="gentle-load-more">
			<span id="gentle-lm-button"><?php _e('Load More', 'gentle'); ?></span>
	    	<span id="gentle-lm-info"></span>	
	</div>
</div> <!-- end mpc-content --> 


<?php get_footer(); ?>