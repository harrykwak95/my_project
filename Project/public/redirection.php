<?php
    $action = $_GET['action'];

    if ($action == strtolower($action)) {
        $jokeController->$action();
    } else {
        http_response_code(301);
        header('location: index.php?action=' . strtolower($action));
    }
?>