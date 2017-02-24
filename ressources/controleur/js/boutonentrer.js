// Appuyer sur le bouton "entrer" après avoir taper un lieu = click sur le bouton

//Boutons espace formulaire annonceur
if(document.getElementById('name')){
    document.getElementById('name').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('proprietaire')){
    document.getElementById('proprietaire').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('adresse')){
    document.getElementById('adresse').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}

if(document.getElementById('commentaire')){
    document.getElementById('commentaire').onkeypress=function(e){
        if(e.keyCode==13){
            document.getElementById('btn').click();
        }
    };
}