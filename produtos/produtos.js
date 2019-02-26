var id_excluir, id_editar;

$(document).ready(() => {
	
	$("#btn_excluir").click(() => {
		
		modal_loading("open");
		
		$.ajax({
			type: "GET",
			url: "./produtos.php",
			data: "&id="+ id_excluir +"&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				modal_loading("close");
				
				if (data.status == "success") {
					$("#card-" + id_excluir).fadeOut(300, () => {
						$(this).remove();
					});
				}
				
			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
			}
		});
		
	});
	
});

function btn_excluir(id) {
	id_excluir = id;
}			

function btn_editar(id) {
	id_editar = id;
}