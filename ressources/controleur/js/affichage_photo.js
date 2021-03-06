$(document).ready(function() {
	$(".div-img").each(function(){
		$(this).on('click', function(e) {
			// On appelle notre fonction pour afficher les images
			// currentTarget est utilisé pour cibler le lien et non l'image
			displayImg(e.currentTarget);
		});
	});
});

function displayImg(link) {
    var img = new Image(),
        overlay = document.getElementById('overlay');
    img.addEventListener('load', function() {
        overlay.innerHTML = '';
        overlay.appendChild(img);
    });
    img.src = link.href;
    overlay.style.display = 'block';
    overlay.innerHTML = '<span>Chargement en cours...</span>';
}

document.getElementById('overlay').addEventListener('click', function(e) {
    // currentTarget est utilisé pour cibler l'overlay et non l'image
    e.currentTarget.style.display = 'none';
});