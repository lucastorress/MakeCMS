<body onload="timer=setTimeout('move()',2000)">
<script language="JavaScript">
var time = null
function move() {
window.location = 'http://stage-hotel.sytes.net:90'
}
</script>
<?php
$con = mysql_connect("localhost","root","wicherqwerty345");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("beta", $con);

$sql="INSERT INTO support_ticket (username, email, problem)
VALUES
('$_POST[username]','$_POST[email]','$_POST[problem]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "
Te enviaremos un email lo mas pronto posible.

Gracias por usar nuestro sistema de ayuda. Un staff lo ayudara pronto.";

mysql_close($con)

?>
