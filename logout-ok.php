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

require_once "global.php";

$tpl->Init();

$tpl->AddGeneric('head-init');
$tpl->AddIncludeSet('process-template');
$tpl->WriteIncludeFiles();
$tpl->AddGeneric('head-overrides-process');
$tpl->AddGeneric('head-bottom');

$tpl->Write('<script language="JavaScript" type="text/javascript"> 
	document.logoutPage = true;
	</script>');

$tpl->AddGeneric('process-template-top');

$tpl->Write('<div class="action-confirmation flash-message"> 
	<div class="rounded"> 
		<b>Você foi desconectado com sucesso !</b>
	</div> 
</div>');

$tpl->Write('<div style="text-align: center"> 
	
	<div style="width:100px; margin: 10px auto"><a href="#" id="logout-ok" class="new-button fill"><b>OK</b><i></i></a></div>

</div>');

$tpl->AddGeneric('process-template-bottom');

$tpl->Write('<script type="text/javascript"> 
	Event.observe(\'logout-ok\', \'click\', function(e) {
		Event.stop(e);
			document.location.href=\'%www%\';
	});
 
    Cookie.erase("habboclient");
    Cookie.erase("friendlist");
</script>');

$tpl->AddGeneric('footer');

$tpl->SetParam('page_title', 'Desconectado');
$tpl->SetParam('body_id', 'logout');

$tpl->Output();

?>