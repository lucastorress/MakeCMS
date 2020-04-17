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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM site_app_openings WHERE id = '" . intval(filter($_GET['doDel'])) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Usu�rio deletado.');
	}
	
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['n-name']) && strlen($_POST['n-name']) >= 1)
{
	dbquery("INSERT INTO site_app_openings (id,name,text_descr,text_reqs,text_duties) VALUES (NULL,'" . filter($_POST['n-name']) . "','" . filter($_POST['n-descr']) . "','" . filter($_POST['n-reqs']) . "','" . filter($_POST['n-duties']) . "')");
	fMessage('ok', 'Usu�rio conclu�do !');
	header("Location: index.php?_cmd=jobopenings");
	exit;
}

if (isset($_POST['edit']) && is_numeric($_POST['edit']))
{
	dbquery("UPDATE site_app_openings SET name = '" . filter($_POST['e-name']) . "', text_descr = '" . filter($_POST['e-descr']) . "', text_reqs = '" . filter($_POST['e-reqs']) . "', text_duties = '" . filter($_POST['e-duties']) . "' WHERE id = '" . intval($_POST['edit']) . "' LIMIT 1");
	fMessage('ok', 'Usu�rios atualizados !');
	header("Location: index.php?_cmd=jobopenings");
	exit;	
}

require_once "top.php";

?>			

<h1>Usu�rios merecedores</h1>

<p>
	Esta � uma ferramenta �nica para aqueles membros que est�o fazendo o bem e contribuindo para o nosso hotel.</p>

<h2>Adicionar novo usu�rio</h2><br />
<form method="post">

Usu�rio:<br />
<input type="text" maxlength="100" name="n-name"><br />
<br />
Descri��o:<br />
<textarea name="n-descr" cols="50" rows="4"></textarea><br />
<br />
No que ele est� ajudando ? Ele sabe mexer em nosso painel ?<br />
<textarea name="n-reqs" cols="50" rows="4"></textarea><br />
<br />
Contato:<br />
<textarea name="n-duties" cols="50" rows="4"></textarea><br />
<br />

<input type="submit" value="Adicionar"><br />

</form>

<br />

<h3>Membros merecedores:</h3>

<?php

$get = dbquery("SELECT * FROM site_app_openings");

while ($opening = mysql_fetch_assoc($get))
{
	echo '<h2>';
	echo '<a href="#"><b style="font-size: 135%;">' . clean($opening['name']) . '</b></a><br />' . clean($opening['text_descr']) . '&nbsp;';
	echo '(<a href="#" onclick="t(\'edit-' . $opening['id'] . '\');">Editar</a>)';
	echo '&nbsp;(<a href="index.php?_cmd=jobopenings&doDel=' . $opening['id'] . '">Remover</a>)';
	
	echo '<div id="edit-' . $opening['id'] . '" style="display: none;">';
	echo '<br /><h3>Editar o usu�rio</h3><br />';
	
	echo '<form method="post">
	<input type="hidden" name="edit" value="' . $opening['id'] . '">
	Usu�rio:<br />
	<input type="text" maxlength="100" name="e-name" value="' . clean($opening['name']) . '"><br />
	<br />
	Descri��o:<br />
	<textarea name="e-descr" cols="50" rows="4">' . clean($opening['text_descr']) . '</textarea><br />
	<br />
	No que ele est� ajudando ? Ele sabe mexer em nosso painel ?<br />
	<textarea name="e-reqs" cols="50" rows="4">' . clean($opening['text_reqs']) . '</textarea><br />
	<br />
	Contato:<br />
	<textarea name="e-duties" cols="50" rows="4">' . clean($opening['text_duties']) . '</textarea><br />
	<br />
	<input type="submit" value="Salvar trocas"><br />
	</form>';
	
	echo '</div>';
	
	echo '</h2>';
}

require_once "bottom.php";

?>