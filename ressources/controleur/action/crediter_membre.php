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
	if(!empty($_POST['email_credit']) AND !empty($_POST['nb_jeton_credit']) AND !empty($_SESSION['pseudo_membre']) AND !empty($_SESSION['email_membre']))
    {
        if (isset($_POST['email_credit']) AND isset($_POST['nb_jeton_credit']) AND isset($_SESSION['pseudo_membre']) AND isset($_SESSION['email_membre']))
        {
			if($_SESSION['email_membre']=="davyphay@gmail.com"){
				$email_credit=htmlspecialchars($_POST['email_credit']);
				$nb_jeton=htmlspecialchars($_POST['nb_jeton_credit']);
				
				require_once('../../modele/connexion_sql.php');  // Connexion base sql
				require_once('../../modele/update_gestion_jeton.php');
				update_gestion_jeton($email_credit,$nb_jeton);
				$_SESSION['success']= "Le compte à été crédité";
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