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

$id = '';

if (isset($_GET['id']))
{
	$id = $_GET['id'];
}

switch ($id)
{
	case "external_variables":
	
		echo @file_get_contents("http://hotel-br.habbo.com/gamedata/external?id=external_variables");	
		$get = dbquery("SELECT * FROM external_variables");
		
		while ($ext = mysql_fetch_assoc($get))
		{
			echo clean($ext['skey']) . '=' . clean($ext['sval'], true) . LB;
		}
		
		break;

	case "external_flash_texts":
	
		echo @file_get_contents("http://hotel-br.habbo.com/gamedata/external?id=external_flash_texts");	
		$get = dbquery("SELECT * FROM external_texts");
		
		while ($ext = mysql_fetch_assoc($get))
		{
			echo clean($ext['skey']) . '=' . clean($ext['sval'], true) . LB;
		}
		
		break;
}

?>