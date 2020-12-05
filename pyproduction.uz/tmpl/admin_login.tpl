<div class="admin-login">
	<h4 class="login-header">Вход в панель</h4>
	<div class="main">
		
		<form action="/admin" id="login-form" method="POST">
			<div class="admin-message">%message%</div>
			<p>Логин</p>
			<input type="text" name="username" required>
			<p>Пароль</p>
			<input type="password" name="password" required><br />
			<div class="submit-cont">
				<input type="submit" name="login" value="Войти">
			</div>
		</form>
		<p >
			<a href="/admin/register">Зарегистрировать</a>&nbsp; | &nbsp;<a href="/admin/remind">Забыли пароль?</a>
		</p>
		<p class="security">Secured by Proof Systems</p>
	</div>
</div>