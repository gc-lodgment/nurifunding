$(function () {
	//애니메이션 함수 호출
	wayP("on", "#per-chart", "20");
	wayP("on", "#per-chart-m", "11.5");

	//이미지로드 지연 - 로딩속도 단축
	/*$("img.lazy").lazyload({
	  threshold : 300,        
	  effect : "fadeIn"       
	});*/

	//메인 bxslider
	$('.swiper-wrapper').bxSlider({
		auto: true,
		speed: 800,
		duration: 8000,
	});

});
//메인슬라이드 애니메이션
// function msAni(flag) {
// 	if (flag == "on") {
// 		var $_slide = $(".swiper-slide");
// 		$_slide.find(".s1-div-2 .d1, .s1-div-2 .d2, .s1-div-3").hide();
// 		setTimeout(function () {
// 			$_slide.find(".s1-div-2 .d1").fadeIn();
// 		}, 0);
// 		setTimeout(function () {
// 			$_slide.find(".s1-div-2 .d2").fadeIn();
// 		}, 500);
// 		setTimeout(function () {
// 			$_slide.find(".s1-div-3").fadeIn();
// 		}, 1000);
// 	} else if (flag == "off") {
// 		var $_slide = $(".swiper-slide");
// 		$_slide.find(".s1-div-2 .d1, .s1-div-2 .d2, .s1-div-3").show();

// 	}
// }

//interactive 효과
function wayP(on, itm, ht) {
	// 차트
	$(itm).children('div').each(function (index, item) {
		var perData = $(item).find('.p-per > span').text(),
			perHeight = perData * ht ;
		
		$(itm).waypoint(function () {
			$(item).children('.p-chart').height(perHeight);
			$(item).addClass('on');
			$(itm).children('.tooltip').addClass('on');

		}, {
			offset: '75%'
		});
	});
	
	// 진행중인 투자상품
	$("#ingProduct .ip-outer").each(function (idx, item) {
		$(item).addClass("blind");
		$(item).waypoint(function () {
			$(item).addClass('animated fadeInUp');
		}, {
			offset: '75%'
		});
	});

	// 쉬운 대출
	// $("#easy .split-1 > *").each(function (idx, item) {
	// 	$(item).addClass("blind");
	// 	$(item).waypoint(function () {
	// 		$(item).addClass('animated fadeInUp');
	// 	}, {
	// 		offset: '75%'
	// 	});
	// });
	$("#easy .split-2").each(function (idx, item) {
		$(item).addClass("blind");
		$(item).waypoint(function () {
			$(item).addClass('animated fadeInUp');
		}, {
			offset: '75%'
		});
	});

}