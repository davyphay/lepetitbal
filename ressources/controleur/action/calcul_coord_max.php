<?php
	function calcul_coord_max($lat,$lng,$rayon){
		$coefLat = $rayon * 0.0179662 /2; // 1km => 0.0179662/2 sur Grenoble en LATITUDE
		$coefLng = $rayon * 0.0254924 /2; // 1km => 0.0254924/2 sur Grenoble en LONGITUDE
		
		$latMin = $lat - $coefLat;
		$latMax = $lat + $coefLat;
		$lngMin = $lng - $coefLng;
		$lngMax = $lng + $coefLng;
		
		return array($latMin,$latMax,$lngMin,$lngMax);
	}
?>