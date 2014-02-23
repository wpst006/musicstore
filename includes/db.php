<?php
mysql_connect($database['host'], $database['username'], $database['password']) or die(mysql_error());
mysql_select_db($database['database']) or die(mysql_error());
?>