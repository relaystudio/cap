<?php

/*-----------------------------------------------------------------------------------*/
/*	Shortcodes PHP:
/*
/*
/*
/*-----------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*	X. Headig 
/*-----------------------------------------------------------------------------------*/

function mpc_heading_shortcode($atts, $content = null ) {
	extract(shortcode_atts(array(
    'heading' => '',
    'subheading' => '',
    'align' => 'center'  
    ), $atts));
    

   $return = '<h2 class="mpc-home-header '.$align.'">'.$heading.'</h2><h4 class="mpc-home-header '.$align.'">'.$subheading.'</h4>';
   $return = parse_shortcode_content($return);
   return $return;
}

add_shortcode('mpc_heading', 'mpc_heading_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	X. Drop Caps 
/*-----------------------------------------------------------------------------------*/

function mpc_gentle_dropcaps($atts, $content = null ) {
	extract(shortcode_atts(array(
    'background' => '',
    'color' => '',
    'size' => 'normal' 
    ), $atts));
    

   $return = '<span class="mpc-dropcaps dropcasps-size-'.$size.'" style="background: '.$background.'; color: '.$color.';">'.$content.'</span>';
   $return = parse_shortcode_content($return);
   return $return;
}

add_shortcode('mpc_dropcaps', 'mpc_gentle_dropcaps');


/*-----------------------------------------------------------------------------------*/
/*	X. Column Icons
/*-----------------------------------------------------------------------------------*/


function mpc_icon_columns($atts, $content) {
	$GLOBALS['column_icon_count'] = 0;
	$GLOBALS['column_icon'] = '';

	do_shortcode($content);

	if(is_array($GLOBALS['column_icon'])) {
		$i = 1; $j = 1;
		
		foreach( $GLOBALS['column_icon'] as $column_icon ) {
			
			if($column_icon['icon'] == "responsive" || $column_icon['icon'] == "cloud"
			|| $column_icon['icon'] == "love" || $column_icon['icon'] == "settings") {
				$icon = MPC_THEME_ROOT.'/images/ui/icons/'.$column_icon['icon'].'.png';
			} else {
				$icon = $column_icon['icon'];
			}
		
			$column_icons[] = '<div class="mpc-icon-column"><span class="mpc-icon"><img src="'.$icon.'" alt="'.$icon.'"></span><h4>'.$column_icon['heading'].'</h4><span class="mpc-column-text">'.$column_icon['content'].'</span><div class="gentle-deco-line"></div></div>';
		}		
		$return = '<div class="mpc-icon-columns icon-columns-'.$GLOBALS['column_icon_count'].'">'.implode( "\n", $column_icons ).'</div>';
	}
	
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('mpc_icon_columns', 'mpc_icon_columns');

function mpc_icon_column($atts, $content) {
	extract(shortcode_atts(array
	(
		'icon' => '',
		'heading' => ''
	), $atts));

	$x = $GLOBALS['column_icon_count'];
	$GLOBALS['column_icon'][$x] = array('icon' => sprintf($icon, $GLOBALS['column_icon_count']), 'heading' => sprintf($heading, $GLOBALS['column_icon_count']), 'content' =>  $content );

	$GLOBALS['column_icon_count']++;
}

add_shortcode('mpc_icon_column', 'mpc_icon_column');


/*-----------------------------------------------------------------------------------*/
/*	X. Recent Portfolio Items
/*-----------------------------------------------------------------------------------*/

function mpc_recent_portfolio($atts, $content = null) {
	extract(shortcode_atts(array(
    'number' => '4',
    'post' => ''
    ), $atts));

	global $page_id;

	$mp_option = gentle_get_global_options();

	$sidebar_position = '';

	if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
		$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
	} 

	if($sidebar_position == '') 
		$sidebar_position = 'right';

	$scroll = 3;
	if($sidebar_position == 'none') 
		$scroll = 4;

    ?>
    

	
    <?php

    $return = '';

    $tags = wp_get_post_tags($post);

    if($tags != '') {
    	$tag_ids = array();
		foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
		}

    $query = new WP_Query(array(
    		'post_type' => 'portfolio', 
    		'showposts' => $number,
     		'tag__in' => $tag_ids,
			'post__not_in' => array($post)
    		));
	} else {
		$query = new WP_Query(array(
    		'post_type' => 'portfolio', 
    		'showposts' => $number
    		));
	}

			
	if($query->have_posts()){
		
		$return = '<ul id="gentle_latest_portfolio" class="jcarousel-skin-gentle">';
		$index = 0;
		while($query->have_posts()) {
			$query->the_post(); 
			$index++; 


			if($index > 1) { 
				$return .= '<li class="gentle-recent-portflio">';
			} else {
				$return .= '<li class="gentle-recent-portflio first">';
			}
			$return .= '<div class="gentle-portfolio-content">';
			$return .= '<a href="'.get_permalink().'" rel="bookmark">';
							
			if(has_post_thumbnail())
				$return .= get_the_post_thumbnail(get_the_ID(), 'recent_portfolio'); 
						
			$return .= '</a></div>';
			$return .= '<h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5>';
			$categories = get_the_terms(get_the_ID(), 'portfolio_cat');
			$length = count($categories);
			$i = 0;
			$return .= '<span class="gentle-portfolio-categories">';
			foreach($categories as $category) {
			
				$return .= '<a href="'.get_term_link($category->slug, 'portfolio_cat').'">';
				$return .= $category->name;
				$return .= '</a>';	
				if($i != $length - 1)
					$return .=' \\\ ';	
					
				$i++;
			}
			
			$return .= '</span><span class="gentle-deco-line"></span></li>';

		}  // end while 
	}?>

	<script type="text/javascript">

		jQuery(document).ready(function($) {
			 
		    $('#gentle_latest_portfolio').jcarousel({
		    	wrap: 'circular',
		    	scroll: <?php echo $scroll; ?>,
		    	easing: 'easeOutExpo',
		    	animation: 'slow',
		    	visible: null,
		    	buttonNextHTML: (parseInt('<?php echo $scroll ?>') >= parseInt('<?php echo $index ?>'))? null : '<div></div>',
		    	buttonPrevHTML: (parseInt('<?php echo $scroll ?>') >= parseInt('<?php echo $index ?>'))? null : '<div></div>'
		    });
			
		});
	
	</script>

	<?php
	wp_reset_query();
	$return .= '</ul>';

    $return = parse_shortcode_content($return);
    return $return;
}

