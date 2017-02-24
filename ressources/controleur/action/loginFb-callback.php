<?php
if(!session_id()) {
    include 'session.inc';
}
//Config bouton retour recherche
$bouton_retour="/cours-et-soirees-dansantes/";
if(isset ($_SESSION['recherche'])){
	if($_SESSION['recherche']=="calendrier"){
		$bouton_retour="/soirees-et-evenements-dansants/";
	}
	if($_SESSION['recherche']=="cours"){
		$bouton_retour="/cours-de-danse/";
	}
	if($_SESSION['recherche']=="accueil"){
		$bouton_retour="//www.lepetitbal.com";
	}
}
require('../../modele/connexion_sql.php');  // Connexion base sql
require('../../modele/put_historique_connexion.php');

define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__ . '/facebook-sdk-v5/');
require_once ('../ext_login_sdk/facebook_sdk/autoload.php');
$fb = new Facebook\Facebook([
    'app_id' => '1239116092768343',
    'app_secret' => 'd4ea649207618012791f6bb5619fb37a',
    'default_graph_version' => 'v2.7',]);

$helper = $fb->getRedirectLoginHelper();
try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (isset($accessToken)) {
  // Logged in!
  $_SESSION['facebook_access_token'] = (string) $accessToken;

  // Now you can redirect to another page and use the
  // access token from $_SESSION['facebook_access_token']
}

// DEMANDE INFO API GRAPH

// Sets the default fallback access token so we don't have to pass it to each request
$fb->setDefaultAccessToken($accessToken);

try {
  $response = $fb->get('/me?fields=first_name,email');
  $graphUser = $response->getGraphUser();

  $email_membre = $graphUser->getProperty("email");

  $pseudo_membre = $graphUser->getProperty("first_name");
  $_SESSION['pseudo_membre']=$pseudo_membre;
  $_SESSION['email_membre']=$email_membre;
  $_SESSION['from']="Facebook";
  
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
if(isset($pseudo_membre)){
    check_auth();
    //SAUVEGARDE DE LA SESSION DANS LA BDD --> historique des connexions
    put_historique_connexion_membre($_SESSION['email_membre'],$_SESSION['from'],$_SESSION['ip'],"login");
}
header('Refresh: 0 ; url='.$bouton_retour);
?>