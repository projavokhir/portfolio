<div class="row">
	<div class="settings">
		<h4 class="header">Загаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%services-header%" name="services-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-services-h"></div>
		</form>
	</div>
	<div class="settings">
		<h4 class="header">Подзагаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%services-s-header%" name="services-s-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-services-s-h"></div>
		</form>
	</div>
	<div class="settings">
		<h4 class="header">Список услуг</h4>
			<ul class="services-list">
				%list%
				<li class="service"><a href="/admin/services/add">Добавить услугу</a></li>
			</ul>
	</div>
</div>