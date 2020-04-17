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

if (LOGGED_IN)
{
	header("Location: " . WWW . "/client");
	break;
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');		
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');

$tpl->AddGeneric('process-template-top');
$tpl->AddGeneric('page-clientlogin');
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Home');
$tpl->SetParam('body_id', 'popup');

$tpl->Output();

?>