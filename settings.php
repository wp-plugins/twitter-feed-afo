<?php
class tweet_afo_settings {

	static $title = 'Recent Tweet Widget AFO Settings';
	
	function __construct() {
		$this->load_settings();
	}
	
	function login_widget_afo_save_settings(){
		if(isset($_POST['option']) and $_POST['option'] == "login_widget_afo_save_settings"){
			update_option( 'redirect_page', $_POST['redirect_page'] );
			update_option( 'logout_redirect_page', $_POST['logout_redirect_page'] );
			update_option( 'link_in_username', $_POST['link_in_username'] );
		}
	}
	
	function  tweet_widget_afo_options () {
	global $wpdb;
	
	$afo_twitteruser = get_option('afo_twitteruser');
	$afo_notweets = get_option('afo_notweets');
	$afo_consumerkey = get_option('afo_consumerkey');
	$afo_consumersecret = get_option('afo_consumersecret');
	$afo_accesstoken = get_option('afo_accesstoken');
	$afo_accesstokensecret = get_option('afo_accesstokensecret');
	$this->twitter_feed_pro_add();
	$this->donate_form_tweet();
	?>
	<form name="f" method="post" action="">
	<input type="hidden" name="option" value="tweet_widget_afo_save_settings" />
	<table width="100%" border="0">
	<?php if($GLOBALS['msg']) { ?>
	<tr>
		<td width="45%" colspan="2"><div class="afo_error"><?php echo $GLOBALS['msg'];?></div></td>
	  </tr>
	 <?php } ?>
	  <tr>
		<td width="45%" colspan="2"><h1><?php echo self::$title;?></h1></td>
	  </tr>
	  <tr>
		<td><strong>Twitter Username: <font color="red">(required)</font></strong></td>
		<td><input type="text" name="afo_twitteruser" value="<?php echo $afo_twitteruser;?>" /></td>
	  </tr>
	   <tr>
		<td><strong>No of Tweets: </strong></td>
		 <td><input type="text" name="afo_notweets" value="<?php echo $afo_notweets;?>" />&nbsp;Default is 5</td>
	  </tr>
	   <tr>
		<td><strong>Consumer Key: <font color="red">(required)</font></strong></td>
		 <td><input type="text" name="afo_consumerkey" value="<?php echo $afo_consumerkey;?>" /></td>
	  </tr>
	   <tr>
		<td><strong>Consumer Secret: <font color="red">(required)</font></strong></td>
		 <td><input type="text" name="afo_consumersecret" value="<?php echo $afo_consumersecret;?>" /></td>
	  </tr>
	  <tr>
		<td><strong>Access Token: <font color="red">(required)</font></strong></td>
		 <td><input type="text" name="afo_accesstoken" value="<?php echo $afo_accesstoken;?>" /></td>
	  </tr>
	  <tr>
		<td><strong>Access Token Secret: <font color="red">(required)</font></strong></td>
		 <td><input type="text" name="afo_accesstokensecret" value="<?php echo $afo_accesstokensecret;?>" /></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="submit" value="Save" class="button button-primary button-large" /></td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	  </tr>
	  <tr>
		<td colspan="2">You need to create a new twitter app and enter all the required data mentioned in the form. <br />
		Please log in to <a href="https://apps.twitter.com/" target="_blank">https://apps.twitter.com/</a> with your twitter account <strong>Username</strong> and <strong>Password</strong>. And click on the <strong>Create new app</strong> button.<br />
		A new window will open. Enter all the relevant data, and follow the instructions. Your new app will be created.<br />
	Now on the <strong>API Keys</strong> tab you will get all the data required for the plugin to work.
	</td>
	  </tr>
	</table>
	</form>
	<?php 
	}
	
	
	private function donate_form_tweet(){?>
	<table width="98%" border="0" style="background-color:#FFFFD2; border:1px solid #E6DB55;">
 <tr>
 <td align="right"><h3>Even $0.60 Can Make A Difference</h3></td>
    <td><form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <input type="hidden" name="cmd" value="_xclick">
          <input type="hidden" name="business" value="avifoujdar@gmail.com">
          <input type="hidden" name="item_name" value="Donation for plugins (Tweet)">
          <input type="hidden" name="currency_code" value="USD">
          <input type="hidden" name="amount" value="0.60">
          <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make a donation with PayPal">
        </form></td>
  </tr>
</table>
	<?php }
	
	private function twitter_feed_pro_add(){ ?>
	<table width="98%" border="0" style="background-color:#FFFFD2; border:1px solid #E6DB55; padding:0px 0px 0px 10px; margin:2px;">
  <tr>
    <td><p>The PRO version <strong>Twitter Feed PRO</strong> supports Twitter feeds from multiple accounts. There is option to customize the look of the twitter feed widget. Select background color, link color, link hover color, link hover style etc. You can get it <a href="http://aviplugins.com/twitter-feed-pro/" target="_blank">here</a> in <strong>USD 2.00</strong> </p></td>
  </tr>
</table>
	<?php }
	
	function tween_widget_afo_menu () {
		add_options_page( 'Recent Tweet Widget', 'Tweet Widget Settings', 'activate_plugins', 'tween_widget_afo_menu', array( $this,'tweet_widget_afo_options') );
	}
	
	function tweet_widget_afo_save_settings(){
		if(isset($_POST['option']) and $_POST['option'] == "tweet_widget_afo_save_settings"){
			update_option( 'afo_twitteruser', $_POST['afo_twitteruser'] );
			update_option( 'afo_notweets', $_POST['afo_notweets'] );
			update_option( 'afo_consumerkey', $_POST['afo_consumerkey'] );
			update_option( 'afo_consumersecret', $_POST['afo_consumersecret'] );
			update_option( 'afo_accesstoken', $_POST['afo_accesstoken'] );
			update_option( 'afo_accesstokensecret', $_POST['afo_accesstokensecret'] );
			$GLOBALS['msg'] = 'Settings saved successfully.';
		}
	}
	
	function load_settings(){
		add_action( 'admin_menu' , array( $this, 'tween_widget_afo_menu' ) );
		add_action( 'admin_init', array( $this, 'tweet_widget_afo_save_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'register_plugin_styles') );
	}
	
	function register_plugin_styles() {
		wp_enqueue_style( 'style_tweet_widget', plugins_url( 'twitter-feed-afo/style_tweet_widget.css' ) );
	}
	
	function donate_form(){?>
	<table width="98%" border="0" style="background-color:#FFFFD2; border:1px solid #E6DB55;">
	 <tr>
	 <td align="right"><h3>Even $0.60 Can Make A Difference</h3></td>
		<td><form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
			  <input type="hidden" name="cmd" value="_xclick">
			  <input type="hidden" name="business" value="avifoujdar@gmail.com">
			  <input type="hidden" name="item_name" value="Donation for plugins (Login)">
			  <input type="hidden" name="currency_code" value="USD">
			  <input type="hidden" name="amount" value="0.60">
			  <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make a donation with PayPal">
			</form></td>
	  </tr>
	</table>
	<?php }
}
new tweet_afo_settings;
