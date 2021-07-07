<?php

// 쿼리 간편화
function query($pdo, $sql, $parameters=[]) {
    $query = $pdo -> prepare($sql);
    $query->execute($parameters);

    return $query;
}


 // 선택 테이블 조회
function findAll($pdo, $table) {
    $result = query($pdo, 'SELECT * FROM `' . $table . '`');

    return $result->fetchAll();
}


// 테이블 선택, 원하는 대상 삭제
function delete($pdo, $table, $primarykey, $id) {
    $parameters = [':id' => $id];

    query($pdo, 'DELETE FROM `' . $table . '`
    WHERE `' . $primarykey . '` = :id', $parameters);
}

// 테이블 선택, 원하는 필드 삽입
function insert($pdo, $table, $fields) {
    $query = 'INSERT INTO `' . $table . '` (';
    
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
}

// 테이블 선택, 원하는 대상 수정
function update($pdo, $table, $primarykey, $fields) {
    $query = ' UPDATE `' . $table . '` SET ';

    foreach ($fields as $key => $value) {
        $query .= '`' . $key . '` = :' . $key . ',';
    }

    $query = rtrim($query, ',');
    $query .= ' WHERE `' . $primarykey . '` = :primarykey';
    // :primaryKey 변수 설정
    $fields['primarykey'] = $fields['id'];

    $fields = processDates($fields);

    query($pdo, $query, $fields);
}

// 테이블 선택, 원하는 대상 검색
function findById($pdo, $table, $primarykey, $value) {
    $query = 'SELECT * FROM `' . $table . '`
            WHERE `'. $primarykey . '` =:value';

    $parameters = [
        'value' => $value
    ];

    $query = query($pdo, $query, $parameters);

    return $query->fetch();
}


// 테이블 선택, 총 게시글 수

function total($pdo, $table) {
    $query = query($pdo, 'SELECT COUNT(*)
    FROM `' . $table . '`');

    $row = $query->fetch();

    return $row[0];
}

// 날짜 포맷 설정
function processDates($fields) {
    foreach ($fields as $key => $value) {
        if($value instanceof DateTime) {
            $fields[$key] = $value->format('Y-m-d H:i:s');
        }
    }

    return $fields;
}

function save($pdo, $table, $primarykey, $record) {
    try {
        if ($record[$primarykey] == '') {
            $record[$primarykey] = null;
        }
        insert($pdo, $table, $record);
    }
    catch (PDOException $e) {
        update($pdo, $table, $primarykey, $record);
    }
}


?>