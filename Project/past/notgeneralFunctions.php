<?php
/*
author만 모두 조회
function allAuthors($pdo) {
    $authors = query($pdo, 'SELECT * FROM `author`');

    return $authors->fetchAll();
 */

/*  
author 테이블에만 입력
function insertAuthor($pdo, $fields) {
    $query = 'INSERT INTO `author` (';

    foreach ($fields as $key => $value) {
        $query .= '`' . $key . '`,';
    }

    $query = rtrim($query, ',');

    $query .= ') VALUES (';

    foreach ($fields as $key => $value) {
        $query .= ':' . $key . ',';
    }

    $query = rtrim($query, ',');

    $query .= ')';

    $fields = processDates($fields);

    query($pdo, $query, $fields);
} */

// author 테이블 선택 id 삭제
/* function deleteAuthor($pdo, $id) {
    $parameters = [':id' => $id];

    query($pdo, 'DELETE FROM `author`
    WHERE `id` = :id', $parameters);
} */
?>