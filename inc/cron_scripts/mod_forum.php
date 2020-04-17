<?php
/*=======================================================================
| StageCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Geek and Meth0d
| #######################################################################
| Este programa é um Free Software aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Contato:                                       Divirta-se com a CMS ;D
|         rafa95123@hotmail.com
\======================================================================*/

if (!defined('UBER') || !UBER)
{
	exit;
}

$cutoff = time() - 604800;

$get = dbquery("SELECT id FROM moderation_forum_threads WHERE timestamp <= " . $cutoff);

while ($topic = mysql_fetch_assoc($get))
{
	dbquery("DELETE FROM moderation_forum_threads WHERE id = '" . $topic['id'] . "' LIMIT 1");
	dbquery("DELETE FROM moderation_forum_replies WHERE thread_id = '" . $topic['id'] . "'");
}

?>