<?php
	if(isset($_POST["id_lieu"])){
        $id_lieu=$_POST["id_lieu"];
		require("connexion_sql.php");
		
        $req = $bdd->prepare(
            'SELECT id_commentaire
            FROM commentaires
            WHERE id_lieu_commentaire=?'
        );
		$req->execute(array($id_lieu));
        $count = $req->rowCount(); // on rowCount() la requete, donc rowcount retournera une valeur si il trouve.
		echo $count;
	}
	else { 
		echo "erreur";
	}
		
?>