<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/jokes.css">
    <title><?=$title?></title>
</head>

<body>
    <header>
        <h1>유머</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="index.php?action=list">유머 목록</a></li>
            <li><a href="index.php?action=edit">유머 등록</a></li>
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