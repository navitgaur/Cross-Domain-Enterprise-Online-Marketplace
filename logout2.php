<?php



// require_once(__DIR__.'/lib/fbapp/src/Facebook/autoload.php');

session_start();



// $fb = new Facebook\Facebook([
//   'app_id' => '1736611106567805',
//   'app_secret' => '316b2d9bc0ece4fbf14caad3794629ee',
//   'default_graph_version' => 'v2.5'
// ]);
// 	$token = $facebook->getAccessToken();
// 	$url = 'https://www.facebook.com/logout.php?next=' . 'http://www.tugceakin.com' .
//   '&access_token='.$token;
// }

session_destroy();
header("Location: index.php");
 ?>



