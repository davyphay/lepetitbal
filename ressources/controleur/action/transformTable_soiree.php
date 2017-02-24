<meta charset="utf-8">
<?php
	$tableForm_soiree_hebdo_value = "";
	$tableDisplay_soiree_hebdo_value = "";
	
	$maxLength_horaire = 13;
	$maxLength_type = 40;
	$maxLength_comment = 60;
	
//DEBUT RECONSTITUTION TABLE FORM
	$tableForm_soiree_hebdo_value.='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (prix,initiation,salle,...)</th></tr>';
	for($day_counter = 1; $day_counter <=7; $day_counter++){
		$day="";
		$dayMaj="";
		$nb_soiree=1;
		$i=0;
		switch ($day_counter) // on indique sur quelle variable on travaille
		{ 
			case 1:
				$day="lundi";
				$dayMaj="Lundi";
			break;
			case 2: 
				$day="mardi";
				$dayMaj="Mardi";
			break;
			case 3:
				$day="mercredi";
				$dayMaj="Mercredi";
			break;
			case 4: // etc. etc.
				$day="jeudi";
				$dayMaj="Jeudi";
			break;
			case 5:
				$day="vendredi";
				$dayMaj="Vendredi";
			break;
			case 6:
				$day="samedi";
				$dayMaj="Samedi";
			break;
			case 7:
				$day="dimanche";
				$dayMaj="Dimanche";
			break;
			default:
				$day="";
				$dayMaj="";
		}
			$tableForm_soiree_hebdo_value.='<tr id="tr_'.$day.'_0" class="soiree-'.$day.'"><td class="jour" id="td_'.$day.'" rowspan="'.$nb_soiree.'">'.$dayMaj.'</td><td><input type="text" class="form-control-table" name="horaire_soiree_'.$day.'[]" value="'.htmlentities($_POST["horaire_soiree_$day"][$i]).'" maxlength="'.$maxLength_horaire.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_soiree_'.$day.'[]" value="'.htmlentities($_POST["type_soiree_$day"][$i]).'" maxlength="'.$maxLength_type.'" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_soiree_'.$day.'[]" value="'.htmlentities($_POST["commentaire_soiree_$day"][$i]).'" maxlength="'.$maxLength_comment.'" placeholder="..."></td></tr>';
	}
	$tableForm_soiree_hebdo_value.='</table>';
//FIN RECONSTITUTION TABLE FORM

//DEBUT RECONSTITUTION TABLE DISPLAY
	$tableDisplay_soiree_hebdo_value='<table class="table table-striped table-bordered table-condensed"><tr><th>Jour</th><th>Horaires</th><th>Type de danse</th><th>Informations (prix, initiation, salle, ...)</th></tr>';
	for($day_counter = 1; $day_counter <=7; $day_counter++){
		$day="";
		$dayMaj="";
		$nb_soiree=1;
		switch ($day_counter) // on indique sur quelle variable on travaille
		{ 
			case 1:
				$day="lundi";
				$dayMaj="Lundi";
			break;
			case 2: 
				$day="mardi";
				$dayMaj="Mardi";
			break;
			case 3:
				$day="mercredi";
				$dayMaj="Mercredi";
			break;
			case 4: // etc. etc.
				$day="jeudi";
				$dayMaj="Jeudi";
			break;
			case 5:
				$day="vendredi";
				$dayMaj="Vendredi";
			break;
			case 6:
				$day="samedi";
				$dayMaj="Samedi";
			break;
			case 7:
				$day="dimanche";
				$dayMaj="Dimanche";
			break;
			default:
				$day="";
				$dayMaj="";
		}

		if($_POST["horaire_soiree_$day"][$i] || $_POST["type_soiree_$day"][$i] || $_POST["commentaire_soiree_$day"][$i] )
		{
			$tableDisplay_soiree_hebdo_value.='<tr id="tr_'.$day.'_'.$i.'" class="soiree-'.$day.'"><td class="jour" id="td_'.$day.'" rowspan="'.$nb_soiree.'">'.$dayMaj.'</td><td>'.htmlentities($_POST["horaire_soiree_$day"][$i]).'</td><td>'.htmlentities($_POST["type_soiree_$day"][$i]).'</td><td>'.htmlentities($_POST["commentaire_soiree_$day"][$i]).'</td></tr>';
		}
	}
	$tableDisplay_soiree_hebdo_value.='</table>';
//FIN RECONSTITUTION
;?>