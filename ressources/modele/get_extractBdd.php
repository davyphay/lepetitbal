<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function get_extractBdd($latMin,$latMax,$lngMin,$lngMax)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT * 
            FROM lieu
            LEFT JOIN cours_hebdomadaire 
                ON id_lieu = id_lieu_cours_hebdomadaire
            LEFT JOIN soiree_hebdomadaire 
                ON id_lieu = id_lieu_soiree_hebdomadaire
            WHERE ? <= latitude_lieu 
                AND latitude_lieu <= ?
                AND ? <= longitude_lieu 
                AND longitude_lieu <= ?'
        );
        $req->execute(array($latMin,$latMax,$lngMin,$lngMax));
        $encode_donnees='';
		while($donnees = $req->fetch(PDO::FETCH_ASSOC))
		{
			$extract_bdd []= $donnees;
		}
		$encode_donnees = json_encode($extract_bdd);
        $req->closeCursor();
        return $encode_donnees;
    }
?>