add_shortcode('mpc_recent_portfolio', 'mpc_recent_portfolio');


/*-----------------------------------------------------------------------------------*/
/*	X. Recent Posts
/*-----------------------------------------------------------------------------------*/

function mpc_recent_posts($atts, $content = null) {
	extract(shortcode_atts(array(
    'number' => '4',
    'post' => ''  
    ), $atts));

	global $page_id;

	$mp_option = gentle_get_global_options();

	$sidebar_position = '';

	if(isset($mp_option['gentle_sidebar']) && isset($mp_option['gentle_sidebar']['radio_sb_' .$page_id])) {
		$sidebar_position = $mp_option['gentle_sidebar']['radio_sb_' .$page_id];
	} 

	if($sidebar_position == '') 
		$sidebar_position = 'right';

	$scroll = 1;
	if($sidebar_position == 'none') 
		$scroll = 2;

    ?>
    
   
	
    <?php
	$return = '';

	$tags = wp_get_post_tags($post);

    if($tags != '') {
    	$tag_ids = array();
		foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
		}

    $query = new WP_Query(array(
    		'post_type' => 'post', 
    		'showposts' => $number,
     		'tag__in' => $tag_ids,
			'post__not_in' => array($post)
    		));
	} else {
		$query = new WP_Query(array(
    		'post_type' => 'post', 
    		'showposts' => $number
    		));
	}


			
	if($query->have_posts()){
		
		$return = '<ul id="gentle_latest_posts_jcarousel" class="jcarousel-skin-gentle-posts">';
		$index = 0;
		while($query->have_posts()) {
			$query->the_post(); 
			
	
			
			if($index % 4 == 0 || $index == 0)
				$return .= '<li><ul class="gentle_latest_posts"><li class="gentle-recent-post">';
			else 
				$return .= '<li class="gentle-recent-post">';
			
			$return .= '<div class="gentle-post-content">';
			$return .= '<span class="recent-post-thumb"><a href="'.get_permalink().'" rel="bookmark">';
							
			if(has_post_thumbnail())
				$return .= get_the_post_thumbnail(get_the_ID(), 'recent_post'); 
						
			$return .= '</a></span>';
			$return .= '<div class="recent-post-title"><h5><a href="'.get_permalink().'">'.get_the_title().'</a></h5></div>';
			
			$return .= '<span class="gentle-post-meta">';
			$return .= get_the_time('M d Y');
			$return .= ' &middot; ';
			 
			$categories = get_the_category(get_the_ID());
			$length = count($categories);
			$i = 0;
// 			print_r('<pre>');
// print_r($category);
// print_r('</pre>');
			foreach($categories as $category) {
				$return .= '<a href="'.get_category_link($category->cat_ID).'">';
				$return .= $category->name;
				$return .= '</a>';	
				if($i != $length - 1)
					$return .=', ';	
					
				$i++;
			}

			$return .= ' &middot; ';
			$comments = get_comments_number('0 comments','1 comment','% comments');			
			$return .= '<a href="'.get_comments_link().'">';
			
			if($comments == 0) {
				$return .= '0 comments';
			} elseif($comments > 1) {
				$return .= $comments.' comments';
			} elseif($comments == 1) {
				$return .= '1 comment';
			}
			
			$return .='</a>';
			
			$return .= '</span>';
			if($sidebar_position == 'none')
				$return .= '<p class="gentle-post-excerpt">'.gentle_my_excerpt(get_the_excerpt(), 14).'</p>';
			else
				$return .= '<p class="gentle-post-excerpt">'.gentle_my_excerpt(get_the_excerpt(), 20).'</p>';

			$return .= '<span class="gentle-deco-line"></span></div>';
			
			if($index % 2 == 0 || $index == 0)
				$return .= '</li>';
			else 
				$return .= '</li></ul></li>';

			$index++; 

		}  // end while 
	}?>

	 <script type="text/javascript">

		jQuery(document).ready(function() {
		    jQuery('#gentle_latest_posts_jcarousel').jcarousel({
		    	wrap: 'circular',
		    	scroll: <?php echo $scroll; ?>,
		    	easing: 'easeOutExpo',
		    	animation: 'slow',
		    	buttonNextHTML: (parseInt('<?php echo $scroll + 1 ?>') >= parseInt('<?php echo $index ?>')) ? null : '<div></div>',
			    buttonPrevHTML: (parseInt('<?php echo $scroll + 1 ?>') >= parseInt('<?php echo $index ?>')) ? null : '<div></div>'
		    });
		});
	
	</script>

	<?php
	wp_reset_query();
	$return .= '</ul>';

    $return = parse_shortcode_content($return);
    return $return;
}

