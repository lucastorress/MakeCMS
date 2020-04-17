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

class RoomManager
{
	public static function CreateRoom($name, $owner, $model)
	{
		dbquery("INSERT INTO rooms (roomtype,caption,owner,state,model_name) VALUES ('private','" . filter($name) . "','" . $owner . "','open','" . $model . "')");
		return intval(mysql_result(dbquery("SELECT id FROM rooms WHERE owner = '" . $owner . "' ORDER BY id DESC LIMIT 1"), 0));
	}
	
	public static function PaintRoom($roomId, $wallpaper, $floor)
	{
		dbquery("UPDATE rooms SET wallpaper = '" . $wallpaper . "', floor = '" . $floor . "' WHERE id = '" . $roomId . "' LIMIT 1");
		return (mysql_affected_rows() > 0) ? true : false;
	}
	
	public static function GetRoomVar($roomId, $var)
	{
		return mysql_result(dbquery("SELECT " . $var . " FROM rooms WHERE id = '" . $roomId . "' LIMIT 1"), 0);
	}
}

?>