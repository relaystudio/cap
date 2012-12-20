<?php

/**
 * @package WordPress
 * @subpackage Gentle
 */

get_header(); 
global $page_id;
$page_id = get_the_ID();

$sidebar_position = '';

if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
}

if($sidebar_position == '')
	$sidebar_position = 'right';

?>

<div id="mpc-content" role="main">
	<div id="mpc-page-wrap">
		<div id="mpc-page-content" class="sidebar-<?php echo $sidebar_position; ?>">
		<?php 
		wp_reset_query();
		if (have_posts()) { 
			while (have_posts()) {
				the_post(); ?>
				<article class="gentle-page-content">
					<?php the_content(); ?>
				</article>
			<?php 
			} 
		} ?>
		<?php wp_link_pages(); ?>
		</div><!-- end page-content -->
	<?php 
		if($sidebar_position != 'none')
			get_sidebar(); ?>
	</div> <!-- page wrap -->
</div> <!-- end mpc-content -->
<?php get_footer(); ?>