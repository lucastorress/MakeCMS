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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

$ip = '';

if (isset($_POST['ip'])) { $ip = filter($_POST['ip']); }

require_once "top.php";			

echo '<h1>Ferramenta de IP / Checar Clone</h1>
<br /><p>Esta ferramenta pode mostrar os usuários que têm mais de uma conta em nosso hotel e também pode mostrar o ip do usuário caso queira bani-lo permanente. <b>Pedimos para que veja o usuário primeiro em seguida o seu IP</b>.</p>';

echo '<br />
<form method="post">
Usuário:<br />
<input type="text" name="user"><Br />
<input type="submit" value="Visualizar">
</form>';

echo '<br />
<form method="post">
Endereço de IP:<br />
<input type="text" name="ip"><Br />
<input type="submit" value="Visualizar">
</form>';

if (isset($_POST['user']))
{
	$user = filter($_POST['user']);
	$get = dbquery("SELECT ip_last FROM users WHERE username = '" . $user . "' LIMIT 1");
	
	if (mysql_num_rows($get) > 0)
	{
		$ip = mysql_result($get, 0);
	}
	
	echo '<h2>' . $user . '\'s tem o IP <br /><b style="font-size: 150%;">' . $ip . '</b></h2>';
}

if (isset($ip) && strlen($ip) > 0)
{
	echo '<h2 style="font-size: 140%;">Usuários com o mesmo IP: ' . $ip . '</h2>';
	$get = dbquery("SELECT * FROM users WHERE ip_last = '" . $ip . "' LIMIT 50");
	
	while ($user = mysql_fetch_assoc($get))
	{
		echo '<h2 style="width: 50%;"><B>' . clean($user['username']) . '</B> <Small>(ID: ' . $user['id'] . ')</small><br /><span style="font-weight: normal;">Ultima visita: ' . $user['last_online'] . '<br />E-mail: ' . $user['mail'] . '<br />This user is <b>' . (($user['online'] == "1") ? 'online!' : 'offline') . '</b></span></h2>';
	}
}

require_once "bottom.php";

?>