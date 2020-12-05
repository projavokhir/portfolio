<div class="admin-login register">
<h4 class="login-header">Восстановление пароля</h4>
<div class="main">
	<form action="/admin/remind" id="login-form" method="POST">
		<div class="admin-message">%message%</div>
		<p>E-mail</p>
		<input type="email" name="email" required>
		<p>Секретный код</p>
		<input type="password" name="secret" required>
		<p class="secret-code">У вас нет секретный код? Сообщите об этом на <a href="mailto:prostojparen.java@gmail.com">prostojparen.java@gmail.com</a></p>
		<br />
		<div class="submit-cont">
			<input type="submit" name="remind" value="Запросить">
		</div>
	</form>
	<p>
		<a href="/admin">Войти в панель</a>
	</p>
	<p class="security">Secured by Proof Systems</p>
</div>
</div>