<?php
/*=======================================================================
| MakeCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/

require_once "global.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=utf-8" /> 
<title>Habbo - Desconectado</title> 
<style type="text/css">
body
{
	background-color: #fff;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	color: rgb(65, 65, 66);	
	margin: auto;
	padding-top: 50px;
}

#container
{
	margin: 10px;
	padding: 10px;
	vertical-align: middle;
}

a, a:visited, a:hover, a:active
{
	color: blue;
	text-decoration: none;
	border-bottom: 1px dotted;
}

a:hover
{
	border-bottom: 1px solid;
}

h1
{
	font-size: 300%;
}
</style>
</head>
<body>

<div id="container">
<table width="100%" height="100%">
<tr>
	<td valign="middle" style="text-align: center;">
		<img src="<?php echo WWW; ?>/images/sadface.png">
	</td>
	<td valign="middle" style="float: right; padding: 25px;">
		
		<?php if (LOGGED_IN) { ?>
		<h1>Disconnected!</h1>
		
		<h2>
			Parece que você foi desconectado do Hotel.
		</h2>
		
		<br />
		
		<h3>
			<a href="<?php echo WWW; ?>/client">Retornar ao jogo</a>
		</h3>
		
		<h3>
			<a href="mailto:admin@habborool.net">Reportar algum erro ou BUG</a>
		</h3>		
		<?php } else { ?>
		<h1>Sair</h1>
		
		<h2>
			Você saiu com sucesso do Habbo Hotel ! Obrigado pela sua visita.
		</h2>
		
		<br />
		
		<h3>
			<a href="<?php echo WWW; ?>/client">Entrar novamente ?</a>
		</h3>		
		<?php } ?>
		
		<h3>
			<a href="#" onclick="window.close();">Fechar Janela</a>
		</h3>		
		
	</td>
</tr>
</div>
	
</body> 
</html>