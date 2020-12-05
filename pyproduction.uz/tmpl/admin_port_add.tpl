<form action="/scripts/sender_post.php" class="form-group" method='post'>
<div class="settings">
  <h4 class="header">Изображение <span class="red">*</span></h4>
    <div class="input-img"><input type="text" id="img_field" name="port-img" required>
      <div class="find">
        <a href="/filemanager/dialog.php?type=2&field_id=img_field" class="cover_image_btn fancy"></a>
      </div>
    </div><br />
    <div style="width:200px;"><img src="/%main_dir%admin/img/photo_bg.png" class="images_l"></div>
</div>

<div class="settings">
  <h4 class="header">Сыылка <span class="red">*</span></h4>
    <div><input type="text" name="port-url" required></div>
    <div><input type="submit" value="Добавить" name="add-port"></div>
</div>

<div class="settings">
  <button class="delete">Удалить</button>
</div>

<div class="message">
  <h4>Удалить?</h4>
  <span class="alias">%port-id%</span>
  <button class="port-delete">Да</button>
  <button class="no">Нет</button>
</div>

<script>
  function responsive_filemanager_callback(field_id){
    var v = $('#img_field').val();
    $('.images_l').attr('src', v);
  }

$(document).on("click", ".message .port-delete", function(){

var id = $($($(this).parent()).find(".alias")).text()
var mess = $(this).parent()

$.ajax({
  type: "POST",
  url: "/scripts/sender_post.php",
  data: ({ delete_port: "delete", id:id }),
  success: function(d){
    $(mess).fadeOut(150)
    $($(mess).find(".alias")).text("")
    alert("Ваш запрос на обработке! ")
  }
})
setTimeout(function(){
  window.location.reload();
}, 1000);

})

</script>