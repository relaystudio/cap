<?php
	
/**
* Index Default Blog Page
*/	
	
	
get_header();
global $more;
global $query;

$mp_option = gentle_get_global_options();
$page_id =$wp_query->get_queried_object_id();
	
$post_values = get_post_custom($page_id);
if( isset($post_values['blog_type'][0]) )
	$blogType = $post_values['blog_type'][0];
else
	$blogType['blog_type'] = '';


$sidebar_position = '';

if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
}

if($sidebar_position == '')
	$sidebar_position = 'right';
	
$postNumber = 0;

if($blogType == 'masonry' || $blogType == 'stacked')
	$blogWidth = 'full';
else
	$blogWidth = '';

?>

<?php

if(isset($mp_option['gentle_portfolio']) && isset($mp_option['gentle_portfolio']['category_portfolio_' .$page_id])) {
	foreach($mp_option['gentle_portfolio']['category_portfolio_' .$page_id] as $key => $option) {
		$port_categories .= $key . ', ';
	}
}

$categories = '';
$categories .= '<div class="mpc-portfolio-categories"><ul>'; 
$categories .= '<li class="active" data-link="post"><a href="">All</a><span class="mpc-gentle-deco"></span></li>';

if(isset($mp_option['gentle_portfolio']['category_portfolio_' .$page_id])) {
	foreach($mp_option['gentle_portfolio']['category_portfolio_' .$page_id] as $key => $option){ 
		$categories .= '<li data-link="'.$key.'">';
		$categories .= 	'<a href="" title="'.$key.'">'.$option.'</a>';
		$categories .= 	'<span class="mpc-gentle-deco"></span>';
		$categories .= '</li>';
	}		
}

$categories .= '</ul></div>';  



$post_values = get_post_custom($page_id);
if( isset($post_values['portfolio_type'][0]) )
	$portfolioType = $post_values['portfolio_type'][0];
else
	$portfolioType = '';


$sidebar_position = '';

if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
}

if($sidebar_position == '')
	$sidebar_position = 'right';
	
$postNumber = 0;

if($portfolioType == 'masonry' || $portfolioType == 'stacked')
	$portfolioWidth = 'full';


if( isset($post_values['home_sc'][0]) )
	$sc = $post_values['home_sc'][0];
else
	$sc = '';

?>


<script>
// mpc-page-content
	jQuery(document).ready(function($) {
		if( '<?php echo $blogType ?>' == 'stacked' ||  '<?php echo $blogType ?>' == 'masonry') {
			var $container = $('#mpc-page-content'),
				externalMargin = 10,
				cwidth = $container.width(),
				maxColWidth = 500,
				minColWidth = 275,
				colNum = 0,
				colWidth = 0,
				blogType = '<?php echo $blogType; ?>';



			function window_resize () {
				$('#mpc-page-wrap.full #mpc-page-content.blog.sidebar-right')
					.css( { 'width': $(window).width() - 328 });
				$('#mpc-page-wrap.full #mpc-page-content.blog.sidebar-left')
				 	.css( { 'width': $(window).width() - 313 });

				$('#mpc-page-wrap.full #mpc-page-content.blog.stacked.sidebar-right')
					.css( { 'width': $(window).width() - 309 });
				$('#mpc-page-wrap.full #mpc-page-content.blog.stacked.sidebar-left')
					.css( { 'width': $(window).width() - 306 });
			}

			function column_width () {
			
				cwidth = $container.outerWidth();
			
				if(cwidth < 650) {
					colNum = 1;
				} else {
					colNum = 0;
					for (var i = 10; i > 0; i--) {
						if(cwidth / i < maxColWidth && cwidth / i > minColWidth) {
							colNum = i;
						}
					}
				}
			
				if(blogType == 'stacked')
					colWidth = Math.floor(cwidth / colNum) - 2;
				else
					colWidth = Math.floor((cwidth - 20) / colNum) - ( externalMargin * 2 ) - 2;

				$('#mpc-page-content .post').each(function () {
					var $this = $(this);
					$this.css( { 'width' : colWidth + 'px' } );
				});

				var dif = cwidth - (colNum * colWidth) - colNum * 2;
				if(blogType == 'stacked') {
					$('#gentle-aside.sidebar-left, #gentle-aside.sidebar-right').css({
						'width' : $(window).width() - cwidth - 53 + dif/*- (colNum * (colWidth)) - 53 - (colNum * 2) */
					});

					$('#mpc-page-wrap.full.sidebar-left #mpc-page-content, #mpc-page-wrap.full.sidebar-right #mpc-page-content').css({
						'width' : cwidth - dif
					});
				}
			}
 
			window_resize();
			column_width();	

			$container.imagesLoaded( function() {
			    $container.isotope({
			    	resizable: false,
			    	animationEngine: 'best-available',
			    	masonry: { columnWidth: 1 }
			    });
			});

		    $(window).resize(function(){
		    	window_resize();
		    	column_width();

		 		$container.isotope({ masonry: { columnWidth: 1 } });
			});
		} else {
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
		}
	});
</script>

<div id="mpc-content" role="main">
	<div id="mpc-page-wrap" class="<?php echo $blogWidth; ?> sidebar-<?php echo $sidebar_position; ?> <?php echo $blogType; ?>">
			<div id="mpc-slider-shortcode">
		
			<?php show_header("header"); ?>
	</div>
		<div id="main-about">
