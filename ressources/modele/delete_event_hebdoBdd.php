<?php    //REQUETE DATABASE POUR TROUVER TOUS LES EVENTS LIES AUX LIEUX DANS LES RESULTATS DE RECHERCHE
    function delete_cours_hebdoBdd($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM cours_hebdomadaire WHERE id_lieu_cours_hebdomadaire =:id_lieu_cours_hebdo');
        $req->execute(array('id_lieu_cours_hebdo' => $id_lieu));
    }
    
    function delete_soiree_hebdoBdd($id_lieu)
    {
        global $bdd;
        $req = $bdd->prepare('DELETE FROM soiree_hebdomadaire WHERE id_lieu_soiree_hebdomadaire =:id_lieu_soiree_hebdo');
        $req->execute(array('id_lieu_soiree_hebdo' => $id_lieu));
    }
?>
