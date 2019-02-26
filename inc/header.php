<?php date_default_timezone_set('America/Sao_Paulo');?>

<header>
	<nav class="pink">
    <div class="nav-wrapper">
      <a class="brand-logo center" style="font-size: 1.5rem"><?php echo $title;?></a>
    </div>
  </nav>
</header>


<div class="fixed-action-btn">
	<a class="btn-floating btn-large pink">
		<i class="fas fa-bars"></i>
	</a>
	<ul>
		<li>
			<a href="/trufas/login/logout.php" class="btn-floating red"><i class="material-icons">exit_to_app</i></a>
		</li>
		<li>
			<a href="/trufas/ajuda" class="btn-floating green"><i class="material-icons">help_outline</i></a>
		</li>
		<li>
			<a href="/trufas/perfil" class="btn-floating blue darken-3"><i class="material-icons">person</i></a>
		</li>
		<li>
			<a href="/trufas/adicionar-produto" class="btn-floating teal"><i class="material-icons">add_shopping_cart</i></a>
		</li>
		<li>
			<a href="/trufas/produtos" class="btn-floating teal"><i class="material-icons">card_giftcard</i></a>
		</li>
		<li>
			<a href="/trufas" class="btn-floating pink"><i class="material-icons">view_list</i></a>
		</li>
		<li>
			<a href="/trufas/adicionar-pedido" class="btn-floating pink"><i class="material-icons">add</i></a>
		</li>
	</ul>
</div>