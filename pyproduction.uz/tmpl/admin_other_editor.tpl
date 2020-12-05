<div class="row">
	<div class="settings">
    <form action="/scripts/sender_post.php" class="form-group" method='post'>
		<h4 class="header">Загаловок страницы</h4>
			<div><input type="text" name="header" value="%header%" required></div>
      <div><input type="hidden" name="section-id" value="%section-id%" required></div>
      <div><input type="submit" name="edit_other_h" value="Изменить"></div>
	  </form>
  </div>
	<div class="settings">
    <form action="/scripts/sender_post.php" class="form-group" method='post'>
    <h4 class="header">Подзагаловок страницы</h4>
      <div><input type="text" name="s-header" value="%s-header%" required></div>
      <div><input type="hidden" name="section-id" value="%section-id%" required></div>
      <div><input type="submit" name="edit_other_s_h" value="Изменить"></div>
    </form>
  </div>

  <div class="settings">
    <button class="delete">Удалить</button>
  </div>

</div>

<div class="settings">
  <form action="/scripts/sender_post.php" method="post" class="form-group">
  	<h4 class="header">Текст</h4>
  	<textarea name="fulltext" id="tiny">%ftext%</textarea>
    <div><input type="hidden" name="section-id" value="%section-id%" required></div>
    <div><input type="submit" name="edit_other_ftext" value="Изменить"></div>
  </form>
</div>

<div class="message">
  <h4>Удалить?</h4>
  <span class="alias">%section-id%</span>
  <button class="yes section">Да</button>
  <button class="no">Нет</button>
</div>

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