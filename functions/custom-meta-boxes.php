<?php 

/*-----------------------------------------------------------------------------------*/
/*	Custom Meta Boxes
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Add Meta Boxes
/*-----------------------------------------------------------------------------------*/

function add_pages_meta_box() {
	$post_id = '';
	
	if(isset($_GET['post']))
		$post_id =  $_GET['post'];
	elseif(isset($_POST['post_ID']))
		$post_id = $_POST['post_ID'];
		
	$template_file = get_post_meta($post_id, '_wp_page_template',TRUE);
	
	/* blog page settings*/
	if($template_file == 'blog-template.php') 
		add_meta_box( 'blog-settings', 'Blog Settings', 'blog_meta_box', 'page', 'normal');

  /* portfolio page settings */
  if($template_file == 'portfolio-template.php') 
    add_meta_box( 'portfolio-settings', 'Portfolio Settings', 'portfolio_meta_box', 'page', 'normal');

  /* Home meta */
  if($template_file == 'home-template.php') 
    add_meta_box( 'home-settings', 'Home Settings', 'home_meta_box', 'page', 'normal');

	/* blog post settings */
	add_meta_box( 'post-settings', 'Post Settings', 'post_meta_box', 'post', 'normal');

  /* portfolio post settings */
  add_meta_box( 'portfolio-post-settings', 'Project Settings', 'portfolio_post_meta_box', 'portfolio', 'normal');
}

add_action( 'add_meta_boxes', 'add_pages_meta_box' );  


/*-----------------------------------------------------------------------------------*/
/*  Home Page Settings
/*-----------------------------------------------------------------------------------*/

function home_meta_box($post) {
  
  wp_nonce_field( 'mpc_home_meta_box_nonce', 'home_meta_box_nonce'); 
  
  $values = get_post_custom($post->ID);
  
  if(isset( $values['home_sc'] )) {
    $home_sc =  esc_attr( $values['home_sc'][0]);
  } else { 
    $home_sc = "";
  }
  
  $box_output = '';

  $box_output .= '<label for="home_sc">Shortcode Asset:</label></br> ';
  $box_output .= '<textarea type="text" name="home_sc" id="home_sc" style="width: 100%; height: 200px;">'.$home_sc.'</textarea></br>';
    
  echo $box_output;
}

function save_home_meta_box($post_id) {
  
  // Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['home_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['home_meta_box_nonce'], 'mpc_home_meta_box_nonce' ) ) return; 
  
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
   
    // now we can actually save the data  
    $allowed = array(  
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )  
    );  
      //echo 'DUPA = '.$_POST['home_sc'];
    if(isset($_POST['home_sc']))  
        update_post_meta( $post_id, 'home_sc', $_POST['home_sc']); 
    
}

add_action('save_post', 'save_home_meta_box');

/*-----------------------------------------------------------------------------------*/
/*  Portfolio Page Settings
/*-----------------------------------------------------------------------------------*/

function portfolio_meta_box($post) {
  
  wp_nonce_field( 'mpc_portfolio_meta_box_nonce', 'portfolio_meta_box_nonce'); 
  
  $values = get_post_custom($post->ID);
  
  if(isset( $values['portfolio_type'] )) {
    $portfolio_type =  esc_attr( $values['portfolio_type'][0] );
  } else { 
    $portfolio_type = "";
  }
  
  $box_output = '';

  $box_output .= '<label for="portfolio_type">Portfolio Type</label> ';
  $box_output .= '<select name="portfolio_type" id="portfolio_type">';
  $box_output .= '<option value="masonry"' .(($portfolio_type == 'masonry') ? 'selected="selected"' : ''). '>Masonry</option>';
  $box_output .= '<option value="stacked"' .(($portfolio_type == 'stacked') ? 'selected="selected"' : ''). '>Stacked Masonry</option>';
  $box_output .= '</select>';
    
  echo $box_output;
}

function save_portfolio_meta_box($post_id) {
  
  // Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['portfolio_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_meta_box_nonce'], 'mpc_portfolio_meta_box_nonce' ) ) return; 
  
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
   
    // now we can actually save the data  
    $allowed = array(  
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )  
    );  
      
    if(isset($_POST['portfolio_type']))  
        update_post_meta( $post_id, 'portfolio_type', wp_kses($_POST['portfolio_type'], $allowed)); 
    
}

add_action('save_post', 'save_portfolio_meta_box');

