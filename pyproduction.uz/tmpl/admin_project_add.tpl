<form action="/scripts/sender_post.php" class="form-group" method='post'>
<div class="row">
<div class="settings">
	<h4 class="header">Имя компании</h4>
	<h4 class="second-header">Текущее значение:</h4>
		<div><input type="text" name="cname" required></div>
</div>

<div class="settings">
	<h4 class="header">Заголовок проекта</h4>
	<h4 class="second-header">Текущее значение:</h4>
		<div><input type="text" name="project-header" required></div>
</div>
</div>

<div class="row">
<div class="settings">
	<h4 class="header">Описание проекта</h4>
	<h4 class="second-header">Текущее значение:</h4><br />
		<div><textarea name="project-desc" id="tiny"></textarea></div>
</div>

<div class="settings">
	<h4 class="header">Теги (<span class="text-required"><span class="red">*</span> запишите через запятую</span> )</h4>
	<h4 class="second-header">Текущее значение:</h4>
		<div><input type="text" name="project-tags" required></div>
</div>
</div>
<div class="row">
	<div class="settings">
		<h4 class="header">Изображение обложки</h4>
		<h4 class="second-header">Текущее значение:</h4>
			<div class="img-block">
				<img src="/%main_dir%admin/img/photo_bg.png" class="cover-img">
				<div class="edit"><a href="/filemanager/dialog.php?type=2&amp;field_id=pr-img" class="fancy"><i class="fas fa-pen"></i></a></div>
			</div>
			<div><input type="hidden" value="" name="project-img" id="pr-img" required></div>
	</div>
</div>

<div class="settings">
	<h4 class="header">Все изображении (<span class="text-required"><span class="red">*</span> выберите одно изображение в фаловом менежере</span> )</h4>
	<h4 class="second-header">Текущие значения:</h4>
		<div class="img-block small img-form">
		</div>
		<br />
		<div class="add-field"><a href="/filemanager/dialog.php?type=2&amp;field_id=1" class="fancy">Добавить изображение</a></div>
		<div><input type="submit" value="Изменить" name="add-project"></div>
</div>
</form>

<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'#tiny',
  height: 300,
  width: "auto",
  plugins: [
      "advlist autolink lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern imagetools" 
  ],
  language: 'ru',
  toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link",
  toolbar2: "preview | forecolor backcolor emoticons | responsivefilemanager",
});
</script>