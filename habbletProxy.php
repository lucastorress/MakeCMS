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

$hid = '';

if (isset($_GET['habbletKey']))
{
	$hid = $_GET['habbletKey'];
}

switch (strtolower($hid))
{
	case "credits":
	
		$tpl->Init();
		$credits = new Template('cproxy-credits');
		$tpl->AddTemplate($credits);
		$tpl->Output();
		
		break;
		
	case "news":
	
		$tpl->Init();
		$news = new Template('cproxy-news');
		$tpl->AddTemplate($news);
		$tpl->Output();
		
		break;		
		
	default:
	
		print_r($_GET);
		exit;
}
	
?>