<?php
/*=======================================================================
| MakeCMS - A content management system for Habbo retro based on UberCMS
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' & Lucas Torres (https://github.com/lucastorress)
| http://www.meth0d.org / https://www.sulake.com
| #######################################################################
| This program is free software: you can redistribute it and/or modify
| it under the terms of the GNU General Public License as published by
| the Free Software Foundation, either version 3 of the License, or
| (at your option) any later version.
| #######################################################################
| This program is distributed in the hope that it will be useful,
| but WITHOUT ANY WARRANTY; without even the implied warranty of
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
| GNU General Public License for more details.
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