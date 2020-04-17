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

if (!isset($_GET['sq']))
{
	$_GET['sq'] = "";
}

if (isset($_GET['new']))
{
	dbquery("INSERT INTO catalog_items (page_id,item_ids,catalog_name,cost_credits,cost_pixels,amount) VALUES (137,1,'',10,0,1)");
	fMessage('ok', 'Novo item adicionado !');
	
	$newId = mysql_result(dbquery("SELECT id FROM catalog_items ORDER BY id DESC LIMIT 1"), 0);
	
	header("Location: ./index.php?_cmd=ot-cata-items&edit=" . $newId);
	exit;
}

if (isset($_GET['del']))
{
	fMessage('error', 'Você tem <b>certeza</b> que deseja deletar este item do catálogo ? Isto não pode ser revertido.<br /><a href="index.php?_cmd=ot-cata-items&realdel=' . $_GET['del'] . '&sq=' . $_GET['sq'] . '">SIM, DELETAR</a> - ou - <a href="index.php?_cmd=ot-cata-items">CANCELAR</a>');
}

if (isset($_GET['realdel']))
{
	fMessage('ok', 'Item deletado !');
	dbquery("DELETE FROM catalog_items WHERE id = '" . intval($_GET['realdel']) . "' LIMIT 1");
	header("Location: ./index.php?_cmd=ot-cata-items&sq=" . $_GET['sq']);
	exit;	
}

$data = null;
$lockedVars = array('id','gonew');

if (isset($_GET['edit']))
{
	$i = intval($_GET['edit']);	
	$get = dbquery("SELECT * FROM catalog_items WHERE id = '" . $i . "' LIMIT 1");
	
	if (mysql_num_rows($get) == 0)
	{
		fMessage('error', 'Opa ! Item inválido.');
	}
	else
	{
		$data = mysql_fetch_assoc($get);
		
		if (isset($_POST['page_id']))
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
			
			dbquery("UPDATE catalog_items SET " . $qB . " WHERE id = '" . intval($_GET['edit']) . "' LIMIT 1");
			fMessage('ok', 'Item atualizado com sucesso !');
			
			if (isset($_POST['gonew']) && $_POST['gonew'] == "y")
			{
				header("Location: ./index.php?_cmd=ot-cata-items&new");
			}
			else
			{
				header("Location: ./index.php?_cmd=ot-cata-items&edit=" . $data['id']);
			}
			
			exit;
		}
	}
}

require_once "top.php";

echo '<h1>Administrar itens do catálogo</h1>';

$checkBlankItems = dbquery("SELECT id,page_id FROM catalog_items WHERE item_ids = '1' AND catalog_name = ''");

if (mysql_num_rows($checkBlankItems) > 0)
{
	echo '<div style="margin: 5px; padding: 10px; border: 2px solid #000; color: darkred;">';
	echo '<p>';
	echo '<b>Aviso !</b> Se você deixar espaços em branco, poderá comprometer o banco de dados:<br />';
	echo '<ul class="styled">';
	
	while ($item = mysql_fetch_assoc($checkBlankItems))
	{
		if (isset($_GET['edit']) && $item['id'] == $_GET['edit'])
		{
			echo '<li><i>Você está editando o item (ID #' . $item['id'] . ').</i></li>';
		}
		else
		{
			echo '<li><a href="index.php?_cmd=ot-cata-items&edit=' . $item['id'] . '" target="_self">Item (ID #' . $item['id'] . ') na página ' . $item['page_id'] . '</a> (or <a href="index.php?_cmd=ot-cata-items&del=' . $item['id'] . '">Deletar</a>)</li>';
		}
	}
	
	echo '</ul>';
	echo '</p>';
	echo '</div>';
}

if ($data != null)
{
	echo '<hr /><br />';
	echo '<small><b>Editando item do catálogo</b></small>';
	echo '<h2><b>' . $data['catalog_name'] . '</b></h2><br />';
	echo '<form method="post" action="index.php?_cmd=ot-cata-items&edit=' . $data['id'] . '">';
	
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
			echo 'readonly="readonly" disabled="desativado" ';
		}

		echo 'name="' . $key . '" cols="50" rows="4">' . $value . '</textarea><br /><br />';
	}
	
	echo '<input type="checkbox" name="gonew" value="y" checked>Criar e gerar outro item para eu criar<br />';
	echo '<input type="submit" value="Salvar">&nbsp;';
	echo '<input type="button" value="Cancelar" onclick="window.location=\'index.php?_cmd=ot-cata-items&sq=' . $_GET['sq'] . '\';">';
	echo '</form>';
	echo '<br />';
}
else
{
	echo '<form method="post">
	<input type="text" value="Search.." style="font-size: 150%;" size="70" onclick="if(this.value==\'Search..\'){this.value=\'\';}" name="search-query">
	</form><Br />';

	if (!isset($_POST['search-query']) && isset($_GET['sq']))
	{
		$_POST['search-query'] = $_GET['sq'];
	}

	if (isset($_POST['search-query']))
	{
		$_POST['search-query'] = filter($_POST['search-query']);

		$getPages = dbquery("SELECT * FROM catalog_items WHERE catalog_name LIKE '%" . $_POST['search-query'] . "%' OR id = '" . $_POST['search-query'] . "' OR item_ids = '" . $_POST['search-query'] . "' OR page_id = '" . $_POST['search-query'] . "' ORDER BY item_ids ASC");					

		echo '<a href="index.php?_cmd=ot-cata-items&new"><b>Gerado novo item de catálogo</b></a><br /><br />';
		
		echo '<table width="100%" border="1" style="text-align: center;">
		<thead style="font-weight: bold; font-size: 110%;">
			<td>ID</td>
			<td>ID da página</td>
			<td>Definição</td>
			<td>Nome</td>
			<td>Valor</td>
			<td>Quantidade</td>
			<td>Opções</td>
		</thead>';

		while ($page = mysql_fetch_assoc($getPages))
		{
			echo '<tr>
			<td>' . $page['id'] . '</td>
			<td>' . $page['page_id'] . '</td>
			<td><a href="ot-def.php?edit=' . $page['item_ids'] . '">' . $page['item_ids'] . '</a></td>
			<td>' . $page['catalog_name'] . '</td>
			<td>' . $page['cost_credits'] . ' Moedas, ' . $page['cost_pixels'] . ' Pixels</td>
			<td>' . $page['amount'] . '</td>
			<td><a href="index.php?_cmd=ot-cata-items&edit=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Editar]</a> <a href="index.php?_cmd=ot-cata-items&del=' . $page['id'] . '&sq=' . $_POST['search-query'] . '">[Remover]</a></td>
			</tr>';
		}
		
		echo '</table><br />';
	}
	else
	{
		echo '<br /><b>Por favor, procure por algo primeiro.</b><br /><Br />';
	}
}

echo '<a href="index.php?_cmd=ot-cata-items&new"><b>Gerado novo item do catálogo</b></a>';

echo '</div>
</div>';

require_once "bottom.php";

?>								