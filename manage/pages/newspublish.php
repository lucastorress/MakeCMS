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

if (isset($_POST['content']))
{
	$title = filter($_POST['title']);
	$teaser = filter($_POST['teaser']);
	$topstory = WWW . '/images/ts/' . filter($_POST['topstory']);
	$content = filter($_POST['content']);
	$seoUrl = filter($_POST['url']);
	$category = intval($_POST['category']);
	
	if (strlen($seoUrl) < 1 || strlen($title) < 1 || strlen($teaser) < 1 || strlen($content) < 1)
	{
		fMessage('error', 'N�o deixe espa�os em branco.');
	}
	else
	{
		dbquery("INSERT INTO site_news (title,category_id,seo_link,topstory_image,body,snippet,datestr,timestamp) VALUES ('" . $title . "','" . $category . "','" . $seoUrl . "','" . $topstory . "','" . $content . "','" . $teaser . "','" . date('d-M-Y') . "', '" . time() . "')");
		fMessage('ok', 'Not�cia publicada.');
		
		header("Location: index.php?_cmd=news");
		exit;
	}
}

require_once "top.php";

?>			

<script type="text/javascript">
function previewTS(el)
{
	document.getElementById('ts-preview').innerHTML = '<img src="<?php echo WWW; ?>/images/ts/' + el + '" />';
}

function suggestSEO(el)
{
	var suggested = el;
	
	suggested = suggested.toLowerCase();
	suggested = suggested.replace(/^\s+/, ''); 
	suggested = suggested.replace(/\s+$/, '');
	suggested = suggested.replace(/[^a-z 0-9]+/g, '');
	
	while (suggested.indexOf(' ') > -1)
	{
		suggested = suggested.replace(' ', '-');
	}
	
	document.getElementById('url').value = suggested;
}
</script>

<h1>Publicar not�cia</h1>
<form method="post">

<br />

<div style="float: left;">

<strong>T�tulo da not�cia:</strong><br />
<input type="text" value="<?php if (isset($_POST['title'])) { echo clean($_POST['title']); } ?>" name="title" size="50" onkeyup="suggestSEO(this.value);" style="padding: 5px; font-size: 130%;"><br />
<br />

<strong>Categoria:</strong><br />
<select name="category">
<?php

$getOptions = dbquery("SELECT * FROM site_news_categories ORDER BY caption ASC");

while ($option = mysql_fetch_assoc($getOptions))
{
	echo '<option value="' . intval($option['id']) . '" ' . (($option['id'] == $_POST['category']) ? 'selected' : '') . '>' . clean($option['caption']) . '</option>';
}

?>
</select><br />
<br />

<strong>Link da not�cia:</strong><br />
<div style="border: 1px dotted; width: 300px; padding: 5px;">
<?php echo WWW; ?>/[id]-<input type="text" id="url" name="url" value="<?php if (isset($_POST['url'])) { echo clean($_POST['url']); } ?>" maxlength="120">/<br />
</div>
<small>Esta � uma sugest�o automatica. <b>N�o altere !</b></small><br />
<br />

<strong>Texto curto (Um pequeno texto):</strong><br />
<textarea name="teaser" cols="48" rows="5" style="padding: 5px; font-size: 120%;"><?php if (isset($_POST['teaser'])) { echo clean($_POST['teaser']); } ?></textarea><br />
<br />

<strong>Imagem:</strong><br />

	<select onkeypress="previewTS(this.value);" onchange="previewTS(this.value);" name="topstory" id="topstory" style="padding: 5px; font-size: 120%;">
	<?php
	
	if ($handle = opendir(CWD . '/images/ts'))
	{
		while (false !== ($file = readdir($handle)))
		{
			if ($file == '.' || $file == '..')
			{
				continue;
			}	
			
			echo '<option value="' . $file . '"';
			
			if (isset($_POST['topstory']) && $_POST['topstory'] == $file)
			{
				echo ' selected';
			}
			
			echo '>' . $file . '</option>';
		}
	}

	?>
	</select>
	
</div>

<div id="ts-preview" style="margin-left: 20px; padding: 10px; float: left; text-align: center; vertical-align: middle;">

	<small>(Selecione uma imagem, ela ser� exibida aqui)</small>

</div>

<div style="clear: both;"></div>

<br /><br />

<script type="text/javascript" src="./tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
	mode : "exact",
	elements : "content",
	theme : "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_resizing : true,
	theme_advanced_statusbar_location : "bottom"
});
</script>

<textarea id="content" name="content" style="width:80%"><?php if (isset($_POST['content'])) { echo clean($_POST['content']); } ?></textarea>

<br />
<br />

<input type="submit" value="Criar">

</form>


<?php

require_once "bottom.php";

?>