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
    if(!empty($_POST['nom_lieu']) AND !empty($_POST['adresse_lieu']) AND !empty($_POST['type_lieu']) AND !empty($_POST['gps_lieu']) AND !empty($_SESSION['pseudo_membre']) AND !empty($_SESSION['email_membre']))
    {
        if (isset($_POST['nom_lieu']) AND isset($_POST['adresse_lieu']) AND isset($_POST['type_lieu']) AND isset($_POST['gps_lieu']) AND isset($_SESSION['pseudo_membre']) AND isset($_SESSION['email_membre']))
        {
            require_once('../../modele/connexion_sql.php');  // Connexion base sql
            //Gestion du nom/adresse du lieu
            $nom_lieu = htmlspecialchars($_POST['nom_lieu']);
            $adresse_lieu = htmlspecialchars($_POST['adresse_lieu']);
            $type_lieu = htmlspecialchars($_POST['type_lieu']);
            $adresse_email_ajout_lieu = htmlspecialchars($_SESSION['email_membre']);
			$proprietaire_lieu = htmlspecialchars($_POST['proprietaire_lieu']);
			//Gestion des communautés
			$communaute_lieu_salsa="0";
			$communaute_lieu_bachata="0";
			$communaute_lieu_kizomba="0";
			$communaute_lieu_rock4T="0";
			$communaute_lieu_rock6T ="0";
			$communaute_lieu_swing="0";
			$communaute_lieu_wcs="0";
			$communaute_lieu_tango="0";
			$communaute_lieu_salon="0";
			if(isset($_POST['communaute_lieu_salsa'])){
				$communaute_lieu_salsa="S";
			}
			if(isset($_POST['communaute_lieu_bachata'])){
				$communaute_lieu_bachata="B";
			}
			if(isset($_POST['communaute_lieu_kizomba'])){
				$communaute_lieu_kizomba="K";
			}
			if(isset($_POST['communaute_lieu_rock4T'])){
				$communaute_lieu_rock4T="4";
			}
			if(isset($_POST['communaute_lieu_rock6T'])){
				$communaute_lieu_rock6T="6";
			}
			if(isset($_POST['communaute_lieu_swing'])){
				$communaute_lieu_swing="S";
			}
			if(isset($_POST['communaute_lieu_wcs'])){
				$communaute_lieu_wcs="W";
			}
			if(isset($_POST['communaute_lieu_tango'])){
				$communaute_lieu_tango="T";
			}
			if(isset($_POST['communaute_lieu_salon'])){
				$communaute_lieu_salon="S";
			}					
			$communaute_lieu = $communaute_lieu_salsa."-".$communaute_lieu_bachata."-".$communaute_lieu_kizomba."-".$communaute_lieu_rock4T."-".$communaute_lieu_rock6T."-".$communaute_lieu_swing."-".$communaute_lieu_wcs."-".$communaute_lieu_tango."-".$communaute_lieu_salon;
            
            //Gestion des activités
            $activite_cours="0";
            $activite_soiree="0";
            $activite_event="0";
            if(isset($_POST['activite_cours'])){
                $activite_cours="C";
            }
            if(isset($_POST['activite_soiree'])){
                $activite_soiree="S";
            }
            if(isset($_POST['activite_event'])){
                $activite_event="E";
            }
            $activite_lieu = $activite_cours."-".$activite_soiree."-".$activite_event;
            
            // Gestion des coordonnées GPS du lieu
            $coordGPS = htmlspecialchars($_POST['gps_lieu']);
            sscanf($coordGPS, '(%f, %f)', $latitude_lieu, $longitude_lieu);

            require_once('../../modele/put_lieuBdd.php');
            put_lieuBdd($nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$activite_lieu,$type_lieu,$proprietaire_lieu);
            $_SESSION['success']="Le lieu a bien été ajouté!";
            header('Refresh: 0 ; url='.$bouton_retour);
        }
        else{
            $_SESSION['erreur']="Une erreur est survenue: Information manquante";
            header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
        }
    }
    else{
        $_SESSION['erreur']="Une erreur est survenue: Information manquante";
        header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
    }
?>