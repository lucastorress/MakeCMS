<div class="habblet-container ">		
						<div class="cbb clearfix default "> 
	
							<h2 class="title">Índice de Notícias <?php if ($mode == 'archive') { echo 'Archive'; } ?>
							</h2> 
						<div id="article-archive"> 
 
<?php

if ($mode == 'recent')
{
	for ($i = 0; $i < 6; $i++)
	{
		$sectionName = '';
		$sectionCutoffMax = 0;
		$sectionCutoffMin = 0;
		
		switch ($i)
		{
			case 0:
			
				$sectionName = 'Últimas 12 Horas';
				$sectionCutoffMax = time();
				$sectionCutoffMin = time() - 43200;
				break;
				
			case 1:
			
				$sectionName = 'Últimas 24 Horas';
				$sectionCutoffMax = time() - 43200;
				$sectionCutoffMin = time() - 86400;
				break;
				
			case 2: 
			
				$sectionName = 'Esta Semana';
				$sectionCutoffMax = time() - 86400;
				$sectionCutoffMin = time() - 172800;
				break;
				
			case 3:
			
				$sectionName = 'Semana Passada';
				$sectionCutoffMax = time() - 172800;
				$sectionCutoffMin = time() - 604800;
				break;
				
			case 4:
			
				$sectionName = 'Este Mês';
				$sectionCutoffMax = time() - 604800;
				$sectionCutoffMin = time() - 1209600;
				break;
				
			case 5:
			
				$sectionName = 'Mês Passado';
				$sectionCutoffMax = time() - 1209600;
				$sectionCutoffMin = time() - 2592000;
				break;
		}
		
		$q = "SELECT * FROM site_news WHERE timestamp >= " . $sectionCutoffMin . " AND timestamp <= " . $sectionCutoffMax .  " ORDER BY timestamp DESC";
		$getArticles = dbquery($q);

		if (mysql_num_rows($getArticles) > 0)
		{
			echo '<h2>' . $sectionName . '</h2> 
			<ul>';
			
			while ($a = mysql_fetch_assoc($getArticles))
			{
				echo '<li>		
					<a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a> 
				</li>';
			}
			
			echo '</ul>';
		}
	}
 
	echo '<a href="%www%/articles/archive">Mais notícias &raquo;</a>';
}
else if ($mode == 'archive')
{
	$categories = Array();	
	$getArticles = dbquery("SELECT * FROM site_news");
	
	while ($newsData = mysql_fetch_assoc($getArticles))
	{
		$categories[$newsData['category_id']][] = $newsData;
	}
	
	foreach ($categories as $catId => $articlesInCat)
	{
		if (count($articlesInCat) < 1)
		{
			continue;
		}
		
		$getCategory = dbquery("SELECT caption FROM site_news_categories WHERE id = '" . intval($catId) . "' LIMIT 1");
		$catName = 'Unknown';
		
		if (mysql_num_rows($getCategory) == 1)
		{
			$catName = clean(mysql_result($getCategory, 0));
		}
		
		echo '<h2>' . $catName . '</h2>';
		echo '<ul>';
		
		foreach ($articlesInCat as $a)
		{
			echo '<li>		
					<a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '/in/archive" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a> 
				</li>';
		}
		
		echo '</ul>';
	}
}
else if ($mode == 'category')
{	
	$getArticles = dbquery("SELECT * FROM site_news WHERE category_id = '" . $category_id . "'");
	$getCategory = dbquery("SELECT caption FROM site_news_categories WHERE id = '" . intval($category_id) . "' LIMIT 1");
	$catName = 'Unknown';
		
	if (mysql_num_rows($getCategory) == 1)
	{
		$catName = clean(mysql_result($getCategory, 0));
	}
		
	echo '<h2>' . $catName . '</h2>';
	echo '<ul>';
		
	while ($a = mysql_fetch_assoc($getArticles))
	{
		echo '<li>		
				<a href="%www%/articles/' . $a['id'] . '-' . $a['seo_link'] . '" class="article-' . $a['id'] . '">' . clean($a['title']) . '&nbsp;&raquo;</a> 
			</li>';
	}
		
	echo '</ul>';
}

?>
</div> 
	
						
					</div> 
				</div> 
				<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
				
