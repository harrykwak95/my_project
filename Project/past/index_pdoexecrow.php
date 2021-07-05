<?php

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8', 'ijdbuser', 'localpassword!@');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'UPDATE joke SET jokedate="2012-04-01"
            WHERE joketext LIKE "%프로그래머%"';
        
        $affectedRows = $pdo->exec($sql);

        $output = '갱신된 row: ' . $affectedRows . ' 개.';

    } 
    catch (ExceptionType $e) {
        $output = '데이터베이스 오류:' . $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/output.html.php';