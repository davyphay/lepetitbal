<?php

	function get_proprio($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT proprietaire_adresse_email_lieu
            FROM lieu 
            WHERE id_lieu=?'
        );
        $req->execute(array($id_lieu));

        $adresse_email_proprio='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $adresse_email_proprio=$donnees['proprietaire_adresse_email_lieu'];
		}
        $req->closeCursor();
		$return=$adresse_email_proprio;
        return $return;
    }
	
	function get_proprio_event($id_evenement)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT adresse_email_evenement
            FROM evenement
            WHERE id_evenement=?'
        );
        $req->execute(array($id_evenement));

        $adresse_email_proprio='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $adresse_email_proprio=$donnees['adresse_email_evenement'];
		}
        $req->closeCursor();
		$return=$adresse_email_proprio;
        return $return;
    }
?>