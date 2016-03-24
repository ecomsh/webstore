//搜索店铺 输入时出现 鼠标点击有内容时出现
if (/msie/i.test(navigator.userAgent)) { //ie
	$('.header-search')[0].onpropertychange = function() {
		var _this = $(this);
		$('.bdsug').show();
		$('.store').html(_this.val());
	};
} else { //非ie
	$('.header-search')[0].addEventListener("input", function() {
		var _this = $(this);
		$('.bdsug').show();
		$('.store').html(_this.val());
	}, false);
}

$(document).on('click', function() {
	$('.bdsug').hide();
});

$('.header-search').on('click', function(event) {
	var _this = $(this);
	if (_this.val() == '') {
		return false;
	}
	$('.bdsug').show();
	event.stopPropagation();
});
//拼接店铺搜索的连接
$('#search-store').on('click', function() {
	var txt = $('.store').html();
	window.location.href = storeUrl + txt;
});