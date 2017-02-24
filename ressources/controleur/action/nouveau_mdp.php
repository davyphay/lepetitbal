<meta charset="utf-8">
<?php
include 'session.inc';
//Config bouton retour recherche
$bouton_retour="/cours-et-soirees-dansantes/";
if(isset ($_SESSION['recherche'])){
	if($_SESSION['recherche']=="calendrier"){
		$bouton_retour="/soirees-et-evenements-dansants/";
	}
	if($_SESSION['recherche']=="cours"){
		$bouton_retour="/cours-de-danse/";
	}
}
if(isset($_GET['mdp'])){
	$mdp=$_GET['mdp'];
	//On regarde de qu'elle adresse mail provient ce mdp
	require_once('../../modele/connexion_sql.php');  // Connexion base sql
    require_once('../../modele/check_mdp_temporaire.php');
	$adresse_email = check_mdp_temporaire($mdp);
	if($adresse_email!==""){
		//Udpate le mdp à l'indresse indiqué
		$mdp_hache= sha1($mdp);
		require_once('../../modele/update_mdp_membre.php');
		update_mdp_membre($adresse_email,$mdp_hache);
		$_SESSION['success']= "Le mot de passe de ".$adresse_email." a bien été changé";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
	else{
		$_SESSION['erreur']= "Le code n'est pas valide";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
}
else{
	$_SESSION['erreur']= "Il manque des informations";
    header('Refresh: 0 ; url='.$bouton_retour);
}
