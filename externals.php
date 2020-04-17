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

$id = '';

if (isset($_GET['id']))
{
	$id = $_GET['id'];
}

switch ($id)
{
	case "external_variables":
	
		echo @file_get_contents("http://hotel-br.habbo.com/gamedata/external?id=external_variables");	
		$get = dbquery("SELECT * FROM external_variables");
		
		while ($ext = mysql_fetch_assoc($get))
		{
			echo clean($ext['skey']) . '=' . clean($ext['sval'], true) . LB;
		}
		
		break;

	case "external_flash_texts":
	
		echo @file_get_contents("http://hotel-br.habbo.com/gamedata/external?id=external_flash_texts");	
		$get = dbquery("SELECT * FROM external_texts");
		
		while ($ext = mysql_fetch_assoc($get))
		{
			echo clean($ext['skey']) . '=' . clean($ext['sval'], true) . LB;
		}
		
		break;
}

?>