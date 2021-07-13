<?php
class EntryPoint
{
    private $route;

    public function __construct($route)
    {
        $this->route = $route;        
        $this->checkUrl();        
    }

    private function checkUrl() {
        if ($this->route !== strtolower($this->route)) {
            http_response_code(301);
            header('location: ' . strtolower($this->route));
        }
    }

    private function loadTemplate($templateFileName, $variables =[]) {
    extract($variables);

    ob_start();
    include __DIR__ . '/../templates/' . $templateFileName;

    return ob_get_clean();
    }

    private function callAction() {
        include __DIR__ . '/../classes/DatabaseTable.php';
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorTable = new DatabaseTable($pdo, 'author', 'id');

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

            return $page;
        }
    }

    public function run() {
        $page = $this->callAction();

        $title = $page['title'];

        if (isset($page['variables'])) {
            $output = $this -> loadTemplate($page['template'], $page['variables']);
        }
        else {
            $output = $this -> loadTemplate($page['template']);
        }

        include __DIR__ . '/../templates/layout.html.php';
    }

}