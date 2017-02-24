function triDistanceMarkers (bdd,$latOrigin,$lngOrigin,type_recherche){
    
    // GENERATION DES MARKERS + INFOBULLES + BILLETS
    var extract = bdd;
    
    // FONCTION GET_DISTANCE
    Math.radians = function(degrees) {
      return degrees * Math.PI / 180;
    };
    
    function get_distance_km($lat1, $lng1, $lat2, $lng2){
        $earth_radius = 6378137;   // Terre = sphère de 6378km de rayon
        $rlo1 = Math.radians($lng1);
        $rla1 = Math.radians($lat1);
        $rlo2 = Math.radians($lng2);
        $rla2 = Math.radians($lat2);
        $dlo = ($rlo2 - $rlo1) / 2;
        $dla = ($rla2 - $rla1) / 2;
        $a = (Math.sin($dla) * Math.sin($dla)) + Math.cos($rla1) * Math.cos($rla2) * (Math.sin($dlo) * Math.sin($dlo));
        $d = 2 * Math.atan2(Math.sqrt($a), Math.sqrt(1 - $a));
        $arrondi = ($earth_radius * $d /10);
        $arrondi = Math.round($arrondi/10);
        $arrondi = $arrondi /10; // arrondi en km
        return ($arrondi);
    }
    
    // TRI DU TABLEAU
    function distanceSortFunction(a, b) {
        if (a.distance === b.distance) {
            return 0;
        }
        else {
            return (a.distance < b.distance) ? -1 : 1;
        }
    }  
    
    // AJOUT DE LA DISTANCE AU POINT DANS LE TABLEAU
    if(extract!==null){
        var i=0,li=extract.length;
        while(i<li){
            var $latMarker,$lngMarker="";
            $latMarker =extract[i].latitude_lieu;
            $lngMarker = extract[i].longitude_lieu;
            extract[i].distance = get_distance_km($latOrigin,$lngOrigin,$latMarker,$lngMarker);
            i++;
        }
    
        //EN FONCTION DE LA DISTANCE
        if(type_recherche=="standard"){
            extract.sort(distanceSortFunction);
    
        // EN FONCTION SI ANNONCE PRO OU PAS autre fichier JS
        extract.sort(annonceSortFunction);
        }
        return (extract);
    }
}