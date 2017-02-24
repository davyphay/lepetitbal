script= document.querySelector('script[data-id="lieuAnnonceur"][extract_lieuAnnonceur]');
if(script){
	custom=JSON.parse(script.getAttribute('extract_lieuAnnonceur'));
	var extractLieu = JSON.parse("[" + custom + "]");
	genererBillets(extractLieu,"listeLieu");
	genererBoutonsModif("listeLieu");
}