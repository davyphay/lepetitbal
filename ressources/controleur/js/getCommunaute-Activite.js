function getCommunauteSalsa(chaine){
	charCommunaute = chaine.charAt(0);
	var communaute ="";
	if(charCommunaute=="S"){
		communaute="Salsa";
	}
	return communaute;
}
function getCommunauteBachata(chaine){
	charCommunaute = chaine.charAt(2);
	var communaute="";
	if(charCommunaute=="B"){
		communaute="Bachata";
	}
	return communaute;
}
function getCommunauteKizomba(chaine){
	charCommunaute = chaine.charAt(4);
	var communaute="";
	if(charCommunaute=="K"){
		communaute="Kizomba";
	}
	return communaute;
}
function getCommunauteRock4T(chaine){
	charCommunaute = chaine.charAt(6);
	var communaute="";
	if(charCommunaute=="4"){
		communaute="Rock 4T";
	}
	return communaute;
}
function getCommunauteRock6T(chaine){
	charCommunaute = chaine.charAt(8);
	var communaute="";
	if(charCommunaute=="6"){
		communaute="Rock 6T";
	}
	return communaute;
}
function getCommunauteSwing(chaine){
	charCommunaute = chaine.charAt(10);
	var communaute="";
	if(charCommunaute=="S"){
		communaute="Swing";
	}
	return communaute;
}
function getCommunauteWCS(chaine){
	charCommunaute = chaine.charAt(12);
	var communaute="";
	if(charCommunaute=="W"){
		communaute="WCS";
	}
	return communaute;
}
function getCommunauteTango(chaine){
	charCommunaute = chaine.charAt(14);
	var communaute="";
	if(charCommunaute=="T"){
		communaute="Tango Argentin";
	}
	return communaute;
}
function getCommunauteSalon(chaine){
	charCommunaute = chaine.charAt(16);
	var communaute="";
	if(charCommunaute=="S"){
		communaute="Salon";
	}
	return communaute;
}

// Pour les activités 
function getActiviteCours(chaine){
	var charActivite = chaine.charAt(0);
	var activiteCours ="";
	if(charActivite=="C"){
		activiteCours="cours";
	}
	return activiteCours;
}

function getActiviteSoiree(chaine){
	var charActivite = chaine.charAt(2);
	var activiteSoiree ="";
	if(charActivite=="S"){
		activiteSoiree="soiree";
	}
	return activiteSoiree;
}