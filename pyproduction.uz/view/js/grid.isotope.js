var $grid = $('.grid').isotope({
 itemSelector: '.grid-item',
 layoutMode: 'fitRows',
});

$('.items-sort').on('click','li',function(){
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({filter:filterValue});
  $(".items-sort li").removeClass("active");
  $(this).addClass("active");
});

$('.button-more-services').on('click', '.load-more-project', function(){

    var all = $(".services.grid .grid-item").length
    var lim = all + ",6"
    $.ajax({
        type:"POST",
        url:'http://pyproduction.uz/scripts/sender_post.php',
        data: ({ajaxcont:true,limit:lim}),
        success: function(res){
         var $r = $(res);
         if(res != "err"){
           $grid.prepend($r).isotope('prepended',$r );
         }
         else $('.load-more-project').text("Больше нет!").attr("disabled", "disabled").css({'background':'#fff', 'color':'#000'});
        }
    })
})
var full_url = document.URL,
url_array = full_url.split('/'),
last_segment = url_array[url_array.length-1],
id = last_segment.substring(last_segment.lastIndexOf('#') + 1)

var s = id == 'services' ? $($('.service-sort li').get(0)).attr('data-filter') : '.'+id,
$grid_1 = $('.list-services').isotope({
 filter: s,
 itemSelector: '.grid-item',
 layoutMode: 'fitRows'
});
$('.service-sort li').removeClass('active');
$('.service-sort li[data-filter=".'+s.slice(1, s.length)+'"]').addClass('active');
$('.service-sort').on('click','li',function(){
  var filterValue = $(this).attr('data-filter');
  $grid_1.isotope({filter:filterValue});
  $(".service-sort li").removeClass("active");
  $(this).addClass("active");
});