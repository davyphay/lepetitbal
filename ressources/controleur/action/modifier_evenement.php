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
	if(isset($_POST['id_evenement']) AND isset($_POST['id_lieu_evenement'])){
		
		$id_evenement = htmlspecialchars($_POST['id_evenement']);
		$id_lieu_evenement = htmlspecialchars($_POST['id_lieu_evenement']);
		require_once('../../modele/connexion_sql.php');  // Connexion Base sql
		require_once('../../modele/get_proprio.php');
		$email_membre=$_SESSION['email_membre'];
		$email_proprietaire_evenement = get_proprio_event($id_evenement);
		
		if($email_membre==$email_proprietaire_evenement){
			if(isset($_POST['id_lieu_evenement']) AND isset($_POST['date_evenement']) AND isset($_POST['heure_debut_evenement']) AND isset($_POST['heure_fin_evenement']) AND isset($_POST['titre_evenement']) AND isset($_POST['danse_pratique_evenement']) AND isset($_POST['tarifs_evenement'])){
				//Infos obligatoires
				$date_evenement = htmlspecialchars($_POST['date_evenement']);
				$heure_debut_evenement = htmlspecialchars($_POST['heure_debut_evenement']);
				$heure_fin_evenement = htmlspecialchars($_POST['heure_fin_evenement']);
				$titre_evenement= htmlspecialchars($_POST['titre_evenement']);
				$danse_pratique_evenement= htmlspecialchars($_POST['danse_pratique_evenement']);
				$tarifs_evenement= htmlspecialchars($_POST['tarifs_evenement']);
				
				$time = strtotime($date_evenement);
				$date_evenement = date('Y-m-d',$time);
				//Infos optionnelles
				$description_evenement ="";
				$url_fb_evenement ="";
				$initiation_evenement =0;
				$special_evenement =0;
				if(isset($_POST['description_evenement'])){
					$description_evenement = str_replace('"','',json_encode(htmlspecialchars($_POST['description_evenement'])));
				};
				if(isset($_POST['url_fb_evenement'])){
					$url_fb_evenement = htmlspecialchars($_POST['url_fb_evenement']);
					$url_fb_evenement = cleanURL($url_fb_evenement);
				};
				if(isset($_POST['initiation_evenement'])){
					$initiation_evenement = 1;
				};
				if(isset($_POST['special_evenement'])){
					$special_evenement = 1;
				};
				if(isset($_POST['organisateur_evenement'])){
					$organisateur_evenement = htmlspecialchars($_POST['organisateur_evenement']);
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
				if(isset($_POST['communaute_evenement_salsa'])){
					$communaute_evenement_salsa="S";
				}
				if(isset($_POST['communaute_evenement_bachata'])){
					$communaute_evenement_bachata="B";
				}
				if(isset($_POST['communaute_evenement_kizomba'])){
					$communaute_evenement_kizomba="K";
				}
				if(isset($_POST['communaute_evenement_rock4T'])){
					$communaute_evenement_rock4T="4";
				}
				if(isset($_POST['communaute_evenement_rock6T'])){
					$communaute_evenement_rock6T="6";
				}
				if(isset($_POST['communaute_evenement_swing'])){
					$communaute_evenement_swing="S";
				}
				if(isset($_POST['communaute_evenement_wcs'])){
					$communaute_evenement_wcs="W";
				}
				if(isset($_POST['communaute_evenement_tango'])){
					$communaute_evenement_tango="T";
				}
				if(isset($_POST['communaute_evenement_salon'])){
					$communaute_evenement_salon="S";
				}					
				$communaute_evenement = $communaute_evenement_salsa."-".$communaute_evenement_bachata."-".$communaute_evenement_kizomba."-".$communaute_evenement_rock4T."-".$communaute_evenement_rock6T."-".$communaute_evenement_swing."-".$communaute_evenement_wcs."-".$communaute_evenement_tango."-".$communaute_evenement_salon;
				require_once('../../modele/connexion_sql.php');  // Connexion base sql
				require_once('../../modele/update_evenement_bdd.php');
				update_evenement_bdd($id_evenement,$id_lieu_evenement,$date_evenement,$heure_debut_evenement,$heure_fin_evenement,$titre_evenement,$organisateur_evenement, $danse_pratique_evenement, $tarifs_evenement,$description_evenement,$url_fb_evenement,$initiation_evenement,$special_evenement,$communaute_evenement);
				$_SESSION['success'] ="L'évènement à bien été mis à jour!";
				$_SESSION['redirection']="evenement";
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");
			}
			else{
				$_SESSION['redirection']="evenement";
				$_SESSION['erreur']= "Des champs obligatoires n\'ont pas été remplis.";
				header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu_evenement");	
			}
		}
		else{
		$_SESSION['redirection']="evenement";
		$_SESSION['erreur']= "Vous n'êtes pas autorisé à modifier cet évènement";
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