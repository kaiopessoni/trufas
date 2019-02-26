$(document).ready(() => {
	
	$("#btn_adicionar").click(() => {
		
		spinner_btn("show", "#btn_adicionar");
		
		$.ajax({
			type: "GET",
			url: "./adicionar-pedido.php",
			data: $("#form_adicionar_pedido").serialize() + "&ids="+ ids +"&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				toast(data.status, data.message);
				
				if (data.status == "success") {
					$("#spinner_btn").hide();
					reload_page();
				} else 
					spinner_btn("hide", "#btn_adicionar");
				
			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				spinner_btn("hide", "#btn_adicionar");
			}
		});
		
	});
	
});


