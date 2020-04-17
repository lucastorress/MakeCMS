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

define('IN_MAINTENANCE', true);
define('BAN_PAGE', true);

require_once "global.php";

if (LOGGED_IN)
{
	$core->Mus('signOut', USER_ID);
}

session_destroy();

setcookie('rememberme', 'false', time() - 3600, '/');
setcookie('rememberme_token', '-', time() - 3600, '/');

unset($_COOKIE['rememberme']);
unset($_COOKIE['rememberme_token']);

header("Location: " . WWW . "/account/logout_ok");
exit;

?>