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

$newOrderNum = intval(mysql_result(dbquery("SELECT MAX(order_num) FROM site_app_form LIMIT 1"), 0)) + 1;

if (isset($_GET['doDel']))
{
	dbquery("DELETE FROM site_app_form WHERE id = '" . filter($_GET['doDel']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Deletar um elemento.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doUp']))
{
	dbquery("UPDATE site_app_form SET order_num = order_num + 1 WHERE id = '" . filter($_GET['doUp']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Mover elemento acima.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_GET['doDown']))
{
	dbquery("UPDATE site_app_form SET order_num = order_num - 1 WHERE id = '" . filter($_GET['doDown']) . "' LIMIT 1");
	
	if (mysql_affected_rows() >= 1)
	{
		fMessage('ok', 'Mover elemento abaixo.');
	}
	
	header("Location: index.php?_cmd=jobform");
	exit;
}

if (isset($_POST['new-element-id']))
{
	$id = filter(strtolower($_POST['new-element-id']));
	$type = filter(strtolower($_POST['new-element-type']));
	$name = filter($_POST['new-element-name']);
	$descr = filter($_POST['new-element-descr']);
	$required = "no";
	
	if (isset($_POST['new-element-required']))
	{
		$required = filter(strtolower($_POST['new-element-required']));
	}
	
	$errors = Array();
	
	if (strlen($id) == 0 || strlen($id) > 24)
	{
		$errors[] = "ID inv�lido. Precisa ser de 0 at� 24 digitos.";
	}
	
	if ($type != "textbox" && $type != "textarea"
	&& $type != "checkbox")
	{
		$type = "textbox";
	}
	
	if (count($errors) == 0)
	{
		fMessage('ok', 'Elemento aplicado !');
		
		$req = "0";
		
		if ($required == "Sim")
		{
			$req = "1";
		}
		
		dbquery("INSERT INTO site_app_form (id,caption,descr,field_type,required,order_num) VALUES ('" . $id . "','" . $name . "','" . $descr . "','" . $type . "','" . $req . "','" . $newOrderNum . "')");
	}
	else
	{
		fMessage('error', 'N�o foi poss�vel adicionar o elemento. Selecione o ponto correto.');
	}
}

require_once "top.php";

?>			

<h1>Formul�rio de aplica��es</h1>

<p>
	Nunca um usu�rio aplica uma resposta. Voc� t�m de fazer um fomul�rio aonde sua obriga��o ser� totalmente sua.
</p>

<h2>

<b>Adicionar novo formul�rio</b> (<a href="#" onclick="t('elform');">Ver/Esconder</a>)

<div id="elform" style="padding: 10px;">
<br />

<form method="post">

Tipo do formul�rio:<br />
<select name="new-element-type">
<option value="textbox">Caixa de texto</option>
<option value="textarea">Area de texto (Para uma reda��o)</option>
<option value="checkbox">Checkbox (Uma descri��o)</option>
</select>

<br /><br />

ID do elemento (curto, <u>unico</u>, e n�o adicione car�cteres especiais):<br />
<input type="text" value="" maxlength="24" name="new-element-id">

<br /><br />

Nome do formul�rio:<br />
<input type="text" value="" maxlength="120" name="new-element-name">

<br /><br />

Descri��o:<br />
<textarea name="new-element-descr" cols="50" rows="4"></textarea>

<br /><br />

<input type="checkbox" value="yes" name="new-element-required"> Requirido

<br /><br />

<input type="submit" value="Adicionar elemento">

<br /><br />

</form>
</div>

</h2>

<h2>Administras/Previsualizar</h2>
<br />

<form method="post">

<?php

$getElements = dbquery("SELECT * FROM site_app_form ORDER BY order_num ASC");

echo '<ol style="margin-left: 20px;">';

while ($el = mysql_fetch_assoc($getElements))
{
	echo '<li>';
	
	echo $el['id'] . '&nbsp;';
	
	if ($el['required'] == "1")
	{
		echo '<b style="color: darkred;"><small>(Este � um espa�o requirido)</small></b><br />';
	}
	
	echo '<div style="width: 75%; border: 1px dotted; background-color: #F2F2F2; margin-top: 5px; padding: 10px;">';
	
	switch ($el['field_type'])
	{
		case "checkbox":
		
			echo '<input type="checkbox" value="checked" name="' . $el['id'] . '"> ' . clean($el['descr']);
			break;
	
		case "textarea":
		
			echo clean($el['caption']) . '<br />';
			echo '<textarea name="' . $el['id'] . '"></textarea>';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	
		case "textbox":
		default:
		
			echo clean($el['caption']) . '<br />';
			echo '<input type="text" name="' . $el['id'] . '" value="">';
			echo '<br />';
			echo '<small>' . $el['descr'] . '</small>';			
			break;
	}
	
	echo '</div>';
	
	echo '<Br />';
	echo 'Order num: ' . $el['order_num'] . ' | ';
	echo '<a href="index.php?_cmd=jobform&doUp=' . $el['id'] . '">Acima</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDown=' . $el['id'] . '">Abaixo</a> | ';
	echo '<a href="index.php?_cmd=jobform&doDel=' . $el['id'] . '">Deletar</a>';	
	
	echo '<br />';
	echo '<br />';
	echo '<br />';
	
	echo '</li>';
}

echo '<li><i>Submit button</i><br /><div style="border: 1px dotted; width: 50px; padding: 10px;">';
echo '<input type="submit" value="Enviar">';
echo '</div></li>';

echo '</ol><br />';

?>

</form>


<?php

require_once "bottom.php";

?>