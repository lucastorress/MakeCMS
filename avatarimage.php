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

	header("Content-type: image/png");
	$look = $_GET['look'];
	if (empty($look)) {
		$look = "hd-180-1.fa-1205-62.ha-1006-100.lg-280-73.wa-2009-62.ch-255-73.sh-290-73.hr-125-42";
	}
	$im = imagecreatefrompng("http://www.habbo.com.br/habbo-imaging/avatarimage?figure=$look&action=wav&direction=4&head_direction=3&gesture=sml&size=l");
	imagepng($im);
	imagedestroy($im);

?>