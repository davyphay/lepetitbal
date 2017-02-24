<?php
    // Connexion à la base de donnée
        try
        {
            $host = 'localhost';
            $database = 'lepetitbal';
            $identifiant = 'root';
            $password = '';
            $bdd = new PDO('mysql:host='.$host.';dbname='.$database.';charset=utf8', $identifiant, $password);
            $bdd->query("SET lc_time_names = 'fr_FR'");
            $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }catch(PDOException $e){
            echo 'La base de donnée n\'est pas disponible pour le moment. <br />';
            echo ''.$e->getMessage().'<br />';
            echo 'Ligne : '.$e->getLine();
        }
    // Fin de la connexion à la base de donnée
?>
