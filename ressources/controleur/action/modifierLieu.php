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
	if (isset($_POST['id_lieu']) AND isset($_POST['nom_lieu']) AND isset($_POST['adresse_lieu']) AND isset($_POST['gps_lieu']))
	{
		$_SESSION['redirection']="fiche_lieu";
		require_once('../../modele/connexion_sql.php');  // Connexion base sql
		$id_lieu = htmlspecialchars($_POST['id_lieu']);
		$nom_lieu = htmlspecialchars($_POST['nom_lieu']);
		$adresse_lieu = htmlspecialchars($_POST['adresse_lieu']);
		$type_lieu = htmlspecialchars($_POST['type_lieu']);
		$id_cours_hebdo_value = htmlspecialchars($_POST['id_cours_hebdo']);
		$id_soiree_hebdo_value = htmlspecialchars($_POST['id_soiree_hebdo']);

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
		if(isset($_POST['activite_lieu_cours'])){
			$activite_cours="C";
		}
		if(isset($_POST['activite_lieu_soiree'])){
			$activite_soiree="S";
		}
		if(isset($_POST['activite_lieu_event'])){
			$activite_event="E";
		}
		$activite_lieu = $activite_cours."-".$activite_soiree."-".$activite_event;
		//Gestion des coords gps
		$coordGPS = htmlspecialchars($_POST['gps_lieu']);
		sscanf($coordGPS,'(%f, %f)',$latitude_lieu, $longitude_lieu);
		//VERIF DROITS MODIF PROMOTION
		$promotion="";
		require_once('../../modele/get_info_promotion.php');
		$promotion= get_info_promotion($id_lieu);

		require_once('../../modele/update_lieuBdd.php');
		//if($promotion==1){ // si promotion

			//Gestion description
			if(isset($_POST['description_lieu'])){
				$description_lieu = str_replace('"','',json_encode(htmlspecialchars($_POST['description_lieu'])));
			}
			else{
				$description_lieu="";
			}
			
			if(isset($_POST['URL_web_lieu'])){
				$URL_web_lieu = htmlspecialchars($_POST['URL_web_lieu']);
				$URL_web_lieu = cleanURL($URL_web_lieu);
			}
			else{
				$URL_web_lieu="";
			}
			
			//Lien upload photo 
			require('upload_photo.php'); // Défini $URL_photo_lieu et $URL_photo_min_lieu

			update_lieuBdd_annonceur($id_lieu,$nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$type_lieu,$activite_lieu,$description_lieu,$URL_web_lieu,$URL_photo_lieu);
			$_SESSION['success'].= "La fiche du lieu à bien été modifiée";
		/*}
		else{ // sinon pas de promotion
			update_lieuBdd_membre($id_lieu,$nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$type_lieu,$activite_lieu);
			$_SESSION['success']= "La fiche du lieu à bien été modifiée";
		}*/

		// UPDATE COURS HEBDO
		//Transform des données récoltées dans la table en un tableau lisible
		//COURS
		if(isset($_POST['cours_changement'])){ // SI CHANGEMENT DANS LE TABLEAU DES COURS
			if($_POST['cours_changement']=="yes"){
				require_once('transformTable_cours.php');
				if($tableForm_cours_hebdo_value =='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (niveau,professeur,salle,...)</th><th>Ajouter/ Supprimer</th></tr><tr id="tr_lundi_0" class="cours-lundi"><td class="jour" id="td_cours_lundi" rowspan="1">Lundi</td><td><input type="text" class="form-control-table" name="horaire_lundi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_lundi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_lundi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_lundi" class="boutons_jour" value-rs="1"><button type="button" value="lundi" onclick="addinputs(this)">+</button><button type="button" value="lundi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_mardi_0" class="cours-mardi"><td class="jour" id="td_cours_mardi" rowspan="1">Mardi</td><td><input type="text" class="form-control-table" name="horaire_mardi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_mardi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_mardi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_mardi" class="boutons_jour" value-rs="1"><button type="button" value="mardi" onclick="addinputs(this)">+</button><button type="button" value="mardi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_mercredi_0" class="cours-mercredi"><td class="jour" id="td_cours_mercredi" rowspan="1">Mercredi</td><td><input type="text" class="form-control-table" name="horaire_mercredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_mercredi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_mercredi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_mercredi" class="boutons_jour" value-rs="1"><button type="button" value="mercredi" onclick="addinputs(this)">+</button><button type="button" value="mercredi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_jeudi_0" class="cours-jeudi"><td class="jour" id="td_cours_jeudi" rowspan="1">Jeudi</td><td><input type="text" class="form-control-table" name="horaire_jeudi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_jeudi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_jeudi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_jeudi" class="boutons_jour" value-rs="1"><button type="button" value="jeudi" onclick="addinputs(this)">+</button><button type="button" value="jeudi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_vendredi_0" class="cours-vendredi"><td class="jour" id="td_cours_vendredi" rowspan="1">Vendredi</td><td><input type="text" class="form-control-table" name="horaire_vendredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_vendredi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_vendredi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_vendredi" class="boutons_jour" value-rs="1"><button type="button" value="vendredi" onclick="addinputs(this)">+</button><button type="button" value="vendredi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_samedi_0" class="cours-samedi"><td class="jour" id="td_cours_samedi" rowspan="1">Samedi</td><td><input type="text" class="form-control-table" name="horaire_samedi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_samedi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_samedi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_samedi" class="boutons_jour" value-rs="1"><button type="button" value="samedi" onclick="addinputs(this)">+</button><button type="button" value="samedi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_dimanche_0" class="cours-dimanche"><td class="jour" id="td_cours_dimanche" rowspan="1">Dimanche</td><td><input type="text" class="form-control-table" name="horaire_dimanche[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_dimanche[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_dimanche[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_dimanche" class="boutons_jour" value-rs="1"><button type="button" value="dimanche" onclick="addinputs(this)">+</button><button type="button" value="dimanche" onclick="deleteinputs(this)">x</button></td></tr></table>')
				{
					//Suppression de la table dans la BDD
					require_once('../../modele/delete_event_hebdoBdd.php');
					delete_cours_hebdoBdd($id_lieu);
					$_SESSION['success'].= " (+planning cours supprimé)";
					header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
				}
				else{
					// Mise dans la BDD
					require_once('../../modele/put_event_hebdoBdd.php');
					put_cours_hebdoBdd($id_lieu,$tableForm_cours_hebdo_value,$tableDisplay_cours_hebdo_value);
					$_SESSION['success'].= " (+planning cours modifié)";
					header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
				}
			}
		}
		//SOIREES
		if(isset($_POST['soiree_changement'])){ // SI CHANGEMENT DANS LE TABLEAU DES COURS
			if($_POST['soiree_changement']=="yes"){
				require_once('transformTable_soiree.php');
				if($tableForm_soiree_hebdo_value =='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (prix,initiation,salle,...)</th></tr><tr id="tr_lundi_0" class="soiree-lundi"><td class="jour" id="td_lundi" rowspan="1">Lundi</td><td><input type="text" class="form-control-table" name="horaire_soiree_lundi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_lundi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_lundi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_mardi_0" class="soiree-mardi"><td class="jour" id="td_mardi" rowspan="1">Mardi</td><td><input type="text" class="form-control-table" name="horaire_soiree_mardi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_mardi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_mardi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_mercredi_0" class="soiree-mercredi"><td class="jour" id="td_mercredi" rowspan="1">Mercredi</td><td><input type="text" class="form-control-table" name="horaire_soiree_mercredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_mercredi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_mercredi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_jeudi_0" class="soiree-jeudi"><td class="jour" id="td_jeudi" rowspan="1">Jeudi</td><td><input type="text" class="form-control-table" name="horaire_soiree_jeudi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_jeudi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_jeudi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_vendredi_0" class="soiree-vendredi"><td class="jour" id="td_vendredi" rowspan="1">Vendredi</td><td><input type="text" class="form-control-table" name="horaire_soiree_vendredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_vendredi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_vendredi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_samedi_0" class="soiree-samedi"><td class="jour" id="td_samedi" rowspan="1">Samedi</td><td><input type="text" class="form-control-table" name="horaire_soiree_samedi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_samedi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_samedi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_dimanche_0" class="soiree-dimanche"><td class="jour" id="td_dimanche" rowspan="1">Dimanche</td><td><input type="text" class="form-control-table" name="horaire_soiree_dimanche[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_dimanche[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_dimanche[]" value="" maxlength="60" placeholder="..."></td></tr></table>')
				{
					//Suppression de la table dans la BDD
					require_once('../../modele/delete_event_hebdoBdd.php');
					delete_soiree_hebdoBdd($id_lieu);
					$_SESSION['success'].= " (+planning soirée supprimé)";
					header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
				}
				else{
					// Mise dans la BDD
					require_once('../../modele/put_event_hebdoBdd.php');
					put_soiree_hebdoBdd($id_lieu,$tableForm_soiree_hebdo_value,$tableDisplay_soiree_hebdo_value);
					$_SESSION['success'].= " (+planning soirée modifié)";
					header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
				}
			}
		}
		header("Refresh: 0 ; url=/modifier/?id_lieu=$id_lieu");
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
?>


