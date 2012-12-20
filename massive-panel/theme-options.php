<?php

/*-----------------------------------------------------------------------------------*/
/*	This is a setup file for Massive Panel
/*-----------------------------------------------------------------------------------*/

function mp_options() {

	$shortname = "gentle";
    // Sidebar Array
    $sidebar_array = array("left" => "Left", "right" => "Right", "none" => "None");
    $template_root = get_template_directory_uri();
    //str_replace("localhost", "192.168.0.7", $template_root);

    // Socials Array
    $social_array = array();
        // "email" => array("email.png", "email us", "support@mpcreation.pl"),
        // "dirbbble" => array("dribbble.png", "dribbble", "http://dribbble.com/mpc"),
        // "forrst" => array("forrst.png", "forrst", "http://forrst.com/people/mpc"),
        // "facebook" => array("facebook.png", "facebook", "http://www.facebook.com/MassivePixelCreation"),
        // "twitter" => array("twitter.png", "twitter", "http://twitter.com/#!/mpcreation"),
        // "blog" => array("website.png", "blog", "http://www.blog.mpcreation.pl"),
        // "documentation" => array("documentation.png", "http://www.mpcreation.pl/themeforest/documentation/agera/", ""),
        // "forums" => array("forums.png", "support forums", "http://www.support.mpcreation.pl"));
        
    //number of footer columns
    $number_of_columns = array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5');

    // this array is used for images example (first attribute of the image is used as a description for the image, the second is the path
    $images_array = array("Agera Original" => "patterns/header/p1.png",
        "Pattern 2" => "patterns/header/p2.png",
        "Pattern 3" => "patterns/header/p3.png",
        "Pattern 4" => "patterns/header/p4.png",
        "Pattern 5" => "patterns/header/p5.png",
        "Pattern 6" => "patterns/header/p6.png",
        "Pattern 7" => "patterns/header/p7.png",
        "Pattern 8" => "patterns/header/p8.png",
        "Pattern 9" => "patterns/header/p9.png",
        "Pattern 10" => "patterns/header/p10.png",
		"Pattern 11" => "patterns/header/p11.png",
        "No Pattern" => "patterns/p12.png");

    $images_footer_array = array("Agera Original" => "patterns/p1-original.jpg",
	"Patern 1" => "patterns/p1.png",
        "Pattern 2" => "patterns/p2.png",
        "Pattern 3" => "patterns/p3.png",
        "Pattern 4" => "patterns/p4.png",
        "Pattern 5" => "patterns/p5.png",
        "Pattern 6" => "patterns/p6.png",
        "Pattern 7" => "patterns/p7.png",
        "Pattern 8" => "patterns/p8.png",
        "Pattern 9" => "patterns/p9.png",
        "Pattern 10" => "patterns/p10.png",
		"Pattern 11" => "patterns/p10.png",
        "No Pattern" => "patterns/p12.png");


    // This array is only used as an example
    $test_array = array("one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five");
	$lbox_or_link_array = array("lightbox" => "Lightbox","post_link" => "Link to Post");
    
    // this array is used for the portfolio module
    $columns_array = array("1" => "1", "2" => "2", "3" => "3", "4" => "4");

   // Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the portfolio categories into an array
    $portfolio_categories = array();
   // $portfolio_categories = $options_categories;
    $portfolio_categories_obj = get_categories(array(
                    'taxonomy' => 'portfolio_cat',
                    'hide_empty' => 0
                     ));
    
	if($portfolio_categories_obj != null){
		foreach ($portfolio_categories_obj as $category) {
			$portfolio_categories[$category->slug] = $category->cat_name;
		}
    }

	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	// Options for single page - Portfolio and Blog
	$options_single = array("blog" => "Blog", "portfolio" => "Portfolio");
	
	
	// Pull all the pages that are type protfolio
	$portfolio_pages = array();  
	$portfolio_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$portfolio_pages[''] = 'Select a page:';
	foreach ($portfolio_pages_obj as $page) {
		if(get_post_meta( $page->ID, '_wp_page_template', true) == "portfolio-template.php") // nazwe default zmieniamy na nazwe template naprzyklad portfolio.php
    		$portfolio_pages[$page->ID] = $page->post_title;
	}


    $options = array();
	
	// General section
	$options[] = array( "name" => "General", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "settings.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");	
						
	$options[] = array( "name" => "Main Settings", // Options of type heading represent tabs for sections
						"type" => "heading");
						
			
	$options[] = array( "name" => "Image Logo",
					"desc" => "Choose image (jpeg, jpg, gif, png) which will be displayed as your logo.",
					"desc-pos" => "top",
					"id" => $shortname."_image_logo",
					"type" => "upload",
					"std" => $template_root.'/images/logo.png',
					"hide" => array(
							"state" => "true",
							"desc" => "To display bitmap logo in the header of your website use this option.",
							"related" => $shortname."_logo_link",
							"std" => "checked"
						)
					);
										
						
	$options[] = array( "name" => "Copyright Text",
						"desc" => "This field specifies the copyright text that will be displayed in the special footer widget.",
						"id" => $shortname."_copyright_text",
						"std" => "&#169; 2012 Gentle, All Rights Reserved MassivePixelCreation",
						"help" => "false", 
						"help-desc"  => "This is some help text",
						"validation" => "", 
						"type" => "textarea"); 	

	$options[] = array( "name" => "Display Related Posts",
						"desc" => "Choose this option if you want to display related posts inside a post single view.",
						"id" => $shortname."_related_posts",
						"std" => "1",
						"type" => "checkbox");	

	$options[] = array( "name" => "Display Related Portfolio Items",
						"desc" => "Choose this option if you want to display related portfolio items inside a single portfolio item.",
						"id" => $shortname."_related_portfolio",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Footer Shown",
						"desc" => "Default footer state should it be hidden or visible?",
						"id" => $shortname."_footer_visible",
						"std" => "0",
						"type" => "checkbox");

	$options[] = array( "name" => "Hide Footer on Roll Out",
						"desc" => "When you hover the footer it will show up and when you roll out it will hide",
						"id" => $shortname."_footer_animated",
						"std" => "1",
						"type" => "checkbox");

	$options[] = array( "name" => "Custom CSS",
						"desc" => "If you want to add some custom CSS please do so here.",
						"id" => $shortname."_custom_css",
						"std" => "",
						"help" => "false", 
						"help-desc"  => "This is some help text",
						"validation" => "", 
						"type" => "textarea"); 					
							

	///////////////////////////////////////////////////////////////////////////
	

													
						
						
	////////////////////////////////////////////					
						
		$options[] = array( "name" => "Comments",
							"type" => "heading");
							
		
							
		$options[] = array( "name" => "Comment Name Error",
							"desc" => "This option lets you customize the message displayed when there is a name error.",
							"id" => $shortname."_comment_name_error",
							"std" => "Please enter a valid name.",
							"type" => "text-small");
							
		$options[] = array( "name" => "Comment Email Error",
							"desc" => "This option lets you customize the message displayed when there is a email error.",
							"id" => $shortname."_comment_email_error",
							"std" => "Please enter a valid email.",
							"type" => "text-small");
							
		$options[] = array( "name" => "Comment Comment Error",
							"desc" => "This option lets you customize the message displayed when there is a comment error.",
							"id" => $shortname."_comment_comment_error",
							"std" => "Your comment must be at least 5 charcters long.",
							"type" => "text-small");					
						
	////////////////////////////////////////////////////////////////////////////

	$options[] = array( "name" => "Colors", // When option is type section that mean that it will be displayed as button on the left
					"icon" => "layout.png", // icon has to be placed in massive-panel/images/icons folder
					"type" => "section");						
						
	$options[] = array( "name" => "General", // Options of type heading represent tabs for sections
						"type" => "heading");

	$options[] = array( "name" => "Body Color",
						"desc" => "This is the default color of the text.",
						"help" => "false", 
						"help-desc"  => "This is some help text",
						"id" => $shortname."_body_color",
						"std" => "#515151",
						"type" => "color");	
						
	$options[] = array( "name" => "Menu Font Color",
						"desc" => "This value specifies menu font color.",
						"help" => "false", 
						"help-desc"  => "This is some help text",
						"id" => $shortname."_menu_color",
						"std" => "#515151",
						"type" => "color");
						
	$options[] = array( "name" => "Menu Font Color Selected",
						"desc" => "This value specifies menu font color when item is selected or hovered.",
						"help" => "false", 
						"help-desc"  => "This is some help text",
						"id" => $shortname."_menu_selected_color",
						"std" => "#ff3c10",
						"type" => "color");			
			
	$options[] = array( "name" => "Active Color",
					"desc" => "This color is used for links.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_active_color",
					"std" => "#ff3c10",
					"type" => "color");	
					
	$options[] = array( "name" => "Header Background Color",
					"desc" => "This value specifies the color of header background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_header_color",
					"std" => "#ffffff",
					"type" => "color");	
					
	$options[] = array( "name" => "Background Color",
					"desc" => "This value specifies the color of page background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_color",
					"std" => "#ffffff",
					"type" => "color");	
					
	$options[] = array( "name" => "Footer Background Color",
					"desc" => "This value specifies the color of footer background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_footer_color",
					"std" => "#ffffff",
					"type" => "color");	

	$options[] = array( "name" => "Bottom Footer Background Color",
					"desc" => "This value specifies the color of bottom part of footer background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_bottom_footer_color",
					"std" => "#F9F9F9",
					"type" => "color");	
					
	$options[] = array( "name" => "Lines Color",
					"desc" => "This value specifies the color of lines on the page (deviders).",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_hr_color",
					"std" => "#DDDDDD",
					"type" => "color");

	$options[] = array( "name" => "Decoration Lines Color",
					"desc" => "This value specifies the color of active lines, which are use on hovers.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_active_hr_color",
					"std" => "#ff3c10",
					"type" => "color");

	$options[] = array( "name" => "Forms", // Options of type heading represent tabs for sections
						"type" => "heading");

	/* Forms */			
	$options[] = array( "name" => "Form Background Color",
					"desc" => "This value specifies the color of contact form & comment form inputs background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_color",
					"std" => "#F9F9F9",
					"type" => "color");	
					
	$options[] = array( "name" => "Form Text Color",
					"desc" => "This value specifies the color of contact form & comment form inputs text.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_text_contact_color",
					"std" => "#515151",
					"type" => "color");	
					
	$options[] = array( "name" => "Form Background Color on Focus",
					"desc" => "This value specifies the color of contact form & comment form inputs background on focus.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_focus_color",
					"std" => "#f0f0f0",
					"type" => "color");	
					
	$options[] = array( "name" => "Form Background Color on Error",
					"desc" => "This value specifies the color of contact form & comment form inputs background on error.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_error_color",
					"std" => "#F0F0F0",
					"type" => "color");				
					
	$options[] = array( "name" => "Form Label Color on Error",
					"desc" => "This value specifies the color of contact form & comment form labels on error.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_labels_error_color",
					"std" => "#ff3c10",
					"type" => "color");	
					
	$options[] = array( "name" => "Form Text Color on Error",
					"desc" => "This value specifies the color of contact form & comment form text on error.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_contact_error_color",
					"std" => "#515151",
					"type" => "color");
					
	$options[] = array( "name" => "Form Submit Button Background",
					"desc" => "This value specifies the color of contact form & comment form submit button background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_submit",
					"std" => "#F9F9F9",
					"type" => "color");

	$options[] = array( "name" => "Form Submit Button Border",
					"desc" => "This value specifies the color of contact form & comment form submit button background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_button_border",
					"std" => "#F0F0F0",
					"type" => "color");
					
	$options[] = array( "name" => "Form Submit Button Text",
					"desc" => "This value specifies the color of contact form & comment form submit button text.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_color_contact_submit",
					"std" => "#515151",
					"type" => "color");
					
	$options[] = array( "name" => "Form Submit Button Background on Hover",
					"desc" => "This value specifies the color of contact form & comment form submit button background on hover.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_contact_submit_hover",
					"std" => "#ff3c10",
					"type" => "color");

	$options[] = array( "name" => "Form Submit Button Border on Hover",
					"desc" => "This value specifies the color of contact form & comment form submit button background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_button_border_hover",
					"std" => "#F0F0F0",
					"type" => "color");
					
	$options[] = array( "name" => "Form Submit Button Text on Hover",
					"desc" => "This value specifies the color of contact form & comment form submit button text on hover.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_color_contact_submit_hover",
					"std" => "#FFFFFF",
					"type" => "color");

	$options[] = array( "name" => "Navigation", // Options of type heading represent tabs for sections
						"type" => "heading");

	/* Load More Button */

	$options[] = array( "name" => "Load More Background",
					"desc" => "This value specifies the color of Load More button background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_lm_bg",
					"std" => "#F9F9F9",
					"type" => "color");

	$options[] = array( "name" => "Load More Text",
					"desc" => "This value specifies the color of Load More button text.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_lm_text",
					"std" => "#FF3C10",
					"type" => "color");

	$options[] = array( "name" => "Load More Background on Focus",
					"desc" => "This value specifies the color of Load More button background on focus.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_lm_bg_hover",
					"std" => "#FF3C10",
					"type" => "color");

	$options[] = array( "name" => "Load More Text on Focus",
					"desc" => "This value specifies the color of Load More button text on focus.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_lm_text_hover",
					"std" => "#FFFFFF",
					"type" => "color");

	/* Read More Button */

	$options[] = array( "name" => "Read More Background",
					"desc" => "This value specifies the color Read More button background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_rm_bg",
					"std" => "#D2D6DB",
					"type" => "color");

	$options[] = array( "name" => "Read More Icon",
					"desc" => "This value specifies the color of Read More button icon.",
					"help" => "false",  
					"help-desc"  => "This is some help text",
					"id" => $shortname."_rm_icon",
					"std" => "#FFFFFF",
					"type" => "color");

	$options[] = array( "name" => "Read More Background on Focus",
					"desc" => "This value specifies the color of read more background button on focus.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_rm_bg_hover",
					"std" => "#D2D6DB",
					"type" => "color");

	$options[] = array( "name" => "Read More Icon on Focus",
					"desc" => "This value specifies the color of read more button icon on Focus.",
					"help" => "false",  
					"help-desc"  => "This is some help text",
					"id" => $shortname."_rm_icon_hover",
					"std" => "#333333",
					"type" => "color");


	$options[] = array( "name" => "Other", // Options of type heading represent tabs for sections
						"type" => "heading");

	/* Search */
	
	$options[] = array( "name" => "Search Form Background",
					"desc" => "This value specifies the color of search form background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_bg_search",
					"std" => "#F9F9F9",
					"type" => "color");

	$options[] = array( "name" => "Search Form Text Color",
					"desc" => "This value specifies the color of search form text.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_search_text",
					"std" => "#888888",
					"type" => "color");
					
	$options[] = array( "name" => "Search Form Border Color",
					"desc" => "This value specifies the color of search form border.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_search_border",
					"std" => "#F0F0F0",
					"type" => "color");

	/* Shortcodes */

	$options[] = array( "name" => "Tabs & Accordion Background",
					"desc" => "This value specifies the color of Tabs & Accordion background.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_sc_bg",
					"std" => "#F9F9F9",
					"type" => "color");

	$options[] = array( "name" => "Quote Post Background",
					"desc" => "This value specifies the color of Blockquote background inside the post.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_sc_bg_bq",
					"std" => "#F9F9F9",
					"type" => "color");

	/* Post Hover */

	$options[] = array( "name" => "Active Elements Background Color on Hover",
					"desc" => "This value specifies the color of posts background after hover. Also it specifies the background color of: recent portfolio background, rece posts background etc.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_post_bg_hover",
					"std" => "#F9F9F9",
					"type" => "color");

	$options[] = array( "name" => "Post Overlay Color on Hover",
					"desc" => "This value specifies the color of post overlay when lightbox is enabled.",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_post_overlay_bg",
					"std" => "#FF3C10",
					"type" => "color");

	/* High Lights */					
	
	$options[] = array( "name" => "Highlight Background Color",
					"desc" => "This color is used as highlight background color",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_highlight_color",
					"std" => "#ff3c10",
					"type" => "color");	
					
	$options[] = array( "name" => "Highlight Text Color",
					"desc" => "This color is used as highlight text color",
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"id" => $shortname."_highlight_text_color",
					"std" => "#FFFFFF",
					"type" => "color");	


	/////////////////////////////////////////////////////////////////////////////	
	
	$options[] = array( "name" => "Layout", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "leaf.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");						
						
	$options[] = array( "name" => "Sidebar & Footer", // Options of type heading represent tabs for sections
						"type" => "heading");
						
	$options[] = array( "name" => "Choose Sidebar position for each page.",
						"desc" => "From the drop down choose the page that you are interested in then choose the sidebar position, additionally you can also create unique footer and sidebar for each of the pages.",
						"id" => $shortname."_sidebar",
						"std" => '', 
						"desc-pos" => "top",
						"options-pages" => $options_pages,
						"options-radio" => $sidebar_array,
						"options-columns" => $number_of_columns,
						"sidebar-unique-description" => "Check this option if you want to use unique sidebar for this page.",
						"footer-unique-description" => "Check this option if you want to use unique footer for this page.",
						"footer-columns-decription" => "Choose number of columns for your custom footer.",
						"type" => "choose-sidebar");	
						
	$options[] = array( "name" => "Choose Sidebar position for single page (Blog & Portfolio).",
						"desc" => "From the drop down choose the single page that you are interested in then choose the sidebar position. ",
						"id" => $shortname."_single_sidebar",
						"std" => '', 
						"desc-pos" => "top",
						"options-pages" => $options_single,
						"options-radio" => $sidebar_array,
						"type" => "choose-sidebar-small");			
						
	$options[] = array( "name" => "Number of Footer Columns",
						"std" => "3",
						"desc" => "Specify the number of columns that you would like to display in the footer.",
						"id" => $shortname."_number_of_footer_columns",
						"options" => $number_of_columns,
						"type" => "select");
			
			
	////////////////////////////////////////////////////////////////////////////			
	
	$options[] = array( "name" => "Portfolio", // Options of type heading represent tabs for sections
						"icon" => "portfolio.png",
						"type" => "section");
						
	$options[] = array( "name" => "Main", // Options of type heading represent tabs for sections
						"type" => "heading");
						
	$options[] = array("name" => "Setup Portfolio",
               	"desc" => "Please choose portoflio page you wish to setup, then please select the number of columns you would like to display and finaly choose categories you want to display.",
                "desc-pos" => "top",
                "id" => $shortname."_portfolio",
                "std" => '',
                "portfolio-pages" => $portfolio_pages,
                "desc-portfolio-page" => "Choose Portfolio page you wish to setup.",
                "options-categories" => $portfolio_categories,
                "desc-categories" => "Choose portfolio categories you would like to display on your page.",
                "options-columns" => $columns_array,
                "desc-columns"	=> "Choose number of columns you want to display.",
                "options-radio" => $sidebar_array,                
                "desc-posts" => "Choose number of portfolio items you would like to display per page.",
                "type" => "choose-portfolio");
			
	// Contact section
	$options[] = array( "name" => "Contact", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "phone.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");	
						
	$options[] = array( "name" => "Contact Form", // Options of type heading represent tabs for sections
						"type" => "heading");
						
	$options[] = array( "name" => "Contact Form Email", // this defines the heading of the option
					"desc" => "Specify your contact email.", // this is the field/option description
					"id"   => $shortname."_contact_email", // the id must be unique, it is used to call back the propertie inside the theme
					"std"  => "", // deafult value of the text
					"help" => "false", // should the help icon be displayed (not working yet, better add this to your settings)
					"help-desc"  => "This is some help text", // text for the help tool tip 
					"validation" => "nohtml", /* Each text field can be specialy validated, if the text wont be using HTML tags you can choose here 'nohtml' ect. Choose Between: numeric, multinumeric, nohtml, url, email or dont set it for standard  validation*/
					"type" => "text-small");				
						
	$options[] = array( "name" => "Name",
						"desc" => "This option lets you customize the label inside the Name field.",
						"id" => $shortname."_cf_name",
						"std" => "Name",
						"type" => "text-small");
						
	$options[] = array( "name" => "Email",
						"desc" => "This option lets you customize the label inside the Email field.",
						"id" => $shortname."_cf_email",
						"std" => "Email",
						"type" => "text-small");
						
	$options[] = array( "name" => "Message",
						"desc" => "This option lets you customize the label inside the Message field.",
						"id" => $shortname."_cf_message",
						"std" => "Message",
						"type" => "text-small");
						
	$options[] = array( "name" => "Send Button",
						"desc" => "This option lets you customize the label of send button.",
						"id" => $shortname."_cf_send",
						"std" => "Send Message",
						"type" => "text-small");
						
	$options[] = array( "name" => "Name Error",
						"desc" => "This option lets you customize the message displayed when there is a name error.",
						"id" => $shortname."_cf_name_error",
						"std" => "Please enter a valid name.",
						"type" => "text-small");
						
	$options[] = array( "name" => "Email Error",
						"desc" => "This option lets you customize the message displayed when there is an email error.",
						"id" => $shortname."_cf_email_error",
						"std" => "Please enter a valid email address.",
						"type" => "text-small");
						
	$options[] = array( "name" => "Message Error",
						"desc" => "This option lets you customize the message displayed when there is a message error.",
						"id" => $shortname."_cf_message_error",
						"std" => "Message must be at least 5 characters.",
						"type" => "text-small");				
						
	$options[] = array( "name" => "Message Sent",
						"desc" => "This option lets you customize the message displayed when the message is successfully sent.",
						"id" => $shortname."_cf_success",
						"std" => "Thank you, message was successfully sent.",
						"type" => "text-small");
						
	$options[] = array( "name" => "Message Not Sent",
						"desc" => "This option lets you customize the message displayed when the message is not sent.",
						"id" => $shortname."_cf_error",
						"std" => "There was an error submitting the form.",
						"type" => "text-small");
						
						
	////////////////////////////////////////////////////////////////	

	
	// Social Networks section
	$options[] = array( "name" => "Social Networks", // When option is type section that mean that it will be displayed as button on the left
						"icon" => "wire.png", // icon has to be placed in massive-panel/images/icons folder
						"type" => "section");	
	
	$options[] = array( "name" => "Social Icons", // Options of type heading represent tabs for sections
						"type" => "heading");
						
	$options[] = array( "name" => "Facebook Icon",
						"desc" => "Choose this option if you want to display Facebook Icon in the footer.",
						"id" => $shortname."_facebook_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Facebook Link", 
					"desc" => "Specify Facebook account url.", 
					"id"   => $shortname."_facebook_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Twitter Icon",
						"desc" => "Choose this option if you want to display Twitter Icon in the footer.",
						"id" => $shortname."_twitter_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Twitter Link", 
					"desc" => "Specify Twitter account url.", 
					"id"   => $shortname."_twitter_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Google Icon",
						"desc" => "Choose this option if you want to display Google Icon in the footer.",
						"id" => $shortname."_google_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Google Link", 
					"desc" => "Specify Google account url.", 
					"id"   => $shortname."_google_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
						
	$options[] = array( "name" => "RSS Icon",
						"desc" => "Choose this option if you want to display RSS Icon in the footer.",
						"id" => $shortname."_rss_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "RSS Link", 
					"desc" => "Specify RSS url.", 
					"id"   => $shortname."_rss_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Dribbble Icon",
						"desc" => "Choose this option if you want to display Dribbble Icon in the footer.",
						"id" => $shortname."_dribbble_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Dribbble Link", 
					"desc" => "Specify Dribbble account url.", 
					"id"   => $shortname."_dribbble_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Vimeo Icon",
						"desc" => "Choose this option if you want to display Vimeo Icon in the footer.",
						"id" => $shortname."_vimeo_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Vimeo Link", 
					"desc" => "Specify Vimeo account url.", 
					"id"   => $shortname."_vimeo_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "YouTube Icon",
						"desc" => "Choose this option if you want to display YouTube Icon in the footer.",
						"id" => $shortname."_youtube_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "YouTube Link", 
					"desc" => "Specify YouTube account url.", 
					"id"   => $shortname."_youtube_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Skype Icon",
						"desc" => "Choose this option if you want to display Skype Icon in the footer.",
						"id" => $shortname."_skype_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Skype Link", 
					"desc" => "Specify Skype account url.", 
					"id"   => $shortname."_skype_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "MySpace Icon",
						"desc" => "Choose this option if you want to display MySpace Icon in the footer.",
						"id" => $shortname."_myspace_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "MySpace Link", 
					"desc" => "Specify MySpace account url.", 
					"id"   => $shortname."_myspace_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Forrst Icon",
						"desc" => "Choose this option if you want to display Forrst Icon in the footer.",
						"id" => $shortname."_forrst_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Forrst Link", 
					"desc" => "Specify Forrst account url.", 
					"id"   => $shortname."_forrst_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Flickr Icon",
						"desc" => "Choose this option if you want to display Flickr Icon in the footer.",
						"id" => $shortname."_flickr_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Flickr Link", 
					"desc" => "Specify Flickr account url.", 
					"id"   => $shortname."_flickr_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Deviant Art Icon",
						"desc" => "Choose this option if you want to display Deviant Art Icon in the footer.",
						"id" => $shortname."_deviant_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Deviant Art Link", 
					"desc" => "Specify Deviant Art account url.", 
					"id"   => $shortname."_deviant_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "Digg Icon",
						"desc" => "Choose this option if you want to display Digg Icon in the footer.",
						"id" => $shortname."_digg_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Digg Link", 
					"desc" => "Specify Digg account url.", 
					"id"   => $shortname."_digg_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "LinkedIn Icon",
						"desc" => "Choose this option if you want to display LinkedIn Icon in the footer.",
						"id" => $shortname."_linkedin_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "LinkedIn Link", 
					"desc" => "Specify LinkedIn account url.", 
					"id"   => $shortname."_linkedin_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "LastFM Icon",
						"desc" => "Choose this option if you want to display LastFM Icon in the footer.",
						"id" => $shortname."_lastfm_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "LastFM Link", 
					"desc" => "Specify LastFM account url.", 
					"id"   => $shortname."_lastfm_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
	
	$options[] = array( "name" => "Picasa Icon",
						"desc" => "Choose this option if you want to display Picasa Icon in the footer.",
						"id" => $shortname."_picasa_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Picasa Link", 
					"desc" => "Specify Picasa account url.", 
					"id"   => $shortname."_picasa_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
					
	$options[] = array( "name" => "StumbleUpon Icon",
						"desc" => "Choose this option if you want to display StumbleUpon Icon in the footer.",
						"id" => $shortname."_stumble_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "StumbleUpon Link", 
					"desc" => "Specify StumbleUpon account url.", 
					"id"   => $shortname."_stumble_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Share Icon",
						"desc" => "Choose this option if you want to display Share Icon in the footer.",
						"id" => $shortname."_share_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Share Link", 
					"desc" => "Specify Share url.", 
					"id"   => $shortname."_share_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Quora Icon",
						"desc" => "Choose this option if you want to display Quora Icon in the footer.",
						"id" => $shortname."_quora_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Quora Link", 
					"desc" => "Specify Quora url.", 
					"id"   => $shortname."_quora_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Ember Icon",
						"desc" => "Choose this option if you want to display Ember Icon in the footer.",
						"id" => $shortname."_ember_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Ember Link", 
					"desc" => "Specify Ember url.", 
					"id"   => $shortname."_ember_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Delicious Icon",
						"desc" => "Choose this option if you want to display Delicious Icon in the footer.",
						"id" => $shortname."_delicious_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Delicious Link", 
					"desc" => "Specify Delicious url.", 
					"id"   => $shortname."_delicious_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");

	$options[] = array( "name" => "Thumblr Icon",
						"desc" => "Choose this option if you want to display Thumblr Icon in the footer.",
						"id" => $shortname."_thumblr_icon",
						"std" => "1",
						"type" => "checkbox");				
					
	$options[] = array( "name" => "Thumblr Link", 
					"desc" => "Specify Thumblr url.", 
					"id"   => $shortname."_thumblr_link", 
					"std"  => "#", 
					"help" => "false", 
					"help-desc"  => "This is some help text",
					"validation" => "nohtml",
					"type" => "text-small");
	
	////////////////////////////////////////////
	
   

    // header settings, main heading and socials						
    $options[] = array("name" => "Greetings, I am Massive Panel", // this is the main heading from thr header
        "desc" => "use me wisely to customize your theme.", // this is the line of description used in the header
        "type" => "top-header");

    $options[] = array("options" => $social_array,
        "type" => "top-socials");

    return $options;
}

/* ----------------------------------------------------------------------------------- */
/* 	Contextual Help
  /*----------------------------------------------------------------------------------- */

function mp_options_page_contextual_help() {
    $text = "<h3>" . __('Massive Panel Settings - Contextual Help', 'agera') . "</h3>";
    $text .= "<p>" . __('Contextual Help Goes Here', 'agera') . "</p>";

    return $text;
}

?>