// CREATION ET GENERATION des markers + infobulles
function addMarkers(extractCommunaute,recherche){
	if(recherche=="standard"){
		markerList = genererBillets(extractCommunaute,recherche);
			// GENERATION DU BILLET MONTRANT LE NOMBRE DE RESULTATS
		if(markerList.length===0){
			$("#billetCounter_content").html("Aucun lieu trouvé");
		}
		else if(markerList.length==1){
			$("#billetCounter_content").html("1 lieu trouvé" );
		}
		else{
			$("#billetCounter_content").html(markerList.length +" lieux trouvés");
		}
	}
	else{
		communaute = $("#communaute_rechercher_lieu").val();
		nb_jour_calendrier = parseInt($("#nb_jour_calendrier").val());
		//Génération des billets lieux/evenement
		markerList=genererBillets(extractCommunaute,recherche);
		if(markerList.length===0){
			$("#billetCounter_content").html("Aucun évènement trouvé");
		}
		else if(markerList.length==1){
			$("#billetCounter_content").html("1 évènement trouvé" );
		}		
		else{
			$("#billetCounter_content").html(markerList.length +" évènements trouvés");
		}
	}

	// GENERATION DU CERCLE REPRESENTANT 2KM AUTOUR DU POINT
	var research_radius_km = $('#research_radius').val();
	var research_radius_m = research_radius_km*1000;
	var research_outer_radius_m = research_radius_m*Math.sqrt(2);
	$(function(){
		// cercle intérieur
	  circle = new google.maps.Circle({
		strokeColor: "#FF0000",
		strokeOpacity: 0.2,
		strokeWeight: 2,
		fillColor: "#FF0000",
		fillOpacity: 0.01,
		map: map,
		radius: research_radius_m,
	  });
	  circle.bindTo('center', markerList[0], 'position');
		
		// cercle exterieur
	  circle2 = new google.maps.Circle({
		strokeColor: "#FF0000",
		strokeOpacity: 0.1,
		strokeWeight: 2,
		fillOpacity: 0,
		map: map,
		radius: research_outer_radius_m,
	  });
	  circle2.bindTo('center', markerList[0], 'position');
		
		//EVENT CIRCLES = MEME CHOSE QUE CLIQUER SUR LA MAP
		google.maps.event.addListener(circle2, 'click', function() {
			var body = $("#right_panel_resultat");
			body.stop().animate({scrollTop:0}, '100', 'swing');
			//ferme toutes les infoswindows dans gmaps
			infowindow.close();
			//ferme tous les billets et les mets en passif
			$('.active-billet').each(function(){			
				$(this).removeClass('active-billet');
				$(this).addClass('passive-billet');
			});
			$('#box9').attr("value","show");
			$('#box9').click();
			$('#hideall').removeClass('fa-compress');
			$('#hideall').removeClass('fa-expand');
			$('#hideall').addClass('fa-expand');
		});
		
		var handle = $("#custom-handle");

	  $("#slider").slider({
			orientation: "horizontal",
			range: "min",
			max: 20,
			min: 1,
			step: 0.5,
			value: research_radius_km,
			slide: function( event, ui ) {
				handle.text( ui.value );
				var radius_m = ui.value *1000;
				var outer_radius_m = radius_m*Math.sqrt(2);
				updateRadius(circle, radius_m);
				updateRadius(circle2, outer_radius_m);
			},
			create: function() {
				handle.text( $( this ).slider("value"));
			},
		});

		var $handle = $('#slider .ui-slider-handle');
		$handle.mouseup(function () {
			$('#research_radius').val($(this).text());
			$('#btn_rechercher_lieu').trigger('click');
		});

		function updateRadius(circle, rad){
		  circle.setRadius(rad);
		}
	});
	
	$(document).trigger('function_addMarkers_complete'); // Envoie l'autorisation de faire des actions sur les billets
    return markerList;
}