add_shortcode('mpc_recent_posts', 'mpc_recent_posts');

/*-----------------------------------------------------------------------------------*/
/*	1. Tabs Shortcode
/*-----------------------------------------------------------------------------------*/


function mpc_tabs($atts, $content) {
	$GLOBALS['tab_count'] = 0;

	do_shortcode($content);

	if(is_array($GLOBALS['tabs'])) {
		$i = 1; $j = 1;
		
		foreach( $GLOBALS['tabs'] as $tab ) {
			$tabs[] = '<li class="tabs_title"><a class="" href="#'.$i++.'">'.$tab['title'].'</a></li>';
			$panes[] = '<div id="'.$j++.'" class="tab_content"><p>'.$tab['content'].'</p></div>';
		}
		
		$return = "\n".'<div class="tabs"><ul>'.implode( "\n", $tabs ).'</ul><span class="clear"></span>'."\n".''.implode( "\n", $panes ).'</div>'."\n";
		
	}
	$return .='<div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode( 'tabs', 'mpc_tabs' );

function mpc_tab($atts, $content) {
	extract(shortcode_atts(array
	(
		'title' => 'Tab %d'
	), $atts));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );

	$GLOBALS['tab_count']++;
}

add_shortcode('tab', 'mpc_tab');

/*--------------------------- END Tabs -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	2. Toggle Shortcode
/*-----------------------------------------------------------------------------------*/

