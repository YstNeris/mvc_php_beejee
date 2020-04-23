<div class="col-12" style="margin: 25px 0">
	<h1>Список задач</h1>
</div>
<div class="col-12 col-md-6">
	<?php if (@$taskCount > 3) : ?>
		<nav>
			<ul class="pagination">
				<li class="page-item<?php if ($_GET['page'] <= 1) echo ' disabled' ?>"><a class="page-link" href="<?php if ($_GET['page'] >= 1) echo lnk('/', ['page' => $_GET['page'] - 1]); ?>" aria-label="Previous">&laquo;</a></li>
				<?php for ($i = 1; $i <= $maxPage; $i++) : ?>
					<li class="page-item<?php if ($_GET['page'] == $i) echo ' active' ?>"><a class="page-link" href="<?= lnk('/', ['page' => $i]) ?>"><?= $i ?></a></li>
				<?php endfor ?>
				<li class="page-item<?php if ($_GET['page'] >= $maxPage) echo ' disabled' ?>"><a class="page-link" href="<?php if ($_GET['page'] <= $maxPage) echo lnk('/', ['page' => $_GET['page'] + 1]); ?>" aria-label="Next">&raquo;</a></li>
			</ul>
		</nav>
	<? endif ?>
</div>
<div class="col-12 col-md-6">
	<?php if (@$taskCount > 1) : ?>
		<div class="btn-group" role="group" aria-label="Basic example" style="height: 38px; margin-bottom: 25px; color: #FFF;">
			<?php foreach ($sortArr as $key => $value) : ?>
				<a href="<?= lnk('/', ['order' => $_GET['sort'] == $key && $_GET['order'] == 'ASC' ? 'DESC' : 'ASC', 'sort' => $key]) ?>" class="btn btn<? if ($_GET['sort'] != $key) echo '-outline' ?>-primary"><?= $value ?> <?= $_GET['sort'] == $key && $_GET['order'] == "DESC" ? '▴' : '▾' ?></a>
			<?php endforeach; ?>
		</div>
	<? endif ?>
</div>
<div class="col-md-6">
	<?php if (@$_GET['success'] == "add") : ?>
		<div class="alert alert-success" role="alert">Задача успешно дабавлена</div>
	<?php elseif (@$_GET['success'] == "update") : ?>
		<div class="alert alert-success" role="alert">Изменения успешно сохранены</div>
	<?php elseif (@$_GET['success'] == "login") : ?>
		<div class="alert alert-success" role="alert">Вы успешно авторизовались</div>
	<?php endif ?>
	<div class="card" style="margin-bottom: 25px">
		<div class="card-header">Добавить новую задачу</div>
		<div class="card-body">
			<form action="/task/add" method="POST">
				<div class="form-group">
					<label for="email">Email</label>
					<input name="email" required type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите эл. почту">
				</div>
				<div class="form-group">
					<label for="name">Имя</label>
					<input name="name" required type="name" class="form-control" id="name" placeholder="Введите имя">
				</div>
				<div class="form-group">
					<label for="content">Содержимое задачи</label>
					<textarea name="content" required class="form-control" id="content" rows="3"></textarea>
				</div>
				<input type="hidden" name="page" value="<?= $_GET['page'] ?>">
				<input type="hidden" name="sort" value="<?= $_GET['sort'] ?>">
				<input type="hidden" name="order" value="<?= $_GET['order'] ?>">
				<button type="submit" class="btn btn-primary">Добавить задачу</button>
			</form>
		</div>
	</div>
</div>
<div class="col-md-6">
	<?php foreach ($tasks as $task) : ?>
		<div class="card" style="margin-bottom: 26px">
			<div class="card-header d-flex align-items-center justify-content-between">
				<span>
					<span><?= @$task['email'] ?></span>
					<?php if (@$task['done']) : ?>
						<span class="badge badge-success">Выполнено</span>
					<?php else : ?>
						<span class="badge badge-danger">Не выполнено</span>
					<?php endif ?>
				</span>
				<? if (@$_SESSION['user']) : ?>
					<a href="<?= lnk('/edit', ['task' => $task['id']]) ?>" class="btn btn-sm btn-outline-primary">✏</a>
				<? endif  ?>
			</div>
			<div class="card-body">
				<h5 class="card-title">
					<span><?= @$task['name'] ?></span>
					<?php if (@$task['edited']) : ?>
						<span class="badge badge-pill badge-secondary">Изменено</span>
					<?php endif ?>
				</h5>
				<p class="card-text"><?= htmlentities($task['content']) ?></p>
			</div>
		</div>
	<?php endforeach ?>
</div>