<?php show_post("about"); ?>
</div>

		<? // PORTFOLIOS ?>

	<div id="mpc-page-content"  class="projectContent blog sidebar-<?php echo $sidebar_position; ?> <?php echo $blogType; ?>" style="border-right: 1px solid #DDD; margin-right: 3%;">
		<h3>Projects</h3>
		<?php
			wp_reset_query();
			global $more;
			$more = 0;
			$my_query = $wp_query;
			$wp_query = null;
			$wp_query = new WP_Query();
			$wp_query->query(array(
					'post_type' => 'portfolio',
					//'portfolio_cat' => $port_categories,
					'paged' => $paged,
					'showposts' => ''
				));

			$counter = 0;
			$row_counter = 0;
			
			while ($wp_query->have_posts()) {
				$wp_query->the_post();
				$counter++; 
				$row_counter++;
				$post_meta = get_post_custom($post->ID);					

				$categories = get_the_terms($post->ID, 'portfolio_cat');
				if(isset($categories) && $categories != ''){
					$category_slug = '';
					foreach($categories as $category) {
						$category_slug .= $category->slug.' '; 
					}
				}

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
	        	 	
	        	 	<div id="post-<?php the_ID(); ?>"  class="portfolio-item post item-<?php echo $counter; ?> <?php echo $category_slug; ?>" data-type="<?php echo $category_slug; ?>">

	        	 		<div class="mpc-post-thumbnail">
	        	 			<!-- Insert LightBox -->
	        	 			<?php 
	        	 			
	        	 			if(isset($page_data['lb']) && $page_data['lb'] != 'off' ) {
		        	 			mpc_gentle_add_lightbox($page_data); 
		        	 			?>
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
							<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M d Y');?></a>
						
						<?php  if(function_exists('zilla_likes')) {
							
							echo ' &middot';
							zilla_likes(); 
						}?>
						</small>   

	      			<span class="gentle-deco-line"></span>
	    			</div><!-- end blog-post -->
	    		<?php } ?>
	    	
	    </div>	<!-- end mpc-page-content-->
	    <?php do_action('mpc_post_loop', $wp_query); ?>




		<?php // THIS IS WHERE THE BLOG BIZ IS ?>
<div id="mpc-page-content"  class="projectContent blog sidebar-<?php echo $sidebar_position; ?> <?php echo $blogType; ?>" style="clear:right;">

<h3 style="width: 70%; float: left">Blog Posts</h3>
<div id="blogFeedPost" style="width: 30%"><a href="<?php bloginfo('rss2_url'); ?>">Subscribe via RSS</a></div>
		
				<?php 
			
			$blog_category = get_option('gentle_blog_category');
			global $query;
			$query = new WP_Query('post_type=post&category_name='.$blog_category.'&paged=' . $paged);

			

	        if ( $query->have_posts()) {
	        	 while ( $query->have_posts() ) {
	        	 	$query->the_post();
	        	 	
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
	        	 	
	        	 	<div id="post-<?php the_ID(); ?>"  <?php post_class('blog-post'); ?> >

	        	 		<?php if($blogType == "blog3" || $blogType == "blog4") { ?>
	        	 			<h4 class="mpc-page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
							</a></h4>
							<small>
								<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M d Y');?></a>
							&middot;
							<?php comments_number('0 comments','1 comment','% comments'); ?>
							&middot;
							<?php the_category(', '); ?>
							
							<?php  if( function_exists('zilla_likes') ){ 
								echo '&middot;';
								zilla_likes(); 
							} ?>
							</small>
	        	 		<?php } ?>

	        	 		<div class="mpc-post-thumbnail">
	        	 			<!-- Insert LightBox -->
	        	 			<?php 
	        	 			
	        	 			if(isset($page_data['lb']) && $page_data['lb'] != 'off' ) {
		        	 			mpc_gentle_add_lightbox($page_data); 
		        	 			?>
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
			        	 		if(($blogType == "blog2" && $sidebar_position == 'none') || ($blogType == "blog3" && $sidebar_position == 'none') || ($blogType == "blog4" && $sidebar_position == 'none'))
									the_post_thumbnail('blog_classic'); 
								elseif($blogType == "blog2" || $blogType == "blog3" || $blogType == "blog4")
									the_post_thumbnail('blog_classic_small'); 
								elseif($blogType == "blog5" && $sidebar_position == "none")
									the_post_thumbnail('blog_classic_square'); 
								elseif($blogType == "blog5")
									the_post_thumbnail('blog_classic_square_small'); 
								else
									the_post_thumbnail(); 
							} ?>
	        	 		</div>
	        	 		
		        	 	<h4 class="mpc-page-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a></h4>
						<small>
							<a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>"><?php the_time('M d Y');?></a>
						
						<?php  if(function_exists('zilla_likes')) {
							
							echo ' &middot';
							zilla_likes(); 
						}?>
						</small>   
	        	 	

	                
	      			<?php //the_content('', TRUE, ''); ?>
	      		
	      			<!-- Read More -->
	               	<a href="<?php the_permalink();?>" class="mpc-read-more" title="Read More">
	               		<span class="plus gentle-icon-right-open"></span>
	               	</a>
	               	
	      			
	      			<span class="gentle-deco-line"></span>
	    			</div><!-- end blog-post -->
	    		<?php } ?>

	   		 <?php } ?>

	    	
	    </div>	<!-- end mpc-page-content-->
	    

	    <div id="mpc-gentle-nav">
	    	<div class="mpc-next-page"><?php next_posts_link(); ?></div>
			<div class="mpc-previous-page"><?php previous_posts_link(); ?></div>
    	</div>
	</div>  <!-- end mpc-page-wrap -->
	<div id="gentle-load-more">
			<span id="gentle-lm-button"><?php _e('Load More', 'gentle'); ?></span>
	    	<span id="gentle-lm-info"></span>
	    	
	</div>
</div><!-- end mpc-content --> 

<?php get_footer(); ?>