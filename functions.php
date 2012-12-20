<?php

define('MPC_THEME_ROOT', get_template_directory_uri());

global $shortname;
global $mp_option;

$shortname = "gentle";


/* Enable the shortcodes to work in sidebar */
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Setup Theme
/*-----------------------------------------------------------------------------------*/

function gentle_setup(){
	//flush_rewrite_rules();
	
	if ( ! isset( $content_width ) ) $content_width = 960;
	/*-----------------------------------------------------------------------------------*/
	/*	Hook MPC Shortcode button & Shortcodes Source
	/*-----------------------------------------------------------------------------------*/
	
	require_once (TEMPLATEPATH . '/tinymce/tinymce-settings.php');
	require_once (TEMPLATEPATH . '/functions/theme-shortcodes.php');
	
	/*--------------------------- END Shortcodes Hook  -------------------------------- */
	
	/*-----------------------------------------------------------------------------------*/
	/*	Setup image sizes	
	/*-----------------------------------------------------------------------------------*/

	if (function_exists('add_theme_support')) {
		add_theme_support( 'automatic-feed-links');
	    add_theme_support('post-thumbnails');
	    add_image_size('recent_portfolio', 215, 215, true);
	    add_image_size('recent_post', 100, 100, true);
	    add_image_size('blog_classic_small', 649, 200, true);
	    add_image_size('blog_classic', 960, 400, true);
	    add_image_size('blog_classic_square', 350, 350, true);
	     add_image_size('blog_classic_square_small', 200, 200, true);
	    
    }
    
    require_once (TEMPLATEPATH . "/functions/theme-widgets.php");

     
}

add_action( 'after_setup_theme', 'gentle_setup' );

/*--------------------------- END Setup Theme -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Location Files / Language Files
/*-----------------------------------------------------------------------------------*/

load_theme_textdomain( 'gentle', TEMPLATEPATH.'/languages' );
 
$locale = get_locale();
$locale_file = MPC_THEME_ROOT."/languages/$locale.php";
if ( is_readable($locale_file) )
	require_once($locale_file);
	
/*-----------------------------------------------------------------------------------*/
/*	Register Menu
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  'main' => 'Main Navigation Menu',
		)
	);
}


/*-----------------------------------------------------------------------------------*/
/*	Add CSS & JS
/*-----------------------------------------------------------------------------------*/

function agera_enqueue_scripts() {
	wp_enqueue_style('mpc-reset-styles', MPC_THEME_ROOT.'/style.css');
	wp_enqueue_style('mpc-reset-styles', MPC_THEME_ROOT.'/css/reset.css');
	wp_enqueue_style('mpc-shortcodes-styles', MPC_THEME_ROOT.'/css/shortcodes-styles.css'); 
	wp_enqueue_style('mpc-widgets-styles', MPC_THEME_ROOT.'/css/widgets-styles.css');
	wp_enqueue_style('jquery-jcarousel-styles', MPC_THEME_ROOT.'/css/tango/skin.css'); 
	wp_enqueue_style('flex-slider', MPC_THEME_ROOT.'/css/flexslider.css');
	wp_enqueue_style('jquery-layerSlider', MPC_THEME_ROOT.'/css/jquery.layerSlider.css');
	wp_enqueue_style('nivo-slider', MPC_THEME_ROOT.'/css/nivo-slider.css');
	wp_enqueue_style('isotope-style', MPC_THEME_ROOT.'/css/isotope/style.css');
	wp_enqueue_style('fancybox-style', MPC_THEME_ROOT.'/css/fancybox.css');
	wp_enqueue_style('iconic-font', MPC_THEME_ROOT.'/css/font_icons.css');
	wp_enqueue_style('font-custom', 'http://fonts.googleapis.com/css?family=Open+Sans:400,300');
	


	wp_enqueue_script('custom-shortcodes', MPC_THEME_ROOT.'/js/shortcodes.js', array('jquery')); 
	wp_enqueue_script('js-functions', MPC_THEME_ROOT.'/js/functions.js', array('jquery'));
	wp_enqueue_script('jquer-layerSlider', MPC_THEME_ROOT.'/js/jQuery.layerSlider.js', array('jquery')); 
	wp_enqueue_script('nivo-slider', MPC_THEME_ROOT.'/js/jquery.nivo.slider.js', array('jquery')); 
	wp_enqueue_script('jquery-ui', 'http://code.jquery.com/ui/1.9.0/jquery-ui.js', array('jquery')); 
	wp_enqueue_script('jquery-colors', MPC_THEME_ROOT.'/js/jquery.color.js', array('jquery'));
	wp_enqueue_script('jquery-quicksand', MPC_THEME_ROOT.'/js/jquery.quicksand.js', array('jquery'));
	wp_enqueue_script('jquery-validate', MPC_THEME_ROOT.'/js/jquery.validate.min.js', array('jquery'));
	wp_enqueue_script('jquery-shadow', MPC_THEME_ROOT.'/js/jquery.shadow-animate.js', array('jquery'));
	wp_enqueue_script('jquery-carousel', MPC_THEME_ROOT.'/js/jquery.jcarousel.min.js', array('jquery'));
	wp_enqueue_script('isotope-js', MPC_THEME_ROOT.'/js/jquery.isotope.min.js', array('jquery')); 
	wp_enqueue_script('jquery-flexslider', MPC_THEME_ROOT.'/js/jquery.flexslider.js');
	wp_enqueue_script('easing-jquery', MPC_THEME_ROOT.'/js/easing-jquery.js', array('jquery'));
	wp_enqueue_script('api-twitter', 'http://widgets.twimg.com/j/2/widget.js');	
	wp_enqueue_script('fancybox-js', MPC_THEME_ROOT.'/js/jquery.fancybox.js', array('jquery'));
	wp_enqueue_script('detect-mobile', MPC_THEME_ROOT.'/js/modernizr.custom.js', array('jquery')); 
}

