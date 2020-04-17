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

	require_once("global.php");

	if ($_GET['code'] == "139742685")
	{
		$_SESSION['jjp']['login']['name'] = filter($_GET['name']);
		dbquery("UPDATE `users` SET `real_name` = '".$_SESSION['jjp']['login']['name']."' WHERE `mail` = '".$_SESSION['jjp']['login']['email']."'");
		
		print "true";
		exit; 
	}
	
	print "false";
?>