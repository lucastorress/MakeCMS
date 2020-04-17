<?php
/*=========================================================
| HabboRetro ~ CMSE - Content Management Systems Expert
| #########################################################
| HabboRetro release_4 Developed by bil & Meth0d
| Parts by Sisija and bil
| Visit Meth0d.org , Portal-Habbo.com.br
| #########################################################
| Cms developed to improve the delivery system of your
| habbo private if you have questions, suggestions or any
| bugs reportal please contact: gabriel_bil123@hotmail.com
| #########################################################
| Content license: Creative Commons 3.0 BY
| Code license: Apache License 2.0
\=========================================================*/

require_once "global.php";

$tpl->Init();

$tpl->Write('
<div id="qtab-container-myfriends" class="qtab-container"><ul>
    <li class="odd">Voc&ecirc; ainda n&atilde;o adicionou amigos</li>
</ul>

<p class="manage-friends"><a href="?/profile/friendsmanagement?tab=6">Gerenciador de Amigos</a></p></div> ');

$tpl->Output();

?>
