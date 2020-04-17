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

$tpl->Write('
<div id="qtab-container-myfriends" class="qtab-container"><ul>
    <li class="odd">Voc&ecirc; ainda n&atilde;o adicionou amigos</li>
</ul>

<p class="manage-friends"><a href="?/profile/friendsmanagement?tab=6">Gerenciador de Amigos</a></p></div> ');

$tpl->Output();

?>
