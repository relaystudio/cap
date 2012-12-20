<?php

/*-----------------------------------------------------------------------------------*/
/*	MassivePixelCreation Theme Widgets
/*
/*	1. Recent Posts
/*	2. Twitter
/*
/*-----------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	1. Recent Posts
/*-----------------------------------------------------------------------------------*/

class MPC_RecentPosts extends WP_Widget {

	/* Init function (constructor) */
	function MPC_RecentPosts() {
		$widget_ops = array( 'classname' => 'recentPosts_widget', 'description' => 'Show recet posts from your blog!' );
		$this->WP_Widget( 'recentPosts_widget', 'Recent Posts', $widget_ops);
	}

	/* Form displayed on the widget page */
	function form($instance) {
		
		$instance = wp_parse_args( (array) $instance, array('title' => 'Latest News', 'number' => 4));
        $title = esc_attr($instance['title']);
		$number = absint($instance['number']);
	?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               Number of Posts:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
<?php
	}
	
	/* Update the widget settings */
	function update($new_instance, $old_instance) {
		$instance=$old_instance;
       
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number']=$new_instance['number'];
        
        return $instance;
	}

	function widget($args, $instance) {
		global $post;
		extract($args);
		

		$title = $instance['title']; 
		$number = absint($instance['number']); // Number of Posts
       
        // Output
		echo $before_widget;
			if($title) 
				echo '<h5 class="widget_title">' . $title .'</h5>' ; 
			
			$pq = new WP_Query(array( 'post_type' => 'post', 'showposts' => $number ));
			
			if( $pq->have_posts()) :
			?>
			<ul class="mpc_latest_news_list">
				<?php 
				$index = 0;
				while($pq->have_posts()) : $pq->the_post(); 
				$index++; 
					if($index > 1) { ?>
						<li class="mpc-recent-post">
					<?php } else { ?>
						<li class="mpc-recent-post first">
					<?php } ?>
						<a href="<?php the_permalink(); ?>" class="recent-post-title"><?php the_title(); ?></a>
						<span class="latest_posts_data"><?php the_time('M d, Y');?> &middot; <?php the_category(', ');?></span>	
					</li>
				<?php wp_reset_query();
				endwhile; ?>
			</ul>
			<?php endif; ?>		
		<?php
		// echo widget closing tag
		echo $after_widget;
		echo '<span class="widget-clearboth"></span>';
		
	}
}

	
/*--------------------------- END Recent Posts -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	2. Twitter
/*-----------------------------------------------------------------------------------*/

class MPC_Twitter extends WP_Widget {

	/* Init function (constructor) */
	function MPC_Twitter() {
		$widget_ops = array( 'classname' => 'twitter_widget', 'description' => 'Display your latest tweets!' );
		$this->WP_Widget( 'twitter_widget', 'Latest Tweets', $widget_ops);
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title' => 'Latest Tweets', 'number' => 2, 'user' => ''));
        $title = esc_attr($instance['title']);
		$number = absint($instance['number']);
		$user = esc_attr($instance['user']);
	?>
		<p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
               Title:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('user'); ?>">
               Twitter Username:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('user'); ?>" name="<?php echo $this->get_field_name('user'); ?>" type="text" value="<?php echo $user; ?>" />
        </p>

		<p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               Number of Tweets:
            </label>
                <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
	<?php

	}

	function update($new_instance, $old_instance) {
		$instance=$old_instance;
       
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number']= $new_instance['number'];
        $instance['user']= $new_instance['user'];
        
        return $instance;
	}

	function widget($args, $instance) {
		extract($args);
		global $mp_option;
		global $shortname; 

		$title = $instance['title']; 
		$number = absint($instance['number']); // Number of Tweets
		$user = $instance['user'];
		$mp_option = gentle_get_global_options(); 
		
		echo $before_widget; ?>
		<h5 class="widget_title "><?php echo $title; ?></h5>
			<script>
				new TWTR.Widget( {
					version: 2,
					type: 'profile',
					rpp: '<?php echo $number; ?>',
					interval: 6000,
					width: 'auto',
					height: 'auto',
					theme: {
						shell: {
							background: 'transparent',
							color: '#ffffff'
						},
						tweets: {
							background: 'transparent', //tweet background
							color: "<?php echo $mp_option['gentle_body_color']?>", // tweet text color
							links: "<?php echo $mp_option['gentle_active_color']?>"
						}
					},
					features: {
						scrollbar: false,
						loop: false,
						live: false,
						hashtags: true,
						timestamp: true,
						avatars: false,
						behavior: 'all'
					}
				}).render().setUser('<?php echo $user ?>').start();
			</script>	
		<?php
		echo $after_widget;
	}
}


/*--------------------------- END Twitter -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	X. Widget Skeleton
/*-----------------------------------------------------------------------------------*/

/*class MPC_WidgetName extends WP_Widget {

	/* Init function (constructor) */
/*	function MPC_WidgetName() {
		$widget_ops = array( 'classname' => 'widgetName_widget', 'description' => 'Widget description!' );
		$this->WP_Widget( 'widgetName_widget', 'Recent Posts', $widget_ops);
	}

	function form($instance) {
	
	}

	function update($new_instance, $old_instance) {
	
	}

	function widget($args, $instance) {
	
	}

}

/* Add and register the widget */
/*add_action( 'widgets_init', 'mpc_load_widgets' );

function mpc_load_widgets() {
	register_widget('MPC_WidgetName');	
}*/


/*--------------------------- END Widget Skeleton -------------------------------- */


/*-----------------------------------------------------------------------------------*/
/*	Register Widgets
/*-----------------------------------------------------------------------------------*/

function mpc_load_widgets() {
	register_widget('MPC_RecentPosts');	
	register_widget('MPC_Twitter');	
}

add_action( 'widgets_init', 'mpc_load_widgets' );

/*--------------------------- END Register Widgets -------------------------------- */
?>