add_action('wp_enqueue_scripts', 'agera_enqueue_scripts');
remove_action( 'wp_head', 'rsd_link' ); 

function gentle_add_my_head() { 
	global $mp_option; 
	global $shortname; 
?>
	<meta http-equiv="Content-Type" charset="<?php bloginfo('charset'); ?>" content="<?php bloginfo('html_type'); ?>"/>
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<title>
	<?php bloginfo('name'); ?>
	<?php wp_title(); ?>
	</title>

	<link rel="shortcut icon" href="<?php echo MPC_THEME_ROOT ?>/images/favicon.ico" />
	<link href='http://fonts.googleapis.com/css?family=Quicksand:300' rel='stylesheet' type='text/css'>

	<!--[if lte IE 8 ]>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie8.css"/>
	<![endif]-->

	<!--[if lte IE 7 ]>
		<script src"http://ie7-js.googlecode.com/svn/version/2.0(beta3)/IE8.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie7.css"/>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="<?php echo MPC_THEME_ROOT ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	<!--[if IE]>
		<link rel="stylesheet" href="<?php echo MPC_THEME_ROOT ?>/css/ie.css"/>
	<![endif]-->

	<script>
	/*-----------------------------------------------------------------------------------*/
	/*	Validate Comment Form
	/*-----------------------------------------------------------------------------------*/
	jQuery(document).ready(function($) {
		$.validator.addMethod("notEqual", function(value, element, param) {
			if(element.value == param)
				return false;
			else if(element.text == param)
				return false;
			else
				return true;
		}, "Please input value!");
		
		$.validator.addMethod("notEqual", function(value, element, param) {
			return value !== param;
		}, "Please input value!");
		
		/* Validation for comment form */
		$('#commentform').validate({
			rules: {
				author: {
					required: true,
					minlength: 2,
					notEqual: 'Name *'
				},
						
				email: {
					required: true,
					email: true, 
					notEqual: 'Email *'
				},
				
				comment: {
					required: true,
					minlength: 5,
					notEqual: 'Message *'	
				}		
			},
					
			messages: {
				author: "<?php echo $mp_option[$shortname.'_comment_name_error']; ?>",
				email: "<?php echo $mp_option[$shortname.'_comment_email_error']; ?>",
				comment: "<?php echo $mp_option[$shortname.'_comment_comment_error']; ?>"
			}
		});
	});
	</script>


	<style>
		<?php
		global $mp_option; 
		global $shortname; ?>

		/* Custom CSS */
		<?php echo $mp_option[$shortname.'_custom_css']?>

	</style>
	
	<?php
}

add_action('wp_head', 'gentle_add_my_head');

