// VERIFICATION DYNAMIQUE
$(document).ready(function () {
    $("input").focus(function () {
        var name = ($(this).prop("name"));
		var info_form="";
        if (name == "password_membre_old") {
            info_form = document.getElementById('password-error-inscription_new');
            info_form.innerHTML = "";
        } else if (name == "password_membre_new") {
            info_form = document.getElementById('password-error-inscription_new');
            info_form.innerHTML = "";
        }
        else if (name == "password_control_old") {
            info_form = document.getElementById('password-error-inscription_new');
            info_form.innerHTML = "";
        }
    });

    $("input").blur(function () {
        var name = ($(this).prop("name"));
        var value = ($(this).prop("value"));
		var texteInfo ="";
		if (name == "password_control_new"){
            if (value) {
                var info_form = document.getElementById("password-error-inscription_new");
                champ1 = document.getElementById("password_membre_new");
                champ2 = document.getElementById("password_control_new");
                var mdp1 = champ1.value;
                var mdp2 = champ2.value;
                if (mdp1 === mdp2) {
                    if (mdp1.length >= 5) {
                        $("#form-group-password_membre_new").removeClass('has-success has-warning has-error');
                        $("#form-group-password_membre_new").addClass('has-success');
                        $("#form-group-password_control_new").removeClass('has-success has-warning has-error');
                        $("#form-group-password_control_new").addClass('has-success');
                    }
					else{
                        texteInfo = "Votre mot de passe doit contenir au moins 5 caractères";
                        info_form.innerHTML =texteInfo; //affichage du message d'erreur
                        $("#form-group-password_membre_new").removeClass('has-success has-warning has-error');
                        $("#form-group-password_membre_new").addClass('has-error');
                        $("#form-group-password_control_new").removeClass('has-success has-warning has-error');
                        $("#form-group-password_control_new").addClass('has-error');
                    }
                }
				else{
                    texteInfo ="Les mots de passes saisis sont différents";
                    info_form.innerHTML = texteInfo; //affichage du message d'erreur
                    $("#form-group-password_membre_new").removeClass('has-success has-warning has-error');
                    $("#form-group-password_membre_new").addClass('has-error');
                    $("#form-group-password_control_new").removeClass('has-success has-warning has-error');
                    $("#form-group-password_control_new").addClass('has-error');
                }
            }
			else{
                $("#form-group-password_membre_new").removeClass('has-success has-warning has-error');
                $("#form-group-password_control_new").removeClass('has-success has-warning has-error');
            }
        }
    });
});

// VERIFICATION FINALE AVANT SUBMIT
function checkMdp_chgt_mdp() {
    champ1 = document.getElementById("password_membre_new");
    champ2 = document.getElementById("password_control_new");
    var mdp1 = champ1.value;
    var mdp2 = champ2.value;
    if (mdp1 !== mdp2) {
        return false;
    } else {
        return true;
    }
}
function check_old_passwd(){
	champ1 = document.getElementById("password_membre_old");
	oldpasswd1 = champ1.value;
	if (!oldpasswd1) {
        return false;
    } else {
        return true;
    }
}

function verifForm_chgt_mdp(f) {
    var info_form_final = document.getElementById('finalcheck-inscription_new');
    info_form_final.innerHTML = "";
	var oldpasswordOk = check_old_passwd();
    var passwordOk = checkMdp_chgt_mdp();
    if (oldpasswordOk && passwordOk) {
        return true;
    } else {
        var texteInfo = "Veuillez remplir correctement tous les champs";
        info_form_final.innerHTML=texteInfo; //affichage du message d'erreur
        return false;
    }
}