/*-----------------------------------------------------------------------------------*/
/*  Portfolio Post Settings
/*-----------------------------------------------------------------------------------*/

function portfolio_post_meta_box($post) {
  
  wp_nonce_field( 'mpc_portfolio_post_meta_box_nonce', 'portfolio_post_meta_box_nonce'); 
  
  $values = get_post_custom($post->ID);
    
  if(isset( $values['post_shortcode'] ))
    $post_shortcode =  esc_attr( $values['post_shortcode'][0] );
  else 
    $post_shortcode = '';

  if(isset($values['lightbox_enable'] ))
    $lightbox_enable =  esc_attr( $values['lightbox_enable'][0] );
  else 
    $lightbox_enable = "off"; 
  
  $lightbox_enable = checked($lightbox_enable, 'on', false);
  
  if(isset( $values['caption'] ))
    $caption =  esc_attr( $values['caption'][0] );
  else 
    $caption = "";
        
  if(isset( $values['lightbox_src'] ))
    $lightbox_src =  esc_attr( $values['lightbox_src'][0] );
  else 
    $lightbox_src = "";
  
  $box_output = '';
    
    $box_output .= '<label for="post_shortcode">Shortcode Asset:</label></br> ';
    $box_output .= '<textarea type="text" name="post_shortcode" id="post_shortcode" style="width: 100%; height: 200px;">'.$post_shortcode.'</textarea></br>';

    $box_output .= '<label for="lightbox_enable">Enable Lightbox</label> ';
    $box_output .= '<input type="checkbox" id="lightbox_enable" name="lightbox_enable"'.$lightbox_enable.'/></br>';
    
    $box_output .= '<label for="caption">Lightbox Caption</label> ';  
    $box_output .= '<input type="text" name="caption" id="caption" value="'.$caption.'"/></br>';
    
    $box_output .= '<label for="lightbox_src">Lightbox Source</label> ';  
    $box_output .= '<input type="text" name="lightbox_src" id="lightbox_src" value="'.$lightbox_src.'"/></br>';           
  
    echo $box_output;
}

function save_portfolio_post_meta_box($post_id) {
  
  // Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['portfolio_post_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['portfolio_post_meta_box_nonce'], 'mpc_portfolio_post_meta_box_nonce' ) ) return; 
  
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
   
    // now we can actually save the data  
    $allowed = array(  
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )  
    );  
      
    if(isset($_POST['post_shortcode']))  
        update_post_meta( $post_id, 'post_shortcode', $_POST['post_shortcode']); 

    if(isset($_POST['lightbox_enable']) && $_POST['lightbox_enable']) 
      $lightbox_enable = 'on';
    else 
      $lightbox_enable = 'off';
      
    update_post_meta( $post_id, 'lightbox_enable', $lightbox_enable);
      
    if(isset($_POST['caption']))  
        update_post_meta( $post_id, 'caption', wp_kses($_POST['caption'], $allowed)); 
        
    if(isset($_POST['lightbox_src']))  
        update_post_meta( $post_id, 'lightbox_src', wp_kses($_POST['lightbox_src'], $allowed));
    
}

add_action('save_post', 'save_portfolio_post_meta_box');

/*-----------------------------------------------------------------------------------*/
/*	Blog Page Settings
/*-----------------------------------------------------------------------------------*/

function blog_meta_box($post) {
	
	wp_nonce_field( 'mpc_blog_meta_box_nonce', 'blog_meta_box_nonce'); 
	
	$values = get_post_custom($post->ID);
	
	if(isset( $values['blog_type'] )) {
		$blog_type =  esc_attr( $values['blog_type'][0] );
	} else { 
		$blog_type = "";
	}
	
	$box_output = '';

	$box_output .= '<label for="blog_type">Blog Type</label> ';
   	$box_output .= '<select name="blog_type" id="blog_type">';
   	$box_output .= '<option value="masonry"' .(($blog_type == 'masonry') ? 'selected="selected"' : ''). '>Masonry</option>';
   	$box_output .= '<option value="stacked"' .(($blog_type == 'stacked') ? 'selected="selected"' : ''). '>Stacked Masonry</option>';
   	$box_output .= '<option value="blog1" ' .(($blog_type == 'blog1') ? 'selected="selected"' : ''). '>One Column</option>';
   	$box_output .= '<option value="blog2"' .(($blog_type == 'blog2') ? 'selected="selected"' : ''). '>Classic Style 1</option>';
   	$box_output .= '<option value="blog3"' .(($blog_type == 'blog3') ? 'selected="selected"' : ''). '>Classic Style 2</option>';
   	$box_output .= '<option value="blog4"' .(($blog_type == 'blog4') ? 'selected="selected"' : ''). '>Classic Style 3</option>';
   	$box_output .= '<option value="blog5"' .(($blog_type == 'blog5') ? 'selected="selected"' : ''). '>Classic Style 4</option>';
   	$box_output .= '</select>';
   	
   	echo $box_output;
}

