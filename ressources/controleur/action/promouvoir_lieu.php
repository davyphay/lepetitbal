<meta charset="utf-8">
<?php
	//Vérifications
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
	if(!empty($_POST['id_lieu']) && isset($_POST['id_lieu'])){
	   $id_lieu = $_POST['id_lieu'];
	   $_SESSION['redirection']="promotion_lieu";
		if(!empty($_POST['nb_jetons_utilise']) AND !empty($_POST['date_picker']) AND !empty($_POST['boolean_proprio']) AND !empty($_SESSION['email_membre']))
		{
			if(isset($_POST['nb_jetons_utilise']) AND isset($_POST['date_picker']) AND isset($_POST['boolean_proprio']) AND isset($_SESSION['email_membre']))
			{
	
				//stockage des variables post
				$id_lieu = htmlspecialchars($_POST['id_lieu']);
				$nb_jetons_utilise = htmlspecialchars($_POST['nb_jetons_utilise']);
				$date_picker = htmlspecialchars($_POST['date_picker']);
				$boolean_proprio = htmlspecialchars($_POST['boolean_proprio']);
				$email_membre = $_SESSION['email_membre'];
				
				if($boolean_proprio==2){
					$email_proprietaire_lieu = $email_membre;
				}else{
					$email_proprietaire_lieu ="";
				}
				//convertion string  "16-05-2016" en date 2016-05-16
				$time = strtotime($date_picker);
				$date_picker_new_format = date('Y-m-d',$time);
	
				require_once('../../modele/connexion_sql.php');  // Connexion base sql
				require_once('../../modele/update_promotion_lieu.php');
				update_promotion_lieu($id_lieu,$email_proprietaire_lieu,$email_membre,$nb_jetons_utilise,$date_picker_new_format);
				$_SESSION['success']= "Le lieu à été promu jusqu'au ".$date_picker;
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
				
			}
			else{
				$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
			}
		}
		else{
			$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
			header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
		}
	}
	else{
		$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
?>