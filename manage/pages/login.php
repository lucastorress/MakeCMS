<?php

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (HK_LOGGED_IN)
{
	exit;
}

if (isset($_POST['usr']) && isset($_POST['pwd']))
{
	$username = filter($_POST['usr']);
	$password = $core->uberHash($_POST['pwd']);

	if ($users->validateUser($username, $password))
	{		
		$hkId = $users->name2id($username);
		
		if ($users->hasFuse($hkId, 'fuse_housekeeping_login'))
		{	
			session_destroy();
			session_start();
		
			$_SESSION['UBER_USER_N'] = $users->getUserVar($hkId, 'username');
			$_SESSION['UBER_USER_H'] = $password;
			$_SESSION['UBER_HK_USER_N'] = $_SESSION['UBER_USER_N'];
			$_SESSION['UBER_HK_USER_H'] = $_SESSION['UBER_USER_H'];
			
			header("Location: " . HK_WWW . "/index.php?_cmd=main");
			
			exit;
		}
		else
		{
			$_SESSION['HK_LOGIN_ERROR'] = "Voc� n�o tem permis�o para acessar estes servi�os";
		}
	}		
	else
	{
		$_SESSION['HK_LOGIN_ERROR'] = 'Erro';
	}
}

?>
<html>
<head>
<title>Habbo Hotel ~ Painel de Controle</title>

<style type="text/css">
body
{
	font-family: sans-serif;
	font-size: 75%;
	background: #FFFFFF;
	color: #000;
}

#text
{
	display: block;
	padding-top: 100px;
	padding-bottom: 10px;
	margin: 0 auto;
	text-align: right;
	width: 420px;
}

#loginblock
{
	display: block;
	margin: 10px auto;
	border: 1px solid #000;
	width: 400px;
	padding: 5px 15px 10px 15px;
}

#loginblock .info
{
	padding-bottom: 2px;
	margin-bottom: 5px;
}

input.biginput
{
	width: 100%;
	font-size: 2em;
	text-align: center;
	padding: 3px;
}
</style>

	<style type="text/css">
		body{ color: #000000; font: 13px 'Lucida Grande', Verdana, sans-serif;
                background-image : url(images/bg.png);           }
	</style>

</head>
<body>

<div id="text">

	<img src="<?php echo HK_WWW; ?>/images/lock.png" style="vertical-align: middle;">&nbsp;
	<b>Painel de Controle</b> Login

</div>

<div id="loginblock">

	<div class="info">
				<p>
     Este servi�o destina-se apenas o pessoal e acompanhar de perto, com 24 horas de endere�os IP registros que est�o sendo tomadas. Toda a atividade
est� gravado, e abuso ou acesso n�o autorizado ser� tratada de forma adequada.
				</p>
				
				<p>
     Seu nome de usu�rio e senha para esta �rea s�o pessoais. <i> Nunca </i> dar-lhes a menores
<i> qualquer circunst�ncias</i>.
				</p>

				
				<p>
    Favor fornecer a devida autentica��o para acesso a este servi�o.
				</p>
	</div>

	<form method="post">

		<input type="text" name="usr" class="biginput" value="<?php if (LOGGED_IN) { echo USER_NAME; } ?>"><br />
		<br />
		<input type="password" name="pwd" class="biginput" value=""><br />
		<br />
		<input type="submit" class="biginput" value="Entre">
		<input type="button" onclick="document.location = '/';" class="biginput" value="Me tire daqui">

	</form>
	
	<?php
	
	if (isset($_SESSION['HK_LOGIN_ERROR']))
	{
		echo '<b style="color: darkred;">' . $_SESSION['HK_LOGIN_ERROR'] . '</b>';
		unset($_SESSION['HK_LOGIN_ERROR']);
	}
	
	?>
	
				<?php if (LOGGED_IN) { ?>
				<p>
					Voc� est� logado ao site principal <b><?php echo USER_NAME; ?></b>.
				</p>
				<?php } ?>	
	
</div>

</body>
</html>
