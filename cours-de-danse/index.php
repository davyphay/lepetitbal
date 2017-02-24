<!DOCTYPE html>
<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
include '../ressources/controleur/action/session.inc';
if((isset($_POST['gps_rechercher_lieu']) || !empty($_SESSION['gps_rechercher_lieu'])) && (isset($_POST['communaute_rechercher_lieu']) || !empty($_SESSION['communaute_rechercher_lieu'])) && (isset($_POST['adresse_rechercher_lieu']) || !empty($_SESSION['adresse_rechercher_lieu']))){
        $_SESSION['recherche']="cours";
        // SESSION FB
        include_once('../ressources/controleur/action/loginFb.php');
        // SESSION GOOGLE
        include_once('../ressources/controleur/action/loginGoogle.php');
        $email_membre ="";
        $pseudo_membre="";
        $plateforme="";
        $proprio=0;
        
        $bouton_retour="/cours-de-danse/";
        if(!empty($_SESSION['email_membre'])){ // SI IL Y A UN MEMBRE CONNECTE, CHECK SI LA SESSION EST EXPIREE OU PAS, si vrai -> logout() puis rechargement de cette page
            check_login();
            $email_membre = $_SESSION['email_membre'];
            $pseudo_membre = $_SESSION['pseudo_membre'];
            $plateforme = $_SESSION['from'];
            $nb_jeton_dispo ="";
            $membre_statut= "Membre";
            
            //Information du membre
            require('../ressources/modele/connexion_sql.php');  // Connexion Base sql 
            include_once('../ressources/modele/get_info_membre.php');
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
        // Mise en cache des variables de sessions
        if (!empty($_POST['gps_rechercher_lieu'])){
            $_SESSION['gps_rechercher_lieu']= htmlspecialchars($_POST['gps_rechercher_lieu']);
        }
        
        $communaute_input=""; // on remplace la definition de la communauté s'il y a un post. sinon, on check si la communaute est définie dans la var de session
        // Extract de la communaute
        $style[]="";
        $salsa=0;
        $bachata=0;
        $kizomba=0;
        $rock4T=0;
        $rock6T=0;
        $swing=0;
        $wcs=0;
        $tango=0;
        $salon=0;
        $styledanse=0;
        if (isset($_POST['style'])) {
                $styledanse=1;
                for($i=0;$i<count($_POST['style']);$i++){
                        $style[$i]=htmlspecialchars($_POST['style'][$i]);
                        $communaute_input.=$style[$i].", ";
                        //Regarde si le style convient
                        switch ($style[$i]) {
                                case "Salsa":
                                    $salsa=1;
                                    break;
                                case "Bachata":
                                    $bachata=1;
                                    break;
                                case "Kizomba":
                                    $kizomba=1;
                                    break;
                                case "Rock 4T":
                                    $rock4T=1;
                                    break;
                                case "Rock 6T":
                                    $rock6T=1;
                                    break;
                                case "Swing":
                                    $swing=1;
                                    break;
                                case "WCS":
                                    $wcs=1;
                                    break;
                                case "Tango Argentin":
                                    $tango=1;
                                    break;
                                case "Salon":
                                    $salon=1;
                                    break;                                
                                default:
                                    $styledanse=0;
                                    break;
                        }
                }
                $_SESSION['communaute_rechercher_lieu']=$style; 
        }
        else{
                if(!isset($_SESSION['communaute_rechercher_lieu'])){
                        $_SESSION['communaute_rechercher_lieu']="default";
                }
                else{
                        $styledanse=1;
                        for($i=0;$i<count($_SESSION['communaute_rechercher_lieu']);$i++){
                                $style[$i]=htmlspecialchars($_SESSION['communaute_rechercher_lieu'][$i]);
                                $communaute_input.=$style[$i].", ";
                                //Regarde si le style convient
                                switch ($style[$i]) {
                                        case "Salsa":
                                            $salsa=1;
                                            break;
                                        case "Bachata":
                                            $bachata=1;
                                            break;
                                        case "Kizomba":
                                            $kizomba=1;
                                            break;
                                        case "Rock 4T":
                                            $rock4T=1;
                                            break;
                                        case "Rock 6T":
                                            $rock6T=1;
                                            break;
                                        case "Swing":
                                            $swing=1;
                                            break;
                                        case "WCS":
                                            $wcs=1;
                                            break;
                                        case "Tango Argentin":
                                            $tango=1;
                                            break;
                                        case "Salon":
                                            $salon=1;
                                            break;                                
                                        default:
                                            $styledanse=0;
                                            break;
                                }
                        }
                $_SESSION['communaute_rechercher_lieu']=$style; 
                }
        }
        
        if (!empty($_POST['adresse_rechercher_lieu'])){
            $_SESSION['adresse_rechercher_lieu']=htmlspecialchars($_POST['adresse_rechercher_lieu']);
        }
        
        $research_radius=5; /*(valeur par défaut)*/
        if (!empty($_POST['research_radius'])){
            $research_radius = $_POST['research_radius'];
        }
        
        //Gère la redirection et les valeurs
        $redirection_value="";
        if(isset($_SESSION['redirection'])){
              if($_SESSION['redirection']=="commentaire"){
                if(isset($_SESSION['redirection_value'])){
                    $redirection_value=$_SESSION['redirection_value'];
                }
                unset($_SESSION['redirection_value']);
            }
            unset($_SESSION['redirection']); 
        }
        // AFFICHAGE DE LA PAGE FINALE AVEC TOUTES LES COURS
        include_once('../ressources/vue/vueCours.php');
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
    
        // TRAITEMENT DES COORDONNEES - DEFINITION DU CERCLE DES MARQUEURS POSSIBLES 
        $coordGPS = $_SESSION['gps_rechercher_lieu'];
        sscanf($coordGPS, '(%f, %f)', $lat, $lng);
        include_once('../ressources/controleur/action/calcul_coord_max.php');
        $rayon=$research_radius; // prends en compte le cercle de rayon = diagonale du rectangle/2;
        $tableau = calcul_coord_max($lat,$lng,$rayon);
        $latMin = $tableau[0];
        $latMax = $tableau[1];
        $lngMin = $tableau[2];
        $lngMax = $tableau[3];
        // Recupération des données du formulaire dans des variables
        $communaute = $style;
        
        $map_setup_init = array('zoom'=>12,'center'=>array('lat'=>$lat,'lng'=>$lng)); // Préparation des parametre pour initialiser la map
        // RECUPERATION DE TOUS LES MARQUEURS INCLUS DANS LE CERCLE DES MARQUEURS LIES AUX COORDS GPS
        require('../ressources/modele/connexion_sql.php');  // Connexion Base sql
        require_once('../ressources/modele/get_extract_cours.php');
        $extractBdd = '';
        $extractBdd = get_extract_cours($latMin,$latMax,$lngMin,$lngMax); // renvoie une chaine de caract [xxx,xxxx,"xxx",xxx,...]
}
else{
        header("Refresh: 0 ; url=https://www.lepetitbal.com");
}
?>
<script data-goo="<?php echo htmlentities(json_encode($map_setup_init));?>" extractBdd="<?php echo htmlentities($extractBdd);?>" communaute="<?php echo htmlentities(json_encode($communaute));?>" src="https://maps.googleapis.com/maps/api/js?callback=initMap&key=AIzaSyCVvPab8JGafCZMvlwtWEBWgUE0-3d88gs&libraries=places" async defer></script>