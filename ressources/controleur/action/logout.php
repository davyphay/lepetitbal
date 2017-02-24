<?php // LOGOUT

    include 'session.inc';
    require_once('../../modele/connexion_sql.php');  // Connexion base sql
    require('../../modele/put_historique_connexion.php');
    put_historique_connexion_membre($_SESSION['email_membre'],$_SESSION['from'],$_SESSION['ip'],"logout");
    logout();
?>