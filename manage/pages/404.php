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