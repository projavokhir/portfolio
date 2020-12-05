<form action="/scripts/sender_post.php" class="form-group" method='post'>
  <input type="hidden" name="id" value="%id%">
<div class="settings">
  <button class="delete">Удалить вакансию</button>
</div>
<div class="row">
<div class="settings" style="width:800px;float:none;">
	<h4 class="header">Имя вакансии</h4>
  <h4 class="second-header">Текущое значение:</h4>
		<div><input type="text" name="vname" value="%vac-name%" required></div>
<br /><br />
	<h4 class="header">Обязанности</h4>
  <h4 class="second-header">Текущое значение:</h4>
		<div><textarea name="duties" class="tiny">%duties%</textarea></div>
<br /><br />
	<h4 class="header">Требования</h4>
  <h4 class="second-header">Текущое значение:</h4>
		<div><textarea name="requirements" class="tiny">%reqs%</textarea></div>
<br /><br />
	<h4 class="header">Условия</h4>
  <h4 class="second-header">Текущое значение:</h4>
	<div><textarea name="conditions" class="tiny">%conds%</textarea></div>
	<div><input type="submit" value="Изменить" name="edit-vacancy"></div>
</div>
</div>
</form>

<div class="message">
  <h4>Удалить пост?</h4>
  <span class="alias">%id%</span>
  <button class="yes vacancy">Да</button>
  <button class="no">Нет</button>
</div>

<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'.tiny',
  height: 300,
  width: 700,
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