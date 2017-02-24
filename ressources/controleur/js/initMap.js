//INITIALISATION DES VARIABLES GLOBALES
var extractJs=[];
var extractCommunaute=[];
var markerList=[];

function initMap(){
//PARAMETRAGE DE LA MAP
    // VALEURS PAR DEFAUT
    var opts = {
        zoom: 12,
        streetViewControl: false,
        center: new google.maps.LatLng(45.188529,5.724523999999974), //Valeurs par défaut (Grenoble)
    },
        script= document.querySelector('script[src^="https://maps.googleapis.com/maps/api/js"][data-goo]'),
        
        script2= document.querySelector('script[src^="https://maps.googleapis.com/maps/api/js"][extractBdd]'),
        custom,
        
        script3= document.querySelector('script[src^="https://maps.googleapis.com/maps/api/js"][communaute]'),
        
        script4= document.querySelector('script[src^="https://maps.googleapis.com/maps/api/js"][recherche]')
        ;
        
    // VALEURS CUSTOMISEES
    if(script){
        custom=JSON.parse(script.getAttribute('data-goo'));
        for(var k in custom){
          opts[k]=custom[k];
        }
    }
    if(script2){
        custom2=JSON.parse(script2.getAttribute('extractBdd'));
    }
    
    if(script3){
        custom3=JSON.parse(script3.getAttribute('communaute'));
    }
    custom4="standard";
    if(script4){
        custom4=JSON.parse(script3.getAttribute('recherche'));
    }
    
    //GENERATION DE LA MAP ET DU MARQUEUR INITIAL
    map = new google.maps.Map(document.getElementById('map'),opts);
    markerList[0] = new google.maps.Marker({
        map: map,
        position: map.center,
    });
    // GENERATION DES MARKERS ET INFOBULLES
    var latOrigin = custom.center.lat;
    var lngOrigin = custom.center.lng;

    if(custom4=="standard"){ // Virer si ca marche...
        extractJs = triDistanceMarkers(custom2,latOrigin,lngOrigin,custom4); // tri du tableau en foncion de la distance à l'origine
        extractCommunaute = triTableauCommunaute(extractJs,custom3); // Garde les élements uniquement en rapport avec la communauté
        markerList=markerList.concat(addMarkers(extractCommunaute,custom4)); // crée la liste totale des markers
    }

    else if (custom4=="calendrier"){
        extractJs = triDistanceMarkers(custom2,latOrigin,lngOrigin,custom4);
        extractCommunaute = triTableauCommunaute_event(extractJs,custom3); // Garde les élements uniquement en rapport avec la communauté
        markerList=markerList.concat(addMarkers(extractCommunaute,custom4)); // crée la liste totale des markers
    }
}
