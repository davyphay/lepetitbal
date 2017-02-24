<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include_once "../ressources/controleur/ext_login_sdk/google_sdk/templates/base.php";
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
		$bouton_retour="/";
	}
}

require_once realpath(dirname(__FILE__) . '/../ext_login_sdk/google_sdk/Google/autoload.php');

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = '733566653676-9s8l9vupa12ttpi8565mh7erpdfnbftt.apps.googleusercontent.com';
 $client_secret = 'HpQc5IEuNUJssJ1CCaikEeeP';
 $redirect_uri = 'https://www.lepetitbal.com'.$bouton_retour;

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->setScopes('email');

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/

if(!isset($_SESSION['pseudo_membre']) && !isset($_SESSION['from']) && !isset($_SESSION['ip'])) // ON RENTRE uniquement 1 fois pour définir les variables de session
{
	$plus = new Google_Service_Plus($client);
	if ($client->getAccessToken()) {
		$_SESSION['access_token'] = $client->getAccessToken();
		$token_data = $client->verifyIdToken()->getAttributes();
		$me = $plus->people->get('me');
		$emails = $me->getEmails();
		$pseudo_membre=$me['name']['givenName'];
		$_SESSION['pseudo_membre']=$pseudo_membre;
		$_SESSION['email_membre']=$emails[0]['value'];
		$_SESSION['from']="Google+";
		check_auth();
		require_once('../modele/connexion_sql.php');  // Connexion base sql
		require_once('../modele/put_historique_connexion.php');
		//SAUVEGARDE DE LA SESSION DANS LA BDD --> historique des connexions
		put_historique_connexion_membre($_SESSION['email_membre'],$_SESSION['from'],$_SESSION['ip'],"login");
	}
}
?>


