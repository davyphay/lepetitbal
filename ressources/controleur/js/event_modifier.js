//Place les valeurs de l'evenement dans l'espace modal lors du click
$(document).ready(function() {
	$(".event_modifier").click(function() {
		$('#espaceEventModal').modal('show');
		$("#id_evenement").val($(this).attr("value"));
		$("#id_evenement_delete").val($(this).attr("value"));
		$("#date_evenement").val($(this).find("#event_header_date").attr("value"));
		$("#titre_evenement").val($(this).find("#event_header_titre").attr("value"));
		$("#heure_debut_evenement").val($(this).find("#event_header_horaire_deb").attr("value"));
		$("#heure_fin_evenement").val($(this).find("#event_header_horaire_fin").attr("value"));
		$("#organisateur_evenement").val($(this).find("#event_content_organisateur").attr("value"));
		$("#danse_pratique_evenement").val($(this).find("#event_content_danse_pratique").attr("value"));
		$("#tarifs_evenement").val($(this).find("#event_content_tarifs").attr("value"));
		//Reformatage de la description
		$("#description_evenement").html("");
		description=$(this).find("#event_content_description_content").attr("value");
		var lines = description.split("\\r\\n");  
		for(var j=0,l=lines.length;j<l;j++){
				var retour_ligne ="&#13;&#10;";
				if(j!==0){
					$("#description_evenement").append(retour_ligne);
				}			
				$("#description_evenement").append(lines[j]);
		}
		$("#url_fb_evenement").val($(this).find("#event_content_url_fb").attr("value"));
		
		// Type de danse
		var communaute = $(this).attr("communaute");
		var event_salsa = communaute[0];
		var event_bachata = communaute[2];
		var event_kizomba = communaute[4];
		var event_rock4T = communaute[6];
		var event_rock6T = communaute[8];
		var event_swing = communaute[10];
		var event_wcs = communaute[12];
		var event_tango = communaute[14];
		var event_salon = communaute[16];
		if(event_salsa=="S"){$("#communaute_evenement_salsa").prop('checked', true);}else{$("#communaute_evenement_salsa").prop('checked', false);}
		if(event_bachata=="B"){$("#communaute_evenement_bachata").prop('checked', true);}else{$("#communaute_evenement_bachata").prop('checked', false);}
		if(event_kizomba=="K"){$("#communaute_evenement_kizomba").prop('checked', true);}else{$("#communaute_evenement_kizomba").prop('checked', false);}
		if(event_rock4T=="4"){$("#communaute_evenement_rock4T").prop('checked', true);}else{$("#communaute_evenement_rock4T").prop('checked', false);}
		if(event_rock6T=="6"){$("#communaute_evenement_rock6T").prop('checked', true);}else{$("#communaute_evenement_rock6T").prop('checked', false);}
		if(event_swing=="S"){$("#communaute_evenement_swing").prop('checked', true);}else{$("#communaute_evenement_swing").prop('checked', false);}
		if(event_wcs=="W"){$("#communaute_evenement_wcs").prop('checked', true);}else{$("#communaute_evenement_wcs").prop('checked', false);}
		if(event_tango=="T"){$("#communaute_evenement_tango").prop('checked', true);}else{$("#communaute_evenement_tango").prop('checked', false);}
		if(event_salon=="S"){$("#communaute_evenement_salon").prop('checked', true);}else{$("#communaute_evenement_salon").prop('checked', false);}
		
		//Stickers
		if($(this).find(".event_header_right_sticker_initiation").attr("value")!=="0"){
			$("#initiation_evenement").prop('checked', true);
		}
		else{
			$("#initiation_evenement").prop('checked', false);
		}
		
		if($(this).find(".event_header_right_sticker_special").attr("value")!=="0"){
			$("#special_evenement").prop('checked', true);
		}
		else{
			$("#special_evenement").prop('checked', false);
		}
	});
});
//Bouton supprimer
$(document).ready(function() {
	$("#btn_supprimer_evenement").click(function() {
		alertify.confirm('Confirmation de suppression',
                        'Êtes-vous sûr\(e\) de vouloir supprimer cet évènement \?',
                        function(){$('#form_supprimer_event').submit();},
                        function(){alertify.error('Opération annulée');}
        );
	});
});
//Bouton retour
$(document).ready(function() {
	$("#btn_retour_evenement").click(function() {
		$('#espaceEventModal').modal('hide');
	});
});

$(document).ready(function() {
   $('#bouton_collapse_ajout_event').click(function(){
      if($('#form_ajouter_event_content').hasClass("collapse") && $('#form_ajouter_event_content').hasClass("in")){
         $('#form_ajouter_event_content').collapse("hide");
		 $(this).find('i').removeClass('glyphicon-menu-up').addClass('glyphicon-menu-down');
      }
      else{
        $('#form_ajouter_event_content').collapse("show");
		$(this).find('i').removeClass('glyphicon-menu-down').addClass('glyphicon-menu-up');
      }
   });
});