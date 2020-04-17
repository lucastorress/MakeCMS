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

if (!HK_LOGGED_IN || !$users->hasFuse(HK_USER_ID, 'fuse_housekeeping_catalog'))
{
	exit;
}

if (isset($_GET['unsetCat']))
{
	unset($_SESSION['OT_PAGE_CAT']);
}

if (!isset($_SESSION['OT_PAGE_CAT']))
{
	if (isset($_POST['OT_PAGE_CAT']))
	{
		$_SESSION['OT_PAGE_CAT'] = $_POST['OT_PAGE_CAT'];
	}
	else
	{
		require_once "top.php";
		
		echo '<p>Selecionar categoria para editar:</p>';
		echo '<form method="post">';
		echo '<select name="OT_PAGE_CAT">';
		echo '<option value="3">Furni Shop</option>';
		echo '<option value="91">Páginas Staff</option>';
		echo '<option value="4">Pixel shop</option>';
		echo '<option value="6">Trax Shop</option>';
		echo '<option value="5">Habbo Club</option>';		
		echo '<option value="-1">Página inicial</option>';		
		echo '</select>';
		echo '<input type="submit" value="Pronto">';
		echo '</form>';
		
		require_once "bottom.php";
		
		exit;
	}
}

$newOrderId = mysql_result(dbquery("SELECT order_num FROM catalog_pages WHERE parent_id = '" . $_SESSION['OT_PAGE_CAT'] . "' ORDER BY order_num DESC"), 0) + 1;

if (!isset($_GET['sq']))
{
	$_GET['sq'] = "";
}

if (isset($_GET['new']))
{
	dbquery("INSERT INTO catalog_pages (parent_id,caption,icon_color,icon_image,visible,enabled,coming_soon,order_num,page_layout,page_text_details,page_headline) VALUES ('" . $_SESSION['OT_PAGE_CAT'] . "','', '0', '1', '1', '1', '0', '" . $newOrderId . "', 'default_3x3','Click on an item for more information.','catalog_frontpage_headline2_en')");
	fMessage('ok', 'New page stub added');
	
	$newId = mysql_result(dbquery("SELECT id FROM catalog_pages ORDER BY id DESC LIMIT 1"), 0);
	
	header("Location: ./index.php?_cmd=ot-pages&edit=" . $newId);
	exit;
}

if (isset($_GET['del']))
{
	fMessage('error', 'Você tem <b>certeza</b> que deseja deletar esta página ? Isto não pode ser revertido.<br /><a href="index.php?_cmd=ot-pages&realdel=' . $_GET['del'] . '">SIM, DELETAR</a> - ou - <a href="index.php?_cmd=ot-pages">CANCELAR</a>');
}

if (isset($_GET['realdel']))
{
	fMessage('ok', 'Página deletada');
	dbquery("DELETE FROM catalog_pages WHERE id = '" . intval($_GET['realdel']) . "' AND parent_id = '" . $_SESSION['OT_PAGE_CAT'] . "' LIMIT 1");
	header("Location: ./index.php?_cmd=ot-pages&");
	exit;	
}

$data = null;
$lockedVars = array('id','parent_id','type','gonew');

if (isset($_GET['edit']))
{
	$i = intval($_GET['edit']);	
	$get = dbquery("SELECT * FROM catalog_pages WHERE id = '" . $i . "' AND parent_id = '" . $_SESSION['OT_PAGE_CAT'] . "' LIMIT 1");
	
	if (mysql_num_rows($get) == 0)
	{
		fMessage('error', 'Opa ! Item inválido.');
	}
	else
	{
		$data = mysql_fetch_assoc($get);
		
		if (isset($_POST['caption']))
		{
			$i = 0;
			
			$qB = '';

			foreach ($_POST as $key => $value)
			{
				$i++;
				
				if (in_array($key, $lockedVars))
				{
					continue;
				}
				
				if ($i > 1)
				{
					$qB .= ',';
				}
				
				$qB .= $key . " = '" . filter($value) . "'";
			}
			
			dbquery("UPDATE catalog_pages SET " . $qB . " WHERE id = '" . intval($_GET['edit']) . "' LIMIT 1");
			fMessage('ok', 'Item atualizado com sucesso !');
			
			if (isset($_POST['gonew']) && $_POST['gonew'] == "y")
			{
				header("Location: ./index.php?_cmd=ot-pages&new");
			}
			else
			{
				header("Location: ./index.php?_cmd=ot-pages&edit=" . $data['id']);
			}
			
			exit;
		}
	}
}

