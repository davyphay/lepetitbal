// Fonction de présentation des events dans les billets
function presenterEvent_hebdomadaire(tableauInfo,compteur_billet,type){
        var type_event="";
        var description_event_hebdo="";
        var destination = "inner_right_panel";
        if(type==="cours"){
                type_event="Cours réguliers";
                id_event_hebdo = tableauInfo.id_cours_hebdomadaire;
                description_event_hebdo = tableauInfo.tableDisplay_cours_hebdomadaire;
                event_attribute="id_cours_hebdo";
                bouton_color=" btn-planning";
        }
        else if (type==="soiree"){
                type_event="Pratiques et soirées fréquentes";
                id_event_hebdo = tableauInfo.id_soiree_hebdomadaire;
                description_event_hebdo = tableauInfo.tableDisplay_soiree_hebdomadaire;
                event_attribute="id_soiree_hebdo";
                bouton_color=" btn-planning";
        }
        //creation d'une zone cours_hebdo border
        var paraEvent_hebdo = document.createElement("div");
        paraEvent_hebdo.id=type+"_hebdo_billet"+compteur_billet+destination;
        paraEvent_hebdo.className=type+"_hebdo";
        paraEvent_hebdo.setAttribute(event_attribute,id_event_hebdo);
        var element = document.getElementById("billet_event"+compteur_billet+destination);
        element.appendChild(paraEvent_hebdo);

        //Creation zone caret switch
        var caret_switch = document.createElement("div");
        caret_switch.className ="caret-switch";
        caret_switch.setAttribute("data-toggle","collapse");
        var data_contenu="#description_"+type+"_hebdo"+compteur_billet+destination;
        caret_switch.setAttribute("href",data_contenu);
        paraEvent_hebdo.appendChild(caret_switch);
        
        //Creation icone dropdown
        var zone_icone_dropdown = document.createElement("div");
        zone_icone_dropdown.className = "zone_icone_dropdown";
        caret_switch.appendChild(zone_icone_dropdown);
        var icon_dropdown = document.createElement("i");
        icon_dropdown.className ="fa fa-caret-up fa-2x";
        zone_icone_dropdown.appendChild(icon_dropdown);
        
        //creation bouton
        var paraEvent_hebdo_bouton = document.createElement("div");
        paraEvent_hebdo_bouton.id=type+"_hebdo_billet"+compteur_billet+destination;
        paraEvent_hebdo_bouton.className="btn-xs btn-block"; // TO CHANGE
        paraEvent_hebdo_bouton.className +=bouton_color;

        //creation du text dans le div contenu du bouton
        var contenuDescription_event_hebdo_bouton=type_event;
        var nodeDescription_event_hebdo_bouton = document.createTextNode(contenuDescription_event_hebdo_bouton);
        // rattachement du texte dans le div contenu
        paraEvent_hebdo_bouton.appendChild(nodeDescription_event_hebdo_bouton);
        // rattachement du bouton au caret switch
        caret_switch.appendChild(paraEvent_hebdo_bouton);
        
        //creation du div contenu du bouton
        var paraDescription_event_hebdo = document.createElement("div");
        paraDescription_event_hebdo.id="description_"+type+"_hebdo"+compteur_billet+destination;
        paraDescription_event_hebdo.className="description_event collapse in";
        
        //Mise en place du tableau avec contenu
        var divTable = document.createElement('div');
        divTable.innerHTML = description_event_hebdo;
        paraDescription_event_hebdo.appendChild(divTable);

        //rattachement du div contenu du bouton à la zone
        paraEvent_hebdo.appendChild(paraDescription_event_hebdo);
}
