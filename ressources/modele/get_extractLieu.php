<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function get_extractLieu($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM lieu 
            LEFT JOIN cours_hebdomadaire 
                ON id_lieu = id_lieu_cours_hebdomadaire
            LEFT JOIN soiree_hebdomadaire 
                ON id_lieu = id_lieu_soiree_hebdomadaire
            WHERE id_lieu=?'
        );
		$req->execute(array($id_lieu));
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