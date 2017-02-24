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
	if($_SESSION['recherche']=="accueil"){
		$bouton_retour="//www.lepetitbal.com";
	}	
}
if(isset($_SESSION['email_membre'])){
	$email_membre= $_SESSION['email_membre'];
	if(isset($_POST['password_membre_old']) AND isset($_POST['password_membre_new']) AND isset($_POST['password_control_new'])){
		$password_membre_old =htmlspecialchars($_POST['password_membre_old']);
		$password_membre_new =htmlspecialchars($_POST['password_membre_new']);
		$password_control_new =htmlspecialchars($_POST['password_control_new']);
		
		//Trouve l'ancien MDP
		require_once('../../modele/connexion_sql.php');
		require_once('../../modele/check_mdp_membre.php');
		$pass_hache=sha1($password_membre_old);
		$resultat=check_mdp_membre($email_membre,$pass_hache);
        if (!$resultat){
			$_SESSION['erreur']= "Mot de passe incorrect ou Membre non inscrit sur lePetitBal";
			header('Refresh: 0 ; url='.$bouton_retour); 
        }
        else{
			//Update le nouveau MDP
			require_once('../../modele/update_mdp_membre.php');
			$pass_hache_new = sha1($password_membre_new);
			update_mdp_membre($email_membre,$pass_hache_new);
			$_SESSION['success'] ="Votre mot de passe a bien été mis à jour!";
			header('Refresh: 0 ; url='.$bouton_retour);
		}
	}
	else{
		$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
}
else{
	$_SESSION['erreur']= "Vous n\'avez pas les droits d\'accès.";
	header('Refresh: 0 ; url='.$bouton_retour);
}
