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
<div id="qtab-container-myrooms" class="qtab-container">


<p class="create-room"><a href="%www%/client?shortcut=roomomatic" onclick="HabboClient.openShortcut(this, "roomomatic"); return false;" target="f480473c417559bfc4a8af13ba39ce2e1da2fcf9">Crie um Quarto gr&aacute;tis</a></p>
</div>');

$tpl->Output();

?>
