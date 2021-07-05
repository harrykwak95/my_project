<?php

    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ijdb;charset=utf8', 'ijdbuser', 'localpassword!@');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = 'SELECT `joketext`, `id` FROM `joke`';
        $jokes = $pdo->query($sql);
        
        $title = '유머 글 목록';

        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        $output = ob_get_clean();


    } 
    catch (ExceptionType $e) {
        $title = '오류가 발생했습니다.';
        $output = '데이터베이스 오류:' .
                    $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';