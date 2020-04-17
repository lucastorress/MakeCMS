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
		<b>Voc� foi desconectado com sucesso !</b>
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