<div class="container">
	<div class="row">
		<a href="/">Главная</a>
		<?php if($mLog) : ?>
		<form method="post">
			Название<br>
			<input type="text" name="title" value="<?php echo $post['title'] != '' ? $post['title'] : ''; ?>"><br>
			Контент<br>
			<textarea rows="15" cols="100" name="content"><?php echo $post['text'] != '' ? $post['text'] : ''; ?></textarea><br>
			<input type="submit" value="Добавить">
		</form>
		<?php else : ?>
			<div>Вы не авторизованы</div>
		<?php endif; ?>
	</div>
</div>