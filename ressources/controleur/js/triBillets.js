function triBillets(typetri){
	//RAZ des billets
    for(var i=1;i<markerList.length;i++){
        document.getElementById("billet"+i+"inner_right_panel").outerHTML='';
    }
    
    //RAZ des anciens marqueurs
    function setMapOnAll(map) {
      for (var i = 1; i < markerList.length; i++) {
        markerList[i].setMap(map);
      }
    }
    setMapOnAll(null);
	
	//RAZ des cercles sur la map
    circle.setMap(null);
    circle2.setMap(null);
    
    //RAZ de la liste des markers en gardant le marker de position
    markerInit=markerList[0];
    markerList=[];
    markerList[0]=markerInit;
	
	//Check box filtres full checked + active jours semaines
	$('#cours').prop('checked', true);
	$('#soiree').prop('checked', true);
	$('#box_jour_lundi').switchClass('box-unactive','box-active');
	$('#box_jour_mardi').switchClass('box-unactive','box-active');
	$('#box_jour_mercredi').switchClass('box-unactive','box-active');
	$('#box_jour_jeudi').switchClass('box-unactive','box-active');
	$('#box_jour_vendredi').switchClass('box-unactive','box-active');
	$('#box_jour_samedi').switchClass('box-unactive','box-active');
	$('#box_jour_dimanche').switchClass('box-unactive','box-active');

	// Reconstitution du tableau a partir de l'extractCommunaute (tous les lieux de la communaute del a recherche précedente) + TRI du tableau en fonction du critère
	extractCommunaute = triTableau(extractCommunaute,typetri.value);
	var recherche="standard";
	markerList=markerList.concat(addMarkers(extractCommunaute,recherche));
}

function triTableau(extract,type){
	if (type=="Distance"){
		extract.sort(distanceSortFunction);
		extract.sort(annonceSortFunction);
		return(extract);
	}
	else if (type == "Nom A-Z"){
		extract.sort(nomSortFunctionAZ);

		extract.sort(annonceSortFunction);
		return(extract);
	}
	else if (type == "Nom Z-A"){
		extract.sort(nomSortFunctionZA);

		extract.sort(annonceSortFunction);
		return(extract);
	}
	else if (type == "Points"){
		// TRI DU TABLEAU EN FONCTION DES POINTS DECROISSANTS
		extract.sort(pointsSortFunction);
		extract.sort(annonceSortFunction);
		return (extract);
	}
}
/*
function distanceSortFunction(a, b) {
	if (parseInt(a[19]) === parseInt(b[19])) {   // 19: extractJs[19]=> distance entre le point d'origine et le marqueur
		return 0;
	}
	else {
		return (parseInt(a[19]) < parseInt(b[19])) ? -1 : 1;
	}
}*/
function distanceSortFunction(a, b) {
	aFloat = parseFloat(a.distance).toFixed(2);
	bFloat = parseFloat(b.distance).toFixed(2);
	if (aFloat == bFloat){   // 19: extractJs[19]=> distance entre le point d'origine et le marqueur
		return 0;
	}
	else{
		return (aFloat < bFloat) ? -1 : 1;
	}
}
/*
function nomSortFunctionAZ(a, b){
	var nameA = a[1].toUpperCase(); // ignore upper and lowercase
	var nameB = b[1].toUpperCase(); // ignore upper and lowercase
	if (nameA === nameB) {   // 1: extractJs[1]=> nom du lieu
		return 0;
	}
	else {
		return (a[1] < b[1]) ? -1 : 1;
	}
}*/
function nomSortFunctionAZ(a, b){
		return a.nom_lieu.toUpperCase().localeCompare(b.nom_lieu.toUpperCase());
}
/*
function nomSortFunctionZA(a, b){
	var nameA = a[1].toUpperCase(); // ignore upper and lowercase
	var nameB = b[1].toUpperCase(); // ignore upper and lowercase
	if (nameA  === nameB) {   // 1: extractJs[1]=> nom du lieu
		return 0;
	}
	else {
		return (nameA  > nameB) ? -1 : 1;
	}
}	*/
function nomSortFunctionZA(a, b){
	return b.nom_lieu.toUpperCase().localeCompare(a.nom_lieu.toUpperCase());
}

function pointsSortFunction(a, b){
	if (parseInt(a.upvote_lieu) === parseInt(b.upvote_lieu)) {   // 14: extractCommunaute[28]=> nombre de upvote
		return 0;
	}
	else {
		return (parseInt(a.upvote_lieu) > parseInt(b.upvote_lieu)) ? -1 : 1;
	}
}
