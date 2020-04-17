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
require_once "inc/class.homes.php";

$qryId = 0;
$userData = null;

if (isset($_GET['qryName']))
{
	$qryId = uberUsers::name2id($_GET['qryName']);
}
else if (isset($_GET['qryId']) && is_numeric($_GET['qryId']))
{
	$qryId = intval($_GET['qryId']);
}

if ($qryId <= 0 || !UberUsers::IdExists($qryId))
{
	require_once "error.php";
	exit;
}

if (LOGGED_IN && $qryId == USER_ID)
{
	define('TAB_ID', 1);
	define('PAGE_ID', 14);
}

if (!HomesManager::HomeExists('user', $qryId))
{
	HomesManager::CreateHome('user', $qryId);
}

$userData = mysql_fetch_assoc(dbquery("SELECT * FROM users WHERE id = '" . $qryId . "' LIMIT 1"));
$homeData = HomesManager::GetHome(HomesManager::GetHomeId('user', $qryId));

$tpl->Init();

$tpl->SetParam('page_title', clean($userData['username']));
$tpl->SetParam('body_id', 'viewmode');

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('default');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-myhabbo');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');

$home = new Template('page-home-test');
$home->SetParam('home_title', clean($userData['username']));
$home->SetParam('homeData', $homeData);
$tpl->AddTemplate($home);

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');
$tpl->Output();

?>