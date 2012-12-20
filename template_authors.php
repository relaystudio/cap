<?php
	
/**
* Home
*
* Template Name: Authors
* @package WordPress
* @subpackage Gentle
*/	
	
	
get_header();
global $more;
global $query;
global $page_id;

$mp_option = gentle_get_global_options();
$page_id = get_the_ID();
$port_categories = '';

$display_admins = false;
$order_by = 'display_name'; // 'nicename', 'email', 'url', 'registered', 'display_name', or 'post_count'
$role = ''; // 'subscriber', 'contributor', 'editor', 'author' - leave blank for 'all'
$avatar_size = 32;
$hide_empty = true; // hides authors with zero posts

if(!empty($display_admins)) {
	$blogusers = get_users('orderby='.$order_by.'&role='.$role);
} else {
	$admins = get_users('role=administrator');
	$exclude = array();
	foreach($admins as $ad) {
		$exclude[] = $ad->ID;
	}
	$exclude = implode(',', $exclude);
	$blogusers = get_users('exclude='.$exclude.'&orderby='.$order_by.'&role='.$role);
}
$authors = array();
foreach ($blogusers as $bloguser) {
	$user = get_userdata($bloguser->ID);
	if(!empty($hide_empty)) {
		$numposts = count_user_posts($user->ID);
		if($numposts < 1) continue;
	}
	$authors[] = (array) $user;
}




?>

<script>
// mpc-page-content
	
</script>




<div id="mpc-content" role="main">
	<div id="mpc-page-wrap" class="authors sidebar-none">
		<div id="mpc-page-content" >

<?
// echo '<ul class="contributors">';
// foreach($authors as $author) {
// 	$display_name = $author['data']->display_name;
// 	$avatar = get_avatar($author['ID'], $avatar_size);
// 	$author_profile_url = get_author_posts_url($author['ID']);

// 	echo '<li><a href="', $author_profile_url, '">', $avatar , '</a><a href="', $author_profile_url, '" class="contributor-link">', $display_name, '</a></li>';
// }
// echo '</ul>';

global $wpdb;
    $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users ORDER BY display_name");
    foreach ($authors as $author ) { 
    $aid = $author->ID; ?>
	    <div class="author_info <?php the_author_meta('user_nicename',$aid); ?>">
			<span class="author_photo"><?php echo get_avatar($aid,96); ?></span>
        	<p><a href="<?php get_bloginfo('url'); ?>/author/<?php the_author_meta('user_nicename', $aid); ?>"><?php the_author_meta('user_firstname',$aid); ?> <?php the_author_meta('user_lastname',$aid); ?></a></p>  
        	<p><?php the_author_meta('description',$aid); ?></p>
        	<p class="author_email"><a href="mailto:<?php the_author_meta('user_email', $aid); ?>" title="Send an Email to the Author of this Post">Contact the author</a></p>
        </div> 
	<?php }
	


?>
	    	
	    </div>	<!-- end mpc-page-content-->
	    <?php do_action('mpc_post_loop', $wp_query); ?>
	    
	    <div id="mpc-gentle-nav">
	    	<div class="mpc-next-page"><?php next_posts_link(); ?></div>
			<div class="mpc-previous-page"><?php previous_posts_link(); ?></div>
    	</div>
	   
	</div> 
	<div id="gentle-load-more">
			<span id="gentle-lm-button"><?php _e('Load More', 'gentle'); ?></span>
	    	<span id="gentle-lm-info"></span>	
	</div>
</div>

<?php get_footer(); ?>