<?php
/*=======================================================================
| MakeCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Torres and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:
|         lucastorres.ce@gmail.com / sonhador_br@live.com
\======================================================================*/

define('TAB_ID', 5);
define('PAGE_ID', 17);

require_once "global.php";

$articleData = null;

if (isset($_GET['mostRecent']))
{
	$getData = dbquery("SELECT * FROM site_news ORDER BY timestamp DESC LIMIT 1");
	
	if (mysql_num_rows($getData) > 0)
	{
		$articleData = mysql_fetch_assoc($getData);
	}
}
else if (isset($_GET['rel']))
{
	$rel = $_GET['rel'];
	
	if (strrpos($rel, '-') >= 1)
	{
		$bits = explode('-', $rel);
		$id = $bits[0];
		
		$getData = dbquery("SELECT * FROM site_news WHERE id = '" . $id . "' LIMIT 1");
		
		if (mysql_num_rows($getData) > 0)
		{
			$articleData = mysql_fetch_assoc($getData);
		}
	}
}

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('generic');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-generic');
$tpl->AddGeneric('head-bottom');
$tpl->AddGeneric('generic-top');
	
$tpl->Write('<div id="column1" class="column">');

$newslist = new Template('comp-newslist');

if (isset($_GET['archiveMode']))
{
	$newslist->SetParam('mode', 'archive');
}
else if (isset($_GET['category']) && is_numeric($_GET['category']))
{
	$newslist->SetParam('mode', 'category');
	$newslist->SetParam('category_id', $_GET['category']);
}
else
{
	$newslist->SetParam('mode', 'recent');
}

$tpl->AddTemplate($newslist);

$tpl->Write('</div>');

$tpl->Write('<div id="column2" class="column">');

$article = new Template('comp-newsarticle');

if ($articleData != null)
{
	$article->SetParam('news_article_id', $articleData['id']);
	$article->SetParam('news_article_title', clean($articleData['title']));
	$article->SetParam('news_article_date', 'Postado em ' . clean($articleData['datestr']));
	$article->SetParam('news_category', '<a href="/articles/category/' . $articleData['category_id'] . '">' . clean(mysql_result(dbquery("SELECT caption FROM site_news_categories WHERE id = '" . $articleData['category_id'] . "' LIMIT 1"), 0)) . '</a>');
	$article->SetParam('news_article_summary', clean($articleData['snippet']));
	$article->SetParam('news_article_body', clean($articleData['body'], true));
	
	$tpl->SetParam('page_title', 'Notícias - ' . clean($articleData['title']));
}
else
{
	$article->SetParam('news_article_id', 0);
	$article->SetParam('news_article_title', 'Notícia não encontrada');
	$article->SetParam('news_article_date', '');
	$article->SetParam('news_category', '');
	$article->SetParam('news_article_summary', '');
	$article->SetParam('news_article_body', "A notícia que você está procurando, não foi encontrada em nosso site.");	
	
	$tpl->SetParam('page_title', 'Notícias - Notícia não encontrada');
}

$tpl->AddTemplate($article);
$tpl->Write('</div>');

$tpl->AddGeneric('generic-column3');
$tpl->AddGeneric('footer');

$tpl->SetParam('body_id', 'news');

$tpl->Output();

?>