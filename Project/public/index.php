<?php

try {
    include __DIR__ . '/../classes/EntryPoint.php';
    include __DIR__ . '/../classes/IjdbRoutes.php';

    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    $entryPoint = new EntryPoint($route, new IjdbRoutes());
    $entryPoint->run();
} catch (PDOException $e) {
    $title = '오류가 발생했습니다.';

    $output = '데이터베이스 오류: ' . $e->getMessage() . ', 위치' . $e->getFile() . ':' . $e->getLine();
    
    include __DIR__ . '/../templates/layout.html.php';
}