function mpc_toggle_shortcode($atts, $content = null){
	extract( shortcode_atts(
		array(
			'title' => 'Click To Open'
			),
			$atts));
			$return = '<div class="toggle-header"><h3 class="toggle-title"><a href="#">'. $title .'</a></h3><span class="gentle-deco-line"></span></div><div class="toggle-content">' . do_shortcode($content) . '</div><div class="toggle-space"></div><div class="clear"></div>';
			$return = parse_shortcode_content($return);
			return $return;
}

add_shortcode('toggle', 'mpc_toggle_shortcode');


/*--------------------------- END Toggle Shortcode -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	3. Button Shortcode
/*-----------------------------------------------------------------------------------*/

function mpc_button_shortcode($atts, $content = null ) {
	extract(shortcode_atts(array(
    'class' => '',
    'url' => '',
    'background' => '',
    'text_color' => '',
    'background_hover' => '',
    'text_color_hover' => '',
    'border_color' => '',
    'border_hover_color' => '',
    
    ), $atts));
    
    ?>
    <style>
    	#shortcode-preview .mpc-button.<?php echo $class; ?>,
    	.mpc-button.<?php echo $class; ?> {
	    	background: <?php echo $background; ?>!important;
	    	color: <?php echo $text_color; ?>!important;
	    	<?php if($border_color != 'none' && $border_color != '') { ?>
	    		border: 1px solid <?php echo $border_color; ?>!important;
	    		border-radius: 1px;
	    	<?php } ?>
    	}
    	
    	#shortcode-preview .mpc-button.<?php echo $class; ?>:hover,
    	.mpc-button.<?php echo $class; ?>:hover {
	    	background: <?php echo $background_hover; ?>!important;
	    	color: <?php echo $text_color_hover; ?>!important;
	    	<?php if($border_hover_color != 'none' && $border_hover_color != '') { ?>
	    		border: 1px solid <?php echo $border_hover_color; ?>!important;
	    		border-radius: 1px;
	    	<?php } ?>
    	}
    
    </style>
    
    <?php
   $return = '<a class="mpc-button ' . esc_attr($class) . '" href="' .$url. '">' . $content . '</a>';
   $return = parse_shortcode_content($return);
   return $return;
}

add_shortcode('button', 'mpc_button_shortcode');

/*--------------------------- END Button Shortcode -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	4. YouTube 
/*-----------------------------------------------------------------------------------*/

function gentle_youtube_shortcode($atts, $content = null) {
   extract(shortcode_atts(array(
			'video'  => '',
			'width'  => '590',
			'height' => '355'
			), $atts));
			
	if($video !=''){
		if($width == '')
			$width = '590';
		if($height == '')
			$height = '355';
				
		$return = '<div class="youtube_video"><object type="application/x-shockwave-flash" style="width:'.esc_attr($width).'; height:'.esc_attr($height).';" data="http://www.youtube.com/v/'.esc_attr($video).'&amp;hl=en_US&amp;fs=1&amp;"><param name="movie" value="http://www.youtube.com/v/'.esc_attr($video).'&amp;hl=en_US&amp;fs=1&amp;" /><param name="wmode" value="opaque" /></object></div>';
		$return = parse_shortcode_content($return);
		return $return;
	}
}
add_shortcode('youtube', 'gentle_youtube_shortcode');

/*--------------------------- END YouTube -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	5. Vimeo
/*-----------------------------------------------------------------------------------*/

