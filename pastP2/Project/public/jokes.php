<?php

    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/DatabaseTable.php';

        $jokeTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorTable = new DatabaseTable($pdo, 'author', 'id');

        $result = $jokesTable ->findAll();

        $jokes = [];
        foreach ($result as $joke) {
            $author = findById($pdo, 'author', 'id', $joke['authorid']);

            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email'],
                
            ];
        }
        
        $title = '유머 글 목록';

        $totalJokes = $jokesTable->total();

        ob_start();

        include __DIR__ . '/../templates/jokes.html.php';

        $output = ob_get_clean();


    } 
    catch (PDOExceptionType $e) {
        $title = '오류가 발생했습니다.';
        $output = '데이터베이스 오류:' .
                    $e->getMessage() . ', 위치: ' . $e->getFile() . ':' . $e->getLine();
    }

    include __DIR__ . '/../templates/layout.html.php';