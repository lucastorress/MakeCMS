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
		echo '<script type="text/javascript">alert(\'Desculpa, mais o texto de confirma��o que voc� digitou est� incorreto.\');</script>';
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