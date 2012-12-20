<?php

/*-----------------------------------------------------------------------------------*/
/*	Button Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['button'] = array(
	'preview' => 'true',
	'shortcode' => '[button class="{{class}}" background="{{background}}" url="{{url}}" text_color="{{text_color}}" background_hover="{{background_hover}}" text_color_hover="{{text_color_hover}}"] {{content}} [/button]',
	'title' => __('Insert Button Shortcode', 'gentle'),
	'fields' => array(
		'content' => array(
			'std' => 'Button Text',
			'type' => 'text',
			'title' => __('Text', 'gentle'),
			'desc' => __('Specify text which will be displayed isnide the button.', 'gentle')
		),
		'class' => array(
			'std' => 'mpc-button-1',
			'type' => 'text',
			'title' => __('Unique Name', 'gentle'),
			'desc' => __('Specify button unique name, no spaces and special characters you can use _ and -', 'gentle')
		),
		'url' => array(
			'std' => '#',
			'type' => 'text',
			'title' => __('Button URL', 'gentle'),
			'desc' => __('Button URL.', 'gentle')
		),
		'background' => array(
			'std' => '#F9625B',
			'type' => 'text',
			'title' => __('Background Color', 'gentle'),
			'desc' => __('Button background color.', 'gentle')
		),
		'text_color' => array(
			'std' => '#FFFFFF',
			'type' => 'text',
			'title' => __('Text Color', 'gentle'),
			'desc' => __('Specify text color.', 'gentle')
		),
		'background_hover' => array(
			'std' => '#F9625B',
			'type' => 'text',
			'title' => __('Background Hover Color', 'gentle'),
			'desc' => __('Button background color after hover.', 'gentle')
		),
		'text_color_hover' => array(
			'std' => '#242424',
			'type' => 'text',
			'title' => __('Text Hover Color', 'gentle'),
			'desc' => __('Button text color after hover.', 'gentle')
		)
	)
);

/*--------------------------- END Button -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Headings
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['heading'] = array(
	'preview' => 'partial',
	'shortcode' => '[mpc_heading heading="{{heading}}" subheading="{{subheading}}" align="{{align}}"]',
	'title' => __('Insert Heading Shortcode', 'gentle'),
	'fields' => array(
		'heading' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Heading', 'gentle'),
			'desc' => __('Define Heading text.', 'gentle')
		),
		'subheading' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Subheading', 'gentle'),
			'desc' => __('Define subheading', 'gentle')
		),
		'align' => array(
			'type' => 'select',
			'title' => __('Align', 'gentle'),
			'desc' => __('Select the type, align type.', 'gentle'),
			'options' => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center'
			)
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Drop Caps
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['dropcaps'] = array(
	'preview' => 'true',
	'shortcode' => '[mpc_dropcaps background="{{background}}" color="{{color}}" size="{{size}}"] {{content}} [/mpc_dropcaps]',
	'title' => __('Insert YouTube Shortcode', 'gentle'),
	'fields' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Content', 'gentle'),
			'desc' => __('Define the leter.', 'gentle')
		),
		'background' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Background', 'gentle'),
			'desc' => __('Define background color (HEX value).', 'gentle')
		),
		'color' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Color', 'gentle'),
			'desc' => __('Define text color (HEX value).', 'gentle')
		),
		'size' => array(
			'type' => 'select',
			'title' => __('Align', 'gentle'),
			'desc' => __('Select the type, align type.', 'gentle'),
			'options' => array(
				'normal' => 'normal',
				'big' => 'big'
			)
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Portfolio
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['recentportfolio'] = array(
	'preview' => 'partial',
	'shortcode' => '[mpc_recent_portfolio number="{{number}}"]',
	'title' => __('Insert Recent Portfolio Shortcode', 'gentle'),
	'fields' => array(
		'number' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Number of Posts', 'gentle'),
			'desc' => __('Define number of posts that will rotate in the carousel.', 'gentle')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['recentposts'] = array(
	'preview' => 'partial',
	'shortcode' => '[mpc_recent_posts number="{{number}}"]',
	'title' => __('Insert Recent Posts Shortcode', 'gentle'),
	'fields' => array(
		'number' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Number of Posts', 'gentle'),
			'desc' => __('Define number of posts that will rotate in the carousel.', 'gentle')
		)
	)
);

/*-----------------------------------------------------------------------------------*/
/*	YouTube Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['youtube'] = array(
	'preview' => 'partial',
	'shortcode' => '[youtube video="{{video}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert YouTube Shortcode', 'gentle'),
	'fields' => array(
		'video' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Video ID', 'gentle'),
			'desc' => __('Paste YouTube video id, example: 090WQvJAOec', 'gentle')
		),
		'width' => array(
			'std' => '375',
			'type' => 'text',
			'title' => __('Video Width', 'gentle'),
			'desc' => __('Video width in pixels.', 'gentle')
		),
		'height' => array(
			'std' => '225',
			'type' => 'text',
			'title' => __('Video Height', 'gentle'),
			'desc' => __('Video height in pixels.', 'gentle')
		)
	)
);

/*--------------------------- END YouTube -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['vimeo'] = array(
	'preview' => 'partial',
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert Vimeo Shortcode', 'gentle'),
	'fields' => array(
		'id' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Video ID', 'gentle'),
			'desc' => __('Paste Vimeo video id, example: 22945553', 'gentle')
		),
		'width' => array(
			'std' => '375',
			'type' => 'text',
			'title' => __('Video Width', 'gentle'),
			'desc' => __('Video width in pixels.', 'gentle')
		),
		'height' => array(
			'std' => '225',
			'type' => 'text',
			'title' => __('Video Height', 'gentle'),
			'desc' => __('Video height in pixels.', 'gentle')
		)
	)
);

/*--------------------------- END Vimeo -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Toggle Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['toggle'] = array(
	'preview' => 'true',
	'shortcode' => '[toggle title="{{title}}"] {{content}} [/toggle]',
	'title' => __('Insert Toggle Shortcode', 'gentle'),
	'fields' => array(
		'title' => array(
			'type' => 'text',
			'std' 	=> 'Toggle Title',
			'title' => __('Toggle\'s Title', 'gentle'),
			'desc' => __('Input toggle\'s title.', 'gentle'),
		), 
		'content' => array(
			'std' => 'Here paste the paragraph that you wish to toggle.',
			'type' => 'textarea',
			'title' => __('Toggle\'s Text', 'gentle'),
			'desc' => __('Add toggle\'s text.', 'gentle'),
		)
	)
);

/*--------------------------- END Toggle -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Column Icons Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['columnicons'] = array(
	'preview' => 'partial',
	'shortcode' => '[mpc_icon_columns] {{inside}}[/mpc_icon_columns]',
	'title' => __('Insert Icon Columns Shortcode', 'gentle'),
	'fields' => array(),
	'inside' => array(
		'shortcode' => '[mpc_icon_column heading="{{heading}}" icon="{{icon}}"] {{content}} [/mpc_icon_column] ',
		'add_section' => __('Add Column', 'gentle'),
		'remove_section' => __('Remove Column', 'gentle'),
		'fields' => array(
			'heading' => array(
				'type' => 'text',
				'title' => __('Column Heading', 'gentle'),
				'desc' => __('Define column heading', 'gentle'),
				'std' => 'Title'
			),
			'icon' => array(
				'type' => 'select',
				'title' => __('Icon', 'gentle'),
				'desc' => __('Select the icon.', 'gentle'),
				'options' => array(
					'responsive' => 'Responsive',
					'settings' => 'Settings',
					'love' => 'Love',
					'cloud' => 'Cloud'
				)
			),
			'content' => array(
				'type' => 'textarea',
				'title' => __('Column Content', 'gentle'),
				'desc' => __('Define column content', 'gentle'),
				'std' => 'Content'
			)
		)
	)
);

/*--------------------------- END Tabs -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['tabs'] = array(
	'preview' => 'partial',
	'shortcode' => '[tabs] {{inside}}[/tabs]',
	'title' => __('Insert Tabbed Content Shortcode', 'gentle'),
	'fields' => array(),
	'inside' => array(
		'shortcode' => '[tab title="{{title}}"] {{content}} [/tab] ',
		'add_section' => __('Add Tab', 'gentle'),
		'remove_section' => __('Remove Tab', 'gentle'),
		'fields' => array(
			'title' => array(
				'type' => 'text',
				'title' => __('Tab Title', 'gentle'),
				'desc' => __('Add the title for this tab', 'gentle'),
				'std' => 'Tab Title'
			),
			'content' => array(
				'std' => 'Example tab content.',
				'type' => 'textarea',
				'title' => __('Tab Content', 'gentle'),
				'desc' => __('Add the tab content.', 'gentle'),
			)
		)
	)
);

/*--------------------------- END Tabs -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
$mpc_shortcodes['columns'] = array(
	'preview' => 'false',
	'shortcode' => ' {{inside}} ',
	'title' => __('Insert Columns Shortcode', 'gentle'),
	'fields' => array(),
	'inside' => array( // when shortcode has two tags you need to define the second one in the inside array
		'shortcode' => '[{{column}}] {{content}} [/{{column}}] ',
		'add_section' => __('Add Column', 'gentle'),
		'remove_section' => __('Remove Column', 'gentle'),
		'fields' => array(
			'column' => array(
				'type' => 'select',
				'title' => __('Column Type', 'gentle'),
				'desc' => __('Select the type, ie width of the column.', 'gentle'),
				'options' => array(
					'column1_2' => 'One Half',
					'column1_2_last' => 'One Half Last',
					'column1_3' => 'One Third',
					'column1_3_last' => 'One Third Last',
					'column2_3' => 'Two Thirds',
					'column2_3_last' => 'Two Thirds Last',
					'column1_4' => 'One Fourth',
					'column1_4_last' => 'One Fourth Last',
					'column3_4' => 'Three Fourth',
					'column3_4_last' => 'Three Fourth Last',
					'column1_5' => 'One Fifth',
					'column1_5_last' => 'One Fifth Last',
					'column2_5' => 'Two Fifth',
					'column2_5_last' => 'Two Fifth Last',
					'column3_5' => 'Three Fifth',
					'column3_5_last' => 'Three Fifth Last',
					'column4_5' => 'Four Fifth',
					'column4_5_last' => 'Four Fifth Last',
					'column1_6' => 'One Sixth',
					'column1_6_last' => 'One Sixth Last',
					'column5_6' => 'Five Sixth',
					'column5_6_last' => 'Five Sixth Last'
				)
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'title' => __('Column Content', 'gentle'),
				'desc' => __('Add the column content.', 'gentle'),
			)
		)
	)
);
/*--------------------------- END Columns -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['lists'] = array(
	'preview' => 'true',
	'shortcode' => '[list] {{inside}} [/list]',
	'title' => __('Insert Columns Shortcode', 'gentle'),
	'fields' => array(),
	'inside' => array( 
		'shortcode' => '[litem type="{{type}}" color="{{color}}"] {{item}} [/litem]',
		'add_section' => __('Add New List Item', 'gentle'),
		'remove_section' => __('Remove List Item', 'gentle'),
		'fields' => array(
			'item' => array(
				'type' => 'textarea',
				'title' => __('List Item Content', 'gentle'),
				'std' => __('List Item', 'gentle'),
				'desc' => __('Specify the list item content.', 'gentle'),
			),
			'color' => array(
				'type' => 'text',
				'title' => __('Icon Color', 'gentle'),
				'std' => __('#515151', 'gentle'),
				'desc' => __('Specify the list item content.', 'gentle'),
			),
			'type' => array(
			'type' => 'select',
			'title' => __('List Type', 'gentle', 'gentle'),
			'desc' => __('Specify the list type', 'gentle'),
			'options' => array(
					'icon-plus' => 'plus',
					'icon-minus' => 'minus',
					'icon-info' => 'info',
					'icon-left' => 'left',
					'icon-up' => 'up',
					'icon-right' => 'right',
					'icon-down' => 'down',
					'icon-level-down' => 'level down',
					'icon-home' => 'home',
					'icon-keyboard' => 'keyboard',
					'icon-pause' => 'pause',
					'icon-fast-fw' => 'fast fw',
					'icon-fast-bw' => 'fast bw',
					'icon-to-end' => 'to end',
					'icon-to-start' => 'to start',
					'icon-hourglass' => 'hourglass',
					'icon-stop' => 'stop',
					'icon-up-dir' => 'up dir',
					'icon-play' => 'play',
					'icon-right-dir' => 'right dir',
					'icon-down-dir' => 'down dir',
					'icon-left-dir' => 'left dir',
					'icon-cloud' => 'cloud',
					'icon-star' => 'star',
					'icon-star-empty' => 'star empty',
					'icon-th-list' => 'th list',
					'icon-moon' => 'moon',
					'icon-heart-empty' => 'heart empty',
					'icon-heart' => 'heart',
					'icon-music' => 'music',
					'icon-th' => 'th',
					'icon-flag' => 'flag',
					'icon-cog' => 'cog',
					'icon-attention' => 'attention',
					'icon-flash' => 'flash',
					'icon-record' => 'record',
					'icon-flight' => 'flight',
					'icon-mail' => 'mail',
					'icon-pencil' => 'pencil',
					'icon-feather' => 'feather',
					'icon-ok' => 'ok',
					'icon-cancel' => 'cancel',
					'icon-cancel-circle' => 'cancel circle',
					'icon-help' => 'help',
					'icon-quote-right' => 'quote right',
					'icon-plus-circle' => 'plus circle',
					'icon-minus-circle' => 'minus circle',
					'icon-right-thin' => 'right thin',
					'icon-direction' => 'direction',
					'icon-forward' => 'forward',
					'icon-ccw' => 'ccw',
					'icon-cw' => 'cw',
					'icon-left-thin' => 'left thin',
					'icon-up-thin' => 'up thin',
					'icon-down-thin' => 'down thin',
					'icon-list-add' => 'list add',
					'icon-left-bold' => 'left bold',
					'icon-right-bold' => 'right bold',
					'icon-up-bold' => 'up bold',
					'icon-down-bold' => 'down bold',
					'icon-user-add' => 'user add',
					'icon-help-circle' => 'help circle',
					'icon-info-circle' => 'info circle',
					'icon-back' => 'back',
					'icon-back-alt' => 'back alt',
					'icon-eye' => 'eye',
					'icon-eye-1' => 'eye 1',
					'icon-tag' => 'tag',
					'icon-upload-cloud' => 'upload cloud',
					'icon-reply' => 'reply',
					'icon-reply-all' => 'reply all',
					'icon-code' => 'code',
					'icon-export' => 'export',
					'icon-print' => 'print',
					'icon-retweet' => 'retweet',
					'icon-comment' => 'comment',
					'icon-chat' => 'chat',
					'icon-vcard' => 'vcard',
					'icon-address' => 'address',
					'icon-location' => 'location',
					'icon-map' => 'map',
					'icon-compass' => 'compass',
					'icon-trash' => 'trash',
					'icon-doc' => 'doc',
					'icon-docs' => 'docs',
					'icon-docs-landscape' => 'docs landscape',
					'icon-archive' => 'archive',
					'icon-rss' => 'rss',
					'icon-share' => 'share',
					'icon-basket' => 'basket',
					'icon-volume' => 'volume',
					'icon-resize-full' => 'resize full',
					'icon-resize-small' => 'resize small',
					'icon-popup' => 'popup',
					'icon-publish' => 'publish',
					'icon-window' => 'window',
					'icon-arrow-combo' => 'arrow combo',
					'icon-down-circle2' => 'down circle2',
					'icon-left-circle2' => 'left circle2',
					'icon-right-circle2' => 'right circle2',
					'icon-up-circle2' => 'up circle2',
					'icon-down-open' => 'down open',
					'icon-left-open' => 'left open',
					'icon-right-open' => 'right open',
					'icon-up-open' => 'up open',
					'icon-progress-0' => 'progress 0',
					'icon-progress-1' => 'progress 1',
					'icon-progress-2' => 'progress 2',
					'icon-progress-3' => 'progress 3',
					'icon-signal' => 'signal',
					'icon-back-in-time' => 'back in time',
					'icon-net' => 'net',
					'icon-inbox' => 'inbox',
					'icon-install' => 'install',
					'icon-lifebuoy' => 'lifebuoy',
					'icon-mouse' => 'mouse',
					'icon-bag' => 'bag',
					'icon-dot' => 'dot',
					'icon-dot-2' => 'dot 2',
					'icon-dot-3' => 'dot 3',
					'icon-cc' => 'cc',
					'icon-google-circles' => 'google circles',
					'icon-logo-entypo' => 'logo entypo',
					'icon-flag-sw' => 'flag sw',
					'icon-logo-db' => 'logo db',
					'icon-globe' => 'globe',
					'icon-picture' => 'picture',
					'icon-leaf' => 'leaf',
					'icon-mic' => 'mic',
					'icon-palette' => 'palette',
					'icon-video' => 'video',
					'icon-target' => 'target',
					'icon-music-alt' => 'music alt',
					'icon-top-list' => 'top list',
					'icon-thumbs-up' => 'thumbs up',
					'icon-user' => 'user',
					'icon-users' => 'users',
					'icon-lamp' => 'lamp',
					'icon-monitor' => 'monitor',
					'icon-cd' => 'cd',
					'icon-folder' => 'folder',
					'icon-doc-text' => 'doc text',
					'icon-calendar' => 'calendar',
					'icon-attach' => 'attach',
					'icon-book-open' => 'book open',
					'icon-phone' => 'phone',
					'icon-upload' => 'upload',
					'icon-download' => 'download',
					'icon-mobile' => 'mobile',
					'icon-camera' => 'camera',
					'icon-shuffle' => 'shuffle',
					'icon-light-down' => 'light down',
					'icon-light-up' => 'light up',
					'icon-volume-off' => 'volume off',
					'icon-volume-up' => 'volume up',
					'icon-battery' => 'battery',
					'icon-bookmark' => 'bookmark',
					'icon-search' => 'search',
					'icon-search-alt' => 'search alt',
					'icon-lock' => 'lock',
					'icon-lock-open' => 'lock open',
					'icon-bell' => 'bell',
					'icon-link' => 'link',
					'icon-link-1' => 'link 1',
					'icon-clock' => 'clock',
					'icon-block' => 'block'
				)
			)
		)
	)
);

/*--------------------------- END Lists -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Contact Form
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['contact_form'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc_contact_form]',
	'title' => __('Insert Contact Form', 'gentle'),
);

/*--------------------------- END Contact Form -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Google Map
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['google_maps'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc_google_map src="{{src}}" width="{{width}}" height="{{height}}"]',
	'title' => __('Insert Contact Form Shortcode', 'gentle'),
	'fields' => array(
		'src' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Source', 'gentle'),
			'desc' => __('Paste the link for a the google maps.', 'gentle')
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Width', 'gentle'),
			'desc' => __('Define the width of a google map.', 'gentle')
		),
		'height' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Map Height', 'gentle'),
			'desc' => __('Define the height of a google map.', 'gentle')
		)
	)
);

/*--------------------------- END Google Map -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	FlexSlider
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['flexslider'] = array(
	'preview' => 'false',
	'shortcode' => '[flexslider width="{{width}}" height="{{height}}" effect="{{effect}}" slideshowspeed="{{slideshowspeed}}"] {{inside}} [/flexslider]',
	'title' => __('Insert Flex Slider Shortcode', 'gentle'),
	'fields' => array(
		'width' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Width', 'gentle'),
			'desc' => __('Specify width of the slider.', 'gentle')
			),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Height', 'gentle'),
			'desc' => __('Specify height of the slider.', 'gentle')
			),
		'effect' => array(
			'type' => 'select',
			'title' => __('Slider Effect', 'gentle'),
			'desc' => __('Specify the transition effect type', 'gentle'),
			'options' => array(
					'fade' => 'Fade',
					'slide' => 'Slide'
				)
			),
		'slideshowspeed' => array(
			'std' => '3000',
			'type' => 'text',
			'title' => __('Slide Show Speed', 'gentle'),
			'desc' => __('Specify slide show speed in milliseconds.', 'gentle')
			),	
		),
	'inside' => array( // when shortcode has two tags you need to define the second one in the inside array
		'shortcode' => '[flex_image url="{{url}}"]',
		'add_section' => __('Add New Image', 'gentle'),
		'remove_section' => __('Remove Image', 'gentle'),
		'fields' => array(
			'url' => array(
				'type' => 'text',
				'title' => __('Image URL', 'gentle'),
				'desc' => __('Select the image that will be displayed in the slider.', 'gentle'),
				'std' => ''
			)
		)
	)
);

/*--------------------------- End FlexSlider -------------------------------- */

