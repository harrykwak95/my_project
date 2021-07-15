<?php
class IjdbRoutes
{
    public function callAction($route) 
    {
        include __DIR__ . '/../classes/DatabaseTable.php';
        include __DIR__ . '/../includes/DatabaseConnection.php';

        $jokesTable = new DatabaseTable($pdo, 'joke', 'id');
        $authorTable = new DatabaseTable($pdo, 'author', 'id');

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

?>