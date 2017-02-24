<!DOCTYPE html>
<?php
    if(!session_id()) {
        include 'ressources/controleur/action/session.inc';
    }
    $_SESSION['recherche']="accueil";
    // SESSION FB
    include_once('ressources/controleur/action/loginFb.php');
    // SESSION GOOGLE
    include_once('ressources/controleur/action/loginGoogle.php');
    
    $email_membre ="";
    $pseudo_membre="";
    $plateforme="";
    $proprio=0;

    if(!empty($_SESSION['email_membre'])){ // SI IL Y A UN MEMBRE CONNECTE, CHECK SI LA SESSION EST EXPIREE OU PAS, si vrai -> logout() puis rechargement de cette page
        check_login();
        $email_membre = $_SESSION['email_membre'];
        $pseudo_membre = $_SESSION['pseudo_membre'];
        $plateforme = $_SESSION['from'];
        $nb_jeton_dispo ="";
        $membre_statut= "Membre";
        
        //Information du membre
        require('ressources/modele/connexion_sql.php');  // Connexion Base sql 
        include_once('ressources/modele/get_info_membre.php');
        $array_annonceur = get_info_membre($email_membre);
        if($array_annonceur[0]!==""){
            $nb_jeton_dispo =$array_annonceur[1];
            $nb_lieu_proprietaire = count($array_annonceur[2]);
            if($nb_jeton_dispo===""){
                $membre_statut="Membre";
            }
            else{
                $membre_statut="Annonceur";
                if($nb_lieu_proprietaire>0){
                    $proprio=1;
                    $liste_id_lieu_proprio = $array_annonceur[2];
                    $liste_nom_lieu_proprio = $array_annonceur[3];
                }
            }
        }
        $admin=0;
        if($email_membre=="davyphay@gmail.com"){
            $admin=1;
        }
    }
    //AFFICHAGE PAGE ACCUEIL
    if (!isset($_GET['section']) OR $_GET['section'] == 'index'){
        // On affiche la page d'accueil (vue)
        include_once('ressources/vue/vueAccueil.php');
    }
    //Affichage des erreurs et success en cas de redirection vers cette page
    if(isset($_SESSION['erreur'])){
        echo'<script type="text/javascript" src="../ressources/controleur/js/alertify/alertify.min.js"></script>';
        echo'<script>alertify.error("'.$_SESSION['erreur'].'")</script>';
        unset($_SESSION['erreur']);
    }
    if(isset($_SESSION['success'])){
        echo'<script type="text/javascript" src="../ressources/controleur/js/alertify/alertify.min.js"></script>';
        echo'<script>alertify.success("'.$_SESSION['success'].'")</script>';
        unset($_SESSION['success']);
    }
?>

