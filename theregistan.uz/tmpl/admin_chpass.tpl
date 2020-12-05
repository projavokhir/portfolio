<div class="admin-login">
	<h4 class="login-header">Изменить пароль</h4>
	<div class="main">
		
		<form action="/admin/chpass" id="login-form" method="POST">
			<p>Новый пароль</p>
			<input type="password" name="new_pass" required>
			<p>Подтверждение пароля</p>
			<input type="password" name="re_pass" required><br />
			<div class="submit-cont">
				<input type="submit" name="ch_pass" value="Изменить">
			</div>
		</form>
		<p class="security">Secured by Proof Systems</p>
	</div>
</div>