<p><?=$totalJokes?> DOCUMENTS.</p>
<?php foreach ($jokes as $joke): ?>
<blockquote>
    <p>
        <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>

        (WRITTER: <a href="mailto:<?php echo htmlspecialchars($joke['email'], ENT_QUOTES, 'UTF-8');  ?> ">
            <?php echo htmlspecialchars($joke['name'], ENT_QUOTES, 'UTF-8'); ?></a>
            WRITTEN DATE:<?php
                $date = new DateTime($joke['jokedate']);
                echo $date->format(' jS F Y'); ?>)
            

        <a href="/joke/edit?id=<?=$joke['id']?>">EDIT</a>

        <form action="/joke/delete" method="post">
        <input type="hidden" name="id" value="<?=$joke['id']?>">
        <input type="submit" value="삭제">
    </form>
    </p>
</blockquote>
<?php endforeach; ?>