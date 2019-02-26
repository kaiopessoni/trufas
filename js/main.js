$(document).ready(() => {
	
	/*** Initializations ***/
	
	$('.fixed-action-btn').floatingActionButton({
		hoverEnabled: false
	});
	$('.tooltipped').tooltip();
	$('.modal').modal();
	$('select').formSelect();
	$('.collapsible').collapsible();
	
	
	/*** Options ***/
	
	// Modal detalhes do pedido
	$("#modal_detalhes_pedido").modal({
		opacity: 0.7,
		endingTop: "22%"
	});
	
	// Modal de confirmação
	$(".confirm").modal({
		opacity: 0.8,
		endingTop: "35%"
	});
	
	// Modal de confirmação
	$("#modal_loading").modal({
		opacity: 0.6,
		endingTop: "35%",
		dismissible: false
	});
	
	
});

/*** Functions ***/

function toast(status, message, time) {

	time = time || 2500;
	var color;
	
	switch (status) {
		case "success":
			color = "green";
			break;
		case "error":
			time = 4000;
			color = "red";
			break;
		default:
			color = "pink";
	}
	
	M.toast({
		html: "<span style='font-weight: 400'>" + message + "</span>", 
		classes: color,
		displayLength: time
	});
}

function spinner_btn(action, id) {
	
	// Spinner deve vir com display none
	
	if (action == "show") {
		// Esconde o botão e mostra o spinner
		$(id).toggle();
		$("#spinner_btn").toggle();
	} else if (action == "hide") {
		// Esconde o spinner e mostra o botão
		$("#spinner_btn").toggle();
		$(id).toggle();
	}
	
}

function modal_loading(action) {
	
	if (action == "open")
		$("#modal_loading").modal("open");
	else if (action == "close")
		$("#modal_loading").modal("close");
}


function redirect_page(url) {
	setTimeout(() => {
		window.location.href = url;
	},2500);
}

function reload_page(time) {
	
	time = time || 2500;
	
	setTimeout(() => {
		location.reload();
	}, time);
}

function reset_form(id) {
	$(id)[0].reset();
}