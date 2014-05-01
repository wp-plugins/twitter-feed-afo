<?php
/*
Plugin Name: Recent Tweet Widget AFO
Plugin URI: http://avifoujdar.wordpress.com/category/my-wp-plugins/
Description: This is a recent twitter feed widget. This plugin will allow you to display recent tweets to your widget area. This plugin is compatible with api v1.1. so no warries. :)
Version: 1.0.1
Author: avimegladon
Author URI: http://avifoujdar.wordpress.com/
*/

/**
	  |||||   
	<(`0_0`)> 	
	()(afo)()
	  ()-()
**/


include_once dirname( __FILE__ ) . '/tweet_afo_widget.php';

add_action('admin_menu', 'tween_widget_afo_menu');

function tween_widget_afo_menu() {  
  add_options_page( 'Recent Tweet Widget', 'Tweet Widget Settings', 1, 'tween_widget_afo_menu', 'tweet_widget_afo_options');
}

function tweet_widget_afo_options() {
global $wpdb;

$afo_twitteruser = get_option('afo_twitteruser');
$afo_notweets = get_option('afo_notweets');
$afo_consumerkey = get_option('afo_consumerkey');
$afo_consumersecret = get_option('afo_consumersecret');
$afo_accesstoken = get_option('afo_accesstoken');
$afo_accesstokensecret = get_option('afo_accesstokensecret');
?>

<table width="98%" border="0" style="background-color:#FFFFD2; border:1px solid #E6DB55;">
 <tr>
 <td align="right"><h3>Even $0.60 Can Make A Difference</h3></td>
    <td><form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post">
          <input type="hidden" name="cmd" value="_xclick">
          <input type="hidden" name="business" value="avifoujdar@gmail.com">
          <input type="hidden" name="item_name" value="Donation for plugins( Tweet )">
          <input type="hidden" name="currency_code" value="USD">
          <input type="hidden" name="amount" value="0.60">
          <input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="Make a donation with PayPal">
        </form></td>
  </tr>
</table>
<form name="f" method="post" action="">
<input type="hidden" name="option" value="tweet_widget_afo_save_settings" />
<table width="100%" border="0">
<?php if($GLOBALS['msg']) { ?>
<tr>
    <td width="45%" colspan="2"><div class="afo_error"><?php echo $GLOBALS['msg'];?></div></td>
  </tr>
 <?php } ?>
  <tr>
    <td width="45%" colspan="2"><h1>Recent Tweet Widget AFO Settings</h1></td>
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
} // end of function 

function tweet_widget_afo_save_settings(){
	if($_POST['option'] == "tweet_widget_afo_save_settings"){
		update_option( 'afo_twitteruser', $_POST['afo_twitteruser'] );
		update_option( 'afo_notweets', $_POST['afo_notweets'] );
		update_option( 'afo_consumerkey', $_POST['afo_consumerkey'] );
		update_option( 'afo_consumersecret', $_POST['afo_consumersecret'] );
		update_option( 'afo_accesstoken', $_POST['afo_accesstoken'] );
		update_option( 'afo_accesstokensecret', $_POST['afo_accesstokensecret'] );
		$GLOBALS['msg'] = 'Settings saved successfully.';
	}
}
function register_plugin_styles() {
	wp_enqueue_style( 'style_tweet_widget', plugins_url( 'recent_tweet_afo/style_tweet_widget.css' ) );
}

add_action( 'admin_enqueue_scripts', 'register_plugin_styles' );
add_action( 'admin_init', 'tweet_widget_afo_save_settings' );