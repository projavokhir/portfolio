<div class="row">
<div class="settings">
	<h4 class="header">Имя компании</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><input type="text" value="%cname%" name="cname" required></div>
		<div><input type="hidden" value="%project-id%" name="project-id"></div>
		<div><input type="submit" value="Изменить" name="edit-company-name"></div>
	</form>
</div>

<div class="settings">
	<h4 class="header">Заголовок проекта</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><input type="text" value="%project-header%" name="project-header" required></div>
		<div><input type="hidden" value="%project-id%" name="project-id"></div>
		<div><input type="submit" value="Изменить" name="edit-project-header"></div>
	</form>
</div>
</div>

<div class="row">
<div class="settings">
	<h4 class="header">Описание проекта</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><textarea name="project-desc">%project-desc%</textarea></div>
		<div><input type="hidden" value="%project-id%" name="project-id"></div>
		<div><input type="submit" value="Изменить" name="edit-project-desc"></div>
	</form>
</div>

<div class="settings">
	<h4 class="header">Теги (<span class="text-required"><span class="red">*</span> запишите через запятую</span> )</h4>
	<h4 class="second-header">Текущее значение:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><input type="text" value="%project-tags%" name="project-tags" required></div>
		<div><input type="hidden" value="%project-id%" name="project-id"></div>
		<div><input type="submit" value="Изменить" name="edit-project-tags"></div>
	</form>
</div>
</div>
<div class="row">
	<div class="settings">
		<h4 class="header">Изображение обложки</h4>
		<h4 class="second-header">Текущое значение:</h4>
		<form action="/scripts/sender_post.php" class="form-group" method='post'>
			<div class="img-block">
				<img src="%project-img%" class="cover-img">
				<div class="edit"><a href="/filemanager/dialog.php?type=2&amp;field_id=pr-img" class="fancy"><i class="fas fa-pen"></i></a></div>
			</div>
			<div><input type="text" value="%project-img%" name="project-img" id="pr-img" required></div>
			<div><input type="hidden" value="%project-id%" name="project-id"></div>
			<div><input type="submit" value="Изменить" name="edit-project-img"></div>
		</form>
	</div>
</div>

<div class="settings">
	<h4 class="header">Все изображении (<span class="text-required"><span class="red">*</span> выберите одно изображение в фаловом менежере</span> )</h4>
	<h4 class="second-header">Текущие значения:</h4>
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><input type="hidden" value="%project-id%" name="project-id"></div>
		<div class="img-block small img-form">
				%project_images%
		</div>
		<br />
		<div class="add-field"><a href="/filemanager/dialog.php?type=2&amp;field_id=" class="fancy">Добавить изображение</a></div>
		<div><input type="submit" value="Изменить" name="edit-project-images"></div>
	</form>
</div>

<div class="settings">
	<button class="delete">Удалить пост</button>
</div>

<div class="message">
	<h4>Удалить пост?</h4>
	<span class="alias">%project-id%</span>
	<button class="yes project">Да</button>
	<button class="no">Нет</button>
</div>