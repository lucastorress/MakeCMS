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
define('PAGE_ID', 20); 

require_once "global.php"; 

$tpl->Init(); 

$tpl->AddGeneric('head-init'); 

$tpl->AddIncludeSet('generic'); 
$tpl->AddIncludeFile(new IncludeFile('text/css', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/v2/styles/newcredits.css', 'stylesheet')); 
$tpl->AddIncludeFile(new IncludeFile('text/javascript', 'http://images.habbo.com/habboweb/%web_build%/web-gallery/static/js/newcredits.js')); 
$tpl->WriteIncludeFiles(); 

$tpl->AddGeneric('head-overrides-generic'); 
$tpl->AddGeneric('head-bottom'); 
$tpl->AddGeneric('generic-top'); 

$tpl->Write('<div id="column1" class="column">'); 
$tpl->AddGeneric('comp-online'); 
$tpl->Write('</div>'); 

$tpl->Write('<div id="column2" class="column">'); 
$tpl->AddGeneric('comp-online-info'); 
$tpl->Write('</div>'); 

$tpl->AddGeneric('generic-column3'); 
$tpl->AddGeneric('footer'); 

$tpl->SetParam('page_title', 'Usuários Onlines'); 
$tpl->SetParam('body_id', 'home'); 

$tpl->Output(); 

?>