$(document).ready(() => {
	
	$("#btn_login").click(() => {
		
		spinner_btn("show", "#btn_login");
		
		$.ajax({
			type: "GET",
			url: "./login.php",
			data: $("#form_login").serialize() + "&kp=true",
			success: (data) => {
				
				data = JSON.parse(data);
				
				if (data.status == "success") {
					$("#spinner_btn").hide();
					window.location.href = "/trufas/";
				} else {
					toast(data.status, data.message);
					spinner_btn("hide", "#btn_login");
				}
				
			},
			error: () => {
				toast("error", "Não foi possível enviar a solicitação! <br> Verifique a sua conexão com a internet ou <br> contate o administrador.");
				spinner_btn("hide", "#btn_login");
			}
		});
		
	});
	
});