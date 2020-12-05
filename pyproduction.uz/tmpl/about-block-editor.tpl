<form action="/scripts/sender_post.php" class="form-group" method='post'>
<div class="row">
	<div class="settings">
		<h4 class="header">Загаловок страницы</h4>
			<div><input type="text" name="header" required></div>
	</div>
	<div class="settings">
		<h4 class="header">Подзагаловок страницы</h4>
			<div><input type="text" name="s-header" required></div>
	</div>
</div>

<div class="settings">
	<h4 class="header">Текст</h4>
	<textarea name="desc" id="tiny"></textarea>
	<div><input type="submit" value="Добавить" name="add_about_block"></div>
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