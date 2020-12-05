$(function(){
	
	$(document).ready(function(){
		setTimeout(function(){
			normalizeAdv();
		}, 500);
	});

	if($(window).width() <= 1230){
		$("body").prepend($(".right-wr"));
	} else if($(window).width() > 1230){
		$(".header-wrap").append($(".right-wr"));
	}

	$(window).resize(function(){
		normalizeAdv();

		if($(window).width() <= 1230){
			$("body").prepend($(".right-wr"));
		} else if($(window).width() > 1230){
			$(".header-wrap").append($(".right-wr"))
		}
	});

	$(window).scroll(function(){
		if($(window).scrollTop() > 120){
			$(".header-wrap").addClass("fixed").stop().animate({"opacity":1}, 100);
		} else if($(window).scrollTop() === 0){
			setTimeout(function(){
				$(".header-wrap").removeAttr("style");
			}, 50);
			$(".header-wrap").removeClass("fixed");
		}
	});


	$("#player_ytp").YTPlayer();

	$(".menu").on("click", "li a", function(){
		var link = $(this).attr("href");
		scrollTo(link);
		return false;
	});

	$(".btn_container").on("click", "button.join_btn", function(){
		openForm();
	});

	$(document).on("click", ".btn__", function(){
		openFormSecond($(this));
		$(".price_wrp").css("opacity", 0);
	});

	$(document).on("click", ".overlay_form_close", function(){
		$(".price_wrp").css("opacity", 1);
		closeForm();
	});

	$(document).on("click", ".close_ajax_form", function(){
		$(".price_wrp").css("opacity", 1);
		closeForm();
	});

	$(document).on("click", ".menu_close_btn", function(){
		$(".m_open_wrp").show(400);
		$(this).fadeOut(200);
		$(".overlay_menu_black").fadeOut(200);
		$(".right-wr").css("right", "-280px");
	});

		$(document).on("click", ".overlay_menu_black", function(){
			$(".m_open_wrp").show(400);
			$(".menu_close_btn").fadeOut(200);
			$(".overlay_menu_black").fadeOut(200);
			$(".right-wr").css("right", "-280px");
	});

	$(document).on("click", ".m_open_wrp", function(){
		$(this).hide();
		$(".overlay_menu_black").fadeIn(200);
		$(".menu_close_btn").fadeIn(400);
		$(".right-wr").css("right", "0");
	});


	$(".form_c_1").on("click", ".ajax_submit", function(){

		var $name = $("input#name_");
		var $phone = $("input#phone_");
		var $email = $("input#email_");
		var $packet = $("#packet__ option:selected");

		if($name.val() == ""){
			$name.parent().find(".message_wrp").show();
			showError();
		}
		if($phone.val() == ""){
			$phone.parent().find(".message_wrp").show();
			showError();
		}
		if($email.val() == ""){
			$email.parent().find(".message_wrp").show();
			showError();
		}
		else if($name.val() != "" && $phone.val() != "" && $email.val() != ""){

			$.ajax({

				url:"/sender_email.php",
				method: "POST",
				data: ({ name: $name.val(), phone: $phone.val(), email: $email.val(), packet: $packet.val() }),
				beforeSend: function(){
					$(".ajax_loading").css("opacity", 1);
				},
				success: function(){
					$(".ajax_loading").css("opactiy", 0);
					$(".ajax_msg_wrp").text("Спасибо! Ваша заявка принята. Вскоре мы свяжемся с Вами.").slideUp(300).slideDown(200);
				}
			});

		}

		return false;
	});

var options = {
    animateThreshold: 50,
}
$('.aniview').AniView(options);

$(".activity_views").owlCarousel({
    loop:false,
    margin:0,
    nav:false,
    dots:false,
    items:6,
    responsive:{
    	0:{
    		items:1
    	},
    	600:{
    		items:2
    	},
    	900:{
    		items:4
    	},
    	1300:{
    		items:6
    	}
    }
});

$(".gallery_ester").owlCarousel({
    loop:true,
    margin:5,
    nav:false,
    dots:true,
    items:6,
    responsive:{
    	0:{
    		items:1
    	},
    	400:{
    		items:3
    	},
    	900:{
    		items:6
    	}

    }

});


//PSWP gallery init
var initPhotoSwipeFromDOM = function(gallerySelector) {
    var parseThumbnailElements = function(el) {
        var thumbElements = el.childNodes,
            numNodes = thumbElements.length,
            items = [],
            figureEl,
            linkEl,
            size,
            item;
        for(var i = 0; i < numNodes; i++) {
            figureEl = thumbElements[i]; // <figure> element
            // include only element nodes 
            if(figureEl.nodeType !== 1) {
                continue;
            }
            linkEl = figureEl.children[0]; // <a> element
            size = linkEl.getAttribute('data-size').split('x');
            // create slide object
            item = {
                src: linkEl.getAttribute('href'),
                w: parseInt(size[0], 10),
                h: parseInt(size[1], 10)
            };
            if(figureEl.children.length > 1) {
                // <figcaption> content
                item.title = figureEl.children[1].innerHTML; 
            }
            if(linkEl.children.length > 0) {
                // <img> thumbnail element, retrieving thumbnail url
                item.msrc = linkEl.children[0].getAttribute('src');
            } 
            item.el = figureEl; // save link to element for getThumbBoundsFn
            items.push(item);
        }
        return items;
    };
    // find nearest parent element
    var closest = function closest(el, fn) {
        return el && ( fn(el) ? el : closest(el.parentNode, fn) );
    };
    // triggers when user clicks on thumbnail
    var onThumbnailsClick = function(e) {
        e = e || window.event;
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
        var eTarget = e.target || e.srcElement;

        // find root element of slide
        var clickedListItem = closest(eTarget, function(el) {
            return (el.tagName && el.tagName.toUpperCase() === 'FIGURE');
        });
        if(!clickedListItem) {
            return;
        }
        // find index of clicked item by looping through all child nodes
        // alternatively, you may define index via data- attribute
        var clickedGallery = clickedListItem.parentNode,
            childNodes = clickedListItem.parentNode.childNodes,
            numChildNodes = childNodes.length,
            nodeIndex = 0,
            index;
        for (var i = 0; i < numChildNodes; i++) {
            if(childNodes[i].nodeType !== 1) { 
                continue; 
            }
            if(childNodes[i] === clickedListItem) {
                index = nodeIndex;
                break;
            }
            nodeIndex++;
        }
        if(index >= 0) {
            // open PhotoSwipe if valid index found
            openPhotoSwipe( index, clickedGallery );
        }
        return false;
    };
    // parse picture index and gallery index from URL (#&pid=1&gid=2)
    var photoswipeParseHash = function() {
        var hash = window.location.hash.substring(1),
        params = {};
        if(hash.length < 5) {
            return params;
        }
        var vars = hash.split('&');
        for (var i = 0; i < vars.length; i++) {
            if(!vars[i]) {
                continue;
            }
            var pair = vars[i].split('=');  
            if(pair.length < 2) {
                continue;
            }           
            params[pair[0]] = pair[1];
        }
        if(params.gid) {
            params.gid = parseInt(params.gid, 10);
        }
        return params;
    };
    var openPhotoSwipe = function(index, galleryElement, disableAnimation, fromURL) {
        var pswpElement = document.querySelectorAll('.pswp')[0],
            gallery,
            options,
            items;
        items = parseThumbnailElements(galleryElement);
        // define options (if needed)
        options = {
            // define gallery index (for URL)
            galleryUID: galleryElement.getAttribute('data-pswp-uid'),
            getThumbBoundsFn: function(index) {
                // See Options -> getThumbBoundsFn section of documentation for more info
                var thumbnail = items[index].el.getElementsByTagName('img')[0], // find thumbnail
                    pageYScroll = window.pageYOffset || document.documentElement.scrollTop,
                    rect = thumbnail.getBoundingClientRect(); 
                return {x:rect.left, y:rect.top + pageYScroll, w:rect.width};
            },
            bgOpacity:.8,
            allowPanToNext:false,
            loop:false,
            pinchToClose:false,
            closeOnScroll:false,
            closeOnVerticalDrag:false,

        };
        // PhotoSwipe opened from URL
        if(fromURL) {
            if(options.galleryPIDs) {
                // parse real index when custom PIDs are used 
                // http://photoswipe.com/documentation/faq.html#custom-pid-in-url
                for(var j = 0; j < items.length; j++) {
                    if(items[j].pid == index) {
                        options.index = j;
                        break;
                    }
                }
            } else {
                // in URL indexes start from 1
                options.index = parseInt(index, 10) - 1;
            }
        } else {
            options.index = parseInt(index, 10);
        }
        // exit if index not found
        if( isNaN(options.index) ) {
            return;
        }
        if(disableAnimation) {
            options.showAnimationDuration = 0;
        }
        // Pass data to PhotoSwipe and initialize it
        gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
        gallery.init();
    };
    // loop through all gallery elements and bind events
    var galleryElements = document.querySelectorAll( gallerySelector );
    for(var i = 0, l = galleryElements.length; i < l; i++) {
        galleryElements[i].setAttribute('data-pswp-uid', i+1);
        galleryElements[i].onclick = onThumbnailsClick;
    }
    // Parse URL and open gallery if it contains #&pid=3&gid=1
    var hashData = photoswipeParseHash();
    if(hashData.pid && hashData.gid) {
        openPhotoSwipe( hashData.pid ,  galleryElements[ hashData.gid - 1 ], true, true );
    }
};
// execute above function
initPhotoSwipeFromDOM(".gallery_ester");
initPhotoSwipeFromDOM(".gl_block_1");


});  //The end of the document ready function
	
	function normalizeAdv(){
		$($(".advantages").get(0)).height($($(".advantages").get(1)).outerHeight());
	}

	function closeForm(){
		var $form = $(".form_wrapper_fixed");
		$(this).css("overflow-y", "hidden");
		$form.fadeOut(300, function(){
			$("html, body").css("overflow-y", "auto");
			$(".overlay_form_close").hide();
		});
	}

	function closeForm(){
		var $form = $(".form_wrapper_fixed");
		$(this).css("overflow-y", "hidden");
		$form.fadeOut(300, function(){
			$("html, body").css("overflow-y", "auto");
			$(".overlay_form_close").hide();
		});
	}

	function openForm(){
		var $form = $(".join__first");
		$form.fadeIn(200, function(){
			$("html, body").css("overflow-y", "hidden");
			$(this).css("overflow-y", "scroll");
			$($(this).find(".overlay_form_close")).show();
		});
	}

	function openFormSecond(btn){
		var $form = $(".join__second");
		var $h = $form.find(".form_header");
		var $type = $form.find("#type");
		var t = $(btn).attr("data-type");
		var t__text = "";

		if(t === "stn"){
			t__text = "Заявка СТАНДАРТЫНЙ ГОД";
			$h.text(t__text);
			$type.val(t__text);
		} else if(t === "max"){
			t__text = "Заявка МАКСИМАЛЬНЫЙ";
			$h.text(t__text);
			$type.val(t__text);
		}

		$form.fadeIn(200, function(){
			$("html, body").css("overflow-y", "hidden");
			$(this).css("overflow-y", "scroll");
			$($(this).find(".overlay_form_close")).show();
		});
	}

	function showError(){
		$(".ajax_msg_wrp").slideDown(300);
	}

	function scrollTo(id){
		var off = $(id).offset().top;
		$("html, body").animate({
			scrollTop: off
		}, 500, function(){
			window.location = id;
		});
		return false;
	}