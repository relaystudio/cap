<?php

/**
 * @package WordPress
 * @subpackage Gentle
 */

global $page_id;
global $post_type;
global $page;
global $wp_query;


if(isset($page->ID))
	$page_id = $page->ID;

$mp_option = gentle_get_global_options();
	
if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) { 
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
} else {
	$sidebar_position = 'right';
}

if($post_type == "post") {
	$sidebar_position = $mp_option['gentle_single_sidebar']['radio_sb_blog'];
} elseif ($post_type == "portfolio") {
	$sidebar_position = $mp_option['gentle_single_sidebar']['radio_sb_portfolio'];
} 
 
// check if custom sidebar is turned on and get the sidebar name
if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['sidebar_' .$page_id]))
	$custom_sb = $mp_option['gentle_sidebar']['sidebar_' .$page_id];
else
	$custom_sb = "off";	

// sidebar name (Page title + 'Sidebar';
$custom_sb_id = get_the_title($page_id).' Sidebar';

?>
	<aside id="gentle-aside" class="sidebar-<?php echo $sidebar_position; ?>">
		<?php 
		// get page template
		$template = get_post_meta( $page_id, '_wp_page_template', true );?>
		<ul>
			<?php	
			if($custom_sb == 'on' && dynamic_sidebar($custom_sb_id) ) {
				// displays custom sidebar
			} elseif(dynamic_sidebar('Main Sidebar') ) {
				// displays regular sidebar when there are no widgets in custom Sidebar
			} else {	
				// display premade widgets when nothing is specified ?>
				<li class="widget"><h2 class="widget_title sidebar_widget_title">Pages</h2>
					<ul>
						<?php wp_list_pages('title_li=' ); ?>
					</ul>
				</li>
				<li class="widget"><h2 class="widget_title sidebar_widget_title">Categories</h2>
					<ul>
						<?php wp_list_categories('show_count=1&title_li='); ?>
					</ul>
				</li>	
				<li class="widget"><h2 class="widget_title sidebar_widget_title">Meta</h2>
					<ul>
						<?php wp_register(); ?>
						<li>
							<?php wp_loginout(); ?>
						</li>
						<?php wp_meta(); ?>
					</ul>
				</li>
			<?php
			}?>
		</ul>
	</aside><!-- #gentle_aside -->