/*-----------------------------------------------------------------------------------*/
/*	Layer Slider Shortcode
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['layerslider'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc-layerslider uniqueID="{{uniqueID}}" defaultWidth="{{defaultWidth}}" defaultHeight="{{defaultHeight}}" pouseOnHover="{{pouseOnHover}}" slideshow="{{slideshow}}" slideShowDelay="{{slideShowDelay}}" arrowsOffset="{{arrowsOffset}}" shadowStyle="{{shadowStyle}}" transitionTime="{{transitionTime}}" showControlsOnHover="{{showControlsOnHover}}" controlsOpacity="{{controlsOpacity}}" showBullets="{{showBullets}}" showArrows="{{showArrows}}" bulletsVerticalOffset="{{bulletsVerticalOffset}}" bulletsHorizontalOffset="{{bulletsHorizontalOffset}}" swipeGesture="{{swipeGesture}}"] {{inside}}[/mpc-layerslider]',
	'title' => __('Insert Layer Slider Shortcode', 'gentle'),
	'fields' => array(
		'uniqueID' => array(
			'std' => 'layer_slider',
			'type' => 'text',
			'title' => __('Slider Unique ID', 'gentle'),
			'desc' => __('Specify unqiue id for your slider.', 'gentle')
			),
		
		'defaultHeight' => array(
			'std' => '450',
			'type' => 'text',
			'title' => __('Slider Height', 'gentle'),
			'desc' => __('Specify height of the slider.', 'gentle')
			),
		'defaultWidth' => array(
			'std' => '960',
			'type' => 'text',
			'title' => __('Slider Width', 'gentle'),
			'desc' => __('Specify width of the slider.', 'gentle')
			),
		'slideshow' => array(
			'type' => 'select',
			'title' => __('Autoplay Slideshow', 'gentle'),
			'desc' => __('Autoplay Slideshow', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'slideShowDelay' => array(
			'type' => 'select',
			'title' => __('Slideshow delay', 'gentle'),
			'desc' => __('Slideshow delay', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'pouseOnHover' => array(
			'type' => 'select',
			'title' => __('Pouse Slideshow on hover', 'gentle'),
			'desc' => __('Pouse Slideshow on hover', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'arrowsOffset' => array(
			'std' => '0',
			'type' => 'text',
			'title' => __('Arrows offset', 'gentle'),
			'desc' => __('Specify arrows offset in pixels', 'gentle'),
			),
		'shadowStyle' => array(
			'type' => 'select',
			'title' => __('Choose Shadow Style', 'gentle'),
			'desc' => __('Choose Shadow Style', 'gentle'),
			'options' => array(
					'none' => 'none',
					'style01' => 'style01',
					'style02' => 'style02',
					'style03' => 'style03'
				)
			),
		'transitionTime' => array(
			'std' => '1000',
			'type' => 'text',
			'title' => __('Length of background transition', 'gentle'),
			'desc' => __('Length of background transition', 'gentle'),
			),
		'showControlsOnHover' => array(
			'type' => 'select',
			'title' => __('Show ui on slide hover', 'gentle'),
			'desc' => __('Show ui on slide hover', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'controlsOpacity' => array(
			'std' => '1',
			'type' => 'text',
			'title' => __('Controls opacity', 'gentle'),
			'desc' => __('Controls opacity (0 to 1) value', 'gentle'),
			),
		'showBullets' => array(
			'type' => 'select',
			'title' => __('Show bullets', 'gentle'),
			'desc' => __('Show bullets (radio buttons)', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'showArrows' => array(
			'type' => 'select',
			'title' => __('Show arrows', 'gentle'),
			'desc' => __('Show arrows (next/preview)', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			),
		'bulletsVerticalOffset' => array(
			'std' => '0',
			'type' => 'text',
			'title' => __('Bullets vertical offset', 'gentle'),
			'desc' => __('Bulelts (radio buttons) vertical offset', 'gentle'),
			),
		'bulletsHorizontalOffset' => array(
			'std' => '0',
			'type' => 'text',
			'title' => __('Bullets horizontal offset', 'gentle'),
			'desc' => __('Bulelts (radio buttons) horizontal offset', 'gentle'),
			),
		'swipeGesture' => array(
			'type' => 'select',
			'title' => __('Swipe gesture', 'gentle'),
			'desc' => __('Choose if swipe gesture should be enabled', 'gentle'),
			'options' => array(
					'true' => 'True',
					'false' => 'False'
				)
			)
	),
	'inside' => array(
		'shortcode'      => '[mpc-ls-slide class="{{class}}" dataEasing="{{dataEasing}}" background="{{background}}" dataTransition="{{dataTransition}}" dataThumbnail="{{dataThumbnail}}"] [/mpc-ls-slide] ',
		'add_section'    => __('Add Slide', 'gentle'),
		'remove_section' => __('Remove Slide', 'gentle'),
		'fields'         => array(		
			'class' => array(
				'std'   => '',
				'type'  => 'text',
				'title' => __('Class name', 'gentle'),
				'desc'  => __('This is used for custom CSS styling.', 'gentle')
				
			),
			'dataEasing' => array(
			'type'       => 'select',
			'title'      => __('Select easing type', 'gentle'),
			'desc'       => __('Choose easing type for your animation', 'gentle'),
			'options'    => array(
				'linear'           => 'linear',
				'swing'            => 'swing',
				'easeInQuad'       => 'easeInQuad',
				'easeOutQuad'      => 'easeOutQuad',
				'easeInOutQuad'    => 'easeInOutQuad',
				'easeInCubic'      => 'easeInCubic',
				'easeOutCubic'     => 'easeOutCubic',
				'easeInOutCubic'   => 'easeInOutCubic',
				'easeInQuart'      => 'easeInQuart',
				'easeOutQuart'     => 'easeOutQuart',
				'easeInOutQuart'   => 'easeInOutQuart',
				'easeInQuint'      => 'easeInQuint',
				'easeOutQuint'     => 'easeOutQuint',
				'easeInOutQuint'   => 'easeInOutQuint',
				'easeInExpo'       => 'easeInExpo',
				'easeOutExpo'      => 'easeOutExpo',
				'easeInOutExpo'    => 'easeInOutExpo',
				'easeInSine'       => 'easeInSine',
				'easeOutSine'      => 'easeOutSine',
				'easeInOutSine'    => 'easeInOutSine',
				'easeInCirc'       => 'easeInCirc',
				'easeOutCirc'      => 'easeOutCirc',
				'easeInOutCirc'    => 'easeInOutCirc',
				'easeInElastic'    => 'easeInElastic',
				'easeOutElastic'   => 'easeOutElastic',
				'easeInOutElastic' => 'easeInOutElastic',
				'easeInBack'       => 'easeInBack',
				'easeOutBack'      => 'easeOutBack',
				'easeInOutBack'    => 'easeInOutBack',
				'easeInBounce'     => 'easeInBounce',
				'easeOutBounce'    => 'easeOutBounce',
				'easeInOutBounce'  => 'easeInOutBounce'
				)
			),
			'dataTransition' => array(
			'type'       => 'select',
			'title'      => __('Select transition type', 'gentle'),
			'desc'       => __('Choose transtiontype for your animation', 'gentle'),
			'options'    => array(
				'slideLeft'   => 'slideLeft',
				'slideRight'  => 'slideRight',
				'slideTop'    => 'slideTop',
				'slideBottom' => 'slideBottom',
				'grow'        => 'grow'
				)
			),
			'dataThumbnail' => array(
				'std'   => '',
				'type'  => 'text',
				'title' => __('Slide thumbnail', 'gentle'),
				'desc'  => __('Specify slides thumbnail URL.', 'gentle')
				
			),
			'background' => array(
				'std'   => '',
				'type'  => 'text',
				'title' => __('Slide background', 'gentle'),
				'desc'  => __('Specify slides background URL.', 'gentle')
				
			)
		)
	)
);

/* Layer Slider - Layer */

