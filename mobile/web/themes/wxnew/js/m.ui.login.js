(function (){
	var tab = new fz.Scroll('.ui-tab', {
		role: 'tab',
		autoplay: false,
		interval: 3000
	});
	/* 滑动开始前 */
	tab.on('beforeScrollStart', function(fromIndex, toIndex) {		
	})
})();

$('.ui-list li,.ui-tiled li').click(function(){
	if($(this).data('href')){
		location.href= $(this).data('href');
	}
});
$('.ui-header .ui-btn').click(function(){
	location.href= 'index.html';
});
