<?php
$dsn = "mysql:host=localhost;port=3306;dbname=workskill;charset=utf8";
$dbUser = trim("root");
$dbPassword = "";
$dbo = new PDO($dsn, $dbUser, $dbPassword);
