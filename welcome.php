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

if (!LOGGED_IN || $users->GetUserVar(USER_ID, 'newbie_status') != "0")
{
	header("Location: " . WWW . "/");
	exit;
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/welcome.css', 'stylesheet'));		
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

$welcome = new Template('page-welcome');
$welcome->SetParam('habboLook', $users->GetUserVar(USER_ID, 'look'));
$tpl->AddTemplate($welcome);

$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Seja bem vindo !');

$tpl->Output();

?>