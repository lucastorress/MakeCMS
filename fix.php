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