function gentle_vimeo_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
                    'id' => '',
                    'height' => '355',
                    'width' => '590'
                        ), $atts));
        if ($id != '') {
        	if($width == '')
				$width = '590';
			if($height == '')
				$height = '355';
					
            $iframe = '<iframe src="http://player.vimeo.com/video/';
            $iframe .= esc_attr($id);
            $iframe .= '?color=F9625B" width="';
            $iframe .= esc_attr($width);
            $iframe .= '" height="';
            $iframe .= esc_attr($height);
            $iframe .= '"></iframe>';
            
            $iframe = parse_shortcode_content($iframe);
            return $iframe;
        }
    }
    
add_shortcode('vimeo', 'gentle_vimeo_shortcode');

/*--------------------------- END Vimeo -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	6. Columns
/*-----------------------------------------------------------------------------------*/

/* function allow you to insert 1 column */
function column1_1_shortcode( $atts, $content = null ) {

	$output = '';
	$content = parse_shortcode_content($content);
	$output .=  '<div class="column one_one" >'.do_shortcode($content).'</div>';
	$output = parse_shortcode_content($output);
	return $output;
	
}

add_shortcode('column1_1', 'column1_1_shortcode');

/* function allow you to insert 1/2 column */
function column1_2_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_half" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_2', 'column1_2_shortcode');

/* function allow you to insert 1/2 column last */
function column1_2_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_half column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_2_last', 'column1_2_last_shortcode');


/* function allow you to insert 1/3 column */
function column1_3_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_third" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_3', 'column1_3_shortcode');

/* function allow you to insert 1/3 column last */
function column1_3_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_third column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_3_last', 'column1_3_last_shortcode');


/* function allow you to insert 2/3 column */
function column2_3_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_third" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_3', 'column2_3_shortcode');

/* function allow you to insert 2/3 column last */
function column2_3_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_third column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_3_last', 'column2_3_last_shortcode');


/* function allow you to insert 1/4 column */
function column1_4_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fourth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_4', 'column1_4_shortcode');

/* function allow you to insert 1/4 column last */
function column1_4_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fourth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_4_last', 'column1_4_last_shortcode');

/* function allow you to insert 3/4 column */
function column3_4_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fourth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_4', 'column3_4_shortcode');

/* function allow you to insert 3/4 column */
function column3_4_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fourth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_4_last', 'column3_4_last_shortcode');


/* function allow you to insert 1/5 column */
function column1_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fifth" ><p>'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_5', 'column1_5_shortcode');

/* function allow you to insert 1/5 column */
function column1_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_5_last', 'column1_5_last_shortcode');

/* function allow you to insert 2/5 column */
function column2_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_5', 'column2_5_shortcode');

/* function allow you to insert 2/5 column */
function column2_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column two_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column2_5_last', 'column2_5_last_shortcode');


/* function allow you to insert 3/5 column */
function column3_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_5', 'column3_5_shortcode');

/* function allow you to insert 3/5 column */
function column3_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column three_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column3_5_last', 'column3_5_last_shortcode');


/* function allow you to insert 4/5 column */
function column4_5_shortcode( $atts, $content = null ) {
	$return = '<div class="column four_fifth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column4_5', 'column4_5_shortcode');

/* function allow you to insert 4/5 column */
function column4_5_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column four_fifth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column4_5_last', 'column4_5_last_shortcode');


/* function allow you to insert 1/6 column */
function column1_6_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_sixth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_6', 'column1_6_shortcode');

/* function allow you to insert 1/6 column */
function column1_6_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column one_sixth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column1_6_last', 'column1_6_last_shortcode');

/* function allow you to insert 5/6 column */
function column5_6_shortcode( $atts, $content = null ) {
	$return = '<div class="column five_sixth" >'.do_shortcode($content).'</div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column5_6', 'column5_6_shortcode');

/* function allow you to insert 5/6 column */
function column5_6_last_shortcode( $atts, $content = null ) {
	$return = '<div class="column five_sixth column_last" >'.do_shortcode($content).'</div><div class="clearboth"></div>';
	$return = parse_shortcode_content($return);
	return $return;
}

add_shortcode('column5_6_last', 'column5_6_last_shortcode');


/*--------------------------- END Columns  -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	7. FlexSlider
/*-----------------------------------------------------------------------------------*/

