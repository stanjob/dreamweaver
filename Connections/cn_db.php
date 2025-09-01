<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_cn_db = "localhost";
$database_cn_db = "db1";
$username_cn_db = "root";
$password_cn_db = "";
$cn_db = mysql_pconnect($hostname_cn_db, $username_cn_db, $password_cn_db) or trigger_error(mysql_error(),E_USER_ERROR); 
mysql_query("SET NAMES utf8");
?>