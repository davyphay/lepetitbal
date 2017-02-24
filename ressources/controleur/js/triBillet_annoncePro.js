function annonceSortFunction(a, b){
	if (checkPromotion(a.date_expiration_promotion_lieu) === checkPromotion(b.date_expiration_promotion_lieu)) { 
		return 0;
	}
	else {
		return (a.date_expiration_promotion_lieu > b.date_expiration_promotion_lieu) ? -1 : 1;
	}
}

function checkPromotion(date_str){ // Renvoie 1 si le lieu est promu sinon 0
	var date = new Date(date_str);
	var today = new Date();
	date.setHours(0,0,0,0);
	today.setHours(0,0,0,0);
	if(today<=date){
		return 1;
	}
	else{
		return 0 ;
	}
}