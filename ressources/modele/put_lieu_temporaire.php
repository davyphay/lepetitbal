<?php
   function put_lieu_temporaire($nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$type_lieu,$adresse_email_ajout_lieu)
    {
		global $bdd;
		$req = $bdd->prepare('INSERT INTO `lieu`(`nom_lieu`, `adresse_lieu`, `latitude_lieu`, `longitude_lieu`,`type_lieu`, `date_ajout_lieu`,`adresse_email_ajout_lieu`) VALUES (:nom_lieu , :adresse_lieu, :latitude_lieu, :longitude_lieu, :type_lieu, CURDATE(), :adresse_email_ajout_lieu)');

		$req->execute(array(
			 'nom_lieu' => $nom_lieu,
			 'adresse_lieu' => $adresse_lieu,
			 'latitude_lieu' => $latitude_lieu,
			 'longitude_lieu' => $longitude_lieu,
			 'type_lieu' => $type_lieu,
			 'adresse_email_ajout_lieu' => $adresse_email_ajout_lieu
		 ));
		
		 $last_id = $bdd->lastInsertId();
		 return $last_id;
   }
?>
