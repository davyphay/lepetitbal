<?php
session_start();
if(isset($_SESSION['email_membre'])){
        $id_lieu = $_POST['id_lieu'];
        $email_membre=$_SESSION['email_membre'];
        require("connexion_sql.php");
        // REGARDE SI L'UTILISATEUR A DEJA VOTE POUR CE LIEU
        $checkVote = $bdd->prepare("SELECT * FROM `upvote_table` WHERE `id_lieu_upvote` =? AND `email_membre_upvote`=?"); // SELECT USER ID FROM DB TO SEE IF THEY HAVE VOTED ON THIS ITEM BEFORE
        $checkVote->execute(array($id_lieu,$email_membre));
        $count = $checkVote->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
        $checkVote->closeCursor();
        if($count !== 0) // s'il trouve une valeur, alors c'est bon
        {
            $req1 = $bdd->prepare("DELETE FROM `upvote_table` WHERE id_lieu_upvote=? AND `email_membre_upvote`=?");
            $req1->execute(array($id_lieu,$email_membre));
            $req1->closeCursor();
            
            // CHERCHE LE NOMBRE EXISTANT DE VOTE DANS LA BASE DE DONNEE
            $req2 = $bdd->prepare("SELECT id_lieu,upvote_lieu FROM lieu WHERE id_lieu = ?");
            $req2->execute(array($id_lieu));
            while ($donnees = $req2->fetch()){
                    // temp user array
                    $lecturelist = array();
                    $lecturelist["id_lieu"] = $donnees["id_lieu"];
                    $lecturelist["upvote_lieu"] = $donnees["upvote_lieu"];
                    }
            $req2->closeCursor();
            $upvote= $lecturelist["upvote_lieu"];
            $upvote = $upvote - 1;
            
            // REPLACE LE NOUVEAU NOMBRE TOTAL DE VOTE DANS LA BDD
            $query = $bdd->prepare('UPDATE lieu SET upvote_lieu = :upvote_lieu WHERE id_lieu = :id_lieu');
            $query->execute(array(  
              ':upvote_lieu'  => $upvote,
              ':id_lieu'    => $id_lieu,
            ));
            $query->closeCursor();

        } 
        else{ 
            echo "0"; 
        }
}
?>