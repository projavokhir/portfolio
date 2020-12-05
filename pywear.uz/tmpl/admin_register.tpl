<div class="admin-login register">
<h4 class="login-header">Регистрация</h4>
<div class="main">
	<form action="/admin/register" id="login-form" method="POST">
		<div class="admin-message">%message%</div>
		<p>Имя/Фамилия</p>
		<input type="text" name="username" required>
		<p>E-mail</p>
		<input type="email" name="email" required>
		<p>Логин</p>
		<input type="text" name="log_name" required>
		<p>Пароль</p>
		<input type="password" name="password" required><br />
		<p>Подтверждение пароля</p>
		<input type="password" name="re_password" required><br />
		<p>Секретный код</p>
		<input type="password" name="secret" required>
		<p class="secret-code">У вас нет секретный код? Сообщите об этом на <a href="mailto:prostojparen.java@gmail.com">prostojparen.java@gmail.com</a></p>
		<br />
		<div class="submit-cont">
			<input type="submit" name="register" value="Зарегистрироваться">
		</div>
	</form>
	<p>
		<a href="/admin">Войти в панель</a>
	</p>
	<p class="security">Secured by Proof Systems</p>
</div>
</div>