<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function get_extract_calendrier($latMin,$latMax,$lngMin,$lngMax,$nb_jour_calendrier)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT * 
            FROM lieu
            LEFT JOIN evenement
                ON id_lieu = id_lieu_evenement
            WHERE ? <= latitude_lieu 
                AND latitude_lieu <= ? 
                AND ? <= longitude_lieu 
                AND longitude_lieu <= ?
                AND date_evenement >= date(NOW() + INTERVAL -4 HOUR)
                AND CURRENT_DATE + INTERVAL ? DAY >= date_evenement
                ORDER BY date_evenement'
        );
        $req->execute(array($latMin,$latMax,$lngMin,$lngMax,$nb_jour_calendrier));
        $encode_donnees='';
		while($donnees = $req->fetch(PDO::FETCH_ASSOC))
		{
			$extract_calendrier []= $donnees;
		}
		$encode_donnees = json_encode($extract_calendrier);
        $req->closeCursor();
        return $encode_donnees;
    }
?>
