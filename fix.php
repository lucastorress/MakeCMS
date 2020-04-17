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

$db_host = "localhost";    //Host database
$db_user = "root";        //mysql_user
$db_pass = "wicherqwerty345";        //mysql_password
$db_database = "beta";    //database

$connect = mysql_connect($db_host, $db_user, $db_pass) or die("Could not connect to server, error: ".mysql_error());
$db = mysql_select_db($db_database, $connect) or die("Could not connect to database, error: ".mysql_error());

$data = file_get_contents("http://hotel-us.habbo.com/gamedata/furnidata/01cb91ad94bc1bc13d34c2ad93c0567714eac846?hash=x");
$data = str_replace("\n", "", $data);
$data = str_replace("[[", "[", $data);
$data = str_replace("]]", "]", $data);
$data = str_replace("][", "],[", $data);


foreach (explode('],[', $data) as $val)
{
    $val = str_replace('[', '', $val);
    $val = str_replace(']', '', $val);
    
    $bits = explode(',', $val);
    $name = str_replace('"', '', $bits[2]);
    
    $stufftoupdate[] = '[' . $val . ']';
}

foreach ($stufftoupdate as $stuff)
    {
        #Start select item_name
        $stuff = str_replace('"s",', '', $stuff);
        $stuff = str_replace('"i",', '', $stuff);
        $furni = explode('[', $stuff);
        $furni = explode(']', $furni[1]);
        $nome = explode('","', $furni[0]);
        $nome = explode('","', $nome[1]);
        $nome = $nome[0];
        #End select item_name
        
        #Start select sprite_id
        $stuff = str_replace('"s",', '', $stuff);
        $stuff = str_replace('"i",', '', $stuff);
        $furni = explode('[', $stuff);
        $furni = explode(']', $furni[1]);
        $id = explode('"', $furni[0]);
        $id = explode('","', $id[1]);
        $id = $id[0];
        #End select sprite_id
        
        
        $idfurni = mysql_query("SELECT * FROM furniture WHERE item_name = '$nome'");
        $furni = mysql_fetch_array($idfurni);
        $furniid = $furni['id'];
        $update = mysql_query("UPDATE furniture SET sprite_id = ".$id." WHERE id =".$furniid);
        if ($update==FALSE) echo("MySQL error in item ".$nome."<br/><br/>");
        else echo("Item ".$nome." updated<br/><br/>");
    }
?> 