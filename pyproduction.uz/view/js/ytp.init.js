$(window).on("load", function(){
	$("#ytp-bg").YTPlayer({
		autoPlay:true,
		containment:'.main-top-section',
		showControls:false,
		quality:'small',
		showYTLogo:false,
		mute:true,
		startAt:0,
		origin:'http://pyproduction.uz'
	});
});