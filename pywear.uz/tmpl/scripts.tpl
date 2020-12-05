<script src="/%main_dir%vendor/jquery/jquery-3.2.1.min.js?%time%"></script>
<script src="/%main_dir%vendor/animsition/js/animsition.min.js?%time%"></script>
<script src="/%main_dir%vendor/bootstrap/js/popper.js?%time%"></script>
<script src="/%main_dir%vendor/bootstrap/js/bootstrap.min.js?%time%"></script>
<script src="/%main_dir%vendor/select2/select2.min.js?%time%"></script>
<script>
$(".js-select2").each(function(){
$(this).select2({
	minimumResultsForSearch: 20,
	dropdownParent: $(this).next('.dropDownSelect2')
});
})
</script>
<script src="/%main_dir%vendor/daterangepicker/moment.min.js?%time%"></script>
<script src="/%main_dir%vendor/daterangepicker/daterangepicker.js?%time%"></script>
<script src="/%main_dir%vendor/slick/slick.min.js?%time%"></script>
<script src="/%main_dir%js/slick-custom.js?%time%"></script>
<script src="/%main_dir%vendor/parallax100/parallax100.js?%time%"></script>
<script>
  $('.parallax100').parallax100();
</script>
<script src="/%main_dir%vendor/MagnificPopup/jquery.magnific-popup.min.js?%time%"></script>
<script>
$('.gallery-lb').each(function() { // the containers for all your galleries
$(this).magnificPopup({
      delegate: 'a', // the selector for gallery item
      type: 'image',
      gallery: {
      	enabled:true
      },
      mainClass: 'mfp-fade'
  });
});
</script>
<script src="/%main_dir%vendor/isotope/isotope.pkgd.min.js?%time%"></script>
<script src="/%main_dir%vendor/sweetalert/sweetalert.min.js?%time%"></script>
<script>

function getCookie(name) {
  var matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
  options = options || {};

  var expires = options.expires;

  if (typeof expires == "number" && expires) {
    var d = new Date();
    d.setTime(d.getTime() + expires * 1000);
    expires = options.expires = d;
  }
  if (expires && expires.toUTCString) {
    options.expires = expires.toUTCString();
  }

  value = encodeURIComponent(value);

  var updatedCookie = name + "=" + value;

  for (var propName in options) {
    updatedCookie += "; " + propName;
    var propValue = options[propName];
    if (propValue !== true) {
      updatedCookie += "=" + propValue;
    }
  }

  document.cookie = updatedCookie;
}

function delete_cookie( name, path, domain ) {
  if( get_cookie( name ) ) {
    document.cookie = name + "=" +
      ((path) ? ";path="+path:"")+
      ((domain)?";domain="+domain:"") +
      ";expires=Thu, 01 Jan 1970 00:00:01 GMT";
  }
}

$('.js-addwish-b2').on('click', function(e){
e.preventDefault();
});
$('.js-addwish-b2').each(function(){
var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
$(this).on('click', function(){

	$(this).addClass('js-addedwish-b2');
	var c = $(".favorite").attr("data-notify");
	c++
	$(".favorite").attr("data-notify", c);
	$(this).off('click');
});
});

var items_cart = $(".header-cart-wrapitem").children("li").length;

$(".js-show-cart").attr("data-notify", items_cart)

var counter = 0
var id = $(".hidden-id").text();
$('.js-addcart-detail').each(function(){
var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
var priceProduct = $(this).parent().parent().parent().parent().find('.price_product').html();
$(this).on('click', function(){
	if(counter === 1) return false;

	$(".no_products").remove();
	$(".js-show-cart").attr("data-notify", (Number(items_cart)+1))

	var tmp = '<li class="header-cart-item m-b-12" data-id="'+id+'"><div class=" p-t-8"><button class="header-cart-item-name m-b-10 hov-cl1 trans-04">'+nameProduct+'</button><span class="header-cart-item-info">'+priceProduct+'</span></div></li>'

  var tmp = '<li class="header-cart-item m-b-12"><div class="cart-item p-t-8"><button class="header-cart-item-name m-b-10 hov-cl1 trans-04">'+nameProduct+'</button><span class="header-cart-item-info">UZS '+priceProduct+'</span><button class="delete-pr-js"><i class="zmdi zmdi-close" data-id="'+id+'"></i></button></div></li>';

	$(".header-cart-wrapitem").append(tmp)
	document.cookie = (!getCookie("pr_id")) ? "pr_id="+id+"; path=/" : "pr_id="+getCookie("pr_id")+":"+id+"; path=/";
	swal(nameProduct, "добавлен в корзину !", "success");
	counter++;
});

});

$(".cart-item").on("click", ".delete-pr-js", function(){
  var id = $(this).attr("data-id")
  var cart = $(".js-show-cart").attr("data-notify")
  cart--;
  $(".js-show-cart").attr("data-notify", cart);
  var pr_id = getCookie("pr_id").replace(id, "");
  document.cookie = "pr_id="+pr_id+"; path=/";
  $(this).parent().parent().remove()

})

</script>
<script src="/%main_dir%vendor/perfect-scrollbar/perfect-scrollbar.min.js?%time%"></script>
<script>
$('.js-pscroll').each(function(){
$(this).css('position','relative');
$(this).css('overflow','hidden');
var ps = new PerfectScrollbar(this, {
	wheelSpeed: 1,
	scrollingThreshold: 1000,
	wheelPropagation: false,
});

$(window).on('resize', function(){
	ps.update();
})
});
</script>
<script src="/%main_dir%js/main.js?%time%"></script>