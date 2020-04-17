<?php
/*=======================================================================
| WareCMS - Sistema avançado de Administração de CMS
| #######################################################################
| Copyright (c) 2010, Lucas Reis & Dcr-Host
| #######################################################################
| Este programa é um FreeSoftware aonde você pode editar os conteúdos
| com os direitos autorais do editor.
| #######################################################################
| Este programa foi editado traduzido por Lucas Reis, créditos totais
| para Meth0d, autor original do programa.
\======================================================================*/

header("Content-type: image/png");
echo file_get_contents("banned/" . rand(1, 6) . ".png");

?>