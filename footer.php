<?php

/**
 * @package WordPress
 * @subpackage Gentle
 */

global $page_id;
global $post_type;
global $page;
global $shortname;
$mp_option = gentle_get_global_options();

if(isset($page->ID))
	$page_id = $page->ID;

if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
	$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
} else {
	$sidebar_position = 'right'; }
?>

<script>
	jQuery(document).ready(function($) {

		<?php if($mp_option['gentle_footer_visible'] == "0") {?>
			$('#gentle_footer').children('.footer-content').slideUp(1);
			$('#gentle_footer').children('.bottom-footer').css('border', 'none');
		<?php } ?>

		<?php if($mp_option['gentle_footer_animated'] == "1") {?>
			$('#gentle_footer').hover(function() {
				var $this = $(this).children('.footer-content');
				$this.stop().slideDown();
				$('html, body').stop().animate({ scrollTop: $(document).height() });
				$('#gentle_footer').children('.bottom-footer').css('border-top', '1px solid #DDD');
			}, function() {
				var $this = $(this).children('.footer-content');
				$this.stop().slideUp('slow', function(){
					$('#gentle_footer').children('.bottom-footer').css('border', 'none');
				});
				
			});
		<?php } ?>
	});
</script>

<footer id="gentle_footer" class="sidebar-<?php echo $sidebar_position; ?>">
	<div class="footer-content">
		<ul>
			<?php 
			if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['footer_' .$page_id]))
				$custom_sb = $mp_option['gentle_sidebar']['footer_' .$page_id];
			else
				$custom_sb = "off";	

			$custom_sb_id = get_the_title($page_id).' Footer';

			if($custom_sb == 'on' && dynamic_sidebar($custom_sb_id) ) {
				// displays custom footer
			} elseif(dynamic_sidebar('Main Footer') ) {
				// displays regular footer when there are no widgets in custom Footer
			} else {
				// displays widgets when they are not specified in custom & Main Footer
			?>
				<li class="widget widget_3">
					<h2 class="widget_title footer_title">About</h2>
					<div class="textwidget">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam quis leo at mauris faucibus suscipit. Sed orci arcu, tincidunt at commodo in, consectetur sed enim. Vestibulum aliquet justo rutrum magna tincidunt fringilla. In eget nisl in justo mattis accumsan eu nec magna. Pellentesque pellentesque pharetra lacus, eget aliquet mi mattis eu.
					</div>
				</li>
				<li class="widget widget_3"><h2 class="widget_title footer_title">Categories</h2>
					<ul>
						<?php wp_list_categories('show_count=1&title_li='); ?>
					</ul>
				</li>
				<li class="widget widget_3"><h2 class="widget_title sidebar_widget_title">Archives</h2>
					<ul>
						<?php wp_get_archives('type=monthly'); ?>
					</ul>
				</li>
			<?php
			}?>
		</ul>
	</div>	
	</div>
</footer><!-- gentle footer end -->
</div><!-- #page end -->
	<?php wp_footer(); ?>
</body>
</html>