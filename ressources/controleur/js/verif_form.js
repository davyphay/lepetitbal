// VERIFICATION DYNAMIQUE
$(document).ready(function () {
    $("input").focus(function () {
        var name = ($(this).prop("name"));
        if (name == "pseudo") {
            var info_form = document.getElementById('username-error-inscription');
            info_form.innerHTML = "";
        } else if (name == "email") {
            var info_form = document.getElementById('email-error-inscription');
            info_form.innerHTML = "";
        } else if (name == "email_lien_mdp") {
            var info_form = document.getElementById('email-error-recuperation');
            info_form.innerHTML = "";
        } else if (name == "password_membre") {
            var info_form = document.getElementById('password-error-inscription');
            info_form.innerHTML = "";
        }
        else if (name == "password_control") {
            var info_form = document.getElementById('password-error-inscription');
            info_form.innerHTML = "";
        }
    });

    $("input").blur(function () {
        var name = ($(this).prop("name"));
        var value = ($(this).prop("value"));
        if (name == "pseudo") {
            if (value) {
                var regEx = /^([a-zA-Z0-9-_]{2,15})$/;
                var info_form = document.getElementById("username-error-inscription");
                //TEST REGEX: PSEUDO NE DOIT PAS CONTENIR DE CARACTERES SPECIAUX ET AVOIR UNE LONGUEUR entre 2 et 15 caractères
                if (regEx.test(value)) {
                    //fonction ajax PSEUDO
                    $.ajax({
                        type: "POST",
                        url: "https://www.lepetitbal.com/ressources/modele/verif_pseudo.php",
                        data: {
                            pseudo: value
                        },
                        success: function (data) {
                            if (!$.trim(data)) {
                                var texteInfo = document.createTextNode("Un compte avec le même pseudo existe déja");
                                info_form.appendChild(texteInfo); //affichage du message d'erreur
                                $("#form-group-username").removeClass('has-success has-warning has-error');
                                $("#form-group-username").addClass('has-error');
                                $('#pseudo_inscription_control').val(0);
                            } else {
                                $("#form-group-username").removeClass('has-success has-warning has-error');
                                $("#form-group-username").addClass('has-success');
                                $('#pseudo_inscription_control').val(1);
                            }
                        }
                    });
                } else {
                    var texteInfo = document.createTextNode("Pseudo incorrect: évitez les caractères spéciaux ni les espaces");
                    info_form.appendChild(texteInfo);
                    $("#form-group-username").removeClass('has-success has-warning has-error');
                    $("#form-group-username").addClass('has-error');
                    $('#pseudo_inscription_control').val(0);
                }
            } else {
                $("#form-group-username").removeClass('has-success has-warning has-error');
            }
        } else if (name == "email") {
            if (value) {
                var info_form = document.getElementById("email-error-inscription");
                var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
                if (regex.test(value)) {
                    //fonction ajax PSEUDO
                    $.ajax({
                        type: "POST",
                        url: "https://www.lepetitbal.com/ressources/modele/verif_email.php",
                        data: {
                            email: value
                        },
                        success: function (data) {
                            if (!$.trim(data)) {
                                var texteInfo = document.createTextNode("Un compte avec la même adresse email existe déja");
                                info_form.appendChild(texteInfo); //affichage du message d'erreur
                                $("#form-group-email").removeClass('has-success has-warning has-error');
                                $("#form-group-email").addClass('has-error');
                                $('#email_inscription_control').val(0);
                            } else {
                                $("#form-group-email").removeClass('has-success has-warning has-error');
                                $("#form-group-email").addClass('has-success');
                                $('#email_inscription_control').val(1);
                            }
                        }
                    });
                } else {
                    var texteInfo = document.createTextNode("Adresse mail incorrecte: vérifiez votre adresse email");
                    info_form.appendChild(texteInfo);
                    $("#form-group-email").removeClass('has-success has-warning has-error');
                    $("#form-group-email").addClass('has-error');
                    $('#email_inscription_control').val(0);
                }
            } else {
                $("#form-group-email").removeClass('has-success has-warning has-error');
            }
        } else if (name =="email_lien_mdp"){
            if (value) {
                var info_form = document.getElementById("email-error-recuperation");
                var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
                if (regex.test(value)) {
                    //fonction ajax PSEUDO
                    $.ajax({
                        type: "POST",
                        url: "https://www.lepetitbal.com/ressources/modele/verif_email.php",
                        data: {
                            email_lien_mdp: value
                        },
                        success: function (data) {
                            if (!$.trim(data)) {
                                var texteInfo = document.createTextNode("L'adresse email indiquée n'est pas utilisé sur notre site.");
                                info_form.appendChild(texteInfo); //affichage du message d'erreur
                                $("#form-mdp-recuperation").removeClass('has-success has-warning has-error');
                                $("#form-mdp-recuperation").addClass('has-error');
                                $('#email_mdp_recup_control').val(0);
                            } else {
                                $("#form-mdp-recuperation").removeClass('has-success has-warning has-error');
                                $("#form-mdp-recuperation").addClass('has-success');
                                $('#email_mdp_recup_control').val(1);
                            }
                        }
                    });
                } else {
                    var texteInfo = document.createTextNode("Adresse mail incorrecte: vérifiez votre adresse email");
                    info_form.appendChild(texteInfo);
                    $("#form-mdp-recuperation").removeClass('has-success has-warning has-error');
                    $("#form-mdp-recuperation").addClass('has-error');
                    $('#email_mdp_recup_control').val(0);
                }
            } else {
                $("form-mdp-recuperation").removeClass('has-success has-warning has-error');
            }
        } else if (name == "password_control") {
            if (value) {
                var info_form = document.getElementById('password-error-inscription');
                champ1 = document.getElementById("password_membre");
                champ2 = document.getElementById("password_control");
                var mdp1 = champ1.value;
                var mdp2 = champ2.value;
                if (mdp1 === mdp2) {
                    if (mdp1.length >= 5) {
                        $("#form-group-password_membre").removeClass('has-success has-warning has-error');
                        $("#form-group-password_membre").addClass('has-success');
                        $("#form-group-password_control").removeClass('has-success has-warning has-error');
                        $("#form-group-password_control").addClass('has-success');
                    } else {
                        var texteInfo = document.createTextNode("Votre mot de passe doit contenir au moins 5 caractères");
                        info_form.appendChild(texteInfo); //affichage du message d'erreur
                        $("#form-group-password_membre").removeClass('has-success has-warning has-error');
                        $("#form-group-password_membre").addClass('has-error');
                        $("#form-group-password_control").removeClass('has-success has-warning has-error');
                        $("#form-group-password_control").addClass('has-error');
                    }
                } else {
                    var texteInfo = document.createTextNode("Les mots de passes saisis sont différents");
                    info_form.appendChild(texteInfo); //affichage du message d'erreur
                    $("#form-group-password_membre").removeClass('has-success has-warning has-error');
                    $("#form-group-password_membre").addClass('has-error');
                    $("#form-group-password_control").removeClass('has-success has-warning has-error');
                    $("#form-group-password_control").addClass('has-error');
                }
            } else {
                $("#form-group-password_membre").removeClass('has-success has-warning has-error');
                $("#form-group-password_control").removeClass('has-success has-warning has-error');
            }
        }
    });
});

