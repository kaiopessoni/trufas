$(document).ready(() => {
	
	
	$("#select_action").change(() => {
		show_hide_div($("#select_action").val())
	});
	
	/*** Atualizar Perfil ***/
	$("#usuario").bind('keyup blur', () => {
		enable_btn_atualizar();
	});
	
	$("#senha").bind('keyup blur', () => {
		enable_btn_atualizar();
	});
	
	$("#btn_atualizar").click(() => {
		
		$("#btn_atualizar").toggle();
		$("#spinner_atualizar").toggle();
		
		$.ajax({
			type: "GET",
			url: "./perfil.php",
			data: $("#form_atualizar").serialize() + "&action=atualizar&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				
				if (data.status == "success") {
					$("#senha").val("");
					atualiza_usuarios();
				}
					
				$("#spinner_atualizar").toggle();
				$("#btn_atualizar").toggle();

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				$("#spinner_atualizar").toggle();
				$("#btn_atualizar").toggle();
			}
		});
		
	});
	
	/*** Adicionar Usuário ***/
	$("#btn_adicionar").click(() => {
		
		$("#btn_adicionar").toggle();
		$("#spinner_adicionar").toggle();
		
		$.ajax({
			type: "GET",
			url: "./perfil.php",
			data: $("#form_adicionar").serialize() + "&action=adicionar&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				
				if (data.status == "success") {
					reset_form("#form_adicionar");
					atualiza_usuarios();
				}
				
				$("#spinner_adicionar").toggle();
				$("#btn_adicionar").toggle();

			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				$("#spinner_adicionar").toggle();
				$("#btn_adicionar").toggle();
			}
		});
		
	});
	

	/*** Remover Usuário ***/
	
	$("#btn_remover").click(() => {
		
		$("#btn_remover").toggle();
		$("#spinner_remover").toggle();
		
		$.ajax({
			type: "GET",
			url: "./perfil.php",
			data: $("#form_remover").serialize() + "&action=remover&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				toast(data.status, data.message);
				
				if (data.status == "success") {
					reset_form("#form_remover");
					atualiza_usuarios();
				}

				$("#spinner_remover").toggle();
				$("#btn_remover").toggle();
				
			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				$("#spinner_remover").toggle();
				$("#btn_remover").toggle();
			}
		});
		
	});
	
});

function atualiza_usuarios() {
	
	$.ajax({
			type: "GET",
			url: "./perfil.php",
			data: "action=lista&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				if (data.status == "success") {
					
					var html = "";
					var length =  data.usuarios.length;
					
					if (length > 0) {
						for (i = 0; i < length; i++) {
							html += "<tr><td>"+ data.usuarios[i] +"</td></tr>";
						}
					} else
						html = "<tr><td>Nenhum usuário cadastrado!</td></tr>";
					
					$("#lista_usuarios").html(html);
					
				}
				
			},
			error: () => {
				toast("error", "Não foi possível atualizar a lista de usuários! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
			}
		});
	
}

function show_hide_div(value) {
	
	if (value == 1) {
		
		$("#div_adicionar").hide();
		$("#div_remover").hide();
		$("#div_editar").fadeIn(450).show();
		
	} else if (value == 2) {
		
		$("#div_editar").hide();
		$("#div_remover").hide();
		$("#div_adicionar").fadeIn(450).show();

	} else if (value == 3) {
		
		atualiza_usuarios();
		$("#div_editar").hide();
		$("#div_adicionar").hide();
		$("#div_remover").fadeIn(450).show();
		
	}
	
}

function enable_btn_atualizar() {
	if (original_user != $("#usuario").val() || $("#senha").val() != "")
		$("#btn_atualizar").removeClass("disabled");
	else
		$("#btn_atualizar").addClass("disabled");
}