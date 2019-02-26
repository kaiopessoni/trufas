$(document).ready(() => {
	
	var original_form = $("#form_produto").serialize();
	
	$("#btn_atualizar").click(() => {
		
		spinner_btn("show", "#btn_atualizar");
		
		$.ajax({
			type: "GET",
			url: "./editar-produto.php",
			data: $("#form_produto").serialize() + "&id=" + id_produto +"&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				
				if (data.status == "success") {
					$("#spinner_btn").hide();
					redirect_page("/trufas/produtos");
				} else 
					spinner_btn("hide", "#btn_atualizar");

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				spinner_btn("hide", "#btn_adicionar");
			}
		});
		
	});
	
	$("input").bind("keyup blur", () => {
		if (original_form != $("#form_produto").serialize())
			$("#btn_atualizar").removeClass("disabled");
		else
			$("#btn_atualizar").addClass("disabled");
	});
	
});