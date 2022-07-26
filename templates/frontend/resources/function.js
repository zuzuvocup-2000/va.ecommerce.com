$(document).ready(function() {
	var wd_width = $(window).width();
	var wd_height = $(window).height();
	if(wd_width < 1220 && $('.subcategories-bar')) {
		$('.subcategories-bar').click(function(event) {
			$(this).parents('.homepage-category').find('.subcategories-list').slideToggle();
			event.preventDefault();
		});
	}
	$('.subcategories-list, .subcategories-bar').click(function(e) {
		var e = window.event || e;
		e.stopPropagation();
	});
	$(document).click(function(e) {
		$('.homepage-category .subcategories-list').hide();
	});


	//Thiết lập chiều cao slide show trang intro
	if(wd_width > 1220 && $('#intropage')) {
		$('.intropage-slide .image').height(wd_height);
	} else if (wd_width < 1220 && $('#intropage')) {
		var mobile_navigation = $('#intropage .mobile-navigation').outerHeight(true);
		var slide_height =  wd_height - mobile_navigation;
		$('.intropage-slide .image').height(slide_height);
	}
});

// $(document).ready(function(){
//    $(document).bind("contextmenu",function(e){
//       return false;
//    });
// });
