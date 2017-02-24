<?php
	if(isset($_POST["id_lieu_evenement"])){
        $id_lieu_evenement=$_POST["id_lieu_evenement"];
		require("connexion_sql.php");
		$req = $bdd->prepare(
			'SELECT *
			FROM evenement
			WHERE id_lieu_evenement= ?
			AND date_evenement >= CURRENT_DATE
			AND CURRENT_DATE + INTERVAL 30 DAY >= date_evenement
			ORDER BY date_evenement'
        );
		$req->execute(array($id_lieu_evenement));
		$encode_donnees='';
		while($donnees = $req->fetch(PDO::FETCH_ASSOC))
		{
			$extractEvent []= $donnees;
		}
		$encode_donnees = json_encode($extractEvent);
        $req->closeCursor();
        echo json_encode($encode_donnees);
	}
	else{ 
		echo "Erreur";
	}
?>