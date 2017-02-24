<meta charset="utf-8">
<?php
    include 'session.inc';
	//Config bouton retour recherche
	$bouton_retour="/cours-et-soirees-dansantes/";
	if(isset ($_SESSION['recherche'])){
		if($_SESSION['recherche']=="calendrier"){
			$bouton_retour="/soirees-et-evenements-dansants/";
		}
		if($_SESSION['recherche']=="cours"){
			$bouton_retour="/cours-de-danse/";
		}
		if($_SESSION['recherche']=="accueil"){
			$bouton_retour="//www.lepetitbal.com";
		}	
	}
    //Test pour voir si les champs sont bien remplis
    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password_membre']) && !empty($_POST['password_control'])){
        // Test pour voir si les variables sont bien définies
        if(isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password_membre']) && isset($_POST['password_control']))
        {
            // Sécurité
            $pseudo = addslashes(htmlspecialchars(htmlentities(trim($_POST['pseudo']))));
            $email = addslashes(htmlspecialchars(htmlentities(trim($_POST['email']))));
            $password_membre = sha1($_POST['password_membre']);
            $passwordConfirm = sha1($_POST['password_control']);

            if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) // on vérifie si l'email à un format valide.
            {
                if($password_membre == $passwordConfirm){ // on vérifie que les deux mots de passe soient identiques.
                    // Inscription du membre dans la BDD
                    require_once('../../modele/connexion_sql.php');
                    require_once('../../modele/put_membreBdd.php'); 
                    $inscription = put_membreBdd($pseudo,$email,$password_membre);
                    if($inscription==0){
                        // Connexion du membre directement après inscription
                        require_once('../../modele/connexion_membreBdd.php'); 
                        $resultat = connexion_membreBdd($pseudo,$password_membre);
                        if ($resultat){
                            check_auth();
                            $_SESSION['id_membre'] = $resultat['id_membre'];
                            $_SESSION['pseudo_membre'] = $resultat['pseudo_membre'];
                            $_SESSION['email_membre'] = $resultat['email_membre'];
                            $_SESSION['from'] = "lepetitbal";
                            $_SESSION['success'] ="Inscription réussie!";
                            header('Refresh: 0 ; url='.$bouton_retour);  
                        }
                    }
                    else if ($inscription==1){
                        $_SESSION['erreur']= "Cette adresse mail est déjà utilisée.";
                        header('Refresh: 0 ; url='.$bouton_retour);    
                    }
                    else{
                        $_SESSION['erreur']= "Ce pseudo est déjà utilisé.";
                        header('Refresh: 0 ; url='.$bouton_retour);
                    }
                }
                else{
                    $_SESSION['erreur']= "Vos mots de passe ne sont pas identiques.";
                    header('Refresh: 0 ; url='.$bouton_retour);
                }
            }
            else{
                $_SESSION['erreur']= "Votre adresse e-mail n\'est pas valide.";
               header('Refresh: 0 ; url='.$bouton_retour);
            }
        }
        else{
            $_SESSION['erreur']= "Veuillez remplir correctement tous les champs";
           header('Refresh: 0 ; url='.$bouton_retour);
        }
    }
?>