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

exit;

require_once "global.php";

if (!LOGGED_IN || !$users->HasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

$hugeItemList = dbquery("SELECT id FROM room_items");

while ($roomItem = mysql_fetch_assoc($hugeItemList))
{
	$get = dbquery("SELECT user_id,id FROM user_items WHERE id = '" . $roomItem['id'] . "'");
	
	while ($item = mysql_fetch_assoc($get))
	{
		echo 'Duplicate item: ' . $item['id'] . ' - deleting..<br />';
		dbquery("DELETE FROM user_items WHERE id = '" . $item['id'] . "' LIMIT 1");
	}
}

echo 'Completo. O que tinha foi removido.<br />';

?>