function flex_images($atts, $content) {
	extract(shortcode_atts(array (
		'url' => 'image %d'
	), $atts));
		
	$i = $GLOBALS['image_count'];
	$GLOBALS['images'][$i] = array ('url' => sprintf ( $url, $GLOBALS['image_count'] ), 'content' => $content);
	$GLOBALS['image_count']++;
}

add_shortcode('flex_image', 'flex_images');


function flex_shortcode ($atts, $content) {
	$GLOBALS['image_count'] = 0;
	$GLOBALS['images'] = '';
	do_shortcode ($content);
	extract(shortcode_atts(array(
		'width'  => '500',
		'height' => '200',
		'effect' => 'fade',
		'slideshowspeed' => '3000'
	), $atts,$content));
	
	if(is_array($GLOBALS['images'])) {
		foreach($GLOBALS['images'] as $image) {
			$images[] = '<li><img src="'.$image['url'].'"/></li>';
		}
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.flexslider').flexslider({
				animation: '<?php echo esc_attr($effect); ?>',
				slideshowSpeed: '<?php echo esc_attr($slideshowspeed); ?>',
				controlNav: false 
			});
		});
	</script>
	
	<?php
		$return = "\n".'<div class="flexslider"><ul class="slides">'.implode( "\n", $images ).'</ul></div>'."\n";
	}
	//echo $return;
	$return = parse_shortcode_content($return);
	return $return;
}
	
add_shortcode('flexslider', 'flex_shortcode');

/*--------------------------- END FlexSlider -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Layer Slider
/*-----------------------------------------------------------------------------------*/

/* layer */
function mpc_ls_slider_layer($atts, $content) {

	extract(shortcode_atts(array (
		'datax'        => '0',
		'datay'        => '0',
		'datadelay'    => '500',
		'dataduration' => '500',
		'dataeasing'   => 'swing',
		'dataeffect'   => 'slideTop',
		'datafade'     => 'on'
	), $atts));
		
	 $i = $GLOBALS['slides_count'];
	 $j = $GLOBALS['layers_count'];

	 $GLOBALS['slides'][$i]['layers'][$j] = array (
		'datax'        => $datax,
		'datay'        => $datay,
		'datadelay'    => $datadelay,
		'dataduration' => $dataduration,
		'dataeasing'   => $dataeasing,
		'dataeffect'   => $dataeffect,
		'datafade'     => $datafade, 
		'content'      => $content
	 );

	 $GLOBALS['layers_count']++;
}

add_shortcode('mpc-ls-slider-layer', 'mpc_ls_slider_layer');

/* slide */
function mpc_ls_slide($atts, $content) {
	

	extract(shortcode_atts(array (
		'background'     => '#ffffff',
		'dataeasing'     => 'easeOutExpo',
		'datatransition' => 'slideLeft',
		'datathumbnail'  => '',
		'class'          => 'class'
	), $atts));
		
	$i = $GLOBALS['slides_count'];

	$GLOBALS['slides'][$i] = array (
		'background'     => $background, 
		'dataeasing'     => $dataeasing,
		'datatransition' => $datatransition,
		'datathumbnail'  => $datathumbnail,
		'class'          => $class,
		'layers'         => ''
	);

	$GLOBALS['layers_count'] = 0;
	do_shortcode($content);

	$GLOBALS['slides_count']++;
}

add_shortcode('mpc-ls-slide', 'mpc_ls_slide');

