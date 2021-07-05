<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>출력 내용</title>
</head>
<body>
    <?php if (isset($error)): ?>
    <p>
        <?=$error; ?>
    </p>
    <?php else: ?>
    <?php foreach ($jokes as $joke): ?>
    <blockquote>
        <p>
        <?=htmlspecialchars($joke, ENT_QUOTES, 'UTF-8') ?>
        </p>
    </blockquote>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>