/*-----------------------------------------------------------------------------------*/
/*	Register Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

function gentle_create_portfolio() {

	register_taxonomy('portfolio_cat','portfolio', array(
   	 	'hierarchical' => true,
    	'show_ui' => true,
   	 	'query_var' => true,
    )); // add unique categories to portfolio section 
	
    $portfolio_args = array(
        	'label' => __('Portfolio', 'agera'),
        	'singular_label' => __('Portfolio', 'agera'),
        	'public' => true,
        	'show_ui' => true,
        	'capability_type' => 'post',
        	'hierarchical' => false,
        	'rewrite' => true,
        	'supports' => array('title', 'editor', 'thumbnail'),
        	'taxonomies' => array('post_tag')
    );
    
    register_post_type('portfolio', $portfolio_args);
}

add_action('init', 'gentle_create_portfolio');

/*-----------------------------------------------------------------------------------*/
/*	Hook Massive Panel & Get Options
/*-----------------------------------------------------------------------------------*/

if(is_admin()) {
		require_once('massive-panel/theme-settings.php');
}

function gentle_get_global_options() {
	global $shortname;
	$mp_option = array();
	$mp_option = get_option($shortname.'_options');
	
	return $mp_option;
}
	
$mp_option = gentle_get_global_options();

/*-----------------------------------------------------------------------------------*/
/*	Load More Content Hook
/*-----------------------------------------------------------------------------------*/

