// Fonction de présentation du billet
function presenterBillet_event(tableauInfo,compteur_billet,compteur_marker,compteur_jour){
	compteur_marker_tag=compteur_marker+1;
	//Stockage des info lieu du tableau dans des variables
	var destination = "inner_right_panel";
	var num_billet = compteur_billet;
	var id_lieu = tableauInfo.id_lieu;
	var nom_lieu = tableauInfo.nom_lieu;
	var adresse_lieu = tableauInfo.adresse_lieu;
	var type_lieu = tableauInfo.type_lieu;
	var upvote_lieu = tableauInfo.upvote_lieu;
	var distance = tableauInfo.distance;
	var description = tableauInfo.description_lieu;
	var URL_web = tableauInfo.URL_web_lieu; 
	var URL_photo = tableauInfo.URL_photo_lieu;
	
	// Pour comparer les dates promotion
	var date_expiration_promotion = new Date(tableauInfo.date_expiration_promotion_lieu);
	var today = new Date();
	today.setHours(0,0,0,0);
	date_expiration_promotion.setHours(0,0,0,0);
	if(today<=date_expiration_promotion){
		billet_header_class="billet_header_pro noselect";
		sponsor='<div id="sponsor_header_1" class="sponsor_header" title="Recommandé par lepetitbal"><i class="fa fa-trophy" aria-hidden="true"></i></div>';
	}
	else{
		billet_header_class="billet_header noselect";
		sponsor='';
	}
	
	//Stockage des info event du tableau dans des variables
	var titre_event = tableauInfo.titre_evenement;
	var heure_debut_event = tableauInfo.heure_debut_evenement;
	var heure_fin_event = tableauInfo.heure_fin_evenement;
	var danse_pratique_event = tableauInfo.danse_pratique_evenement;
	var organisateur_event = tableauInfo.organisateur_evenement;
	var tarifs_event = tableauInfo.tarifs_evenement;
	var description_event = tableauInfo.description_evenement;
	var url_fb_event = tableauInfo.url_fb_evenement;
	var url_fb_event_a = '<a class="event_content_footer_lien" href="http://'+url_fb_event+'" target="_blank" title="Lien de l\'évènement">Lien de l\'évènement</a>';
	var initiation_event = tableauInfo.initiation_evenement;
	var special_event = tableauInfo.special_evenement;
	
	var billet='<div id="billet'+compteur_billet+destination+'" class="billet passive-billet collapse in" id_lieu="'+id_lieu+'" numero_billet="'+num_billet+'" nom="'+nom_lieu+'"> <div id="billet_'+compteur_billet+destination+'_header" class="'+billet_header_class+'"> <div class="billet_header_left"> <div id="num_marker_'+compteur_billet+'" class="num_marker_header"><img src="../ressources/images/icons/marker_red'+compteur_marker_tag+'.png" width="16" height="27"></div><div id="nom" class="nom_header">'+nom_lieu+'</div><div id="distance" class="distance_header">'+distance+' km</div></div><div class="billet_header_right">'+sponsor+'<div id="commentaire" class="comment_header"> <div class="bouton_commentaire" title="Voir les commentaires"><i class="fa fa-comments" aria-hidden="true"></i></div></div><div id="" class="upvote_'+id_lieu+' upvote_header"> <div id="" name="up" id_lieu="'+id_lieu+'" class="zonebouton_upvote_'+id_lieu+' zone_bouton_upvote vote" title="Recommander"> <div id="" class="bouton_upvote_'+id_lieu+' bouton_upvote_header"><i class="fa fa-thumbs-up"></i></div><div id="" class="compteur_upvote_'+id_lieu+' compteur_upvote_header">'+upvote_lieu+'</div></div></div></div></div><div class="billet_content collapse" aria-expanded="true" style=""><div id="billet_description'+compteur_billet+destination+'" class="billet_description"></div></div><div class="event_header"><div id="event_header_left_'+compteur_billet+'" class="event_header_left"> <div class="event_header_left_title txt-hover">'+titre_event+'</div></div><div class="event_header_right"><div id="event_content_danse_pratique_'+num_billet+'" class="event_content_footer_info_danse">'+danse_pratique_event+'</div><div id="event_header_right_sticker'+num_billet+'" class="event_header_right_sticker"> </div><div class="event_header_right_horaire"> <div class="event_header_right_horaire_debut">'+heure_debut_event+'</div><div class="event_header_right_separator">-</div><div class="event_header_right_horaire_fin">'+heure_fin_event+'</div></div></div></div><div id="billet_content'+compteur_billet+destination+'" class="billet_content collapse" aria-expanded="true" style=""> <div class="event_content"> <div id="event_content_footer'+num_billet+'" class="event_content_footer"><div id="event_content_tarifs_'+num_billet+'" class="event_content_footer_info_prix"><b>Tarifs :</b> '+tarifs_event+'</div></div><div class="event_content_description"><div id="event_content_description_recherche_'+num_billet+'" class="event_content_description_content"></div></div></div><div id="billet_footer'+compteur_billet+destination+'" class="billet_footer"> <div id="adresse" class="adresse_footer"><b>'+type_lieu+'</b>, '+adresse_lieu+'</div><div class="bouton_footer"> <div class="modifier_header"> <div id="bouton_modifier_'+id_lieu+'" class="bouton_modifier_header" title="Modifier l\'annonce"><i class="fa fa-pencil-square-o"></i></div></div><div id="modifier_'+id_lieu+'" class="report_header"> <div id="bouton_report_'+id_lieu+'" class="bouton_report_header" title="Signaler l\'annonce"><i class="fa fa-bullhorn"></i></div></div></div></div></div></div>';
	$('#espace_jour'+compteur_jour).append(billet);		
	//Ajouts des stickers si présent
	var sticker_initiation = '<div class="event_header_right_sticker_initiation"><img src="../ressources/images/website/icon-human-shoes-footprints-white.png" style="width:14px;height:14px;" title="Avec initiation"></div>';
	var sticker_special = '<div class="event_header_right_sticker_special"><i class="glyphicon glyphicon-star-empty" title="Évènement spécial"></i></div>';
	if(initiation_event=="1"){
		$('#event_header_right_sticker'+num_billet).append(sticker_initiation);
	}
	if(special_event=="1"){
		$('#event_header_right_sticker'+num_billet).append(sticker_special);
	}
	if(organisateur_event!==""){
		orga_text = '<div id="event_header_organisateur_'+num_billet+'" class="event_header_organisateur">'+organisateur_event+'</div>';
		$("#event_header_left_"+compteur_billet).append(orga_text);
	}
	//Ajout description et lien fb si présent
	if(description_event || url_fb_event){
		if(description_event){
			var lines = description_event.split("\\r\\n");  
			for(var j=0,l=lines.length;j<l;j++){
				lines[j] = JSON.parse('"' + lines[j].replace(/\"/g, '\\"') + '"');
				var retour_ligne ="</br>";
				$("#event_content_description_recherche_"+num_billet).append(lines[j]);
				$("#event_content_description_recherche_"+num_billet).append(retour_ligne);
			}
		}
		if(url_fb_event!==""){
			$('#event_content_footer'+num_billet).append(url_fb_event_a);
		}
	}
	else{
		$("#event_content_description_recherche_"+num_billet).html("<i>Description non renseignée</i>");
	}
	// Click event sur les billets
	$(document).ready(function() {
		$("#num_marker_"+compteur_billet).parent().on('click', function(event){
			event.stopPropagation();
			google.maps.event.trigger(markerList[compteur_billet], 'click');
		});
		$("#num_marker_"+compteur_billet).parent().parent().on('click', function(event){
			if (event.target !== this)
				return;
			event.stopPropagation();
			google.maps.event.trigger(markerList[compteur_billet], 'click');
		});
		$("#event_header_left_"+compteur_billet).parent().on('click', function(event){
			event.stopPropagation();
			google.maps.event.trigger(markerList[compteur_billet], 'click');
		});		
	});
	// Ajout description lieu si dispo
	//création zone photo si photo dispo
	var paraURL_photo = document.createElement("div");paraURL_photo.id="URL_photo";
	paraURL_photo.className="URL_photo_description thumbnail";
	var paraZoneDescription = document.createElement("div");paraZoneDescription.id="commentZone";
	paraZoneDescription.className="commentZone_description";
	var contenuURL_web=URL_web;
	var nodeURL_web = document.createTextNode("Lien vers le site internet");
	if(URL_photo){ 
			photo_billet = document.createElement("div");
			photo_billet.href="../ressources/img_upload_storage/"+URL_photo;
			photo_billet.title="Agrandir!";
			photo_billet.className="div-img";
			paraURL_photo.appendChild(photo_billet);
			photo_billet_mini= document.createElement("img");
			re = /(?:\.([^.]+))?$/;
			input = URL_photo;
			output = input.substr(0, input.lastIndexOf('.')) || input;
			ext = re.exec(URL_photo)[1]; 
			URL_photo_mini = output+"_min."+ext;
			photo_billet_mini.src="../ressources/img_upload_storage/"+URL_photo_mini;
			photo_billet.appendChild(photo_billet_mini);
	}
	else{
			// AFFICHAGE UNIQUE MINIATURE default si no photo
			photo_billet_mini= document.createElement("img");
			photo_billet_mini.src="../ressources/images/website/img-default-resized.jpg";
			paraURL_photo.appendChild(photo_billet_mini);
	}
	 //Creation zone content à gauche de la photo
	var paraDescription_content = document.createElement("div");
	paraDescription_content.id="description_content";
	paraDescription_content.className="description-content";
	
	// creation header description
	var paraHeader_description = document.createElement("div");
	paraHeader_description.className="header_description";
	paraDescription_content.appendChild(paraHeader_description);
	
	//Creation Titre description
	var paraTitre_description = document.createElement("div");
	paraTitre_description.innerHTML="<b>Description</b>";
	paraTitre_description.className="titre_description";
	paraHeader_description.appendChild(paraTitre_description);
	
	//Creation URL zone
	var paraURL_zone = document.createElement("div");
	paraURL_zone.id="URL_zone";
	paraURL_zone.className="URL-zone";
	paraHeader_description.appendChild(paraURL_zone);
	
	//insertion URL web si présent
	if(URL_web!==""){
			var paraURL_web = document.createElement("div");
			paraURL_web.id="URL_web";
			paraURL_web.className="website_description";
			paraURL_zone.appendChild(paraURL_web);

			var URL_web_billet= document.createElement("a");
			URL_web_billet.href="http://"+contenuURL_web;
			paraURL_web.appendChild(URL_web_billet);
			URL_web_billet.appendChild(nodeURL_web);
			URL_web_billet.target="_blank";
	}
	// Zone Description
	paraDescription_content.appendChild(paraZoneDescription);
	if(description===""){
			paraZoneDescription.innerHTML="<i>Description non renseignée</i>";
	}
	//Génération contenu description
	var lines2 = description.split("\\r\\n"); //Affiche ligne par ligne le textarea
	for(var i=0,m=lines2.length;i<m;i++){
			lines2[i] = JSON.parse('"' + lines2[i].replace(/\"/g, '\\"') + '"');
			paraZoneDescription.innerHTML+=lines2[i];
			paraZoneDescription.appendChild(document.createElement("br"));
	}
	
	//Affichage des infos zone description
	billet_description = document.getElementById("billet_description"+compteur_billet+destination);
	billet_description.appendChild(paraURL_photo);
	billet_description.appendChild(paraDescription_content);
	if((!description && !URL_photo &&!URL_web) || today>date_expiration_promotion){ //Cache la zone s'il n'y a pas d'infos dedans et si l'event n'est plus en promo
			billet_description.className+=" hidden";
	}

	return $('#billet'+compteur_billet+destination);
}