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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
	exit;
}

if (isset($_POST['v-code']))
{
	$vCode = filter($_POST['v-code']);
	$vValue = filter($_POST['v-value']);
	
	if (strlen($vCode) <= 0)
	{
		fMessage('error', 'Entre com um c�digo de Habbo Moedas.');
	}
	else if (!is_numeric($vValue) || intval($vValue) <= 0 || intval($vValue) > 90000)
	{
		fMessage('error', 'Quantidade inv�lida, digite uma quantidade entre 1 - 90000.');
	}
	else
	{
		dbquery("INSERT INTO credit_vouchers (code,value) VALUES ('" . $vCode . "','" . intval($vValue) . "')");
		fMessage('ok', 'Um novo c�digo foi criado. Bom uso !');
	}
}

require_once "top.php";

?>			

<h1>C�digo de Habbo Moedas</h1>

<br />

<p>
	Os c�digos de Habbo Moedas podem ser usados tanto no site como no Hotel. Lembre-se do que est� escrito na p�gina inicial !
</p>

<br />

<p style="font-size: 125%; color: darkred;">
	<b>NOTA:</b> Equipe Habbo, n�o abuse do sistema. Isso lhe acarretar� problemas no hotel. N�o entregue moedas de gra�a, somente se algum membro ganhou em alguma promo��o.</u>
</p>

<br />

<div style="float: left; width: 49%;">

	<h2>C�digos ativados</h2>
	
	<br />

	<table width="100%" border="1">
	<thead>
		<td>C�digo</td>
		<td>Quantidade</td>
	</thead>
	<?php

	$get = dbquery("SELECT code,value FROM credit_vouchers ORDER BY code ASC");

	while ($user = mysql_fetch_assoc($get))
	{
		echo '<tr>';
		echo '<td>' . $user['code'] . '</td>';
		echo '<td>' . $user['value'] . ' moedas</td>';
		echo '</tr>';
	}

	?>
	</table>

</div>

<div style="float: right; width: 49%;">

	<h2>Adicionar novo c�digo</h2>
	
	<br />
	
	<form method="post">
	
		C�digo:<br />
		<input type="text" name="v-code"><br />
		<br />
		Quantidade de moedas:<br />
		<input type="text" name="v-value"><br />
		<br />
		<input type="submit" value="Adicionar">
	</form>

</div>

<div style="clear: both;"></div>

<?php

require_once "bottom.php";

?>