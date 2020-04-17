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

define('TAB_ID', 1);
define('PAGE_ID', 4);

require_once "global.php";
require_once "inc/class.mutant.php";

if (!LOGGED_IN)
{
	header("Location: " . WWW . "/");
	exit;
}

// Initialize template system
$tpl->Init();

// Initial variables
$tpl->SetParam('page_title', 'Suas Prefer�ncias');
$tpl->SetParam('body_id', 'profile');

// Generate page header
$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/settings.js'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/settings.css', 'stylesheet'));
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/friendmanagement.css', 'stylesheet'));
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');

// Generate generic top/navigation/login box
$tpl->AddGeneric('generic-top');

// Navigation
$settingsNavi = new Template('comp-settings-navi');
$tpl->AddTemplate($settingsNavi);

// Content
$updateResult = 0;

$settingsEditor = new Template('meusdetalhes');
$settingsEditor->SetParam('userH', $userH);
$settingsEditor->SetParam('updateResult', $updateResult);
$tpl->AddTemplate($settingsEditor);

// Footer
$tpl->AddGeneric('footer');

// Output the page
$tpl->Output();

?>