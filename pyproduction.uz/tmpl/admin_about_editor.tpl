<div class="row">
	<div class="settings">
		<h4 class="header">Загаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%about-header%" name="about-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-about-h"></div>
		</form>
	</div>
	<div class="settings">
		<h4 class="header">Подзагаловок страницы</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%about-s-header%" name="about-s-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-about-s-h"></div>
		</form>
	</div>
		<div class="settings">
		<h4 class="header">Подзагаловок вакансий</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div><input type="text" value="%vac-s-header%" name="vac-s-header" required></div>
			<div><input type="submit" value="Изменить" name="edit-vac-s-header"></div>
		</form>
	</div>
	<div class="settings">
		<h4 class="header">Описание "О компании"</h4>
		<ul class="services-list">
			%list_blocks%
		</ul>
	</div>
</div>
<div class="settings">
	<h4 class="header">Блоки "О компании"</h4>
	<ul class="services-list">
		%list_blocks_2%
		<li class="service"><a href="/admin/about/add_block">Добавить блок</a></li>
	</ul>
</div>
<div class="settings">
	<h4 class="header">Вакансии</h4>
	<ul class="services-list">
		%list_vacancies%
		<br />
		<li class="service"><a href="/admin/vacancy/add">Добавить вакансию</a></li>
	</ul>
</div>