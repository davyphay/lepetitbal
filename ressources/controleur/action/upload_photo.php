<?php
$URL_photo_lieu=htmlspecialchars(($_POST['image_lieu_old'])); // par défaut
if(!empty($_FILES['image_lieu']['name'])){
     $dossier = '../../img_upload_storage/';
     $fichier = basename($_FILES['image_lieu']['name']);
     $taille_maxi = 2097152;
     $taille = filesize($_FILES['image_lieu']['tmp_name']);
     $erreur_upload = $_FILES['image_lieu']['error'];
     $extensions = array('.jpg','.jpeg');
     $extension = strrchr($_FILES['image_lieu']['name'], '.');
     $extension = strtolower($extension); // if .JPG => .jpg

     $time = time();
     $date = date("Y-m-d",$time);
     //Début des vérifications de sécurité...
     if(!in_array($extension, $extensions)){  //Si l'extension n'est pas dans le tableau
          $erreur = 'Vous devez uploader un fichier de type jpg ou jpeg!';
     }
     if($taille>$taille_maxi){
          $erreur = 'Le fichier est trop gros... La taille maximale est de 2Mo';
     }
     if($erreur_upload==2){
          $erreur = 'Le fichier est trop gros... La taille maximale est de 2Mo';
     }
     if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
     {
           //On formate le nom du lieu ici...
           $nom_lieu= strtr($nom_lieu, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
           $nom_lieu = preg_replace('/([^.a-z0-9]+)/i', '-', $nom_lieu);

           if(move_uploaded_file($_FILES['image_lieu']['tmp_name'], $dossier.$date.'_'.$nom_lieu.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
           {
               $URL_photo_lieu_full=$dossier.$date.'_'.$nom_lieu.$extension;
               $URL_photo_lieu=$date.'_'.$nom_lieu.$extension;
               //Creation de la miniature
               $ImageChoisie = imagecreatefromjpeg($URL_photo_lieu_full);
               $TailleImageChoisie = getimagesize($URL_photo_lieu_full);
               $NouvelleLargeur = 200; //Largeur choisie à 350 px mais modifiable
               $NouvelleHauteur = ( ($TailleImageChoisie[1] * (($NouvelleLargeur)/$TailleImageChoisie[0])) ); //Proportion gardée
               $NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
               imagecopyresampled($NouvelleImage , $ImageChoisie  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
               imagedestroy($ImageChoisie);
               $URL_photo_min_lieu_full = $dossier.$date.'_'.$nom_lieu.'_min'.$extension;
               $URL_photo_min_lieu = $date.'_'.$nom_lieu.'_min'.$extension;
               imagejpeg($NouvelleImage ,$URL_photo_min_lieu_full, 95); //100 : qualité de rééchantillonnage de 100%
               $_SESSION['success']= "Upload photo effectué avec succès !";
           }
           else{
               $_SESSION['success']="";
               $_SESSION['erreur']= "Echec de l\'upload !";
           }
     }
     else{
          $_SESSION['success']="";
          $_SESSION['erreur']= "'$erreur'";
     }
}
else{ // Si pas d'upload de photo => RIEN FAIRE
     $_SESSION['success']="";
}
?>
