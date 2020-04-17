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

function getExtension($str)
{
	$i = strrpos($str, '.');
	
	if (!$i)
	{
		return '';
	}
	
	$l = strlen($str) - $i;
	$ext = substr($str, $i + 1, $l);
	
	return $ext;
}

if (isset($_POST['name']))
{
	$image = $_FILES['img']['name'];
	
	if ($image && isset($_POST['name']) && isset($_POST['clickurl']))
	{
		$filename = strtolower($_POST['name']);
		$clickurl = $_POST['clickurl'];
		
		if (strlen($filename) >= 1 && strlen($clickurl) >= 1)
		{
			$ext = getExtension(strtolower($_FILES['img']['name']));
			
			$fileLoc = CWD . '/ads/' . $filename . '.' . $ext;
			$wwwLoc = WWW . '/ads/' . $filename . '.' . $ext;
			
			if ($ext == "gif")
			{
				if (copy($_FILES['img']['tmp_name'], $fileLoc))
				{
					dbquery("INSERT INTO room_ads (id,ad_image,ad_image_orig,ad_link,views,views_limit,enabled) VALUES (NULL,'" . $wwwLoc . "','" . $filename . '.' . $ext . "','" . filter($clickurl) . "',0,0,1)");
					fMessage('ok', 'ADS foi baixado !.');
				}
				else
				{
					fMessage('error', 'N�o foi poss�vel carregaro arquivo: ' . $fileLoc);
				}
			}
			else
			{
				fMessage('error', 'Arquivo inv�lido: ' . $ext);
			}
		}
		else
		{
			fMessage('error', 'Entre com um nome do arquivo e o link para redirecionamento.');
		}
	}
	else
	{
		fMessage('error', 'Erro ao fazer upload. (Desconhecido).');
	}
}

if (isset($_GET['delId']))
{
	dbquery("DELETE FROM room_ads WHERE ad_image_orig = '" . filter($_GET['delId']) . "'");
	
	if (@unlink(CWD . '/ads/' . filter($_GET['delId'])))
	{
		fMessage('ok', 'ADS deletado.');
	}
	
	header("Location: index.php?_cmd=roomads");
	exit;
}

if (isset($_GET['switchId']))
{
	$get = dbquery("SELECT enabled FROM room_ads WHERE ad_image_orig = '" . filter($_GET['switchId']) . "' LIMIT 1");
	
	if (mysql_num_rows($get) >= 1)
	{
		$enabled = mysql_result($get, 0);
		
		$set = "0";
		
		if ($enabled == "0")
		{
			$set = "1";
		}

		dbquery("UPDATE room_ads SET enabled = '" . $set . "' WHERE ad_image_orig = '" . filter($_GET['switchId']) . "' LIMIT 1");
	}
	
	header("Location: index.php?_cmd=roomads");
	exit;	
}

require_once "top.php";

?>			

<h1>ADS</h1>

<p>
	ADS podem ser exibidos quando um usu�rio vai de um quarto para o outro. NOTA: Somente em quartos p�blicos.
</p>

<h2>Galeria</h2>

<br />

<table border="1" width="100%">
<thead>
<tr>
	<td>Imagem <small>(clique para visualizar por inteiro)</small></td>
	<td>Nome do arquivo</td>
	<td>Redirecionamento</td>
	<td>Visualiza��es</td>
	<td>ATIVAR/DESATIVAR</td>
	<td>Deletar</td>
</tr>
</thead>
<tbody>
<?php

$handle = null;

if ($handle = opendir(CWD . '/ads'))
{
	while (false !== ($file = readdir($handle)))
	{
		$file = strtolower($file);
	
		if ($file == '.' || $file == '..' || getExtension($file) != "gif")
		{
			continue;
		}
		
		$hasDbEntry = false;
		$dbData = null;
		$dbGet = dbquery("SELECT * FROM room_ads WHERE ad_image_orig = '" . $file . "' LIMIT 1");
		
		if (mysql_num_rows($dbGet) >= 1)
		{
			$hasDbEntry = true;
			$dbData = mysql_fetch_assoc($dbGet);
		}

		echo '<tr>
		<td><a href="/ads/' . $file . '"><center><img src="' . WWW . '/ads/' . $file . '" height="150" width="200"></center></a></td>
		<td><a href="/ads/' . $file . '"><b>' . $file . '</b></a></td>
		<td>';
		
		if ($hasDbEntry)
		{
			echo '<a href="' . $dbData['ad_link'] . '">' . clean($dbData['ad_link']) . '</a>';
		}
		else
		{
			echo 'N/A';
		}
		
		echo '</td>
		<td>';
		
		if ($hasDbEntry)
		{
			echo $dbData['views'];
		}
		else
		{
			echo 'N/A';
		}
		
		echo '</td>
		<td>';
		
		if ($hasDbEntry)
		{
			if ($dbData['enabled'] == "0")
			{
				echo 'Atualmente <span style="color: darkred !important; font-size: 140%;">desativada</span>,<br /><input type="button" onclick="document.location = \'index.php?_cmd=roomads&switchId=' . $file . '\';" value="Ativar">';
			}
			else
			{
				echo 'Atualmente se encontra ativo,<br /><input type="button" onclick="document.location = \'index.php?_cmd=roomads&switchId=' . $file . '\';" value="Desatvar">';
			}
		}
		else
		{
			echo '<strong style="color: darkred;">Erro na entrada no banco de dados !<br />Fa�a o upload novamente.</strong>';
		}
		
		echo '</td>
		<td><input type="button" onclick="document.location = \'index.php?_cmd=roomads&delId=' . $file . '\';" value="Deletar"></td>
		</tr>';
	}
	
	closedir($handle);
}
	
?>
</tbody>
</table>

<h2>Upload de imagem (Somente .GIF)</h2><br />
<form method="post" enctype="multipart/form-data">

<b>Arquivo:</b><br />
<input type="file" name="img"><br />
<br />

<b>Nome do arquivo:</b><br />
<input type="text" name="name"><br />
<br />

<b>Redirecionamento:</b><br />
<input type="clickurl" name="clickurl"><br />
<br />

<input type="submit" value="Enviar">

</form>

<?php

require_once "bottom.php";

?>