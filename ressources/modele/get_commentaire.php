<?php
	if(isset($_POST["id_lieu"])){
		$id_lieu=$_POST["id_lieu"];
		require("connexion_sql.php");
		$req = $bdd->prepare(
			'SELECT *,DATE_FORMAT(datetime_commentaire, "%d %M, %H:%i") AS date_convert
			FROM commentaires
			WHERE id_lieu_commentaire= ?
			ORDER BY datetime_commentaire DESC'
		);
		$req->execute(array($id_lieu));
		$encode_donnees='';
		while($donnees = $req->fetch(PDO::FETCH_ASSOC))
		{
			$extract_commentaire[]=$donnees;
		}
		$encode_donnees = json_encode($extract_commentaire);
		$req->closeCursor();
		echo $encode_donnees;
    }
	else{
		echo "Erreur";
	}
?>