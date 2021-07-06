<?php

    //쿼리 간단하게
    function query($pdo, $sql, $parameters=[]) {
        $query = $pdo -> prepare($sql);
        $query->execute($parameters);

        return $query;
    }

    // 테이블 목록 조회
    function allJokes($pdo) {
        $jokes = query($pdo, 'SELECT `joke`.`id`, `joketext`, `name`, `email` FROM `joke` INNER JOIN `author` ON `authorid` = `author`.`id`');
        
        return $jokes->fetchAll();
    }


    // 테이블 글 수 확인
    function totalJokes($pdo) {
        $query = query($pdo, 'SELECT COUNT(*) FROM `joke`');

        $row = $query->fetch();

        return $row[0];
    }
    
    // 유머 검색
    function getJoke($pdo, $id) {
        $parameters = [':id' =>$id];

        $query =query($pdo, 'SELECT * FROM `joke` WHERE `id` = :id', $parameters);
        return $query->fetch();
    }

    // 유머 추가
    function insertJoke($pdo, $joketext, $authorId) {
        $query = 'INSERT INTO `joke` (`joketext`, `jokedate`, `authorId`) VALUES (:joketext, CURDATE(), :authorId)';
        
        $parameters = [':joketext' => $joketext, ':authorId' => $authorId];

        query($pdo, $query, $parameters);
    }

    // 유머 수정
    function updateJoke($pdo, $jokeId, $joketext, $authorId) {
        $parameters = [':joketext' => $joketext, ':authorId' => $authorId, ':id' => $jokeId];

        query($pdo, 'UPDATE `joke` SET `authorId` = :authorId, `joketext` = :joketext WHERE `id` = :id', $parameters);
    }

    // 유머 삭제
    function deleteJoke($pdo, $id) {
        $parameters =[':id' => $id];

        query($pdo, 'DELETE FROM `joke` WHERE `id` = :id', $parameters);
    }
?>