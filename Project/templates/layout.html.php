<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/css/jokes.css">
    <title><?=$title?></title>
</head>

<body>
    <header>
        <h1>PHP</h1>
    </header>
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/joke/list">LIST</a></li>
            <li><a href="/joke/edit">ADD</a></li>
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