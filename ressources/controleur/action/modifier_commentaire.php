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
if(!empty($_POST['numero_billet_commentaire']) && isset($_POST['numero_billet_commentaire'])){
		$numero_billet=$_POST['numero_billet_commentaire'];
	if(isset($_SESSION['email_membre'])){
		if(isset($_POST['id_commentaire']) AND isset($_POST['adresse_email_commentaire']) AND isset($_POST['modifier_commentaire_type'])){
			$adresse_email_commentaire =htmlspecialchars($_POST['adresse_email_commentaire']);
			$adresse_email_session = $_SESSION['email_membre'];
			$id_commentaire= intval(htmlspecialchars($_POST['id_commentaire']));
			$type_modification = htmlspecialchars($_POST['modifier_commentaire_type']);
			if($adresse_email_commentaire=$adresse_email_session){
				if($type_modification=="supprimer"){
				require_once('../../modele/connexion_sql.php');  // Connexion Base sql
				require_once('../../modele/delete_commentaire_bdd.php');
				delete_commentaire_bdd($id_commentaire);
				$_SESSION['redirection']="commentaire";
				$_SESSION['redirection_value']=$numero_billet;
				$_SESSION['success']="Votre commentaire a été supprimé";
				header('Refresh: 0 ; url='.$bouton_retour);
				}
				else if($type_modification=="modifier"){
					if(isset($_POST['modifier_commentaire_content'])){
						$contenu_commentaire=htmlspecialchars($_POST['modifier_commentaire_content']);
						require_once('../../modele/connexion_sql.php');  // Connexion Base sql
						require_once('../../modele/update_commentaire_bdd.php');
						update_commentaire_bdd($id_commentaire,$contenu_commentaire);
						$_SESSION['redirection']="commentaire";
						$_SESSION['redirection_value']=$numero_billet;
						$_SESSION['success']="Votre commentaire a été modifié";
						header('Refresh: 0 ; url='.$bouton_retour);
					}
					else{
						$_SESSION['erreur']= "Des informations sont manquantes.";
						$_SESSION['redirection']="commentaire";
						$_SESSION['redirection_value']=$numero_billet;
						header('Refresh: 0 ; url='.$bouton_retour);	
					}
				}
				else{
					$_SESSION['erreur']= "Des informations sont manquantes.";
					$_SESSION['redirection']="commentaire";
					$_SESSION['redirection_value']=$numero_billet;
					header('Refresh: 0 ; url='.$bouton_retour);
				}
			}
			else{
				$_SESSION['erreur']= "Vous ni disposez pas de la bonne adresse email.";
				$_SESSION['redirection']="commentaire";
				$_SESSION['redirection_value']=$numero_billet;
				header('Refresh: 0 ; url='.$bouton_retour);
			}
		}
		else{
		$_SESSION['erreur']= "Des informations sont manquantes.";
		$_SESSION['redirection']="commentaire";
		$_SESSION['redirection_value']=$numero_billet;
		header('Refresh: 0 ; url='.$bouton_retour);
		}
	}
	else{
		$_SESSION['erreur']= "Vous devez cous connecter pour supprimer un commentaire.";
		$_SESSION['redirection']="commentaire";
		$_SESSION['redirection_value']=$numero_billet;
		header('Refresh: 0 ; url='.$bouton_retour);
	}
}
else{
	$_SESSION['erreur']="Numero de post invalide";
	header('Refresh: 0 ; url='.$bouton_retour);
}	
