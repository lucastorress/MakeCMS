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

if (!LOGGED_IN)
{
	header("Location: ./index.html");
	exit;
}

echo '<b>The following users are currently online:</b>';

$getUsers = dbquery("SELECT id FROM users WHERE online = '1' ORDER BY activity_points_lastupdate DESC");

if (mysql_num_rows($getUsers) > 0)
{
	echo '<ul style="margin: 0;">';
	
	while ($u = mysql_fetch_assoc($getUsers))
	{
		echo '<li style="margin-left: 20px;">';
		echo $users->formatUsername($u['id']);
		echo '</li>';
	}
	
	echo '</ul>';
}
else
{
	echo '<br /><br /><i>N�o temos usu�rios onlines agora.</i>';
}

?>