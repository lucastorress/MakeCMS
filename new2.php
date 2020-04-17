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

exit;

require_once "global.php";

if (!LOGGED_IN || !$users->HasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$hugeItemList = dbquery("SELECT id FROM room_items");

while ($roomItem = mysql_fetch_assoc($hugeItemList))
{
	$get = dbquery("SELECT user_id,id FROM user_items WHERE id = '" . $roomItem['id'] . "'");
	
	while ($item = mysql_fetch_assoc($get))
	{
		echo 'Duplicate item: ' . $item['id'] . ' - deleting..<br />';
		dbquery("DELETE FROM user_items WHERE id = '" . $item['id'] . "' LIMIT 1");
	}
}

echo 'Completo. O que tinha foi removido.<br />';

?>