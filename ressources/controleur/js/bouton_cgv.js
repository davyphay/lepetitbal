function confSubmit()
{
    if(!document.getElementById("one").checked)
    { 
		alertify.alert("Veuillez lire et accepter les conditions générales de vente.");
        return false;
    }
}