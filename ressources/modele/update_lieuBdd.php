<?php
	//Annonceur
   function update_lieuBdd_annonceur($id_lieu,$nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$type_lieu,$activite_lieu,$description_lieu,$URL_web_lieu,$URL_photo_lieu)
    {
        global $bdd;
        $req = $bdd->prepare('UPDATE lieu SET nom_lieu=:nom_lieu, adresse_lieu=:adresse_lieu, latitude_lieu=:latitude_lieu, longitude_lieu=:longitude_lieu, communaute_lieu=:communaute_lieu, type_lieu=:type_lieu, activite_lieu=:activite_lieu, description_lieu=:description_lieu, URL_web_lieu=:URL_web_lieu, URL_photo_lieu=:URL_photo_lieu WHERE id_lieu=:id_lieu');
        $req->execute(array(
			'id_lieu' => $id_lieu,
			'nom_lieu' => $nom_lieu,
			'adresse_lieu' => $adresse_lieu,
			'latitude_lieu' => $latitude_lieu,
			'longitude_lieu' => $longitude_lieu,
			'communaute_lieu' => $communaute_lieu,
			'type_lieu' => $type_lieu,
			'activite_lieu' => $activite_lieu,
			'description_lieu' => $description_lieu,
			'URL_web_lieu' => $URL_web_lieu,
			'URL_photo_lieu' => $URL_photo_lieu
            ));
        $req->closeCursor();
   }
	
	//Membre
	function update_lieuBdd_membre($id_lieu,$nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$type_lieu,$activite_lieu)
    {
        global $bdd;
        $req = $bdd->prepare('UPDATE lieu SET nom_lieu=:nom_lieu, adresse_lieu=:adresse_lieu, latitude_lieu=:latitude_lieu, longitude_lieu=:longitude_lieu, communaute_lieu=:communaute_lieu, type_lieu=:type_lieu, activite_lieu=:activite_lieu WHERE id_lieu=:id_lieu');
        $req->execute(array(
				'id_lieu' => $id_lieu,
            'nom_lieu' => $nom_lieu,
            'adresse_lieu' => $adresse_lieu,
            'latitude_lieu' => $latitude_lieu,
            'longitude_lieu' => $longitude_lieu,
            'communaute_lieu' => $communaute_lieu,
				'type_lieu' => $type_lieu,
				'activite_lieu' => $activite_lieu
            ));
        $req->closeCursor();
   }
?>
