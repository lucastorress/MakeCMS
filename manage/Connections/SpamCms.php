<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_SpamCms = "localhost";
$database_SpamCms = "alokdb";
$username_SpamCms = "root";
$password_SpamCms = "88174636";
$SpamCms = mysql_pconnect($hostname_SpamCms, $username_SpamCms, $password_SpamCms) or trigger_error(mysql_error(),E_USER_ERROR); 
?>