function load_content_init($query) {
@		$max_pages = $query->max_num_pages;
@		$posts_count = $query->found_posts;
@		$posts_per_page = $query->post_count;
		$page = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;

		?>
		<script>
		jQuery(document).ready(function($) {
			var max_pages = parseInt('<?php echo $max_pages; ?>');
			var posts_count = parseInt('<?php echo $posts_count; ?>');
			var posts_per_page = parseInt('<?php echo $posts_per_page; ?>');
			var page = parseInt('<?php echo $page; ?>') + 1;
			var next_page_link = '<?php echo next_posts($max_pages, false)?>';

			var $button = $('#gentle-lm-button');
			var $container = $("#mpc-page-content");
			var $loaded = $('#gentle-lm-info');

			$loaded.text(posts_per_page + ' / ' + posts_count);

			if(posts_count <= posts_per_page) 
				$button.hide();

			$button.click(function() {
				
				if (page <= max_pages) {
					$(this).text('Loading...');
					
					$('<div></div>').load(next_page_link + ' .post', function() {
						var $posts = $(this).children();
							
						page++;
						next_page_link = next_page_link.replace(/page\/[0-9]\//, 'page/' + page);
		
						if (page <= max_pages) {
							$button.text('Load More');
							$loaded.text((posts_per_page * (page - 1)) + ' / ' + posts_count);
						} else {
							$button.stop().animate({ 'top': '30px' }, 500, 'easeOutExpo', function() {
								$(this).hide();
							});
							$loaded.text(posts_count + ' / ' + posts_count);
						}
						
						$container.append($posts);
						$posts.addClass('no-transition');
						$posts.css( { 'opacity' : 0 });

						if ($.browser.msie && parseInt($.browser.version, 10) === 8) {
							$container.isotope('addItems', $posts, function() {
								$(window).trigger('resize');

								$posts.animate({ 'opacity' : 1}, 2000, 'easeOutExpo', function() {
									$posts.removeClass('no-transition');
								});
							});
						}
						else {
							$container.imagesLoaded(function() {
								$container.isotope('addItems', $posts, function() {
									$(window).trigger('resize');

									$posts.animate({ 'opacity' : 1}, 2000, 'easeOutExpo', function() {
										$posts.removeClass('no-transition');
									});
								});
							});
						}
					
						setTimeout(function(){
							$(window).trigger('resize');
						}, 200);

						$(window).trigger('resize');
					});
				}
			});
		});
		</script>
<?php }

add_action('mpc_post_loop', 'load_content_init');

/*-----------------------------------------------------------------------------------*/
/*	Triming the excerpt
/*-----------------------------------------------------------------------------------*/

function gentle_my_excerpt($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if (count($words) > $word_limit)
	    array_pop($words);

	//$content = preg_replace('/<img[^>]+./','', $words);

	return strip_tags(implode(' ', $words) . '...');
}

/*-----------------------------------------------------------------------------------*/
/*	Add lightbox
/*-----------------------------------------------------------------------------------*/

function mpc_gentle_add_lightbox($post_data) {
	$output = '';

	if(isset($post_data['lb']) && $post_data['lb']) { 
		$type = '';
		$asset = $post_data['lb_src'];
		$search = preg_match('/.(jpg|JPG|jpeg|JPEG|gif|GIF|png)/', $asset);
		if($search == 1) {
			$type = 'mpc-image';
			$search = 0;
		}
		
		$search = preg_match('/.(vimeo)./', $asset);
		
		if($search == 1) {
			$type = 'mpc-vimeo-video';
			$search = 0;
		}
		
		$search = preg_match('/.(youtube)/', $asset);
		
		if($search == 1) {
			$type = 'mpc-youtube-video';
			$search = 0;
		}
		
		$search = preg_match('/.(swf|SWF)/', $asset);
		if($search == 1) {
			$type = 'mpc-swf';
			$search = 0;
		}
		
		if($type == '') {
			$type = 'mpc-iframe'; 
		}
	// rel="'.$post_data['lb_gallery']."
	$output .= '<a class="gentle-icon-eye mpc-fancybox '.$type.'"  href="'.$post_data['lb_src'].'" title="'.$post_data['lb_caption'].'" ></a>';
	}

	echo $output;
}
	
/*-----------------------------------------------------------------------------------*/
/*	List Comments
/*-----------------------------------------------------------------------------------*/

function comments_all($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	
	
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<span class="comment-line"></span>
		<?php if(get_comment_author_email() == get_the_author_meta('email')){
			$author = "comment_author";
		} else {
			$author ="";
		}?>
		
		<div id="comment-<?php comment_ID(); ?>" class="comments_holder comment_line <?php echo $author; ?>" >
			<div class="comment-author vcard">
				<div class="gentle_comment_gravatar">
					<?php echo get_avatar(get_comment_author_email(), $size ='80'); ?>
					
				</div>
			<div class="comment_meta">
				<?php if($author == "comment_author") { ?>
					<span class="comment_author">
						<?php printf(__('<h4 class="comments_author"> %s</h4>', 'gentle'), get_comment_author_link()) ?>
						
					</span>
					<p class="comment_date"><time><?php printf(__('%1$s ', 'gentle'),  get_comment_time('H:i F jS, Y')) ?> &middot;</time>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					&middot; <span class="author">author</span>
					</p>
				<?php } else { ?>
					<?php printf(__('<h4 class="comments_author"> %s</h4>', 'gentle'), get_comment_author_link()) ?>
					<p class="comment_date">On: <time datetime="2011-04-26"><?php printf(__('%1$s ', 'gentle'),  get_comment_time('H:i F jS, Y')) ?> &middot;</time>
					<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</p>
				<?php } ?>
			</div>
			<div class="gentle_message">
				<?php comment_text() ?>
			</div>
			<div class="clear"></div>
		</div>
    </div>
	<?php 
}	

/*-----------------------------------------------------------------------------------*/
/*	Register Standard Sidebar & Footer
/* 	
/*	footer can display 1 - 5 columns (default 3)
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') )
	{
		register_sidebar(array(
			'before_widget' => '<li id="%1$s" class="widget %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<h5 class="widget_title sidebar_widget_title">',
			'after_title' => '</h5>',
			'name'=>'Main Sidebar'
		));
		
		/* Create different number of footer columns */
		if(isset($mp_option[$shortname.'_number_of_footer_columns']) && $mp_option[$shortname.'_number_of_footer_columns'] == '1'){
			register_sidebar(array(
				'before_widget' => '<li id="%1$s" class="widget widget_1 %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title footer_title">',
				'after_title' => '</h5>',
				'name'=>'Main Footer'
			));
		} elseif(isset($mp_option[$shortname.'_number_of_footer_columns']) && $mp_option[$shortname.'_number_of_footer_columns'] == '2') {
			register_sidebar(array(
				'before_widget' => '<li id="%1$s" class="widget widget_2 %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title footer_title">',
				'after_title' => '</h5>',
				'name'=>'Main Footer'
			));
		} elseif(isset($mp_option[$shortname.'_number_of_footer_columns']) && $mp_option[$shortname.'_number_of_footer_columns'] == '4') {
			register_sidebar(array(
				'before_widget' => '<li id="%1$s" class="widget widget_4 %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title footer_title">',
				'after_title' => '</h5>',
				'name'=>'Main Footer'
			));
		} elseif(isset($mp_option[$shortname.'_number_of_footer_columns']) && $mp_option[$shortname.'_number_of_footer_columns'] == '5') {
			register_sidebar(array(
				'before_widget' => '<li id="%1$s" class="widget widget_5 %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title footer_title">',
				'after_title' => '</h5>',
				'name'=>'Main Footer'
			));
		} else {
			register_sidebar(array(
				'before_widget' => '<li id="%1$s" class=" widget widget_3 %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title footer_title">',
				'after_title' => '</h5>',
				'name'=>'Main Footer'
			));
		}

	}

