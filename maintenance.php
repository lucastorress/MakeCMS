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

// Initial variables
$tpl->SetParam('page_title', 'Manutenção !');

$tpl->Init();
$tpl->AddGeneric('page-maintenance');
$tpl->Output();

?>
