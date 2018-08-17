<?php  ?>
<div class="container">
	<div class="row">
		<a href="/">Главная</a>
		<div>
			<a href="edit/<?php echo $post['id']; ?>">Редактировать</a><br>
			<h3 class="title-art"><?=$post['title'];?></h3>
			<div class="text-art"><?=$post['text'];?><br></div>
		</div>
	</div>
</div>