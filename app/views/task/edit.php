<div class="col-12" style="margin: 25px 0">
	<h1><a href="/">&laquo;</a> Изменение задачи <?= @$task['id'] ?></h1>
</div>
<div class="col-md-6">
	<div class="card" style="margin-bottom: 26px">
		<div class="card-header"><?= $task['email'] ?></div>
		<div class="card-body">
			<h5 class="card-title"><?= $task['name'] ?></h5>
			<form action="/task/update" method="POST">
				<div class="form-group">
					<textarea name="content" required class="form-control" id="content" rows="3"><?= $task['content'] ?></textarea>
				</div>
				<div class="form-group form-check">
					<input name="done" type="checkbox" class="form-check-input" id="done" value="1" <? if ($task['done']) echo "checked" ?>>
					<label class="form-check-label" for="done">Выполнено</label>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Сохрнить изменения</button>
				</div>
				<input type="hidden" name="oldContent" value="<?= $task['content'] ?>">
				<input type="hidden" name="id" value="<?= $task['id'] ?>">
				<input type="hidden" name="page" value="<?= $_GET['page'] ?>">
				<input type="hidden" name="sort" value="<?= $_GET['sort'] ?>">
				<input type="hidden" name="order" value="<?= $_GET['order'] ?>">
			</form>
		</div>
	</div>
</div>