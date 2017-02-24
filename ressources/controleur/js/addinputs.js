// SEULEMENT POUR LES COURS
function addinputs(retour){
	$jour = retour.getAttribute("value");
	//AJOUTER UNE LIGNE JUSTE APRES LE +
	td_jour_cours = document.getElementById('td_cours_'+$jour);
	boutons_jour = document.getElementById('boutons_'+$jour);
	old_rowspan = boutons_jour.getAttribute("value-rs");
	value_id=parseInt(old_rowspan)-1;
	new_rowspan = parseInt(old_rowspan)+1;
	td_jour_cours.setAttribute("rowspan",new_rowspan);
	
	var input= '<tr id=tr_'+$jour+'_'+old_rowspan+'><td><input type="text" class="form-control-table" name="horaire_'+$jour+'[]" value="" maxlength="13" placeholder="..."></td><td><input type="text" class="form-control-table" name="type_'+$jour+'[]" value="" maxlength="25" placeholder="..."></td><td><input type="text" class="form-control-table" name="commentaire_'+$jour+'[]" value="" maxlength="60" placeholder="..."></td></tr>';
	$('#tr_'+$jour+'_'+value_id).after(input);
	
	// déplacement du bouton ajouter et incrémentation de la valeur du bouton
	boutons_jour.setAttribute("value-rs",new_rowspan);
	$('#tr_'+$jour+'_'+old_rowspan).append($('#boutons_'+$jour));
	
	$('#form_modifier_lieu').data('changed', true); //Notif de changement de form pour envoi
	
	$('#cours_changement').val("yes");
}

function deleteinputs(retour){
	$jour = retour.getAttribute("value");
	td_jour_cours = document.getElementById('td_cours_'+$jour);
	boutons_jour = document.getElementById('boutons_'+$jour);
	old_rowspan = boutons_jour.getAttribute("value-rs");
	new_rowspan = parseInt(old_rowspan)-1;
	if(old_rowspan>1){
		// déplacement du bouton ajouter et décrémentation de la valeur du bouton
		value_id=parseInt(old_rowspan)-2;
		td_jour_cours.setAttribute("rowspan",new_rowspan);
		boutons_jour.setAttribute("value-rs",new_rowspan);
		$('#tr_'+$jour+'_'+value_id).append($('#boutons_'+$jour));
		
		//delete la ligne
		$('#tr_'+$jour+'_'+new_rowspan).remove();
	}
	else if(old_rowspan<=1){
		$('#tr_'+$jour+'_'+new_rowspan).find('input').val('');
	}
	
	$('#form_modifier_lieu').data('changed', true); //Notif de changement de form pour envoi
	$('#cours_changement').val("yes");
}
