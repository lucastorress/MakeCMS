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

require_once "global.php";

$cmd = '';

if (isset($_GET['cmd']))
{
	$cmd = $_GET['cmd'];
}

switch (strtolower($cmd))
{
	case 'mytagslist':
	
		if (LOGGED_IN)
		{
			$tpl->Init();
			$taglist = new Template('comp-taglist');
			$taglist->SetParam('habbletmode', true);
			$tpl->AddTemplate($taglist);
			$tpl->Output();
		}
		
		break;
		
	case 'proxy':
	
		$tpl->Init();
		$tagcloud = new Template('habblet-tagcloud');
		$tpl->AddTemplate($tagcloud);
		$tpl->Output();
	
		break;
}
	
?>