<div class="col-12 col-md-6 col-auto" style="padding-top: 25px">
	<?php if (@$_GET['code'] == "error") : ?>
		<div class="alert alert-danger" role="alert">Неверный логин или пароль</div>
	<?php endif ?>
	<div class="card">
		<div class="card-header">Авторизация</div>
		<div class="card-body">
			<form method="POST">
				<div class="form-group">
					<label for="login">Логин</label>
					<input name="login" type="login" class="form-control" id="login" placeholder="Введите логин">
				</div>
				<div class="form-group">
					<label for="password">Пароль</label>
					<input name="password" type="password" class="form-control" id="password" placeholder="Введите пароль">
				</div>
				<button type="submit" class="btn btn-primary">Войти</button>
			</form>
		</div>
	</div>
</div>