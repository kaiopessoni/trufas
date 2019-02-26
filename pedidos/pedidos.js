var cod_excluir, cod_detalhes, cod_entregue, cod_pago;

$(document).ready(() => {
	
	refresh_pedidos("ultimo_mes");
	
	$("#btn_excluir").click(() => {
		
		var codigo = cod_excluir;
		modal_loading("open");
		
		$.ajax({
			type: "GET",
			url: "/trufas/pedidos/pedidos.php",
			data: "codigo=" + codigo +"&action=excluir&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				modal_loading("close");
				
				if (data.status == "success")
					refresh_pedidos($("#option_filtro").val());

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
			}
		});
		
	}); // end btn_excluir
	
	$("#btn_entregue").click(() => {
		
		var codigo = cod_entregue;
		modal_loading("open");
		
		$.ajax({
			type: "GET",
			url: "/trufas/pedidos/pedidos.php",
			data: "codigo=" + codigo +"&action=entregue&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				modal_loading("close");
				
				if (data.status == "success")
					refresh_pedidos($("#option_filtro").val());

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				spinner_btn("hide", "#btn_adicionar");
			}
		});
		
	}); // end btn_entregue
	
	$("#btn_pago").click(() => {
		
		var codigo = cod_pago;
		modal_loading("open");
		
		$.ajax({
			type: "GET",
			url: "/trufas/pedidos/pedidos.php",
			data: "codigo=" + codigo +"&action=pago&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				modal_loading("close");
				
				if (data.status == "success")
					refresh_pedidos($("#option_filtro").val());

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				spinner_btn("hide", "#btn_adicionar");
			}
		});
		
	}); // end btn_pago
	
	// Filtrar
	$("#option_filtro").change(() => {
		refresh_pedidos($("#option_filtro").val());
	});
	
});

function refresh_pedidos(option) {
	
	spinner_btn("show", "#pedidos");
	
	$.ajax({
	type: "GET",
	url: "/trufas/pedidos/pedidos.php",
	data: "option=" + option +"&action=filtrar&kp=true",
	success: (data) => {

		data = JSON.parse(data);

		var html = "";
		
		if (data.pedidos.length > 0) {
			
			html = '<p class="grey-text center-align">'+ data.pedidos.length +' Pedidos encontrados</p>';
			
			$.each(data.pedidos, (key, value) => {
			
			html += '<div class="card" id="card-$codigo"> \
									<div class="card-content"> \
											\
										<!-- Cabeçalho --> \
										<div class="row"> \
											<div class="col s6 pink-text codigo_pedido">Pedido '+ value.codigo +'</div> \
											<div class="col s6 grey-text right-align '+ value.classe_status +'" id="status-$codigo" style="font-weight: 500;">'+ value.status +'</div> \
										</div> \
										\
										<div class="row"> \
											<div class="col s6 pink-text valign-wrapper"><strong>R$ '+ value.total +'</strong></div> \
											<div class="col s6 grey-text right-align data_pedido">'+ value.data +'</div> \
										</div> \
										 \
										<div class="row comprador grey-text text-darken-2"> \
											<div class="col s7">'+ value.cliente +'</div> \
											<div class="col s5 right-align">'+ value.telefone +'</div> \
										</div> \
										 \
										<!-- Ações do Pedido --> \
										<div class="divider_card"></div> \
										\
										<div class="row botoes valign-wrapper"> \
											<div class="col s3 center"> \
												<a class="modal-trigger" href="#modal_excluir" onclick="btn_excluir(this)" data-codigo="'+ value.codigo +'"> \
													<i class="fas fa-trash-alt red-text"></i> \
												</a> \
											</div> \
											<div class="col s3 center"> \
												<a class="btn_detalhes modal-trigger" href="#modal_detalhes_pedido" onclick="btn_detalhes(this)" data-codigo="'+ value.codigo +'"> \
													<i class="fas fa-eye fa-lg pink-text"></i> \
												</a> \
											</div> \
											<div class="col s3 center"> \
												<a class="modal-trigger" href="#modal_entregue" onclick="btn_entregue(this)" data-codigo="'+ value.codigo +'"> \
													<i class="fas fa-truck entregue"></i> \
												</a> \
											</div> \
											<div class="col s3 center"> \
												<a class="modal-trigger" href="#modal_pago" onclick="btn_pago(this)" data-codigo="'+ value.codigo +'"> \
													<i class="fas fa-check pago"></i> \
												</a> \
											</div> \
										</div> \
									</div> \
								</div>';
			});
			
		} else {
			html = '<p class="center-align">Nenhum pedido cadastrado! <br> Clique <a href="/trufas/adicionar-pedido">aqui</a> para adicionar um pedido.</p>';
		}
		
		$("#pedidos").fadeIn(400).html(html);
		$("#spinner_btn").toggle();
		
		},
		error: () => {
			toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
			spinner_btn("hide", "#pedido");
		}
	});
}

function btn_excluir(element) {
	cod_excluir = $(element).data("codigo");
}			

function btn_detalhes(element) {

	codigo = $(element).data("codigo");
		
	$("#conteudo_detalhes").addClass("hide");
	$("#loading_detalhes").removeClass("hide");

	$.ajax({
		type: "GET",
		url: "/trufas/pedidos/pedidos.php",
		data: "codigo=" + codigo +"&action=detalhes&kp=true",
		success: (data) => {

			data = JSON.parse(data);

			$("#loading_detalhes").addClass("hide");
			$("#conteudo_detalhes").fadeIn(400).removeClass("hide");

			var html = 	'	<div class="row mb-0"> \
											<div class="col s12 grey-text" style="font-size: .85rem;">Feito pelo usuário: '+ data.usuario +'</div> \
										</div> \
										\
										<div class="row mb-0"> \
											<div class="col s6 pink-text codigo_pedido">Pedido '+ data.codigo_pedido +'</div> \
											<div class="col s6 grey-text right-align '+ data.classe_status +'"><strong>'+ data.status_pedido +'</strong></div> \
										</div> \
										\
										<div class="row mb-0"> \
											<div class="col s6 pink-text valign-wrapper codigo_pedido">R$ '+ data.total_pedido +'</div> \
											<div class="col s6 grey-text right-align data_pedido">'+ data.data_pedido +'</div> \
										</div> \
										\
										<div class="row mb-0 comprador grey-text text-darken-2"> \
											<div class="col s7">'+ data.cliente +'</div> \
											<div class="col s5 right-align">'+ data.telefone +'</div> \
										</div> \
										\
										<div class="container"><div class="divider_card"></div></div>';

			$.each(data.itens, (key, value) => {

				html += '	<div class="row item grey-text text-darken-1"> \
										<div class="col s7">&#8226; '+ value.nome +'</div> \
										<div class="col s2">'+ value.quantidade +'x</div> \
										<div class="col s3 right-align">R$ '+ value.preco_praticado +'</div> \
									</div>';
			});

			// Se a sessão foi expirada
			if (data.status == "error") {
				html = '	<div class="row mb-0"> \
										<div class="col s12 grey-text text-darken-2">'+ data.message +'</div> \
									</div>';
			}


			$("#conteudo_detalhes").html(html);

		},
		error: () => {
			toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
			spinner_btn("hide", "#btn_adicionar");
		}
	});
	
}

function btn_entregue(element) {
	cod_entregue = $(element).data("codigo");
}

function btn_pago(element) {
	cod_pago = $(element).data("codigo");
}
