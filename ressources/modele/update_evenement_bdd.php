<?php
	//Annonceur
   function update_evenement_bdd($id_evenement,$id_lieu_evenement,$date_evenement,$heure_debut_evenement,$heure_fin_evenement,$titre_evenement, $organisateur_evenement, $danse_pratique_evenement, $tarifs_evenement,$description_evenement,$url_fb_evenement,$initiation_evenement,$special_evenement,$communaute_evenement)
    {
		global $bdd;
        $req = $bdd->prepare('UPDATE evenement SET id_lieu_evenement=:id_lieu_evenement, date_evenement=:date_evenement, heure_debut_evenement=:heure_debut_evenement, heure_fin_evenement=:heure_fin_evenement, titre_evenement=:titre_evenement, organisateur_evenement=:organisateur_evenement, danse_pratique_evenement=:danse_pratique_evenement, tarifs_evenement=:tarifs_evenement, description_evenement=:description_evenement, url_fb_evenement=:url_fb_evenement, initiation_evenement=:initiation_evenement, special_evenement=:special_evenement, communaute_evenement=:communaute_evenement WHERE id_evenement=:id_evenement');
        $req->execute(array(
			'id_evenement' => $id_evenement,
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
			'communaute_evenement' => $communaute_evenement,
            ));
        $req->closeCursor();
   }
;?>