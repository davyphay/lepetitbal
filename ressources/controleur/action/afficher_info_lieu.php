<?php
	if($_SESSION['email_membre']){
		if (isset($_GET['id_lieu'])){
			//Recuperation des données coté serveur en fonction de l'id lieu
			require_once('../ressources/modele/get_extractLieu.php');
			$extractLieu=get_extractLieu(htmlentities($_GET['id_lieu']));
			$extract2=json_decode($extractLieu,true);

			$id_lieu=$extract2[0]['id_lieu'];
			$nom_lieu=$extract2[0]['nom_lieu'];
			$adresse_lieu=$extract2[0]['adresse_lieu'];
			$type_lieu=$extract2[0]['type_lieu'];
			
			$description_lieu= '"'.$extract2[0]['description_lieu'].'"';
			$description_lieu = json_decode($description_lieu);

			$email_proprietaire_lieu= $extract2[0]['email_proprietaire_lieu'];
			$URL_web_lieu=$extract2[0]['URL_web_lieu'];
			$URL_photo_lieu=$extract2[0]['URL_photo_lieu'];
			
			$id_cours_hebdo = $extract2[0]['id_cours_hebdomadaire'];
			$description_cours_hebdo=$extract2[0]['tableDisplay_cours_hebdomadaire'];
			$id_soiree_hebdo = $extract2[0]['id_soiree_hebdomadaire'];
			$description_soiree_hebdo= $extract2[0]['tableDisplay_soiree_hebdomadaire'];

			//Verification si lieu promu ou pas
			$promotion="";
			$statut_lieu="";
			$today = date("Y-m-d");
			$today_dt = new DateTime($today);
			$expire_dt = new DateTime($extract2[0]['date_expiration_promotion_lieu']);
			if ($today_dt <= $expire_dt) {
				$promotion=1; // promotion en cours
			}
			else{
				$promotion=0; // pas de promotion en cours
			}
			if($promotion===1){
				$date_expiration_promotion_lieu = $extract2[0]['date_expiration_promotion_lieu'];
				$newDate = date("d-m-Y", strtotime($date_expiration_promotion_lieu));
				$statut_lieu="Promotion en cours jusqu'au ".$newDate;
			}
			else{
				$date_expiration_promotion_lieu = $today;
				$statut_lieu="Aucune promotion en cours";				
			}

			//Décodage de la communauté
			$communaute_lieu_salsa=0;
			$communaute_lieu_bachata=0;			
			$communaute_lieu_kizomba=0;
			$communaute_lieu_rock4T=0;
			$communaute_lieu_rock6T=0;
			$communaute_lieu_swing=0;
			$communaute_lieu_wcs=0;
			$communaute_lieu_tango=0;
			$communaute_lieu_salon=0;
			$extract_communaute= $extract2[0]['communaute_lieu'];
			if($extract_communaute{0}=="S"){
				$communaute_lieu_salsa=1;
			}
			if($extract_communaute{2}=="B"){
				$communaute_lieu_bachata =1;
			}			
			if($extract_communaute{4}=="K"){
				$communaute_lieu_kizomba=1;
			}
			if($extract_communaute{6}=="4"){
				$communaute_lieu_rock4T=1;
			}			
			if($extract_communaute{8}=="6"){
				$communaute_lieu_rock6T=1;
			}
			if($extract_communaute{10}=="S"){
				$communaute_lieu_swing=1;
			}
			if($extract_communaute{12}=="W"){
				$communaute_lieu_wcs=1;
			}
			if($extract_communaute{14}=="T"){
				$communaute_lieu_tango=1;
			}
			if($extract_communaute{16}=="S"){
				$communaute_lieu_salon=1;
			}
			
			//Décodage des activités
			$activite_lieu_cours=0;
			$activite_lieu_soiree=0;
			$activite_lieu_event=0;
			$extract_activity = $extract2[0]['activite_lieu'];
			if($extract_activity{0}=="C"){
					$activite_lieu_cours=1;
			}
			if($extract_activity{2}=="S"){
					$activite_lieu_soiree=1;
			}
			if($extract_activity{4}=="E"){
					$activite_lieu_event=1;
			}

			require_once('../ressources/modele/get_extractEventHebdoTable.php');
			$extractCoursHebdoTableForm = get_extractCoursHebdoTableForm($id_lieu);
			$extractSoireeHebdoTableForm = get_extractSoireeHebdoTableForm($id_lieu);
			
			if(!$extractCoursHebdoTableForm){
				$extractCoursHebdoTableForm='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (niveau,professeur,salle,...)</th><th>Ajouter/ Supprimer</th></tr><tr id="tr_lundi_0" class="cours-lundi"><td class="jour" id="td_cours_lundi" rowspan="1">Lundi</td><td><input type="text" class="form-control-table" name="horaire_lundi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_lundi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_lundi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_lundi" class="boutons_jour" value-rs="1"><button type="button" value="lundi" onclick="addinputs(this)">+</button><button type="button" value="lundi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_mardi_0" class="cours-mardi"><td class="jour" id="td_cours_mardi" rowspan="1">Mardi</td><td><input type="text" class="form-control-table" name="horaire_mardi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_mardi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_mardi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_mardi" class="boutons_jour" value-rs="1"><button type="button" value="mardi" onclick="addinputs(this)">+</button><button type="button" value="mardi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_mercredi_0" class="cours-mercredi"><td class="jour" id="td_cours_mercredi" rowspan="1">Mercredi</td><td><input type="text" class="form-control-table" name="horaire_mercredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_mercredi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_mercredi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_mercredi" class="boutons_jour" value-rs="1"><button type="button" value="mercredi" onclick="addinputs(this)">+</button><button type="button" value="mercredi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_jeudi_0" class="cours-jeudi"><td class="jour" id="td_cours_jeudi" rowspan="1">Jeudi</td><td><input type="text" class="form-control-table" name="horaire_jeudi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_jeudi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_jeudi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_jeudi" class="boutons_jour" value-rs="1"><button type="button" value="jeudi" onclick="addinputs(this)">+</button><button type="button" value="jeudi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_vendredi_0" class="cours-vendredi"><td class="jour" id="td_cours_vendredi" rowspan="1">Vendredi</td><td><input type="text" class="form-control-table" name="horaire_vendredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_vendredi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_vendredi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_vendredi" class="boutons_jour" value-rs="1"><button type="button" value="vendredi" onclick="addinputs(this)">+</button><button type="button" value="vendredi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_samedi_0" class="cours-samedi"><td class="jour" id="td_cours_samedi" rowspan="1">Samedi</td><td><input type="text" class="form-control-table" name="horaire_samedi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_samedi[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_samedi[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_samedi" class="boutons_jour" value-rs="1"><button type="button" value="samedi" onclick="addinputs(this)">+</button><button type="button" value="samedi" onclick="deleteinputs(this)">x</button></td></tr><tr id="tr_dimanche_0" class="cours-dimanche"><td class="jour" id="td_cours_dimanche" rowspan="1">Dimanche</td><td><input type="text" class="form-control-table" name="horaire_dimanche[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_dimanche[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_dimanche[]" value="" maxlength="60" placeholder="..."></td><td id="boutons_dimanche" class="boutons_jour" value-rs="1"><button type="button" value="dimanche" onclick="addinputs(this)">+</button><button type="button" value="dimanche" onclick="deleteinputs(this)">x</button></td></tr></table>';
			}
			if(!$extractSoireeHebdoTableForm){
				$extractSoireeHebdoTableForm='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (prix,initiation,salle,...)</th></tr><tr id="tr_lundi_0" class="soiree-lundi"><td class="jour" id="td_lundi" rowspan="1">Lundi</td><td><input type="text" class="form-control-table" name="horaire_soiree_lundi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_lundi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_lundi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_mardi_0" class="soiree-mardi"><td class="jour" id="td_mardi" rowspan="1">Mardi</td><td><input type="text" class="form-control-table" name="horaire_soiree_mardi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_mardi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_mardi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_mercredi_0" class="soiree-mercredi"><td class="jour" id="td_mercredi" rowspan="1">Mercredi</td><td><input type="text" class="form-control-table" name="horaire_soiree_mercredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_mercredi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_mercredi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_jeudi_0" class="soiree-jeudi"><td class="jour" id="td_jeudi" rowspan="1">Jeudi</td><td><input type="text" class="form-control-table" name="horaire_soiree_jeudi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_jeudi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_jeudi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_vendredi_0" class="soiree-vendredi"><td class="jour" id="td_vendredi" rowspan="1">Vendredi</td><td><input type="text" class="form-control-table" name="horaire_soiree_vendredi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_vendredi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_vendredi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_samedi_0" class="soiree-samedi"><td class="jour" id="td_samedi" rowspan="1">Samedi</td><td><input type="text" class="form-control-table" name="horaire_soiree_samedi[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_samedi[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_samedi[]" value="" maxlength="60" placeholder="..."></td></tr><tr id="tr_dimanche_0" class="soiree-dimanche"><td class="jour" id="td_dimanche" rowspan="1">Dimanche</td><td><input type="text" class="form-control-table" name="horaire_soiree_dimanche[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_dimanche[]" value="" maxlength="40" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_dimanche[]" value="" maxlength="60" placeholder="..."></td></tr></table>';
			}
			
			//Récupération des évènements et extraction des données
			require_once('../ressources/modele/get_extractEventLieu.php');
			$extractEventLieu=get_extractEventLieu(htmlentities($_GET['id_lieu']));
			$extractEvent=json_decode($extractEventLieu,true);
			$extract=[];
			$date_event=[];
			$date_data=[];
			$nb_event = count($extractEvent);
			for ($i = 0; $i < $nb_event; $i++) {
				$extract[$i]=$extractEvent[$i];
				$date=date_create($extract[$i]['date_evenement']);
				$date_data[$i]=date_format($date,"d-m-Y");
				setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
				$date_event[$i] = strftime("%A %d %b",strtotime($extract[$i]['date_evenement']));
			}
			//Mise en place du formulaire
			include_once('../ressources/vue/vueModifier_lieu.php');
		}
		else
		{
			$_SESSION['erreur']= "Le lieu n'existe pas!";
			header('Refresh: 0 ; url='.$bouton_retour);
		}
	}
	else{
		$_SESSION['erreur']= "Vous n\'avez pas les droits d\'accès.";
		header('Refresh: 0 ; url='.$bouton_retour);
	}
?>