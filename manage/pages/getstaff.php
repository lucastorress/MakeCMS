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

if (!HK_LOGGED_IN)
{
	exit;
}

require_once "top.php";

?>			

<h1>Staff listing</h1>

<p>
	Esta página pode mostrar todos os usuários de nossa equipe.
</p>

<br />

<table width="100%" border="1">
<thead>
	<td>Usuário</td>
	<td>Cargo</td>
	<td>E-mail</td>
</thead>
<?php

$get = dbquery("SELECT id,rank,mail FROM users WHERE rank >= 3 ORDER BY rank DESC");

while ($user = mysql_fetch_assoc($get))
{
	echo '<tr>';
	echo '<td>' . $users->formatUsername($user['id']) . '</td>';
	echo '<td>' . $users->getRankName($user['rank']) . '</td>';
	echo '<td><a href="mailto:' . $user['mail'] . '">' . $user['mail'] . '</a></td>';
	echo '</tr>';
}

?>
</table>

<?php

require_once "bottom.php";

?>