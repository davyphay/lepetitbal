<?php
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
if(isset($_SESSION['recherche'])){
	if($_SESSION['recherche']=="accueil"){
		require_once ('ressources/controleur/ext_login_sdk/facebook_sdk/autoload.php');
	}
	else{
		require_once ('../ressources/controleur/ext_login_sdk/facebook_sdk/autoload.php');
	}
}
else{
	require_once ('../ressources/controleur/ext_login_sdk/facebook_sdk/autoload.php');
}

$fb = new Facebook\Facebook([
    'app_id' => '1239116092768343',
    'app_secret' => 'd4ea649207618012791f6bb5619fb37a',
    'default_graph_version' => 'v2.7',]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional
$loginUrl = $helper->getLoginUrl('https://www.lepetitbal.com/ressources/controleur/action/loginFb-callback.php', $permissions);
?>
