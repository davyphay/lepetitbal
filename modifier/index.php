<!DOCTYPE html>
<?php
	include '../ressources/controleur/action/session.inc';
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
	if(!empty($_SESSION['email_membre'])){
		check_login();
		if(!empty($_GET['id_lieu'])){
			//Vérif de l'id lieu dans la database
			require_once('../ressources/modele/connexion_sql.php');  // Connexion Base sql
			require_once('../ressources/modele/verif_id_lieu.php');
			if($count !== 0){ // si il trouve une valeur, alors c'est bon
				//Recuperation des données coté serveur en fonction de l'id lieu
				require_once('../ressources/modele/get_proprio.php');
				$id_lieu=htmlspecialchars($_GET['id_lieu']);
				$email_proprietaire_lieu = get_proprio($id_lieu);
				
				$email_membre = $_SESSION['email_membre'];
				$pseudo_membre = $_SESSION['pseudo_membre'];
				$plateforme = $_SESSION['from'];
				$nb_jeton_dispo ="";
				$membre_statut= "Membre";
				$boolean_proprio="";
				if($email_proprietaire_lieu!==""){
					$boolean_proprio=2;
				}
				else{
					$boolean_proprio=1;
				}
				//Statut par défaut
				$nb_jeton_dispo=0; 
				$membre_statut= "Membre";
				$proprio=0;
				$fiche_visible=0;
				$admin="";
				
				//CONTROLE DE L'ID DU PROPRIO
				if($boolean_proprio==2){ // si le lieux possède un proprietaire
					$fiche_visible=0;
					if($email_membre==$email_proprietaire_lieu){
						$fiche_visible=1;
					}
				}

				//Si admin
				if($email_membre=="davyphay@gmail.com"){
					$fiche_visible=1;
				}
				
				if($fiche_visible==1){
					//Information du membre
					require('../ressources/modele/connexion_sql.php');  // Connexion Base sql 
					include_once('../ressources/modele/get_info_membre.php');
					$array_annonceur = get_info_membre($email_membre);
					if($array_annonceur[0]!==""){
						$nb_jeton_dispo =$array_annonceur[1];
						$nb_lieu_proprietaire = count($array_annonceur[2]);
						if($nb_jeton_dispo===""){
							$membre_statut="Membre";
						}
						else{
							$membre_statut="Annonceur";
							if($nb_lieu_proprietaire>0){
								$proprio=1;
								$liste_id_lieu_proprio = $array_annonceur[2];
								$liste_nom_lieu_proprio = $array_annonceur[3];
							}
						}
					}
					if($email_membre=="davyphay@gmail.com"){
						$admin=1;
						$membre_statut="Admin";
					}
					
					//Gère la redirection et les valeurs
					$redirection="event_lieu";
					if(isset($_SESSION['redirection'])){
						if($_SESSION['redirection']=="fiche_lieu"){
							$redirection ="fiche_lieu";
						}
						else if($_SESSION['redirection']=="promotion_lieu"){
							$redirection="promotion_lieu";
						}
						unset($_SESSION['redirection']); 
					}
					//Afficher les infos sur la page
					include_once('../ressources/controleur/action/afficher_info_lieu.php');
					//Traitement des messages d'erreurs et de succès
					if(isset($_SESSION['erreur'])){
						echo'<script type="text/javascript" src="../ressources/controleur/js/alertify/alertify.min.js"></script>';
						echo'<script>alertify.error("'.$_SESSION['erreur'].'")</script>';
						unset($_SESSION['erreur']);
					}
					if(isset($_SESSION['success'])){
						echo'<script type="text/javascript" src="../ressources/controleur/js/alertify/alertify.min.js"></script>';
						echo'<script>alertify.success("'.$_SESSION['success'].'")</script>';
						unset($_SESSION['success']);
					}
				}
				else{
					$_SESSION['erreur']= "Vous n'avez pas les droits d'accès.";
					header('Refresh: 0 ; url='.$bouton_retour);	
				}
			}
			else{
				$_SESSION['erreur']= "Lieu inconnu, veuillez réessayer.";
				header('Refresh: 0 ; url='.$bouton_retour);	
			}				
		}
		else{
			$_SESSION['erreur']= "Lieu inconnu, veuillez réessayer.";
			header('Refresh: 0 ; url='.$bouton_retour);	
		}
	}
	else{
		$_SESSION['erreur']= "Vous n\'avez pas les droits d\'accès.";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
?>




