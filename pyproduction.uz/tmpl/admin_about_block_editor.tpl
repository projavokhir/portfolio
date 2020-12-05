<div class="settings">
	<h4 class="header">Текст страницы</h4>
	<h4 class="second-header">Текущое значение:</h4><br />
	<form action="/scripts/sender_post.php" class="form-group" method='post'>
		<div><textarea name="about-text" id="tiny">%about-text%</textarea></div>
		<div><input type="hidden" value="%about-id%" name="about-id" required></div>
		<div><input type="submit" value="Изменить" name="edit-about-bl"></div>
	</form>
</div>

<script type="text/javascript" src="%address%%main_dir%admin/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
  selector:'#tiny',
  height: 400,
  width: "800",
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