$mpc_shortcodes['layerslider_layer'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc-ls-slider-layer dataX="{{dataX}}" dataY="{{dataY}}"  dataDelay="{{dataDelay}}" dataDuration="{{dataDuration}}" dataEasing="{{dataEasing}}" dataEffect="{{dataEffect}}" dataFade="{{dataFade}}"] {{content}} [/mpc-ls-slider-layer]',
	'title' => __('Insert Layers Slider - Layer Shortcode', 'gentle'),
	'fields' => array(	
		'dataX' => array(
			'std'   => '0',
			'type'  => 'text',
			'title' => __('Layer X position', 'gentle'),
			'desc'  => __('Specify final position of the layer on X axis.', 'gentle')	
		),
		'dataY' => array(
			'std'   => '0',
			'type'  => 'text',
			'title' => __('Layer Y position', 'gentle'),
			'desc'  => __('Specify final position of the layer on Y axis.', 'gentle')	
		),
		'dataDuration' => array(
			'std'   => '500',
			'type'  => 'text',
			'title' => __('Layer animation duration', 'gentle'),
			'desc'  => __('Specify layer animation duration', 'gentle')	
		),
		'dataDelay' => array(
			'std'   => '500',
			'type'  => 'text',
			'title' => __('Layer animation delay', 'gentle'),
			'desc'  => __('Specify layer animation delay', 'gentle')	
		),
		'dataEasing' => array(
		'type'       => 'select',
		'title'      => __('Layer animation easing type', 'gentle'),
		'desc'       => __('Choose layer animation easing type.', 'gentle'),
		'options'    => array(
			'linear'           => 'linear',
			'swing'            => 'swing',
			'easeInQuad'       => 'easeInQuad',
			'easeOutQuad'      => 'easeOutQuad',
			'easeInOutQuad'    => 'easeInOutQuad',
			'easeInCubic'      => 'easeInCubic',
			'easeOutCubic'     => 'easeOutCubic',
			'easeInOutCubic'   => 'easeInOutCubic',
			'easeInQuart'      => 'easeInQuart',
			'easeOutQuart'     => 'easeOutQuart',
			'easeInOutQuart'   => 'easeInOutQuart',
			'easeInQuint'      => 'easeInQuint',
			'easeOutQuint'     => 'easeOutQuint',
			'easeInOutQuint'   => 'easeInOutQuint',
			'easeInExpo'       => 'easeInExpo',
			'easeOutExpo'      => 'easeOutExpo',
			'easeInOutExpo'    => 'easeInOutExpo',
			'easeInSine'       => 'easeInSine',
			'easeOutSine'      => 'easeOutSine',
			'easeInOutSine'    => 'easeInOutSine',
			'easeInCirc'       => 'easeInCirc',
			'easeOutCirc'      => 'easeOutCirc',
			'easeInOutCirc'    => 'easeInOutCirc',
			'easeInElastic'    => 'easeInElastic',
			'easeOutElastic'   => 'easeOutElastic',
			'easeInOutElastic' => 'easeInOutElastic',
			'easeInBack'       => 'easeInBack',
			'easeOutBack'      => 'easeOutBack',
			'easeInOutBack'    => 'easeInOutBack',
			'easeInBounce'     => 'easeInBounce',
			'easeOutBounce'    => 'easeOutBounce',
			'easeInOutBounce'  => 'easeInOutBounce'
			)
		),
		'dataEffect' => array(
		'type'       => 'select',
		'title'      => __('Layer transition type', 'gentle'),
		'desc'       => __('Choose layer transtion type.', 'gentle'),
		'options'    => array(
			'slideLeft'   => 'slideLeft',
			'slideRight'  => 'slideRight',
			'slideTop'    => 'slideTop',
			'slideBottom' => 'slideBottom',
			'grow'        => 'grow'
			)
		),
		'dataFade' => array(
		'type'       => 'select',
		'title'      => __('Layer fade', 'gentle'),
		'desc'       => __('Choose whether the fade animation should be applyed.', 'gentle'),
		'options'    => array(
			'on'   => 'On',
			'off'  => 'Off'
			)
		),
		'content' => array(
			'std'   => '',
			'type'  => 'textarea',
			'title' => __('Layer HTML Content', 'gentle'),
			'desc'  => __('Insidert HTML content for your layer', 'gentle')	
		)
	)
);	

