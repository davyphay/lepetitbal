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
		if(!empty($_POST['pseudo_commentaire'])){
			if(!empty($_POST['lieu_commentaire']) AND !empty($_POST['contenu_commentaire']) AND !empty($_POST['pseudo_commentaire']) AND !empty($_SESSION['email_membre']))
			{
				if (isset($_POST['lieu_commentaire']) AND isset($_POST['contenu_commentaire']) AND isset($_POST['pseudo_commentaire']) AND isset($_SESSION['email_membre']))
				{
					$id_lieu=$_POST['lieu_commentaire'];
					$contenu=$_POST['contenu_commentaire'];
					$pseudo=$_POST['pseudo_commentaire'];
					$adresse_mail=$_SESSION['email_membre'];
					$_SESSION['communaute_rechercher_lieu']=$_POST['communaute_input'];
					require_once('../../modele/connexion_sql.php');  // Connexion base sql
					require_once('../../modele/put_commentaire.php');
					put_commentaire($id_lieu,$contenu,$pseudo,$adresse_mail);
					$_SESSION['redirection']="commentaire";
					$_SESSION['redirection_value']=$numero_billet;
					$_SESSION['success']="Votre commentaire a été ajouté";
					header('Refresh: 0 ; url='.$bouton_retour);
				}
				else{
					$_SESSION['redirection']="commentaire";
					$_SESSION['redirection_value']=$numero_billet;
					$_SESSION['erreur']="Une erreur est survenue: Information manquante";
					header('Refresh: 0 ; url='.$bouton_retour);
				}
			}
			else{
				$_SESSION['redirection']="commentaire";
				$_SESSION['redirection_value']=$numero_billet;
				$_SESSION['erreur']="Une erreur est survenue: Information manquante";
				header('Refresh: 0 ; url='.$bouton_retour);
			}
		}
		else{
			$_SESSION['redirection']="commentaire";
			$_SESSION['redirection_value']=$numero_billet;
			$_SESSION['erreur']="Veuillez saisir un pseudo";
			header('Refresh: 0 ; url='.$bouton_retour);	
		}
	}
	else{
		$_SESSION['erreur']="Numero de post invalide";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
?>