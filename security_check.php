<?php
/*=======================================================================
| MakeCMS - A content management system for Habbo retro based on UberCMS
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' & Lucas Torres (https://github.com/lucastorress)
| http://www.meth0d.org / https://www.sulake.com
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
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

<p class="btn">Se voc� n�o for redirecionado automaticamente, clique <a href="<?php echo $redirMode; ?>" id="manual_redirect_link">aqui</a>.</p>

</body>
</html>