<?php
namespace Ijdb;

class IjdbRoutes
{
    public function callAction($route) 
    {
        include __DIR__ . '/../../includes/DatabaseConnection.php';


        $jokesTable = new \Hanbit\DatabaseTable($pdo, 'joke', 'id');
        $authorTable = new \Hanbit\DatabaseTable($pdo, 'author', 'id');

        if ($route === 'joke/list') {
            $controller = new \Ijdb\Controller\Joke($jokesTable, $authorTable);
            $page = $controller->list();
        } elseif ($route === '') {
            $controller = new \Ijdb\Controller\Joke($jokesTable, $authorTable);
            $page = $controller->home();
        } elseif ($route === 'joke/edit') {
            $controller = new \Ijdb\Controller\Joke($jokesTable, $authorTable);
            $page = $controller->edit();
        } elseif ($route === 'joke/delete') {
            $controller = new \Ijdb\Controller\Joke($jokesTable, $authorTable);
            $page = $controller->delete();
        } elseif ($route === 'register') {
            $controller = new \Ijdb\Controller\Register($authorTable);
            $page = $controller->showForm();
        }

        return $page;
    } 
}

?>