/*--------------------------- END Registering Sidebars -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Register Custom Sidebars and Footers
/*-----------------------------------------------------------------------------------*/

// Pull all the pages into an array
$options_pages = array();  
$options_pages_obj = get_pages('sort_column=post_parent,menu_order');

foreach ($options_pages_obj as $page) {
 	if(isset($mp_option[$shortname.'_sidebar']) && isset($mp_option[$shortname.'_sidebar']['sidebar_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['sidebar_'.$page->ID] == "on"){
 		if(function_exists('register_sidebar')) {
 			register_sidebar(array(
		 		'name' => $page->post_title.' Sidebar',
 		 		'description' => 'This is a custom sidebar for '.$page->post_title.' page.',
		  		'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget' => '</li>',
				'before_title' => '<h5 class="widget_title sidebar_widget_title">',
				'after_title' => '</h5>'
			));	
		}
 	}
 	
 	if(isset($mp_option[$shortname.'_sidebar']) && isset($mp_option[$shortname.'_sidebar']['footer_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['footer_'.$page->ID] == "on"){
 		if(function_exists('register_sidebar')) {
 			
			if(isset($mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID] == '1'){
				register_sidebar(array(
					'description' => 'This is a custom footer for '.$page->post_title.' page.',
					'before_widget' => '<li id="%1$s" class="widget widget_1 %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h5 class="widget_title footer_title">',
					'after_title' => '</h5>',
					'name'=> $page->post_title.' Footer'
				));
			} elseif (isset($mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID] == '2') {
				register_sidebar(array(
					'description' => 'This is a custom footer for '.$page->post_title.' page.',
					'before_widget' => '<li id="%1$s" class="widget widget_2 %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h5 class="widget_title footer_title">',
					'after_title' => '</h5>',
					'name'=> $page->post_title.' Footer'
				));
			} elseif (isset($mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID] == '4') {
				register_sidebar(array(
					'description' => 'This is a custom footer for '.$page->post_title.' page.',
					'before_widget' => '<li id="%1$s" class="widget widget_4 %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h5 class="widget_title footer_title">',
					'after_title' => '</h5>',
					'name'=> $page->post_title.' Footer'
				));
			} elseif (isset($mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID]) && $mp_option[$shortname.'_sidebar']['footer_columns_'.$page->ID] == '5') {
				register_sidebar(array(
					'description' => 'This is a custom footer for '.$page->post_title.' page.',
					'before_widget' => '<li id="%1$s" class="widget widget_5 %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h5 class="widget_title footer_title">',
					'after_title' => '</h5>',
					'name'=> $page->post_title.' Footer'
				));
			} else {
				register_sidebar(array(
					'description' => 'This is a custom footer for '.$page->post_title.' page.',
					'before_widget' => '<li id="%1$s" class=" widget widget_3 %2$s">',
					'after_widget' => '</li>',
					'before_title' => '<h5 class="widget_title footer_title">',
					'after_title' => '</h5>',
					'name'=> $page->post_title.' Footer'
				));
			}
		}
 	} 
}

/*------------------- END Register Custom Sidebars and Footers --------------------- */

function show_post($path) {
  $post = get_page_by_path($path);
  $content = apply_filters('the_content', $post->post_content);
  
  echo $content;
}

function show_header($path) {
  $post = get_page_by_path($path);
  $content = apply_filters('the_content', $post->post_content);
  echo do_shortcode($content);
  
}

/* WP-Admin meta boxes */ 
require_once (TEMPLATEPATH . "/functions/custom-meta-boxes.php");

?>