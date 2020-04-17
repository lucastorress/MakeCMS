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

require_once "global.php";	

if (!defined('FORCE_MAINTENANCE') || !FORCE_MAINTENANCE)
{
	header("Location: " . WWW . "/");
	exit;
}
else if (LOGGED_IN && $users->HasFuse(USER_ID, 'fuse_ignore_maintenance'))
{
	header("Location: " . WWW . "/");
	exit;
}

$tpl->Init();
$tpl->AddGeneric('page-twitter');
$tpl->Output();

?>