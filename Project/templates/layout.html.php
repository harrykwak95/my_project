<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="jokes.css">
    <title><?=$title?></title>
</head>
<body>
    <header>
        <h1>유머</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="jokes.php">유머</a></li>
            <li><a href="addjoke.php">유머 글 추가</a></li>
        </ul>
    </nav>

    <main>
        <?=$output?>
    </main>

    <footer>
        &copy; IJDB 2017;
    </footer>
</body>
</html>