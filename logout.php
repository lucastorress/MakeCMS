<?php
/*=======================================================================
| MakeCMS - Sistema avan�ado de Administra��o de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa � um Free Software aonde voc� pode editar os conte�dos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/

define('IN_MAINTENANCE', true);
define('BAN_PAGE', true);

require_once "global.php";

if (LOGGED_IN)
{
	$core->Mus('signOut', USER_ID);
}

session_destroy();

setcookie('rememberme', 'false', time() - 3600, '/');
setcookie('rememberme_token', '-', time() - 3600, '/');

unset($_COOKIE['rememberme']);
unset($_COOKIE['rememberme_token']);

header("Location: " . WWW . "/account/logout_ok");
exit;

?>