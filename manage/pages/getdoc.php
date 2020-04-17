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

if (!defined('IN_HK') || !IN_HK)
{
	exit;
}

if (!HK_LOGGED_IN)
{
	exit;
}

if (!isset($_GET['doc']))
{
	die("Sem arquivo !");
}

$file = 'docs/' . $_GET['doc'];

if (!file_exists($file))
{
	die("N�o foi poss�vel encontrar o arquivo.");
}

header("Content-type: application/force-download");
header("Content-Transfer-Encoding: Binary");
header("Content-length: " . filesize($file));
header("Content-disposition: attachment; filename = " . basename($file));
readfile($file);

?>