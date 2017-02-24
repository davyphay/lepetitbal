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
$mail = 'contact@lepetitbal.com'; // Déclaration de l'adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui présentent des bogues.
{
    $passage_ligne = "\r\n";
}
else
{
    $passage_ligne = "\n";
}
// LIST DES INPUTS
$nom_lieu = htmlspecialchars($_POST['nom_lieu']);
$type_lieu = htmlspecialchars($_POST['type_lieu']);
$adresse_lieu = htmlspecialchars($_POST['adresse_lieu']);

//Gestion des communautés
$communaute_lieu_rock="0";
$communaute_lieu_swing="0";
$communaute_lieu_latino="0";
$communaute_lieu_tango="0";
$communaute_lieu_salon="0";
$communaute_lieu_country="0";
$communaute_lieu_bal="0";
$communaute_lieu_monde="0";
if(isset($_POST['communaute_lieu_rock'])){
	$communaute_lieu_rock="R";
}
if(isset($_POST['communaute_lieu_swing'])){
	$communaute_lieu_swing ="S";
}
if(isset($_POST['communaute_lieu_latino'])){
	$communaute_lieu_latino="L";
}
if(isset($_POST['communaute_lieu_tango'])){
	$communaute_lieu_tango ="T";
}
if(isset($_POST['communaute_lieu_salon'])){
	$communaute_lieu_salon ="S";
}
if(isset($_POST['communaute_lieu_country'])){
	$communaute_lieu_country ="C";
}
if(isset($_POST['communaute_lieu_bal'])){
	$communaute_lieu_bal ="B";
}
if(isset($_POST['communaute_lieu_monde'])){
	$communaute_lieu_bal ="M";
}
$communaute_lieu = $communaute_lieu_rock."-".$communaute_lieu_swing."-".$communaute_lieu_latino."-".$communaute_lieu_tango."-".$communaute_lieu_salon."-".$communaute_lieu_country."-".$communaute_lieu_bal."-".$communaute_lieu_monde;

//Gestion des activités
$activite_cours="0";
$activite_soiree="0";
$activite_event="0";
if(isset($_POST['activite_cours'])){
	$activite_cours="C";
}
if(isset($_POST['activite_soiree'])){
	$activite_soiree="S";
}
if(isset($_POST['activite_event'])){
	$activite_event="E";
}
$activite_lieu = $activite_cours."-".$activite_soiree."-".$activite_event;

$email_membre = htmlspecialchars($_POST['email_membre']);

//=====Déclaration des messages au format texte et au format HTML.
//$message_txt = "Description: ".$description_report;
$message_html = "<html><head></head><body><p><b>Nom du lieu:</b></p><p>".$nom_lieu."</p><p><b>Type: </b></p><p>".$type_lieu."</p><p><b>Adresse: </b></p><p>".$adresse_lieu."</p><p><b>Communauté: </b></p><p>".$communaute_lieu."</p><p><b>Activité: </b></p><p>".$activite_lieu."</p><p><b>Expéditeur: </b></p><p>".$email_membre."</p></body></html>";

//=====Création de la boundary.
$boundary = "-----=".md5(rand());
$boundary_alt = "-----=".md5(rand());
//==========
 
//=====Définition du sujet.
$sujet = "Demande Annonceur - ". $nom_lieu;
//=========
 
//=====Création du header de l'e-mail.
$header = "From: \"Annonceur Section\"<annonceur@mail.fr>".$passage_ligne;
$header.= "Reply-to: \"".$email_membre."\" <".$email_membre.">".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//==========
 
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
$message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
//==========
 
$message.= $passage_ligne."--".$boundary_alt.$passage_ligne;
 
//=====Ajout du message au format HTML.
$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
 
//=====On ferme la boundary alternative.
$message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
//==========

$message.= $passage_ligne."--".$boundary.$passage_ligne;

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
$_SESSION['success']= "Votre demande à bien été envoyée, vous aller recevoir sous 24h un mail de confirmation.";
header('Refresh: 0 ; url='.$bouton_retour);
?>
