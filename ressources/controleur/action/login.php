<meta charset="utf-8">
<?php
if(!session_id()) {
    include 'session.inc';
}
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
require('../../modele/put_historique_connexion.php');
    // Vérifs de base
    if(!empty($_POST['pseudo']) AND !empty($_POST['password_membre'])){
        if (isset($_POST['pseudo']) AND isset($_POST['password_membre']) && (check_auth($_POST['pseudo'], $_POST['password_membre'])))
        {
            // Hachage du mot de passe
            $pass_hache = sha1(htmlspecialchars($_POST['password_membre']));
            $pseudo_membre = htmlspecialchars($_POST['pseudo']);

            // Connexion sql
            require_once('../../modele/connexion_sql.php');  // Connexion base sql
            require_once('../../modele/connexion_membreBdd.php'); // on lance la co a la BDD
            $resultat = connexion_membreBdd($pseudo_membre,$pass_hache);
            if (!$resultat)
            {
                $_SESSION['erreur']= "Pseudo ou mot de passe incorrect";
                header('Refresh: 0 ; url='.$bouton_retour); 
            }
            else
            {
                $_SESSION['id_membre'] = $resultat['id_membre'];
                $_SESSION['pseudo_membre'] = $resultat['pseudo_membre'];
                $_SESSION['email_membre'] = $resultat['email_membre'];
                $_SESSION['from'] = "lepetitbal";
                if(isset($_SESSION['pseudo_membre'])){
                    check_auth();
                    //SAUVEGARDE DE LA SESSION DANS LA BDD --> historique des connexions
                    put_historique_connexion_membre($_SESSION['email_membre'],$_SESSION['from'],$_SESSION['ip'],"login");
                }
                $_SESSION['success']="Bonjour ".$_SESSION['pseudo_membre'];
                header('Refresh: 0 ; url='.$bouton_retour);
            }
        }
        else
        {
            $_SESSION['erreur']= "Pseudo et mot de passe non valide";
            header('Refresh: 0 ; url='.$bouton_retour);
        }
    }
?>
