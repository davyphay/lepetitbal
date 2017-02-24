<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function get_extractEventLieu($id_lieu_evenement)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM evenement 
            WHERE id_lieu_evenement=?
			AND date_evenement >= CURRENT_DATE
			ORDER BY date_evenement'
        );
		$req->execute(array($id_lieu_evenement));
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