<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
// FCT COURS 
    function get_extractCoursHebdoTableForm($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM cours_hebdomadaire 
            WHERE id_lieu_cours_hebdomadaire=?'
        );
        $req->execute(array($id_lieu));

        //Récupération de tous les points pour les mettre dans une table façon JavaScript + affichage des résultats sur la page
        $extractCoursHebdoTable='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $extractCoursHebdoTable=$donnees['tableForm_cours_hebdomadaire'];
		}
        $req->closeCursor();
        return $extractCoursHebdoTable;
    }
	
	function get_extractCoursHebdoTableDisplay($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM cours_hebdomadaire 
            WHERE id_lieu_cours_hebdomadaire=?'
        );
        $req->execute(array($id_lieu));

        //Récupération de tous les points pour les mettre dans une table façon JavaScript + affichage des résultats sur la page
        $extractCoursHebdoTable='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $extractCoursHebdoTable=$donnees['tableDisplay_cours_hebdomadaire'];
		}
        $req->closeCursor();
        return $extractCoursHebdoTable;
    }
	
// FCT SOIREES
	function get_extractSoireeHebdoTableForm($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM soiree_hebdomadaire 
            WHERE id_lieu_soiree_hebdomadaire=?'
        );
        $req->execute(array($id_lieu));

        //Récupération de tous les points pour les mettre dans une table façon JavaScript + affichage des résultats sur la page
        $extractSoireeHebdoTable='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $extractSoireeHebdoTable=$donnees['tableForm_soiree_hebdomadaire'];
		}
        $req->closeCursor();
        return $extractSoireeHebdoTable;
    }
	
	function get_extractSoireeHebdoTableDisplay($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare(
            'SELECT *
            FROM soiree_hebdomadaire 
            WHERE id_lieu_soiree_hebdomadaire=?'
        );
        $req->execute(array($id_lieu));

        //Récupération de tous les points pour les mettre dans une table façon JavaScript + affichage des résultats sur la page
        $extractSoireeHebdoTable='';
        while ($donnees = $req->fetch()){
            // Préparation du tableau de résultat PHP dans le string $extractBdd
            $extractSoireeHebdoTable=$donnees['tableDisplay_soiree_hebdomadaire'];
		}
        $req->closeCursor();
        return $extractSoireeHebdoTable;
    }
?>