/* slider */
function mpc_layerslider ($atts, $content) {
	$GLOBALS['slides_count'] = 0;
	$GLOBALS['layers_count'] = 0;
	$GLOBALS['slides'] = '';
	do_shortcode($content);
	extract(shortcode_atts(array(
		'uniqueid'                => 'layer_slider',
		'defaultwidth'            => '960',
		'defaultheight'           => '450',
		'pouseonhover'            => true,
		'slideshow'               => true,
		'slideshowdelay'          => '10000',
		'arrowsoffset'            => '0',
		'shadowstyle'             => '0',
		'transitiontime'          => '1000',
		'showcontrolsonhover'     => true,
		'controlsopacity'         => '1',
		'showbullets'             => true,
		'showarrows'              => true,
		'bulletsverticaloffset'   => '0',
		'bulletshorizontaloffset' => '0',
		'swipegesture'            => true
	), $atts, $content));

	if(is_array($GLOBALS['slides'])) {
		// slides
		for ($i=0; $i < count($GLOBALS['slides'])  ; $i++) { 
			
			@$slide_content = '<li class="'.$GLOBALS['slides'][$i]['class'].'" data-easing="'.$GLOBALS['slides'][$i]['dataeasing'].'" data-transition="'.$GLOBALS['slides'][$i]['datatransition'].'" data-thumbnail="'.$GLOBALS['slides'][$i]['datathumbnail'].'">';
			// background
			@$slide_content .= '<div class="mpc_ls_slide_background" data-style="scale"><img src="'.$GLOBALS['slides'][$i]['background'].'" alt="Image"></div>';
			
			// layers
			for ($j = 0; $j < count($GLOBALS['slides'][$i]['layers']); $j++) { 
				// slide layers
				
				@$slide_content .= '<div class="mpc_ls_slide_item" data-x="'.$GLOBALS['slides'][$i]['layers'][$j]['datax'].'" data-y="'.$GLOBALS['slides'][$i]['layers'][$j]['datay'].'" data-delay="'.$GLOBALS['slides'][$i]['layers'][$j]['datadelay'].'" data-duration="'.$GLOBALS['slides'][$i]['layers'][$j]['dataduration'].'" data-easing="'.$GLOBALS['slides'][$i]['layers'][$j]['dataeasing'].'" data-effect="'.$GLOBALS['slides'][$i]['layers'][$j]['dataeffect'].'" data-fade="'.$GLOBALS['slides'][$i]['layers'][$j]['datafade'].'">'.$GLOBALS['slides'][$i]['layers'][$j]['content'].'</div>';
	
			}

			$slide_content .= '</li>';
			$slides[] = $slide_content;
		}
	?>

	<style>
		#<?php echo $uniqueid; ?> {
			width: 100%;
			height: <?php echo $defaultheight; ?>px;
		} 
	</style>
	
	<script type="text/javascript">

		jQuery(document).ready(function($){
			$('#<?php echo $uniqueid; ?>').mpcLayerSlider( {
				'defaultWidth' 				: <?php echo $defaultwidth; ?>,
				'defaultHeight' 			: <?php echo $defaultheight; ?>,
				'pauseOnHover' 				: <?php echo $pouseonhover; ?>,
				'slideshow' 				: <?php echo $slideshow; ?>,
				'delay' 					: <?php echo $slideshowdelay; ?>,
				'arrowsOffset' 				: <?php echo $arrowsoffset; ?>,
				'shadowStyle' 				: '<?php echo $shadowstyle; ?>',
				'transitionTime' 			: <?php echo $transitiontime; ?>,
				'showControlsOnHover' 		: <?php echo $showcontrolsonhover; ?>,
				'controlsOpacity' 			: <?php echo $controlsopacity; ?>,
				'showBullets' 				: <?php echo $showbullets; ?>,
				'showArrows' 				: <?php echo $showarrows; ?>,
				'bulletsVerticalOffset' 	: <?php echo $bulletsverticaloffset; ?>,
				'bulletsHorizontalOffset' 	: <?php echo $bulletshorizontaloffset; ?>,
				'swipeGesture' 				: <?php echo $swipegesture; ?>
			});
			
		});

	</script>
	
	<?php
		$return = "\n".'<div id="'.$uniqueid.'" class="mpc_ls"><ul>'.implode( "\n", $slides ).'</ul></div>'."\n";
	}
	//echo $return;
	$return = parse_shortcode_content($return);
	return $return;
}
	
add_shortcode('mpc-layerslider', 'mpc_layerslider');

/*--------------------------- END Layer Slider -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	7. Nivo Slider
/*-----------------------------------------------------------------------------------*/

