<?php
/*=======================================================================
| UberCMS - Advanced Website and Content Management System for uberEmu
| #######################################################################
| Copyright (c) 2010, Roy 'Meth0d' and updates by Matthew 'MDK'
| http://www.meth0d.org & http://www.sulake.biz
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

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$popClient = '';

if (isset($_POST['username']))
{
	$username = filter($_POST['username']);
	$get = dbquery("SELECT id FROM users WHERE username = '" . $username . "' LIMIT 1");
	
	if (mysql_num_rows($get) == 1)
	{
		$id = intval(mysql_result($get, 0));
		$ticket = $core->GenerateTicket();
		
		dbquery("UPDATE users SET auth_ticket = '" . $ticket . "' WHERE id = '" . $id . "' LIMIT 1");
		$core->Mus('signOut', $id);
		$popClient = $ticket;
		
		fMessage('ok', 'Criando SSO TICKET.');
	}
	else
	{
		fMessage('error', 'Não foi possível encontrar o usuário.');
	}
}

require_once "top.php";			

echo '<h1>Login external</h1>';

if ($popClient != '')
{
	echo "<input type=\"button\" onclick=\"popSsoClient('" . $popClient . "'); window.location = 'index.php?_cmd=extsignon'\" value=\"SSO TICKET criado. Você está conectado como " . $username . "\" style=\"margin: 20px; font-size: 150%;\">";
	echo '<input type="button" value="Voltar" onclick="window.location = \'index.php?_cmd=extsignon\';">';
}
else
{
	echo '<br /><p>Esta ferramenta, possibilita entrar em outras contas e visualizar se ela tem uma quantia a mais de moedas. Também funciona para ajudar membros que estão tendo problemas.</p><br />';
	echo '<form method="post">
	Usuário: <input type="text" name="username" value=""><input type="submit" value="Entrar">
	</form>';
}

require_once "bottom.php";

?>