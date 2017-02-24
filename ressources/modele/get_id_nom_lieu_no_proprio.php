<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function get_id_nom_lieu_no_proprio($nom_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT id_lieu 
            FROM lieu
            WHERE nom_lieu=?'
        );
        $req->execute(array($nom_lieu));
        $encode_donnees='';
		while($donnees = $req->fetch(PDO::FETCH_ASSOC))
		{
			$id_lieu []= $donnees;
		}
		$encode_donnees = json_encode($id_lieu);
        $req->closeCursor();
        return $encode_donnees;
    }
?>
