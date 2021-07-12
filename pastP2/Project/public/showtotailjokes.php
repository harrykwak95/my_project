<?php

// $pdo 변수 생성 데이터베이스 접속
include_once __DIR__ . '/../includes/DatabaseConnection.php';

// totalJokes() 함수 선언된 인클루드 파일
include_once __DIR__ . '/../includes/DatabaseFunctions.php';

//함수 호출
echo totalJokes($pdo);
echo '<br/>';

$joke1 = getJoke($pdo, 9);
echo $joke1['joketext'];

?>