function save_blog_meta_box($post_id) {
	
	// Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['blog_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['blog_meta_box_nonce'], 'mpc_blog_meta_box_nonce' ) ) return; 
 	
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
 	 
    // now we can actually save the data  
    $allowed = array(  
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )  
    );  
      
    if(isset($_POST['blog_type']))  
        update_post_meta( $post_id, 'blog_type', wp_kses($_POST['blog_type'], $allowed)); 
  	
}

add_action('save_post', 'save_blog_meta_box');

/*-----------------------------------------------------------------------------------*/
/*	Blog Post Settings
/*-----------------------------------------------------------------------------------*/

function post_meta_box($post) {
	
	wp_nonce_field( 'mpc_post_meta_box_nonce', 'post_meta_box_nonce'); 
	
	$values = get_post_custom($post->ID);
		
	if(isset( $values['post_shortcode'] ))
		$post_shortcode =  esc_attr( $values['post_shortcode'][0] );
	else 
		$post_shortcode = '';

	if(isset($values['lightbox_enable'] ))
		$lightbox_enable =  esc_attr( $values['lightbox_enable'][0] );
	else 
		$lightbox_enable = "off";	
	
	$lightbox_enable = checked($lightbox_enable, 'on', false);
	
	if(isset( $values['caption'] ))
		$caption =  esc_attr( $values['caption'][0] );
	else 
		$caption = "";
				
	if(isset( $values['lightbox_src'] ))
		$lightbox_src =  esc_attr( $values['lightbox_src'][0] );
	else 
		$lightbox_src = "";
	
	$box_output = '';
   	
   	$box_output .= '<label for="post_shortcode">Shortcode Asset:</label></br> ';
   	$box_output .= '<textarea type="text" name="post_shortcode" id="post_shortcode" style="width: 100%; height: 200px;">'.$post_shortcode.'</textarea></br>';

   	$box_output .= '<label for="lightbox_enable">Enable Lightbox</label> ';
   	$box_output .= '<input type="checkbox" id="lightbox_enable" name="lightbox_enable"'.$lightbox_enable.'/></br>';
   	
   	$box_output .= '<label for="caption">Lightbox Caption</label> '; 	
   	$box_output .= '<input type="text" name="caption" id="caption" value="'.$caption.'"/></br>';
   	
   	$box_output .= '<label for="lightbox_src">Lightbox Source</label> '; 	
   	$box_output .= '<input type="text" name="lightbox_src" id="lightbox_src" value="'.$lightbox_src.'"/></br>';           
	
   	echo $box_output;
}

function save_post_meta_box($post_id) {
	
	// Bail if we're doing an auto save  
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return; 
 
    // if our nonce isn't there, or we can't verify it, bail 
    if( !isset( $_POST['post_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['post_meta_box_nonce'], 'mpc_post_meta_box_nonce' ) ) return; 
 	
    // if our current user can't edit this post, bail  
    if( !current_user_can( 'edit_post' ) ) return;  
 	 
    // now we can actually save the data  
    $allowed = array(  
        'a' => array( // on allow a tags  
            'href' => array() // and those anchors can only have href attribute  
        )  
    );  
      
    if(isset($_POST['post_shortcode']))  
        update_post_meta( $post_id, 'post_shortcode', $_POST['post_shortcode']); 

    if(isset($_POST['lightbox_enable']) && $_POST['lightbox_enable']) 
    	$lightbox_enable = 'on';
    else 
     	$lightbox_enable = 'off';
     	
    update_post_meta( $post_id, 'lightbox_enable', $lightbox_enable);
     	
    if(isset($_POST['caption']))  
        update_post_meta( $post_id, 'caption', wp_kses($_POST['caption'], $allowed)); 
        
    if(isset($_POST['lightbox_src']))  
        update_post_meta( $post_id, 'lightbox_src', wp_kses($_POST['lightbox_src'], $allowed));
  	
}

add_action('save_post', 'save_post_meta_box');

?>