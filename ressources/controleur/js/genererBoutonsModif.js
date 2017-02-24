function genererBoutonsModif(destination)
{
	var element= document.getElementById("listeLieu");
	var nbLieux = element.childNodes.length;
	var i=1;
	while(i<=nbLieux){
		//Recup des datas du billet
		var billet = document.getElementById("billet"+i+"listeLieu");
		id_lieu= billet.getAttribute("id_lieu");
		data_lieu=billet.getAttribute("data");

		//creation d'une zone bouton group
        var zoneBouton = document.createElement("div");
        zoneBouton.id="blabla";
        zoneBouton.className="btn-group btn-group-xs btn-group-justified";
		//attachement de la zone au billet dans la listelieu
        var element2 = document.getElementById("billet"+i+destination);
        element2.appendChild(zoneBouton);
		
		var j=1;
		while(j<=3){
			//creation des 3 boutons
			var bouton = document.createElement("a");
			bouton.className="btn btn_modif";
			var contenuBouton="";
			if (j===1){
				bouton.href="#";
				contenuBouton="Ajouter un event au lieu";
				bouton.className+=" disabled";
			}
			else if (j===2){
				bouton.href="indexModifierLieu.php?id_lieu="+id_lieu;
				contenuBouton="Modifier la fiche du lieu";
			}
			else if (j===3){
				
				bouton.href="action/supprimerLieu.php?id_lieu="+id_lieu;
				contenuBouton="Supprimer le lieu";
				bouton.setAttribute("onclick","return confirm('Etes-vous sûr(e) de vouloir supprimer ce lieu?');");
			}
			var nodeContenuBouton = document.createTextNode(contenuBouton);
			// rattachement du texte sur le bouton
			bouton.appendChild(nodeContenuBouton);
			//rattachement du bouton dans la zone bouton
			zoneBouton.appendChild(bouton);
			j++;
		}
		i++;
	}
}
