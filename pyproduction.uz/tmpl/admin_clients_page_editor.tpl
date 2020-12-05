<div class="row">
	<div class="settings">
		<h4 class="header">Загаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%services-header%" name="clients-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-clients-h"></div>
		</form>
	</div>
	<div class="settings">
		<h4 class="header">Подзагаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%services-s-header%" name="clients-s-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-clients-s-h"></div>
		</form>
	</div>
	<div class="settings list-clients">
		<h4 class="header">Список клиентов</h4>
			<ul class="services-list">
				%list%
				<br />
				<li class="service"><a href="/admin/clients/add" style="text-align:center;">Добавить</a></li>
			</ul>
	</div>
</div>