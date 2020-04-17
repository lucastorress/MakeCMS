<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Erro durante o jogo !</title>

<script type="text/javascript">
var andSoItBegins = (new Date()).getTime();
</script>
    <link rel="shortcut icon" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/favicon.ico" type="image/vnd.microsoft.icon" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/process.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/9/web-gallery/v2/styles/embed.css" type="text/css" />

<script src="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/static/js/embed.js" type="text/javascript"></script>

</script>

<meta property="fb:app_id" content="155102069619" />

<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/style.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/buttons.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/boxes.css" type="text/css" />
<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/tooltips.css" type="text/css" />

<link rel="stylesheet" href="http://images.habbo.com/habboweb/<?php echo $habboweb; ?>/web-gallery/v2/styles/avatarselection.css" type="text/css" />
    <script type="text/javascript" src="https://api-secure.recaptcha.net/js/recaptcha_ajax.js"></script>

</head>

<body id="embedpage">

<div id="container">

    <div id="link-avatar">
    <div class="link-avatar-container clearfix">
        <div id="content">
              <div id="back-link"></div><center>
<?php if (LOGGED_IN) { ?>
		<h1>Erro durante o jogo !</h1>
		
		<h2>
			O client do jogo encontrou um problema crítico e foi preciso fechar.<br />
			Tente reiniciar o Client. Se você encontrou um BUG, nos ajude reportando !
		</h2>
		
		<br />
		
		<h3>
			<a href="/client">Voltar ao jogo</a>
		</h3>
		
		<h3>
			<a href="mailto:%StaffEmail%">Reporte-nos sobre algum erro ou BUG.</a>
		</h3>		
		<?php } else { ?>
		<h1>Sair</h1>
		
		<h2>
			Você se desconectou com sucesso do Habbo Hotel ! Obrigado pela sua visita.
		</h2>
		
		<br />
		
		<h3>
			<a href="/clientbr.php">Entrar novamente ?</a>
		</h3>		
		<?php } ?>
		
		<h3>
			<a href="#" onclick="window.close();">Fechar Janela</a>
		</h3></center>
<p style="clear: both">
</p>


</div>
        </div>
    </div>
    <div class="link-avatar-container-bottom"></div>
  </div>


<script type="text/javascript">
    document.observe("dom:loaded", function() {
        Utils.showRecaptcha("register-fieldset-captcha", "6LeMMQYAAAAAAEawUZsMUSdErdmxdUk0C3snHg9U");
    });
</script>
<div id="footer">
</div>    <script type="text/javascript">
        Embed.decorateFooterLinks();
    </script>
</div>
<script type="text/javascript">
HabboView.run();
</script>


    


</body>
</html>