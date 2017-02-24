<?php
  
    if(isset($_GET['query'])) {
        // Mot tapé par l'utilisateur
        $q = "%".htmlentities($_GET['query'])."%";
 
		require_once("connexion_sql.php");
 
        // Requête SQL
        $requete = "SELECT `nom_lieu`,`id_lieu` FROM `lieu` WHERE nom_lieu LIKE ? AND proprietaire_adresse_email_lieu='' LIMIT 0, 10";
 
        // Exécution de la requête SQL
        $resultat = $bdd->prepare($requete) or die(print_r($bdd->errorInfo()));
		$resultat->execute(array($q));
 
        // On parcourt les résultats de la requête SQL
        while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)) {
            // On ajoute les données dans un tableau
            $suggestions['suggestions'][] = $donnees['nom_lieu'];
			$suggestions['id_lieu'][] = $donnees['id_lieu'];
        }
		$resultat->closeCursor();
		
		if(sizeof($suggestions['suggestions'])===0){
			$suggestions['suggestions'][] ="Aucun résultat";
		}
 
        // On renvoie le données au format JSON pour le plugin
        echo json_encode($suggestions);
    }
?>