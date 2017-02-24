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
function generer_mot_de_passe()
{
	$nb_caractere = 12;
	$mot_de_passe = "";
	$chaine = "abcdefghjkmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ023456789";
	$longeur_chaine = strlen($chaine);
	for($i = 1; $i <= $nb_caractere; $i++)
	{
		$place_aleatoire = mt_rand(0,($longeur_chaine-1));
		$mot_de_passe .= $chaine[$place_aleatoire];
	}
	return $mot_de_passe;   
}

if(isset($_POST['email_lien_mdp'])){
	$email = addslashes(htmlspecialchars(htmlentities(trim($_POST['email_lien_mdp']))));
	if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) // on vérifie si l'email à un format valide.
	{
		//Check si l'utilisateur existe dans la BDD de lepetitbal
		require_once('../../modele/connexion_sql.php');  // Connexion base sql
		require_once('../../modele/get_info_membre.php');
		$info=get_info_membre($email);
		if($info[0]!==""){
				$mot_de_passe=generer_mot_de_passe();
				$pseudo_membre=$info[4];
				$url_lien_confirmation = "https://www.lepetitbal.com/ressources/controleur/action/nouveau_mdp?mdp=".$mot_de_passe;
				//Ajout du mdp temporaire et de l'adresse mail dans la BDD
				require_once('../../modele/put_mdp_temporaire.php');
				put_mdp_temporaire($email,$mot_de_passe);
				
				$to = $email;
				$subject = "Pseudo ou MdP lepetitbal.com oublié";
				$message = "
				<html>
				<head>
				<title>HTML email</title>
				</head>
				<body>
				<p>
					<p>Bonjour,</p>
					<p>Vous avez fait une demande pour récupérer votre pseudo ou votre mot de passe.</p>
					<p>Votre pseudo est: ".$pseudo_membre."</p>
					<p>Si vous avez perdu votre mot de passe, vous pouvez utiliser le mot de passe temporaire ci dessous en l'activant.</p>
					<p>Veuillez cliquer sur le lien suivant pour l'activer :
						<a href='".$url_lien_confirmation."'>Activer le mot de passe temporaire</a>
					</p>
					<p>Votre mot de passe temporaire : ".$mot_de_passe."</p>
					<p>Pensez à changer le mot de passe temporaire en vous connectant juste après.</p>
					<p>Si vous n'êtes pas à l'origine de cette opération, veuillez nous le signaler en répondant à ce mail.</p>
					<p>L'équipe de lepetitbal.com vous souhaite une excellente journée.</p>
				</p>	
				</body>
				</html>
				";
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: "Contact lepetitbal" <contact@lepetitbal.com>' . "\r\n";
				mail($to,$subject,$message,$headers);

				$_SESSION['success']="Un nouveau mot de passe a été envoyé à ".$email;
				header('Refresh: 0 ; url='.$bouton_retour);
			}
			else{
				$_SESSION['erreur']= "Cette adresse mail n'est pas liée à un utilisateur.";
				header('Refresh: 0 ; url='.$bouton_retour); 
			}
	}
	else{
		$_SESSION['erreur']= "L'adresse email n'est pas valide";
		header('Refresh: 0 ; url='.$bouton_retour);  
	}
}
else{
	$_SESSION['erreur']= "Vous devez saisir une adresse email";
	header('Refresh: 0 ; url='.$bouton_retour);
}