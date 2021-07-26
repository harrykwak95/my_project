<?php if (empty($joke['id']) || $userId == $joke['authorid']): ?>
<form action="" method="post">
	<input type="hidden" name="joke[id]" value="<?=$joke['id'] ?? ''?>">
    <label for="joketext">TEXT PLEASE: </label>
    <textarea id="joketext" name="joke[joketext]" rows="3" cols="40"><?=$joke['joketext'] ?? ''?></textarea>
    <input type="submit" name="submit" value="SAVE">
</form>
<?php else: ?>

<p>ONLY YOURS CAN BE USED</p>

<?php endif; ?>