<?php
   function put_lieuBdd($nom_lieu,$adresse_lieu,$latitude_lieu,$longitude_lieu,$communaute_lieu,$activite_lieu,$type_lieu,$proprietaire_lieu)
    {
        global $bdd;
        $req = $bdd->prepare('INSERT INTO `lieu`(`nom_lieu`, `adresse_lieu`, `latitude_lieu`, `longitude_lieu`, `communaute_lieu`, `activite_lieu`, `type_lieu`, `date_ajout_lieu`,`proprietaire_adresse_email_lieu`) VALUES (:nom_lieu , :adresse_lieu, :latitude_lieu, :longitude_lieu, :communaute_lieu, :activite_lieu, :type_lieu, CURDATE(), :proprietaire_lieu)');

        $req->execute(array(
            'nom_lieu' => $nom_lieu,
            'adresse_lieu' => $adresse_lieu,
            'latitude_lieu' => $latitude_lieu,
            'longitude_lieu' => $longitude_lieu,
            'communaute_lieu' => $communaute_lieu,
            'activite_lieu' => $activite_lieu,
            'type_lieu' => $type_lieu,
            'proprietaire_lieu' => $proprietaire_lieu
            ));
        $req->closeCursor();
   }
?>
