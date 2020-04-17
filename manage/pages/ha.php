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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_admin'))
{
	exit;
}

if (isset($_POST['hatext']))
{
	fMessage('ok', 'Mensagem enviada:<br />"' . clean($_POST['hatext']) . '"');
	$core->Mus('ha', clean($_POST['hatext']));
}

require_once "top.php";

?>			

<h1>Hotel Alert</h1>

<br />

<p>
	Essa ferramenta pode avisar o hotel inteiro. Use com cuidado. <i>Uma mensagem seguida da outra, pode trazer erros para o hotel.</i>
</p>

<br />

<p>
<?php if (isset($_POST['hatext'])) { ?>
<h1 style="padding: 15px;">Mensagem enviada <span style="border: 2px dotted gray; padding: 10px; margin: 5px; font-size: 70%; font-weight: normal;"><?php echo clean($_POST['hatext']); ?></span><input type="button" value="Enviar nova mensagem ?" onclick="document.location = 'index.php?_cmd=ha';"></h1>
<?php } else { ?>
<form method="post">

<textarea name="hatext" cols="30" rows="3"></textarea>
<input type="submit" value="Enviar">

</form>
</p>
<?php
}

require_once "bottom.php";

?>