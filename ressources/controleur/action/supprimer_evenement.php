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
if(isset($_SESSION['email_membre'])){
	if(isset($_POST['id_lieu_evenement'])){
		$id_lieu_evenement =$_POST['id_lieu_evenement'];
		if(isset($_POST['id_evenement_delete'])){
			
			$id_evenement = $_POST['id_evenement_delete'];
			require_once('../../modele/connexion_sql.php');  // Connexion Base sql
			require_once('../../modele/get_proprio.php');
			$email_membre=$_SESSION['email_membre'];
			$email_proprietaire_evenement = get_proprio_event($id_evenement);
			
			if($email_membre==$email_proprietaire_evenement){
				require_once('../../modele/connexion_sql.php');  // Connexion base sql
				require_once('../../modele/delete_evenement_bdd.php');
				delete_evenement_bdd($id_evenement);
				$_SESSION['redirection']="evenement";
				$_SESSION['success'] ="L'évènement à bien été supprimé!";
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");
			}
			else{
				$_SESSION['redirection']="evenement";
				$_SESSION['erreur']= "Vous n'êtes pas autorisé à supprimer cet évènement";
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement"); 
			}
		}
		else{
			$_SESSION['redirection']="evenement";
			$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
			header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement"); 
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