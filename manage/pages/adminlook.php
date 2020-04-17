<?php
if (!defined('IN_HK') || !IN_HK)
{
    exit;
}

if (!HK_LOGGED_IN || !$users->hasFuse(USER_ID, 'fuse_housekeeping_moderation'))
{
    exit;
}

$name = '';

if (isset($_POST['user'])) { $name = filter($_POST['user']); }
require_once "top.php";

echo("<h1>Visualizar Usuário</h1>
<br /><p>Visualize o usuário e depois edite-o.</p>");
echo '<br />
<form method="post">
Usuário:<br />
<input type="text" name="user"><Br />
<input type="submit" value="Visualizar">
</form>';
if (isset($name))
{
if (!$_POST['update'])
{
$users = mysql_query("SELECT * from users where username = '$name'");
$user = mysql_fetch_array($users);
echo("<div align=\"center\"><form method=\"POST\">
<table width=\"100%\">
<tr>
<td align=\"right\" width=\"25%\">
Usuário
</td>
<td align=\"left\">
$user[username]
<input type=\"hidden\" name=\"username\"
value=\"$user[username]\">
</td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Nome na vida real
</td>
<td align=\"left\">
<input type=\"text\" size=\"25\" maxlength=\"25\" name=\"real_name\"
value=\"$user[real_name]\"></td>
</tr>
<td align=\"right\" width=\"25%\">
Criado no dia
</td>
<td align=\"left\">
$user[account_created]
</td>
</tr>
<td align=\"right\" width=\"25%\">
A ultima visita foi
</td>
<td align=\"left\">
$user[last_online]
</td>
</tr>
<td align=\"right\" width=\"25%\">
IP
</td>
<td align=\"left\">
$user[ip_last]
</td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Cargo
</td>
<td align=\"left\">
<input type=\"text\" size=\"25\" maxlength=\"25\" name=\"rank\"
value=\"$user[rank]\"></td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Moedas
</td>
<td align=\"left\">
<input type=\"text\" size=\"25\" maxlength=\"25\" name=\"credits\"
value=\"$user[credits]\"></td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
E-mail
</td>
<td align=\"left\">
<input size=\"25\" name=\"mail\" value=\"$user[mail]\"></td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Auth Ticket
</td>
<td align=\"left\">
<input size=\"25\" name=\"auth_ticket\" value=\"$user[auth_ticket]\"></td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Missão
</td>
<td align=\"left\">
<input size=\"25\" name=\"motto\"  value=\"$user[motto]\"></td>
</tr>
<tr>
<td align=\"right\" width=\"25%\">
Pixels</td>
<td align=\"left\">
<input size=\"25\"  name=\"pixels\" value=\"$user[activity_points]\"></td>
</tr>
<tr>
<td align=\"center\">
</td>
<td align=\"left\">
<input type=\"submit\" name=\"update\" value=\"Atualizar\"></td>
</tr>
</table>
</form>
</div>");
}
else
{
$username = htmlspecialchars($_POST['username']);
$real_name = htmlspecialchars($_POST['real_name']);
$motto = htmlspecialchars($_POST['motto']);
$mail = htmlspecialchars($_POST['mail']);
$auth_ticket = htmlspecialchars($_POST['auth_ticket']);
$credits = htmlspecialchars($_POST['credits']);
$rank = htmlspecialchars($_POST['rank']);
$pixels = htmlspecialchars($_POST['pixels']);
echo ("<br /><br />$username's foi atualizado com sucesso.");
$update = mysql_query("Update users set real_name = '$real_name', mail = '$mail', auth_ticket = '$auth_ticket', motto = '$motto',
credits = '$credits', rank = '$rank', activity_points = '$pixels' where username = '$username'");
}
}
require_once "bottom.php";
?>
