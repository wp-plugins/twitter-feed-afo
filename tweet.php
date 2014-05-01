<?php
session_start();
require_once("twitteroauth/twitteroauth.php"); //Path to twitteroauth library
 
$twitteruser = "demoforclient3";
$notweets = 5;
$consumerkey = "GU1t8wT8vI531aGdR6MnX2plk";
$consumersecret = "ApgtlbWUooy5kw14Osl9SYwyxRc6CeheaO18NhvF1jRvjAt9dh";
$accesstoken = "2447006569-6ZIfe2bt88LPkn0ERllu6RIUkwjIUy2IZzbUKvh";
$accesstokensecret = "VVtqQnX9IKpINrgwlD91lzF1U8XU32K2lqmR14c18w2IK";
 
function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
  return $connection;
}
 
$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
 
$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);

echo '<pre>';
echo print_r($tweets);
?>