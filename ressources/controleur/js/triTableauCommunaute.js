//Extrait du tableau extractJs les infos d'une communaute en particulier dans un autre tableau extractCommunaute

function triTableauCommunaute(extractJs,communaute){
    obj = extractJs;
    extractCommunaute=[];
    if(obj!==null && obj !==undefined){
        var nb_ligne_extract_bdd = obj.length;
        var communauteSalsa="";
        var communauteBachata="";
        var communauteKizomba="";
        var communauteRock4T="";
        var communauteRock6T="";
        var communauteSwing="";
        var communauteWCS="";
        var communauteTango="";
        var communauteSalon="";
        var i=0;
        var compteur_communaute = 0;
        while(i<nb_ligne_extract_bdd){
            chaine=obj[i].communaute_lieu;
            communauteSalsa = getCommunauteSalsa(chaine);
            communauteBachata = getCommunauteBachata(chaine);
            communauteKizomba = getCommunauteKizomba(chaine);
            communauteRock4T = getCommunauteRock4T(chaine);
            communauteRock6T = getCommunauteRock6T(chaine);
            communauteSwing = getCommunauteSwing(chaine);
            communauteWCS = getCommunauteWCS(chaine);
            communauteTango = getCommunauteTango(chaine);
            communauteSalon = getCommunauteSalon(chaine);
            for(j=0;j<communaute.length;j++){
                if(communauteSalsa==communaute[j] || communauteBachata==communaute[j] || communauteKizomba==communaute[j] || communauteRock4T==communaute[j] || communauteRock6T==communaute[j] || communauteSwing==communaute[j] || communauteWCS==communaute[j] || communauteTango==communaute[j] || communauteSalon==communaute[j]){
                    extractCommunaute[compteur_communaute]=obj[i];
                    compteur_communaute++;
                    j=communaute.length;
                }
            }
            i++;
        }        
    }
    return extractCommunaute;
}

function triTableauCommunaute_event(extractCalendrier,communaute){
    obj = extractCalendrier;
    extractCommunaute=[];
    if(obj!==null && obj !==undefined){
        var nb_ligne_extractCalendrier = obj.length;
        var communauteSalsa="";
        var communauteBachata="";
        var communauteKizomba="";
        var communauteRock4T="";
        var communauteRock6T="";
        var communauteSwing="";
        var communauteWCS="";
        var communauteTango="";
        var communauteSalon="";
        var i=0;
        var compteur_communaute = 0;
        while(i<nb_ligne_extractCalendrier){ //Pour chaque event, on regarde le style de danse en extractant la chaine en pleine lettre R => Rock
            chaine=obj[i].communaute_evenement;
            communauteSalsa = getCommunauteSalsa(chaine);
            communauteBachata = getCommunauteBachata(chaine);
            communauteKizomba = getCommunauteKizomba(chaine);
            communauteRock4T = getCommunauteRock4T(chaine);
            communauteRock6T = getCommunauteRock6T(chaine);
            communauteSwing = getCommunauteSwing(chaine);
            communauteWCS = getCommunauteWCS(chaine);
            communauteTango = getCommunauteTango(chaine);
            communauteSalon = getCommunauteSalon(chaine);
            // Si le style de danse de l'event correspond à recherche souhaitée on le met dans un array extractCommunaute
            for(j=0;j<communaute.length;j++){
                if(communauteSalsa==communaute[j] || communauteBachata==communaute[j] || communauteKizomba==communaute[j] || communauteRock4T==communaute[j] || communauteRock6T==communaute[j] || communauteSwing==communaute[j] || communauteWCS==communaute[j] || communauteTango==communaute[j] || communauteSalon==communaute[j]){
                    extractCommunaute[compteur_communaute]=obj[i];
                    compteur_communaute++;
                    j=communaute.length;
                }
            }
            i++;
        }
    }
    return extractCommunaute;
}