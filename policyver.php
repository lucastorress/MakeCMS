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

define('FOREIGNBUSTER', true);

require_once "global.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	break;
}

if ($users->GetUserVar(USER_ID, 'newbie_status') != "1")
{
	header("Location: /client");
	exit;
}

if (isset($_POST['confirm']))
{
	$confirm = filter($_POST['confirm']);
	
	if ($confirm == 'Eu aceito as normas do Habbo Hotel.')
	{
		dbquery("UPDATE users SET newbie_status = '2' WHERE id = '" . USER_ID . "' LIMIT 1");
		header("Location: /client");
		exit;		
	}
	else
	{
		echo '<script type="text/javascript">alert(\'Desculpa, mais o texto de confirmação que você digitou está incorreto.\');</script>';
	}
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');		
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');

$tpl->AddGeneric('process-template-top');
$tpl->AddGeneric('page-langver');
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Contrato de Responsabilidade');
$tpl->SetParam('body_id', 'popup');

$tpl->Output();

?>