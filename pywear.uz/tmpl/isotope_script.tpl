<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/%main_dir%vendor/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
var $topeContainer = $('.isotope-grid');

var $grid = $topeContainer.each(function () {
$(this).isotope({
    filter: ".%sort%",
    itemSelector: '.isotope-item',
    layoutMode: 'fitRows',
    percentPosition: true,
    animationEngine : 'best-available',
    masonry: {
        columnWidth: '.isotope-item'
    }
});
});
});
</script>