
function afficherPourEtudiant(){
	$(".eleve").css("display", "block");
	$(".eleveInput").prop('required',true);
}
function enleverPourEtudiant(){
	$(".eleve").css("display", "none");
	$(".eleveInput").prop('required', false);
}

function afficherPourEnseignant(){
	$(".enseignant").css("display", "block");
	$(".enseignantInput").prop('required',true);
}
function enleverPourEnseignant(){
	$(".enseignant").css("display", "none");
	$(".enseignantInput").prop('required',false);
}

//fonctions pour afficher le menu
var menuIsOpen = false;
function openNav() {
	$("#mySidenav").css('width',"30%");
	var login = $("#login");
	if(login != null)
		login.focus();
	menuIsOpen = true;
}

function closeNav() {
	$("#mySidenav").css('width',"0");
	menuIsOpen = false;
}

document.onkeydown = checkKey;
function checkKey(e) {
	e = e || window.event;
	if (e.keyCode == '27') { // keycode pour esc
		if(menuIsOpen)
			closeNav();
		else
			openNav();
	}
}

//fonction pour bloquer un champ de texte (groupe/Td)
function SupprimerPourTD(){
	$(".groupe").css('background', '#fff').prop('required', true);
	$(".td").css('background', '#ddd').prop('required',false).val('');
}
function SupprimerPourGroupe(){
	$(".td").css('background', '#fff').prop('required', true);
	$(".groupe").css('background', '#ddd').prop('required',false).val('');
}

var pourToute = false;
function pourToutePromo(){
	if(!pourToute){
		$(".groupe").prop('disabled', true).prop('required', false).css('background','#ddd');
		$(".td").prop('disabled', true).prop('required', false).css('background','#ddd');
	} else {
		$(".groupe").prop('disabled', false).prop('required', true).css('background','#fff');
		$(".td").prop('disabled', false).css('background','#fff');
	}
	pourToute = !pourToute;
}

function disabledChamps(){
	var selectedValue = $("#inputPromo option:selected").val();
	if(selectedValue=="tous"){
		$(".groupe").prop('disabled', true).prop('required', false).css('background','#ddd');
		$(".td").prop('disabled', true).prop('required', false).css('background','#ddd');
		$(".allprom").css('display', 'none');
	} else {
		if(!pourToute){
			$(".groupe").prop('disabled', false).prop('required', true).css('background','#fff');
			$(".td").prop('disabled', false).css('background','#fff');
		}
		$(".allprom").css('display','contents');
	}
}