if (isset($_POST['update-order']))
{
	foreach ($_POST as $key => $value)
	{
		if ($key == 'update-order')
		{
			continue;
		}
	
		if (substr($key, 0, 4) != 'ord-')
		{
			die("Invalid: " . $key);
			continue;
		}
		
		$id = intval(substr($key, 4));

		dbquery("UPDATE catalog_pages SET order_num = '" . intval($value) . "' WHERE id = '" . $id .  "' AND parent_id = '" . $_SESSION['OT_PAGE_CAT'] . "' LIMIT 1");
	}
	
	fMessage('ok', 'Atualizar por ordem de página.');
}

require_once "top.php";

echo '<h1>Administrar páginas do catálogo</h1>';

echo '<br />Editing category: <b>' . mysql_result(dbquery("SELECT caption FROM catalog_pages WHERE id = '" . $_SESSION['OT_PAGE_CAT'] . "' LIMIT 1"), 0) . '</b> (<a href="index.php?_cmd=ot-pages&unsetCat">Change</a>)';
echo '<br /><br /><hr /><br />';

if ($data != null)
{
	echo '<hr /><br />';
	echo '<small><b>Editing item</b></small>';
	echo '<h2><b>' . $data['caption'] . '</b></h2><br />';
	echo '<form method="post">';
	
	foreach ($data as $key => $value)
	{
		$lck = false;
		
		if (in_array($key, $lockedVars))
		{
			$lck = true;
		}

		echo $key . ':<br /><textarea ';

		if ($lck)
		{
			echo 'readonly="readonly" disabled="disabled" ';
		}

		echo 'name="' . $key . '" cols="50" rows="4">' . $value . '</textarea><br /><br />';
	}
	
	echo '<input type="checkbox" name="gonew" value="y" checked>Criar e gerar outra página para colocar itens<br />';
	echo '<input type="submit" value="Salvar">&nbsp;';
	echo '<input type="button" value="Cancelar" onclick="window.location=\'index.php?_cmd=ot-pages&sq=' . $_GET['sq'] . '\';">';
	echo '</form>';
	echo '<br /><hr /><Br />';
}

$getPages = dbquery("SELECT * FROM catalog_pages WHERE parent_id = '" . $_SESSION['OT_PAGE_CAT'] . "' ORDER BY order_num ASC");					

echo '<a href="index.php?_cmd=ot-pages&new"><b>Nova página gerada</b></a><br /><br />';

echo '<table width="100%" border="1" style="text-align: center;">
<thead style="font-weight: bold; font-size: 110%;">
	<td>ID</td>
	<td>Nome</td>
	<td>Visibilidade</td>
	<td>Ativado</td>
	<td>Estrutura</td>
	<td>Ordem</td>
	<td>Opções</td>
</thead>
<form method="post">';

while ($page = mysql_fetch_assoc($getPages))
{
	echo '<tr>
	<td>' . $page['id'] . '</td>
	<td>' . $page['caption'] . '</td>
	<td>' . $page['visible'] . '</td>
	<td>' . $page['enabled'] . '</td>
	<td>' . $page['page_layout'] . '</td>
	<td><input style="text-align: center; font-weight: bold; margin: 2px;" type="text" size="3" value="' . $page['order_num'] . '" name="ord-' . $page['id'] . '"></td>
	<td><a href="index.php?_cmd=ot-pages&edit=' . $page['id'] . '">[Editar]</a> <a href="index.php?_cmd=ot-pages&del=' . $page['id'] . '">[Remover]</a></td>
	</tr>';
}

echo '</table><br /><input type="submit" name="update-order" value="Salvar ordem da página"> ou <input type="button" value="Cancelar" onclick="location.reload(true);"></form><br /><br />';

echo '<a href="index.php?_cmd=ot-pages&new"><b>Editado !</b></a>';

echo '</div>
</div>';

require_once "bottom.php";

?>					