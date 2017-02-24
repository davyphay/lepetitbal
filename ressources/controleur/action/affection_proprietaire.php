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
	if(!empty($_POST['affection_email_proprio']) AND !empty($_POST['affection_proprio_lieu']) AND !empty($_SESSION['pseudo_membre']) AND !empty($_SESSION['email_membre']))
    {
        if (isset($_POST['affection_email_proprio']) AND isset($_POST['affection_proprio_lieu']) AND isset($_SESSION['pseudo_membre']) AND isset($_SESSION['email_membre']))
        {
			if($_SESSION['email_membre']=="davyphay@gmail.com"){
				$email_proprio=htmlspecialchars($_POST['affection_email_proprio']);
				$nom_lieu_proprio=htmlspecialchars($_POST['affection_proprio_lieu']);
				
				require_once('../../modele/connexion_sql.php');  // Connexion base sql
				require_once('../../modele/update_proprietaire_lieu.php');
				update_proprietaire_lieu($email_proprio,$nom_lieu_proprio);
				$_SESSION['success']= "Le propriétaire a bien été affecté";
				header('Refresh: 0 ; url='.$bouton_retour);	
			}
			else{
				$_SESSION['erreur']= "Vous n'avez pas les droits d'accès";
				header('Refresh: 0 ; url='.$bouton_retour);				
			}
		}
        else{
			$_SESSION['erreur']= "Veuillez remplir correctement tous les champs";
			header('Refresh: 0 ; url='.$bouton_retour);
		}
	}
	else{
		$_SESSION['erreur']= "Veuillez remplir correctement tous les champs";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
?>