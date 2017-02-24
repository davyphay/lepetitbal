<?php
   function put_event_bdd($id_lieu_evenement,$date_evenement,$heure_debut_evenement,$heure_fin_evenement,$titre_evenement,$organisateur_evenement,$danse_pratique_evenement, $tarifs_evenement,$description_evenement,$url_fb_evenement,$initiation_evenement,$special_evenement,$adresse_email_evenement,$communaute_evenement,$nb_jeton_utilise)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO `evenement`(`id_lieu_evenement`, `date_evenement`, `heure_debut_evenement`, `heure_fin_evenement`, `titre_evenement`,`organisateur_evenement`,`danse_pratique_evenement`,`tarifs_evenement`, `description_evenement`, `url_fb_evenement`, `initiation_evenement`, `special_evenement`, `adresse_email_evenement`, `communaute_evenement`, `date_ajout_evenement`) VALUES (:id_lieu_evenement , :date_evenement, :heure_debut_evenement, :heure_fin_evenement, :titre_evenement, :organisateur_evenement, :danse_pratique_evenement, :tarifs_evenement, :description_evenement, :url_fb_evenement, :initiation_evenement, :special_evenement, :adresse_email_evenement,:communaute_evenement, NOW())');

        $req->execute(array(
            'id_lieu_evenement' => $id_lieu_evenement,
            'date_evenement' => $date_evenement,
            'heure_debut_evenement' => $heure_debut_evenement,
            'heure_fin_evenement' => $heure_fin_evenement,
            'titre_evenement' => $titre_evenement,
				'organisateur_evenement' => $organisateur_evenement,
				'danse_pratique_evenement' => $danse_pratique_evenement,
				'tarifs_evenement' => $tarifs_evenement,
            'description_evenement' => $description_evenement,
            'url_fb_evenement' => $url_fb_evenement,
				'initiation_evenement' => $initiation_evenement,
				'special_evenement' => $special_evenement,
				'adresse_email_evenement' => $adresse_email_evenement,
				'communaute_evenement' => $communaute_evenement
            ));
			$req->closeCursor();
		  
		  	// Update nombre de jetons restants
			$req = $bdd->prepare('UPDATE gestion_jeton
									  SET nombre_jeton_gestion_jeton = nombre_jeton_gestion_jeton - :nombre_jeton_utilise, derniere_maj_gestion_jeton=NOW()
									  WHERE adresse_email_gestion_jeton=:email_membre');
			$req->execute(array(
				'nombre_jeton_utilise' => $nb_jeton_utilise,
				'email_membre' =>$adresse_email_evenement
				));
			$req->closeCursor();
   }
	
?>