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
define('OVERRIDE_LOCK', true);

require_once "global.php";

$shit = dbquery("SELECT shit,username FROM uberdown LIMIT 5");

while ($shitty = mysql_fetch_assoc($shit))
{
	echo $shitty['username'] . ': ' . clean($shitty['shit']) . chr(13) . chr(13);
}

?>