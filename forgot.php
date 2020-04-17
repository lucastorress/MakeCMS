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

if (LOGGED_IN)
{
	header("Location: " . WWW . "/me");
	exit;
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('process-template-top');
$tpl->Write('<p>Desculpe, mas a recupera��o de conta n�o � poss�vel neste momento. Por favor, volte mais tarde.</p>');
$tpl->Write('<p>Voc� pode optar pelo manual - Clicando <a href="mailto:%StaffEmail%">aqui</a></p>');
$tpl->AddGeneric('process-template-bottom');
$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Home');

$tpl->Output();

?>