<div class="container">
	<div class="row">
		<a href='/'>Главная</a><br>
		<?php if($mLog) : ?>
		<form method="post">
			Имя<br>
			<input type="text" name="title" value="<?=$title;?>"><br>
			Комментарий<br>
			<textarea name="text"><?=$text;?></textarea><br>
			<input type="submit" value="Отправить">
		</form>
		<?php else : ?>
			<div>Вы не авторизованы</div>
		<?php endif; ?>
	</div>
</div>