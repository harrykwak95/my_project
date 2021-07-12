<?php
// DB 접속
$pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8', 'ijdbuser', 'localpassword!@');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);