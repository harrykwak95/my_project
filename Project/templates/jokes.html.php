
<p><?=$totalJokes?> DOCU EXIST</p>

<?php foreach($jokes as $joke): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($joke['joketext'], ENT_QUOTES, 'UTF-8')?>

    (EDITOR): <a href="mailto:<?=htmlspecialchars($joke['email'], ENT_QUOTES,
                    'UTF-8'); ?>">
                <?=htmlspecialchars($joke['name'], ENT_QUOTES,
                    'UTF-8'); ?></a> EDIT_DATE:  
<?php
$date = new DateTime($joke['jokedate']);

echo $date->format('jS F Y');
?>)

<?php if ($userId == $joke['authorid']): ?>
  <a href="/joke/edit?id=<?=$joke['id']?>">EDIT</a>
  <form action="/joke/delete" method="post">
    <input type="hidden" name="id" value="<?=$joke['id']?>">
    <input type="submit" value="DELETE">
  </form>
<?php endif; ?>
  </p>
</blockquote>
<?php endforeach; ?>