function mpc_nivo_images($atts, $content) {
	extract(shortcode_atts(array (
		'url' => 'image %d',
		'caption' => ''
	), $atts));
		
	$i = $GLOBALS['image_count'];
	$GLOBALS['images'][$i] = array ('url' => sprintf ( $url, $GLOBALS['image_count'] ), 'caption' => sprintf ( $caption, $GLOBALS['image_count'] ),'content' => $content);
	$GLOBALS['image_count']++;
}

add_shortcode('mpc_nivo_image', 'mpc_nivo_images');


function mpc_nivo_shortcode ($atts, $content) {
	$GLOBALS['image_count'] = 0;
	$GLOBALS['images'] = '';
	do_shortcode ($content);
	extract(shortcode_atts(array(
		'width'  => '500',
		'height' => '200',
		'effect' => 'fade',
		'pausetime' => '3000',
		'uniqueid' => 'nivo_slider'
	), $atts,$content));
	
	if(is_array($GLOBALS['images'])) {
		foreach($GLOBALS['images'] as $image) {
	
		if($image['caption'] == ''){
			$images[] = '<img src="'.$image['url'].'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" alt="item" />';
		} else {
			$images[] = '<img src="'.$image['url'].'" width="'.esc_attr($width).'" height="'.esc_attr($height).'" alt="item" title="'.$image['caption'].'"/>';
		}
			
	}
	?>
	
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#<?php echo $uniqueid; ?>').nivoSlider({
				effect: '<?php echo esc_attr($effect); ?>',
				pauseTime: '<?php echo esc_attr($pausetime); ?>',
				directionNav: false,
				controlNav: true
			});
		});
	</script>
	
	<?php
		$return = '<div id="'.$uniqueid.'" class="nivoSlider" style="width: '.$width.'px; height: '.$height.'px;">'.implode('' , $images ).'</div>';
	}
	return $return;
}
	
add_shortcode('mpc_nivo', 'mpc_nivo_shortcode');

/*--------------------------- END Nivo Slider -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	8. Lists
/*-----------------------------------------------------------------------------------*/

function mpc_list_items($atts, $content) {
	extract(shortcode_atts(array (
		'item' => '',
		'type' => '',
		'color' => ''
	), $atts));
	
	$i = $GLOBALS['item_count'];
	$GLOBALS['items'][$i] = array ('type' => sprintf ( $type, $GLOBALS['item_count'] ), 'color' => sprintf ( $color, $GLOBALS['item_count'] ), 'content' => $content);
	$GLOBALS['item_count']++;	
}

add_shortcode('litem', 'mpc_list_items');

function mpc_lists_shortcode($atts, $content = null ) {
	$GLOBALS['item_count'] = 0;
	$GLOBALS['items'] = '';
	do_shortcode ($content);
	extract(shortcode_atts(array(), $atts,$content));
   
  	$output = '<ul class="gentle-list">';

   
   if(is_array($GLOBALS['items'])) {
		foreach($GLOBALS['items'] as $item) {
			$output .= '<li class="gentle-list-'.$item['type'].'"><span class="gentle-'.$item['type'].'" style="color: '.$item['color'].'"></span>' .$item['content']. '</li>';
		}	
	}
	
   $output .= '</ul>';
 
  
   $output = parse_shortcode_content($output);
   return $output;
} 

add_shortcode('list', 'mpc_lists_shortcode');


/*--------------------------- END Lists -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	9. Contact Form
/*-----------------------------------------------------------------------------------*/

function contact_form_shortcode($params = array()) {
	extract(shortcode_atts(array(
	), $params));
	
	$output = '';
	$output = include(get_theme_root() . '/' . get_template() . "/functions/contact-form.php");
	return $output; 
}

add_shortcode('mpc_contact_form', 'contact_form_shortcode');


/*--------------------------- END Contact Form -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	10. Google Maps
/*-----------------------------------------------------------------------------------*/

function mpc_gmaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '640',
      "height" => '480',
      "src" => ''
   ), $atts));
   return '<iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe>';
}
add_shortcode("mpc_google_map", "mpc_gmaps");

/*--------------------------- END Google Maps -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Shortcodes clean up - prevents the empty paragraph at the top of the shortcode
/*-----------------------------------------------------------------------------------*/

// clean up shortcode

function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

?>