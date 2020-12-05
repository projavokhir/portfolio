<form action="/scripts/sender_post.php" class="form-group" method='post'>
<div class="row">
<div class="settings" style="width:800px;float:none;">
	<h4 class="header">Имя вакансии</h4>
		<div><input type="text" name="vname" required></div>
<br /><br />
	<h4 class="header">Обязанности</h4>
		<div><textarea name="duties" class="tiny"></textarea></div>
<br /><br />
	<h4 class="header">Требования</h4>
		<div><textarea name="requirements" class="tiny"></textarea></div>
<br /><br />
	<h4 class="header">Условия</h4>
	<div><textarea name="conditions" class="tiny"></textarea></div>
	<div><input type="submit" value="Добавить" name="add-vacancy"></div>
</div>
</div>
</form>

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