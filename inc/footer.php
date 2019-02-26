
<?php 
	
	if (!isset($no_spacer_btn))
		echo '<div id="spacer_btn" style="margin-top: 22%"></div>';

?>

<!-- Scripts -->
<script type="text/javascript" src="/trufas/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="/trufas/js/materialize.min.js"></script>
<script type="text/javascript" src="/trufas/js/main.js"></script>


<!-- Modal Loading -->
<div id="modal_loading" class="modal valign-wrapper center">
	<div class="row">
		<div class="col s12 ">
			<br>
			<div id="spinner_btn" class="preloader-wrapper small active">
				<div class="spinner-layer spinner-pink-only">
					<div class="circle-clipper left">
						<div class="circle"></div>
					</div><div class="gap-patch">
						<div class="circle"></div>
					</div><div class="circle-clipper right">
						<div class="circle"></div>
					</div>
				</div>
			</div>
			<h6 class="pink-text" style="margin-top: .8rem">Carregando...</h6>
		</div>
	</div>
</div>
<!-- FIM Modal Loading -->