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

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

if (isset($_SESSION['set_cookies']) && $_SESSION['set_cookies'] === true)
{
	setcookie('rememberme', 'true', time() + 2592000, '/');
	setcookie('rememberme_token', USER_HASH, time() + 2592000, '/');
	setcookie('rememberme_name', USER_NAME, time() + 2592000, '/');

	unset($_SESSION['set_cookies']);
}

$redirMode = WWW . '/me';

if (isset($_SESSION['page-redirect']))
{
	$redirMode = $_SESSION['page-redirect'];
	unset($_SESSION['page-redirect']);
}

?>
<html>
<head>
  <title>Redirecionando ...</title>
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <style type="text/css">body { background-color: #e3e3db; text-align: center; font: 11px Verdana, Arial, Helvetica, sans-serif; } a { color: #fc6204; }</style>
</head>
<body>

<script type="text/javascript">window.location.replace('<?php echo $redirMode; ?>');</script><noscript><meta http-equiv="Refresh" content="0;URL=<?php echo $redirMode; ?>"></noscript>

<p class="btn">Se você não for redirecionado automaticamente, clique <a href="<?php echo $redirMode; ?>" id="manual_redirect_link">aqui</a>.</p>

</body>
</html>