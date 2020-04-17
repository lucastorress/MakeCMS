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

require_once "top.php";

?>			

<div style="margin: 25px;">
<center>
	<b style="font-size: 18px;">P�gina n�o encontrada.</b>
	
	<p>
		A p�gina foi removida ou n�o existe !
	</p>
	
	<p>
		Se voc� encontrou algum bug, por favor, crie um t�pico na �rea de <a href="index.php?_cmd=forum">discu��o</a>.
	</p>
	
</center>
</div>

<?php

require_once "bottom.php";

?>