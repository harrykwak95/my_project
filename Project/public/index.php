<?php
function loadTemplate($templateFileName, $variables =[])
{
    extract($variables);

    ob_start();
    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean();
}

try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
    $authorTable = new DatabaseTable($pdo, 'author', 'id');

    // route 변수 없을 시 'joke/home' 할당


    $route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

    if ($route == strtolower($route)) {
        if ($route === 'joke/list') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorTable);
            $page = $controller->list();
        } elseif ($route === '') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorTable);
            $page = $controller->home();
        } elseif ($route === 'joke/edit') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorTable);
            $page = $controller->edit();
        } elseif ($route === 'joke/delete') {
            include __DIR__ . '/../controllers/JokeController.php';
            $controller = new JokeController($jokesTable, $authorTable);
            $page = $controller->delete();
        } elseif ($route === 'register') {
            include __DIR__ . '/../controllers/RegisterController.php';
            $controller = new RegisterController($authorTable);
            $page = $controller->showForm();
        }
    }
    else {
        http_response_code(301);
        header('location: ' . strtolower($route));
    }

    $title = $page['title'];

    if (isset($page['variables'])) {
        $output = loadTemplate($page['template'], $page['variables']);
    } else {
        $output = loadTemplate($page['template']);
    }
} catch (PDOException $e) {
    $title = '오류가 발생했습니다.';

    $output = '데이터베이스 오류: ' . $e->getMessage() . ', 위치' . $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/layout.html.php';