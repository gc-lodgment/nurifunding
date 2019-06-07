$(function () {

	sliderFn();
	wayP("on", "#per-chart", "20");
	wayP("on", "#per-chart-m", "11.5");
	firstStep();

	//이미지로드 지연 - 로딩속도 단축
	/*$("img.lazy").lazyload({
	  threshold : 300,        
	  effect : "fadeIn"       
	});*/

});

// slider 영역
function sliderFn() {
	$('#main-slider').bxSlider({
		auto: true,
		speed: 800,
		duration: 8000,
	});
}

function firstStep() {
	var main = $('#main');
	main.find('.quick-bar .box-1').on('click', function() {
		console.log('work');
		$(this).toggleClass('on');
		$(this).closest('.quick-bar').find('.box-1-2').toggleClass('on');
	});
}

//애니메이션 함수 호출  영역
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
			offset: '70%'
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