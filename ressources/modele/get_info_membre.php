<?php
	function get_info_membre($adresse_email)
    {
		//Adresse mail + jetons
        global $bdd;
        $req = $bdd->prepare(
            "SELECT *
            FROM gestion_jeton 
            WHERE adresse_email_gestion_jeton=?"
        );
        $req->execute(array($adresse_email));

        $adresse_email_info='';
		$nb_jetons='';
        while ($donnees = $req->fetch()){
            $adresse_email_info=$donnees['adresse_email_gestion_jeton'];
			$nb_jetons=$donnees['nombre_jeton_gestion_jeton'];
		}
        $req->closeCursor();
		$return=[];
		$return[0]=$adresse_email;
		$return[1]=$nb_jetons;
		
		//Statut membre
        $req = $bdd->prepare("SELECT id_lieu,nom_lieu FROM lieu WHERE proprietaire_adresse_email_lieu = ?");
		$req->execute(array($adresse_email));
		$array_id_lieu=[];
		$array_nom_lieu=[];
		$i=0;
		while ($donnees = $req->fetch()){
			$array_id_lieu[$i] = $donnees['id_lieu'];
			$array_nom_lieu[$i] = $donnees['nom_lieu'];
			$i++;
		}
        $req->closeCursor();

		$return[2]=$array_id_lieu;
		$return[3]=$array_nom_lieu;
		
		//Pseudo
        $req = $bdd->prepare("SELECT * FROM membres WHERE email_membre = ?");
		$req->execute(array($adresse_email));
		$pseudo_membre='';
		while ($donnees = $req->fetch()){
			$pseudo_membre=$donnees['pseudo_membre'];
		}
		$req->closeCursor();
		$return[4]=$pseudo_membre;
        return $return;
    }
?>