/*-----------------------------------------------------------------------------------*/
/*	Nivo Slider
/*-----------------------------------------------------------------------------------*/

$mpc_shortcodes['nivo'] = array(
	'preview' => 'false',
	'shortcode' => '[mpc_nivo uniqueid="{{uniqueid}}" width="{{width}}" height="{{height}}" effect="{{effect}}" pausetime="{{pausetime}}"] {{inside}} [/mpc_nivo]',
	'title' => __('Insert Columns Shortcode', 'gentle'),
	'fields' => array(
		'uniqueid' => array(
			'std' => 'nivo_slider',
			'type' => 'text',
			'title' => __('Sliders Unique ID', 'gentle'),
			'desc' => __('Specify slider unique ID.', 'gentle')
			),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Width', 'gentle'),
			'desc' => __('Specify width of the slider.', 'gentle')
			),
		
		'height' => array(
			'std' => '',
			'type' => 'text',
			'title' => __('Slider Height', 'gentle'),
			'desc' => __('Specify height of the slider.', 'gentle')
			),
		'effect' => array(
			'type' => 'select',
			'title' => __('Slider Height', 'gentle'),
			'desc' => __('Specify the transition effect type', 'gentle'),
			'options' => array(
					'random' => 'Random',
					'sliceDown' => 'Slice Down',
					'sliceDownLeft' => 'Slice Down Left',
					'sliceUp' => 'Slice Up',
					'sliceUpLeft' => 'Slice Up Left',
					'sliceUpDown' => 'Slice Up Down',
					'sliceUpDownLeft' => 'Slice Up Down Left',
					'fold' => 'Fold',
					'fade' => 'Fade',
					'slideInRight' => 'Slide In Right',
					'slideInLeft' => 'Slide In Left',
					'boxRandom' => 'Box Random',
					'boxRain' => 'Box Rain',
					'boxRainReverse' => 'Box Rain Reverse',
					'boxRainGrow' => 'Box Rain Grow',
					'boxRainGrowReverse' => 'Box Rain Grow Reverse'
				)
			),
		'pausetime' => array(
			'std' => '3000',
			'type' => 'text',
			'title' => __('Slider Pause Time', 'gentle'),
			'desc' => __('Specify pause time of each slide in milliseconds.', 'gentle')
			),	
		),
	'inside' => array( // when shortcode has two tags you need to define the second one in the inside array
		'shortcode' => '[mpc_nivo_image url="{{url}}"]',
		'add_section' => __('Add New Image', 'gentle'),
		'remove_section' => __('Remove Image', 'gentle'),
		'fields' => array(
			'url' => array(
				'type' => 'text',
				'title' => __('Image URL', 'gentle'),
				'desc' => __('Select the image that will be displayed in the slider.', 'gentle'),
				'std' => ''
			)
		)
	)
);




















?>