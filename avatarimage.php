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

	header("Content-type: image/png");
	$look = $_GET['look'];
	if (empty($look)) {
		$look = "hd-180-1.fa-1205-62.ha-1006-100.lg-280-73.wa-2009-62.ch-255-73.sh-290-73.hr-125-42";
	}
	$im = imagecreatefrompng("http://www.habbo.com.br/habbo-imaging/avatarimage?figure=$look&action=wav&direction=4&head_direction=3&gesture=sml&size=l");
	imagepng($im);
	imagedestroy($im);

?>