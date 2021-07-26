<?php if (isset($error)):?>
	<div class="errors"><?=$error;?></div>
<?php endif; ?>
<form method="post" action="">
	<label for="email">EMAIL</label>
	<input type="text" id="email" name="email">

	<label for="password">PASSWORD</label>
	<input type="password" id="password" name="password">

	<input type="submit" name="login" value="LOGIN">
</form>