// VERIFICATION FINALE AVANT SUBMIT
function verifPseudo(champ) {
    pseudo = champ.value;
    var regEx = /^([a-zA-Z0-9-_]{2,15})$/;
    pseudoVerificator = regEx.test(pseudo);
    if (pseudoVerificator === false) {
        return false;
    } else {
        if($('#pseudo_inscription_control').val() ==1){
            return true;
        }
        else{
            return false;
        }
    }
}

function verifMail(champ) {
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if (!regex.test(champ.value)) {
        return false;
    } else {
        if($('#email_inscription_control').val() ==1){
            return true;
        }
        else{
            return false;
        }
    } 
}

function verifMail_mdp(champ) {
        var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
        if (!regex.test(champ.value)) {
            return false;
        } else {
            if($('#email_mdp_recup_control').val() ==1){
                return true;
            }
            else{
                return false;
            }
        }
}

function checkMdp() {
    champ1 = document.getElementById("password_membre");
    champ2 = document.getElementById("password_control");
    var mdp1 = champ1.value;
    var mdp2 = champ2.value;
    if (mdp1 !== mdp2) {
        return false;
    } else {
        return true;
    }
}

function verifForm(f) {
    var info_form = document.getElementById('finalcheck-inscription');
    info_form.innerHTML = "";
    
    var pseudoOk = verifPseudo(f.pseudo);
    var mailOk = verifMail(f.email);
    var passwordOk = checkMdp();
    if (pseudoOk && mailOk && passwordOk) {
        return true;
    } else {
        var texteInfo = document.createTextNode("Veuillez remplir correctement tous les champs");
        info_form.appendChild(texteInfo); //affichage du message d'erreur
        return false;
    }
}

function verifForm_mdp_recup(f){
    var info_form = document.getElementById('finalcheck-recup_mdp');
    info_form.innerHTML = "";
    var delay=2000; //2second
    setTimeout(function() {
        var mailOk = verifMail_mdp(f.email_lien_mdp);
        if (mailOk) {
            return true;
        } else {
            var texteInfo = document.createTextNode("Veuillez remplir correctement tous les champs");
            info_form.appendChild(texteInfo); //affichage du message d'erreur
            return false;
        }
    }, delay);   
}

