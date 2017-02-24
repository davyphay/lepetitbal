<meta charset="utf-8">
<?php

	$tableForm_cours_hebdo_value = "";
	$tableDisplay_cours_hebdo_value = "";
	$nb_post_lundi =count($_POST['horaire_lundi']);
	$nb_post_mardi =count($_POST['horaire_mardi']);
	$nb_post_mercredi =count($_POST['horaire_mercredi']);
	$nb_post_jeudi =count($_POST['horaire_jeudi']);
	$nb_post_vendredi =count($_POST['horaire_vendredi']);
	$nb_post_samedi =count($_POST['horaire_samedi']);
	$nb_post_dimanche =count($_POST['horaire_dimanche']);
	
	$maxLength_horaire = 13;
	$maxLength_type = 25;
	$maxLength_comment = 60;

//DEBUT RECONSTITUTION TABLE FORM
	$tableForm_cours_hebdo_value.='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (niveau,professeur,salle,...)</th><th>Ajouter/ Supprimer</th></tr>';
	for($day_counter = 1; $day_counter <=7; $day_counter++){
		$day="";
		$dayMaj="";
		$nb_post=0;
		$nb_cours=0;
		switch ($day_counter) // on indique sur quelle variable on travaille
		{ 
			case 1:
				$day="lundi";
				$dayMaj="Lundi";
				$nb_post=$nb_post_lundi;
			break;
			case 2: 
				$day="mardi";
				$dayMaj="Mardi";
				$nb_post=$nb_post_mardi;
			break;
			case 3:
				$day="mercredi";
				$dayMaj="Mercredi";
				$nb_post=$nb_post_mercredi;
			break;
			case 4: // etc. etc.
				$day="jeudi";
				$dayMaj="Jeudi";
				$nb_post=$nb_post_jeudi;
			break;
			case 5:
				$day="vendredi";
				$dayMaj="Vendredi";
				$nb_post=$nb_post_vendredi;
			break;
			case 6:
				$day="samedi";
				$dayMaj="Samedi";
				$nb_post=$nb_post_samedi;
			break;
			case 7:
				$day="dimanche";
				$dayMaj="Dimanche";
				$nb_post=$nb_post_dimanche;
			break;
			default:
				$day="";
				$dayMaj="";
				$nb_post=0;
		}
		
		//Ajout du contenu
		$tableForm_cours_hebdo_value.='<tr id="tr_'.$day.'_0" class="cours-'.$day.'"><td class="jour" id="td_cours_'.$day.'" rowspan="'.$nb_post.'">'.$dayMaj.'</td><td><input type="text" class="form-control-table" name="horaire_'.$day.'[]" value="'.htmlentities($_POST["horaire_$day"][0]).'" maxlength="'.$maxLength_horaire.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_'.$day.'[]" value="'.htmlentities($_POST["type_$day"][0]).'" maxlength="'.$maxLength_type.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_'.$day.'[]" value="'.htmlentities($_POST["commentaire_$day"][0]).'" maxlength="'.$maxLength_comment.'" placeholder="..."></td>';
		for ($i = 1; $i < $nb_post; $i++){
			$tableForm_cours_hebdo_value.='</tr><tr id="tr_'.$day.'_'.$i.'" class="cours-'.$day.'"><td><input type="text" class="form-control-table" name="horaire_'.$day.'[]" value="'.htmlentities($_POST["horaire_$day"][$i]).'" maxlength="'.$maxLength_horaire.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_'.$day.'[]" value="'.htmlentities($_POST["type_$day"][$i]).'" maxlength="'.$maxLength_type.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_'.$day.'[]" value="'.htmlentities($_POST["commentaire_$day"][$i]).'" maxlength="'.$maxLength_comment.'" placeholder="..."></td>';
		}
		$tableForm_cours_hebdo_value.='<td id="boutons_'.$day.'" class="boutons_jour" value-rs="'.$nb_post.'"><button type="button" value="'.$day.'" onclick="addinputs(this)">+</button><button type="button" value="'.$day.'" onclick="deleteinputs(this)">x</button></td></tr>';
	}
	$tableForm_cours_hebdo_value.='</table>';
//FIN RECONSTITUTION TABLE FORM


//DEBUT RECONSTITUTION TABLE DISPLAY
	$tableDisplay_cours_hebdo_value.='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (niveau, professeur, salle, ...)</th></tr>';
	for($day_counter = 1; $day_counter <=7; $day_counter++){
		$day="";
		$dayMaj="";
		$nb_post=0;
		$nb_cours=0;
		switch ($day_counter) // on indique sur quelle variable on travaille
		{ 
			case 1:
				$day="lundi";
				$dayMaj="Lundi";
				$nb_post=$nb_post_lundi;
			break;
			case 2: 
				$day="mardi";
				$dayMaj="Mardi";
				$nb_post=$nb_post_mardi;
			break;
			case 3:
				$day="mercredi";
				$dayMaj="Mercredi";
				$nb_post=$nb_post_mercredi;
			break;
			case 4: // etc. etc.
				$day="jeudi";
				$dayMaj="Jeudi";
				$nb_post=$nb_post_jeudi;
			break;
			case 5:
				$day="vendredi";
				$dayMaj="Vendredi";
				$nb_post=$nb_post_vendredi;
			break;
			case 6:
				$day="samedi";
				$dayMaj="Samedi";
				$nb_post=$nb_post_samedi;
			break;
			case 7:
				$day="dimanche";
				$dayMaj="Dimanche";
				$nb_post=$nb_post_dimanche;
			break;
			default:
				$day="";
				$dayMaj="";
				$nb_post=0;
		}
		
		//Comptage du nombre effectif de cours pour affichage AVANT ajout de contenu
		for ($j = 0; $j < $nb_post; $j++){
			if($_POST["horaire_$day"][$j] || $_POST["type_$day"][$j] || $_POST["commentaire_$day"][$j]){
				$nb_cours++;
			}
		}
		
		//Ajout contenu
		$capteur=0;
		for($i = 0; $i < $nb_post; $i++){
			if($_POST["horaire_$day"][$i] || $_POST["type_$day"][$i] || $_POST["commentaire_$day"][$i]){
				if($capteur==0){
					$tableDisplay_cours_hebdo_value.='<tr id="tr_'.$day.'_'.$i.'" class="cours-'.$day.'"><td class="jour" id="td_cours_'.$day.'" rowspan="'.$nb_cours.'">'.$dayMaj.'</td><td>'.htmlentities($_POST["horaire_$day"][$i]).'</td><td>'.htmlentities($_POST["type_$day"][$i]).'</td><td>'.htmlentities($_POST["commentaire_$day"][$i]).'</td>';
					$capteur=1;
				}
				else{
					$tableDisplay_cours_hebdo_value.='</tr><tr id="tr_'.$day.'_'.$i.'" class="cours-'.$day.'"><td>'.htmlentities($_POST["horaire_$day"][$i]).'</td><td>'.htmlentities($_POST["type_$day"][$i]).'</td><td>'.htmlentities($_POST["commentaire_$day"][$i]).'</td>';
				}
				$tableDisplay_cours_hebdo_value.='</tr>';
			}
		}
	}
	$tableDisplay_cours_hebdo_value.='</table>';
//FIN RECONSTITUTION
;?>