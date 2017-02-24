/* Page d'accueil, recherche principale*/
var autocomplete,wto;
function initAutocomplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('adresse_rechercher_lieu')),
      {  types: ['geocode'],componentRestrictions:{country: 'fr'}}
			);
}

$(document).ready(function() {
	$("#adresse_rechercher_lieu").on('focus',function() {
      initAutocomplete();
  });
});

$(document).ready(function() {
	$("#adresse_rechercher_lieu").on('change',function() {
		  clearTimeout(wto);
			wto = setTimeout(function() {
				$('#btn_rechercher_lieu').click();
			}, 20);

  });
});

/* Nouvel Annonceur*/ 
function initAutocomplete_devenir_annonceur() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('adresse_lieu_devenir_annonceur')),
      {  types: ['geocode'],componentRestrictions:{country: 'fr'}}
			);
}

$(document).ready(function() {
	$("#adresse_lieu_devenir_annonceur").on('focus',function() {
      initAutocomplete_devenir_annonceur();
  });
});

/* Nouvel event */ 
function initAutocomplete_new_event() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {!HTMLInputElement} */(document.getElementById('adresse_lieu_event')),
      {  types: ['geocode'],componentRestrictions:{country: 'fr'}}
			);
}

$(document).ready(function() {
	$("#adresse_lieu_event").on('focus',function() {
      initAutocomplete_new_event();
  });
});
