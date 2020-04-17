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

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_sitemanagement'))
{
	exit;
}

if (isset($_GET['doDel']) && is_numeric($_GET['doDel']))
{
	dbquery("DELETE FROM site_news WHERE id = '" . intval($_GET['doDel']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Notícia deletada.');
	}
	
	header("Location: index.php?_cmd=news&deleteOK");
	exit;
}

if (isset($_GET['doBump']) && is_numeric($_GET['doBump']))
{
	dbquery("UPDATE site_news SET datestr = '" . date('d-M-Y') . "', timestamp = '" . time() . "' WHERE id = '" . intval($_GET['doBump']) . "' LIMIT 1"); 
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Notícia atualizada.');
	}
	
	header("Location: index.php?_cmd=news&bumpOK");
	exit;
}

require_once "top.php";

?>			

<h1>Manage News</h1>

<br />

<p>
	Está página administra as notícias. As notícias que estão com o fundo desta <span style="background-color: #008000; padding: 2px;">cor</span>, estão ativadas e pode ser visualizadas no site principal.
</p>

<br />

<p>
	<a href="index.php?_cmd=newspublish">
		<b>
			Escrever nova notícia
		</b>
	</a>
</p>

<br />

<table border="1" width="100%">
<thead>
<tr>
	<td>ID</td>
	<td>Título</td>
	<td>Texto curto</td>
	<td>Categoria</td>
	<td>Data</td>
	<td>Controles</td>
</tr>
</thead>
<tbody>
<?php

$getNews = dbquery("SELECT * FROM site_news ORDER BY timestamp DESC");
$i = 1;

while ($n = mysql_fetch_assoc($getNews))
{
	$highlight = '#fff';
	
	if ($i <= 3)
	{
		$highlight = '#008000';
	}
	else if ($i <= 5)
	{
		$highlight = '#EFFBFB';
	}
	
	echo '<tr style="background-color: ' . $highlight . ';">
	<td>' . $n['id'] . '</td>
	<td>' . clean($n['title']) . '</td>
	<td>' . clean($n['snippet']) . '</td>
	<td>' . clean(mysql_result(dbquery("SELECT caption FROM site_news_categories WHERE id = '" . $n['category_id'] . "' LIMIT 1"), 0)) . '</td>
	<td>' . $n['datestr'] . '</td>
	<td>
		<input type="button" value="Ver" onclick="document.location = \'' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '\';">&nbsp;
		<input type="button" value="Deletar" onclick="document.location = \'index.php?_cmd=news&doDel=' . $n['id'] . '\';">&nbsp;
		<input type="button" value="Editar" onclick="document.location = \'index.php?_cmd=newsedit&u=' . $n['id'] . '\';">
		<input type="button" value="Atualizar data" onclick="document.location = \'index.php?_cmd=news&doBump=' . $n['id'] . '\';">&nbsp;
	</td>
	</tr>';
	
	$i++;
}

?>
</tbody>
</table>


<?php

require_once "bottom.php";

?>