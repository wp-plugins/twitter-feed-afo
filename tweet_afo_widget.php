<?php

class tweet_wid extends WP_Widget {
	
	public function __construct() {
		parent::__construct(
	 		'tweet_wid',
			'Tweet Widget AFO',
			array( 'description' => __( 'Recent tweet widget by afo.', 'text_domain' ), )
		);
	 }

	public function widget( $args, $instance ) {
		extract( $args );
		
		$wid_title = apply_filters( 'widget_title', $instance['wid_title'] );
		
		echo $args['before_widget'];
		if ( ! empty( $wid_title ) )
			echo $args['before_title'] . $wid_title . $args['after_title'];
			echo $this->getTweets();
		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['wid_title'] = strip_tags( $new_instance['wid_title'] );
		return $instance;
	}


	public function form( $instance ) {
		$wid_title = $instance[ 'wid_title' ];
		?>
		<p><label for="<?php echo $this->get_field_id('wid_title'); ?>"><?php _e('Title:'); ?> </label>
		<input class="widefat" id="<?php echo $this->get_field_id('wid_title'); ?>" name="<?php echo $this->get_field_name('wid_title'); ?>" type="text" value="<?php echo $wid_title; ?>" />
		</p>
		<?php 
	}
	
	public function getTweets(){
	
		require_once(plugin_dir_path(__FILE__) . "twitteroauth/twitteroauth.php"); //Path to twitteroauth library
		$afo_twitteruser = get_option('afo_twitteruser');
		$afo_notweets = get_option('afo_notweets');
		$afo_consumerkey = get_option('afo_consumerkey');
		$afo_consumersecret = get_option('afo_consumersecret');
		$afo_accesstoken = get_option('afo_accesstoken');
		$afo_accesstokensecret = get_option('afo_accesstokensecret');
 
		if($afo_notweets == ""){
			$afo_notweets = 5;
		}
		 
		function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		  return $connection;
		}
		 
		$connection = getConnectionWithAccessToken($afo_consumerkey, $afo_consumersecret, $afo_accesstoken, $afo_accesstokensecret);
		 
		$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$afo_twitteruser."&count=".$afo_notweets);
		
		if(is_array($tweets)){
			$tweets = array_filter($tweets);
		}
		
		if(is_array($tweets) and count($tweets) > 0){
			$ret = '<ul>';
				foreach($tweets as $key => $value){
					$ret .= '<li>';
						$ret .= '<a href="https://twitter.com/'.$afo_twitteruser.'/status/'.$value->id_str.'" target="_blank">'.substr($value->text,0,50).'..</a>';
						 $datetoshow = date("M j, Y", strtotime($value->created_at));
						$ret .= '<br>'. $datetoshow;
					$ret .= '</li>';
				}
				$ret .= '<li><a href="https://twitter.com/'.$afo_twitteruser.'" target="_blank">Follow @'.$afo_twitteruser.'</a></li>';
			$ret .= '</ul>';
		} else {
			$ret = 'Sorry. No tweets found!';
		}
		
		return $ret;
		//echo '<pre>';
		//echo print_r($tweets);
		
	}
	
} 
add_action( 'widgets_init', create_function( '', 'register_widget( "tweet_wid" );' ) );
?>