<?php foreach ($posts as $post) : ?>
	<div>
		<h2><a href="/post/<?=$post['id'];?>"><?=$post['title'];?></a></h2>
	</div>
<?php endforeach; ?>
	<?php if($mLog): ?>
		<div>
			<a href="/post/add/">Добавить новую статью</a>
		</div>
	<?php endif; ?>
	<?php if(!$mLog): ?>
		<div>
			<a href="/login/">Авторизация</a>
		</div>
	<?php endif; ?>	
	<div>
		<a href="/?log=end">Выйти с аккаунта</a>
	</div>