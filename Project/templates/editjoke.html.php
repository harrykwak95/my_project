<form action="" method="post">
    <input type="hidden" name="jokeid" value="<?=$joke['id'];?>">
    <label for="joketext">유머 글을 입력해주세요: </label>
    <textarea name="joketext" id="joketext" cols="40" rows="3">
    <?=$joke['joketext']?></textarea>
    <input type="submit" value="저장">
</form>

