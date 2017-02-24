<meta charset="utf-8">
<?php
	function cleanURL($URL){
		$input = $URL;
		// in case scheme relative URI is passed, e.g., //www.google.com/
		$input = trim($input, '/');
		// If scheme not included, prepend it
		if (!preg_match('#^http(s)?://#', $input)) {
			$input = 'http://' . $input;
		}
		$urlParts = parse_url($input);
		// remove www
		$path="";
		if (isset($urlParts['path'])){
			$path=$urlParts['path'];
		}
		$domain = preg_replace('/^www\./', '', $urlParts['host'].$path);
		$domain = trim($domain,'/');
		return $domain;
	}
	function addDayswithdate($date,$days){
		$date = strtotime("+".$days." days", strtotime($date));
		return  date("Y-m-d", $date);
	}
	
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
		$adresse_email = $_SESSION['email_membre'];
		if(!empty($_POST['id_lieu_add'])){
			$id_lieu_evenement= htmlspecialchars($_POST['id_lieu_add']);
			if(!empty($_POST['date_evenement_add']) AND !empty($_POST['heure_debut_evenement_add']) AND !empty($_POST['heure_fin_evenement_add']) AND !empty($_POST['titre_evenement_add']) AND !empty($_POST['danse_pratique_evenement_add']) AND !empty($_POST['tarifs_evenement_add'])){
				if(isset($_POST['date_evenement_add']) AND isset($_POST['heure_debut_evenement_add']) AND isset($_POST['heure_fin_evenement_add']) AND isset($_POST['titre_evenement_add']) AND isset($_POST['danse_pratique_evenement_add']) AND isset($_POST['tarifs_evenement_add'])){
					//Infos obligatoires	
					$date_evenement = htmlspecialchars($_POST['date_evenement_add']);// Exemple 1
					$date_evenement_array = explode(",",$date_evenement);
					$nb_event_add = count($date_evenement_array);

					$heure_debut_evenement = htmlspecialchars($_POST['heure_debut_evenement_add']);
					$heure_fin_evenement = htmlspecialchars($_POST['heure_fin_evenement_add']);
					$titre_evenement= htmlspecialchars($_POST['titre_evenement_add']);
					$danse_pratique_evenement= htmlspecialchars($_POST['danse_pratique_evenement_add']);
					$tarifs_evenement= htmlspecialchars($_POST['tarifs_evenement_add']);
					$adresse_email_evenement = $adresse_email;
					
					/* AJOUT Nouveau Lieu ou lieu existant*/
					if($id_lieu_evenement=="nouveau_lieu" || $id_lieu_evenement=="recherche_lieu"){
						if(isset($_POST['nom_lieu_evenement_add']) || isset($_POST['nom_lieu_evenement_recherche'])){
							//Check voir si le nom existe déjà
							if(!empty($_POST['nom_lieu_evenement_add'])){
								$nom_lieu=htmlspecialchars($_POST['nom_lieu_evenement_add']);

							}
							else if(!empty($_POST['nom_lieu_evenement_recherche'])){
								$nom_lieu=htmlspecialchars($_POST['nom_lieu_evenement_recherche']);
							}
							require_once('../../modele/connexion_sql.php');  // Connexion base sql
							require_once('../../modele/get_id_nom_lieu_no_proprio.php');
							$id_nom_lieu=json_decode(get_id_nom_lieu_no_proprio($nom_lieu));
							$id_lieu = $id_nom_lieu[0]->id_lieu;
							if(!$id_nom_lieu){ // si=0, on crée un nouveau lieu
								if(isset($_POST['adresse_lieu_event']) AND isset($_POST['type_lieu_event']) AND isset($_POST['gps_lieu_event'])){
									require_once('../../modele/put_lieu_temporaire.php');
									$adresse_lieu=htmlspecialchars($_POST['adresse_lieu_event']);
									// Gestion des coordonnées GPS du lieu
									$coordGPS = htmlspecialchars($_POST['gps_lieu_event']);
									sscanf($coordGPS, '(%f, %f)', $latitude_lieu, $longitude_lieu);
									$type_lieu=htmlspecialchars($_POST['type_lieu_event']);
									$adresse_email_ajout_lieu=$adresse_email;
									$insert_id = put_lieu_temporaire($nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$type_lieu,$adresse_email_ajout_lieu);
									$id_lieu_evenement = $insert_id;
								}
							}
							else{ // si=1, on prend un lieu existant
								$id_lieu_evenement = $id_lieu;
							}
						}
						else{
							$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
							header('Refresh: 0 ; url='.$bouton_retour);
						}
					}
					//Infos optionnelles
					$description_evenement ="";
					$url_fb_evenement ="";
					$initiation_evenement =0;
					$special_evenement =0;
					if(isset($_POST['description_evenement_add'])){
						$description_evenement = str_replace('"','',json_encode(htmlspecialchars($_POST['description_evenement_add'])));
					};
					if(isset($_POST['url_fb_evenemen_addt'])){
						$url_fb_evenement = htmlspecialchars($_POST['url_fb_evenement_add']);
						$url_fb_evenement = cleanURL($url_fb_evenement);
					};
					if(isset($_POST['initiation_evenement_add'])){
						$initiation_evenement = 1;
					};
					if(isset($_POST['special_evenement_add'])){
						$special_evenement = 1;
					};
					if(isset($_POST['organisateur_evenement_add'])){
						$organisateur_evenement = htmlspecialchars($_POST['organisateur_evenement_add']);
					};
					
					//Gestion des communautés
					$communaute_evenement_salsa="0";
					$communaute_evenement_bachata="0";
					$communaute_evenement_kizomba="0";
					$communaute_evenement_rock4T="0";
					$communaute_evenement_rock6T ="0";
					$communaute_evenement_swing="0";
					$communaute_evenement_wcs="0";
					$communaute_evenement_tango="0";
					$communaute_evenement_salon="0";
					if(isset($_POST['communaute_evenement_salsa_add'])){
						$communaute_evenement_salsa="S";
					}
					if(isset($_POST['communaute_evenement_bachata_add'])){
						$communaute_evenement_bachata="B";
					}
					if(isset($_POST['communaute_evenement_kizomba_add'])){
						$communaute_evenement_kizomba="K";
					}
					if(isset($_POST['communaute_evenement_rock4T_add'])){
						$communaute_evenement_rock4T="4";
					}
					if(isset($_POST['communaute_evenement_rock6T_add'])){
						$communaute_evenement_rock6T="6";
					}
					if(isset($_POST['communaute_evenement_swing_add'])){
						$communaute_evenement_swing="S";
					}
					if(isset($_POST['communaute_evenement_wcs_add'])){
						$communaute_evenement_wcs="W";
					}
					if(isset($_POST['communaute_evenement_tango_add'])){
						$communaute_evenement_tango="T";
					}
					if(isset($_POST['communaute_evenement_salon_add'])){
						$communaute_evenement_salon="S";
					}					
					$communaute_evenement = $communaute_evenement_salsa."-".$communaute_evenement_bachata."-".$communaute_evenement_kizomba."-".$communaute_evenement_rock4T."-".$communaute_evenement_rock6T."-".$communaute_evenement_swing."-".$communaute_evenement_wcs."-".$communaute_evenement_tango."-".$communaute_evenement_salon;
					
					//Vérif du nombre de jetons
					$cout_jeton_unitaire = 0; // A MODIFIER

					$jeton_dispo = 0; // par défaut
					require_once('../../modele/connexion_sql.php');  // Connexion base sql
					require_once('../../modele/get_info_membre.php');
					$info_membre = get_info_membre($adresse_email);
					if($info_membre[0]!==""){
						$jeton_dispo = (int)$info_membre[1];
					}
					$cout_jeton_total = $nb_event_add * $cout_jeton_unitaire;
					if($jeton_dispo>=$cout_jeton_total){
						require_once('../../modele/connexion_sql.php');  // Connexion base sql
						require_once('../../modele/put_evenement_bdd.php');
						for($i=0;$i<$nb_event_add;$i++){
							//formatage de la date
							$time = strtotime($date_evenement_array[$i]);
							$date_evenement_format = date('Y-m-d',$time);
							//Envoi à la bdd
							put_event_bdd($id_lieu_evenement,$date_evenement_format,$heure_debut_evenement,$heure_fin_evenement,$titre_evenement,$organisateur_evenement, $danse_pratique_evenement, $tarifs_evenement,$description_evenement,$url_fb_evenement,$initiation_evenement,$special_evenement,$adresse_email_evenement,$communaute_evenement,$cout_jeton_unitaire);
						}
						$_SESSION['success']="L'évènement à bien été ajouté!";
						$_SESSION['redirection']="evenement";
						header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");
					}
					else{
						$_SESSION['redirection']="evenement";
						$_SESSION['erreur']="Vous ne disposez pas d'assez de jetons !";
						header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");	
					}
				}
				else{
					$_SESSION['redirection']="evenement";
					$_SESSION['erreur']="Une erreur est survenue: Information manquante";
					header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");
				}
			}
			else{
				$_SESSION['redirection']="evenement";
				$_SESSION['erreur']="Une erreur est survenue: Information manquante";
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
;?>