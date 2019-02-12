<?php
	@header("Content-Type: text/html; charset=UTF-8");
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/config/config.php");
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/log_query.php");
?>
<!DOCTYPE html>
<html lang="ko-KR">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- 180702 모바일에서 전화링크 걸리게 메타태그 숨김 -->
	<!--<meta name="format-detection" content="telephone=no">-->
	<title>미리페이</title>
	<link rel="shortcut icon" href="https://nurifunding.co.kr/img/32x32.ico">
	<link rel="canonical" href="www.nurifunding.co.kr">

	<link rel="stylesheet" href="https://nurifunding.co.kr/static/fonts/NanumBarunGothic/nanumbarungothic.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/nanumgothic.css">
<!--	<link href="https://opensource.keycdn.com/fontawesome/4.6.3/font-awesome.min.css" rel="stylesheet">-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<!--css 추가-->
	<link rel="stylesheet" href="https://nurifunding.co.kr/static/css/animate.css">
	<link rel="stylesheet" href="https://nurifunding.co.kr/static/css/jquery.bxslider.css">

	<link rel="stylesheet" href="https://nurifunding.co.kr/static/css/override.css">
    <link rel="stylesheet" href="https://nurifunding.co.kr/static/css/common.css">
	<!-- 180702 미리페이 css -->
    <link rel="stylesheet" href="https://nurifunding.co.kr/static/css/nuripay/pay-v1.1.css">


	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/jquery-1.10.2.min.js"></script>
	<!--js 추가-->
	<!--<script type="text/javascript" src="https://nurifunding.co.kr/static/js/jquery.lazyload.min.js"></script>-->
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/jquery.bxslider.min.js"></script>
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/jquery.animateNumber.min.js"></script>
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/waypoints.min.js"></script>
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/jquery.easing.min.js"></script>

	<!--<script type="text/javascript" src="https://nurifunding.co.kr/static/js/components_custom.js"></script>-->
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/common.js"></script>
	<!-- 180702 미리페이 js -->
	<script type="text/javascript" src="https://nurifunding.co.kr/static/js/nuripay/pay.js"></script>


	<!--[if lt IE 9]>
		<link rel="stylesheet" href="https://nurifunding.co.kr/static/css/grid_ie9lt.min.css">
	    <link rel="stylesheet" href="https://nurifunding.co.kr/static/css/common_ie9lt.css">
		<link rel="stylesheet" href="https://nurifunding.co.kr/static/css/nuripay/pay-v1.1_ie9lt.css">
   
	    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

	<script>
		function checktype(type, field) {
			if (!(event.keyCode >=37 && event.keyCode<=40)) {
				if(type == "en2") {
					var inputVal = $("#"+field+"").val();
				} else {
					var inputVal = $("input[name='"+field+"']").val();
				}
				switch(type) {
					case "email1":
						$("input[name='"+field+"']").val(inputVal.replace(/[^a-z0-9\-_]/gi,''));
						break;
					
					case "email2":
						$("input[name='"+field+"']").val(inputVal.replace(/[^a-z0-9\.]/gi,''));
						break;
					
					case "en":		//영문소문자와 숫자만
						$("input[name='"+field+"']").val(inputVal.replace(/[^a-z0-9]/gi,''));
						break;
					
					case "en2":		//영문소문자와 숫자만
						$("#"+field+"").val(inputVal.replace(/[^a-z]/gi,''));
						break;

					case "number":
						$("input[name='"+field+"']").val(inputVal.replace(/[^0-9]/gi,''));
						break;
					
					case "kor":
						$("input[name='"+field+"']").val(inputVal.replace(/[^ㄱ-힣\.]/gi,''));
						break;
					
					case "pw":		//영문소문자, 대문자, 숫자, 특수문자
						$("input[name='"+field+"']").val(inputVal.replace(/[^a-zA-Z0-9]/gi,''));
						break;
					
					case "kor2":
						$("input[name='"+field+"']").val(inputVal.replace(/[^ㄱ-힣a-zA-Z]/gi,''));
						break;
					
				}
			}
		}
		function pay_submit() {
			var name	= $('input[name="name"]');
			var phone	= $('input[name="phone"]');
			var email	= $('input[name="email"]');
			var price	= $('input[name="price"]');

			if(name.val() == "") {
				alert("회사명을 입력해주세요.");
				name.focus();
				return false;
			}
			if(phone.val() == "") {
				alert("휴대폰 번호를 입력해주세요.");
				phone.focus();
				return false;
			}
			if(email.val() == "") {
				alert("이메일을 입력해주세요.");
				email.focus();
				return false;
			}
			if(price.val() == "") {
				alert("대출희망금액을 입력해주세요.");
				price.focus();
				return false;
			}

			$.ajax({
				type	:	"POST",
				data	:	{"mode":"<?=XOREncode('loan_new')?>", "name":name.val(), "phone":phone.val(), "email":email.val(), "price":price.val()},
				url		:	"state.php",
				success	:	function(data) {
					var result = data.split("||");
					if(result[0] == "SUCC") {
						alert(result[1]);
						window.location.reload();
					} else {
						alert(result[1]);
					}
				}
			});		
		}
	</script>
</head>

<body>
	<h1 class="skip">미리페이</h1>
	<div class="wrap">
		<!-- 헤더 -->
		<header class="header pay-header" id="header">
			<div class="container header-box">
                <h2><a href="#none" class="navbar-brand"><img src="https://nurifunding.co.kr/img/nuripay/miripay/logo.png" alt="미리페이 로고"></a></h2>
                <div class="navbar-collapse pull-right">
                    <ul class="main-nav clr">
                        <li><a href="tel:1666-4570">고객센터<span class="img-call">☎</span>1666-4570</a></li>
                        <li class="last"><a href="javascript:;" class="btn-pay btn-move">선지급 신청하기</a></li>
                    </ul>
                </div>
            </div>
		</header>

		
		<div class="contents">
			<section class="pay-sec1">
				<div class="pay-area">
					<h2 class="pay-tit">
						<em>미리페이 선지급 서비스로 <span class="hidden-xs">간편하고  빠르게 !</span><span class="show-xs">아주 쉽고 빠르게 !</span></em>
						<p>보유하신 매출채권으로 필요자금을 긴급지원<span class="hidden-xs">해 드립니다.</span></p>
					</h2>
					<p class="pay-img"><img src="https://nurifunding.co.kr/img/nuripay/miripay/logo_w.png" alt="미리페이 로고"></p>
					<p class="pay-txt-1">동산, 상품, 재고자산 등이나 매출채권을 담보를 활용하여 선지급을 이용하실 수 있습니다.</p>
					<a href="javascript:;" class="btn-pay btn-move">선지급 신청하기</a>
					<p class="pay-txt-2">※ 미리페이 선지급 서비스는 핀테크 전문 P2P금융회사인 누리펀딩이 함께 하는 서비스입니다. <span class="pay-img-2"><img src="https://www.nurifunding.co.kr/img/lnb_logo.png" alt="누리펀딩 로고"></span></p>
				</div>
			</section>
			<section class="pay-sec2">
				<div class="pay-area container clr">
					<div class="pay-info-1">
						<div class="pay-tit-box clr">
							<h2 class="pay-tit">
								<em>미리페이 선지급 서비스는?</em>
								<p>대한민국 핀테크 P2P금융업계를 선도하는 누리펀딩이 함께 하는 서비스입니다.</p>
							</h2>
							<p class="pay-img"><img src="https://nurifunding.co.kr/img/nuripay/logo_svc.png" alt="누리펀딩 로고"></p>
						</div>
						<ul class="pay-info-list clr">
							<li class="list-1">
								<p class="list-tit">신속하게 지급됩니다.</p>
								<p class="list-txt">손쉽게 30초만에 일단 신청,<br>최대한 신속하게 지급됩니다.</p>
							</li>
							<li class="list-2">
								<p class="list-tit">가장 저렴합니다.</p>
								<p class="list-txt">
									<span class="hidden-xs">신청하신 금액에 대해서만 최저기준 하루 0.045%의<br>수수료가 부과되어 사업자 부담이 최소화됩니다.</span>
									<span class="show-xs">신청하신 금액에 대해서만 최저기준 하루 0.045% 수수료가 부과되어 사업자 부담이 최소화!</span>
								</p>
							</li>
						</ul>
						<ul class="pay-info-list clr">
							<li class="list-3">
								<p class="list-tit">신용도에 <span class="hidden-xs">영향이 없습니다.</span><span class="show-xs">영향이 제로 !</span></p>
								<p class="list-txt">금융기관 대출 상품과 다르므로<br><span class="hidden-xs">신용도에 영향이 없고 편리합니다.</span><span class="show-xs">신용도에 영향이 없습니다</span></p>
							</li>
							<li class="list-4">
								<p class="list-tit">누구나 이용가능</p>
								<p class="list-txt">온라인 판매를 통해 미정산대금이 발생한<br class="hidden-xs"> 고객사라면 누구나 이용가능합니다.</p>
							</li>
						</ul>
					</div>
					<div class="pay-info-2">
						<div class="pay-tit-box">
							<h2 class="pay-tit">
								<em>누구나 이용가능합니다 !</em>
								<p>미리페이 선지급 서비스는 업체를 가리지 않습니다.<span class="show-xs"></span> 모두에게 열려있으니 두드려주세요 !</p>
							</h2>
						</div>

						<div class="pay-info-area clr">
							<dl class="pay-info-box">
								<dt>온라인 마켓, 소셜의</dt>
								<dd>
									<p class="pay-info-txt"><span class="dot">-</span> 판매자 / 업체</p>
									<p class="pay-info-txt"><span class="dot">-</span> 선정산을 예정하시는 분</p>
									<p class="pay-info-txt"><span class="dot">-</span> 판매자센터</p>
									<p class="pay-info-txt"><span class="dot">-</span> 파트너사</p>
								</dd>
							</dl>
							<dl class="pay-info-box nth-2">
								<dt>모든 기업체</dt>
								<dd>
									<p class="pay-info-txt">
										신용카드 선결제, 얼리페이, 비타페이나, 쿠팡, 티몬, <br class="hidden-xs">
										여기어때, 데일리호텔, 야놀자, 익스피디아 등의 업체께서도 <br class="hidden-xs">
										매출할인(선정산)이 모두 이용가능하오니 많은 이용바랍니다.
									</p>
								</dd>
							</dl>
						</div>

						<p class="pay-txt-2">※ 온라인마켓 (옥션, 지마켓, 11번가 등), 소셜마켓 (쿠팡, 티몬, 위메프 등) 을 비롯한 모든 업체가 이용가능한 서비스 입니다.</p>
					</div>
				</div>
			</section>
			<section class="pay-sec3 clr">
				<div class="pay-area container">
					<div class="pay-first">
						<h2 class="pay-tit">
							<em class="thColor">미리페이에서 먼저 정산 받으세요.</em>
							<p>
								소셜 / 오픈마켓으로 부터 아직 정산받지 못한 금액을 정산예정일까지<br>
								가다리지 않고 미리페이에 신청 즉시 지급받을 수 있는 서비스입니다.
							</p>
						</h2>
						<figure class="f-cal01">
							<img src="https://nurifunding.co.kr/img/nuripay/miripay/img_cal01.png" alt="미리페이정산">
						</figure>
						<div class="txt-box">
							<ul>
								<li><span class="dot">-</span> 파트너사는 서비스 이용과 함께 소셜 / 오픈마켓으로부터 정산 받을 권리인 정산금채권을 미리페이에 양도합니다.</li>
								<li><span class="dot">-</span> 이후 도래하는 정산일부터 미리페이가 파트너사를 대신하여 소셜 / 오픈마켓으로부터 정산금을 받게 됩니다.</li>
								<li><span class="dot">-</span> 미리페이가 받은 정산금은 파트너사가 이용 중인 선정산대금의 상환에 사용됩니다.</li>
								<li><span class="dot">-</span> 미리페이가 받은 정산금이 서비스 이용금액보다 많을 경우, 그 차액은 파트너사에게 다시 지급됩니다.</li>
								<li><span class="dot">-</span> 선정산대금의 상환이 완료되면 미리페이는 정산금채권을 다시 파트너사에게 양도하며, 소셜 / 오픈마켓은 다시 정산금을 파트너사에게 정상적으로 지급합니다.</li>
							</ul>
						</div>
					</div>
					<div class="pay-max clr">
						<h3 class="tit thColor show-xs">최대 금액 제한없이 이용가능합니다.</h3>
						<div class="flt-box clr">
							<d class="flt-1">
								<h3 class="tit thColor hidden-xs">최대 금액 제한없이 이용가능합니다.</h3>
								<p class="p-1">
									<span class="num">1</span>
									<span class="txt">배송상품 판매가 누적됨에 따라<br>
										이용한도가 매일매일 증가합니다.</span>
								</p>
								<p class="p-1">
									<span class="num">2</span>
									<span class="txt">이용한도 내에서 필요하신 금액만큼만<br>
										선택적으로 신청하여 이용가능합니다.</span>
								</p>
								<p class="p-1">
									<span class="num">3</span>
									<span class="txt">이용한도 내에서 횟수제한 없이 신청 가능 !<br>
										횟수에 따른 별도 수수료가 없습니다.</span>
								</p>
							</d>
							<d class="flt-2">
								<figure class="f-cal02">
									<img src="https://nurifunding.co.kr/img/nuripay/miripay/img_cal02.png" alt="정산차트" class="hidden-xs">
									<img src="https://nurifunding.co.kr/img/nuripay/m/miripay/img_cal02.png" alt="정산차트" class="show-xs">
								</figure>
								<p class="f-p hidden-xs">
									※ 배송완료 후 7일 이하의 금액을 제외한 미정산대금의 100% 까지 이용가능<br>
									※ 소셜 / 오픈마켓 판매이력에 따라 조정될 수 있습니다.
								</p>
							</d>
						</div>
						<p class="f-p show-xs">
							※ 배송완료 후 7일 이하의 금액을 제외한 미정산대금의 100% 까지 이용가능<br>
							※ 소셜 / 오픈마켓 판매이력에 따라 조정될 수 있습니다.
						</p>
					</div>
				</div>
			</section>
			<section class="pay-sec4">
				<div class="pay-area container">
					<h2 class="pay-tit thColor">FAQ 안내</h2>
					<ul class="pay-faq">
						<li>
							<p class="p-q"><span class="dot">Q</span> 소셜/오픈마켓 등의 선정산 서비스는 대출 인가요?</p>
							<p class="p-a">본 서비스는 소셜/오픈마켓 등의 판매처로부터 미지급된 파트너님의 정산채권을 양도하는 방식이며, 판매처로부터 정산 받을 금액이 있는 파트너사라면 누구나 이용 가능 하십니다. 따라서 본 서비스 이용에 따른 신용등급에 어떠한 영향도 미치지 않습니다.</p>
						</li>
						<li>
							<p class="p-q"><span class="dot">Q</span> 선정산 서비스 사용 가능 금액은 어떻게 되나요?</p>
							<p class="p-a">본 서비스는 매출채권 양도후 미정산금액을 100%이내에서 이용 가능합니다. </p>
						</li>
						<li>
							<p class="p-q"><span class="dot">Q</span> 선정산 서비스 이용료는 어떻게 산정되나요?</p>
							<p class="p-a">본 서비스 이용료는 선지급 대금 잔액을 기준으로 최저기준 하루 0.045%가 부가되며, 사용하는 기간만큼 이용료를 부담하게 됩니다. </p>
						</li>
						<li>
							<p class="p-q"><span class="dot">Q</span> 혹시 상품 중계업체 측에서 선정산 서비스가 거절 될 수도 있나요?</p>
							<p class="p-a">본 서비스는 일부 내부 심사 기준에 부합하지 않는 경우 서비스 이용이 불가할 수 있습니다. 예를 들면 제3 채권자로부터 매출채권에 대한 경합 등이 발생한 경우 서비스 이용은 불가합니다. 또한 신청일 기준, 연체중이시면 서비스 이용이 불가능합니다.</p>
						</li>
					</ul>
				</div>
			</section>
	

			<section id="sec-move" class="pay-sec5">
		        <div class="pay-area">
			        <p class="cal-tit">미리페이의 선정산 서비스를 신청하세요!</p>
				    <p class="cal-txt">보내주신 신청서 확인후 빠른시일내에 연락을 드리고 상담해 드리겠습니다.</p>
					
	                <div class="input-box clr">
						<p class="input-tit"><label for="label01">회사명</label></p>
						<div class="input-txt-box">
							<input type="text" class="nr-text" name="name" id="label01" value="" placeholder="회사명을 입력해주세요." />
						</div>
					</div>

					<div class="input-box clr">
						<p class="input-tit"><label for="label02">휴대폰 번호</label></p>
						<div class="input-txt-box">
							<input type="text" onkeyup="javascript:checktype('number', 'phone')" class="nr-text" name="phone" id="label02" value="" placeholder="'-'를 제외하고 입력해주세요." />
						</div>
					</div>

					<div class="input-box clr">
						<p class="input-tit"><label for="label03">이메일</label></p>
						<div class="input-txt-box">
							<input type="text" class="nr-text" name="email" id="label03" value="" placeholder="이메일주소를 입력해주세요." />
						</div>
					</div>

					<div class="input-box clr">
						<?php
							//180809 대출희망금액 > 희망금액으로 수정 : 이준혁 > 요청 디쟌 성다솜사원
						?>
						<p class="input-tit"><label for="label04">희망금액</label></p>
						<div class="input-txt-box">
							<input type="text" class="nr-text" onkeyup="javascript:checktype('number', 'price')" name="price" id="label04" value="" placeholder="'원'단위로 입력해 주세요." />
						</div>
					</div>

					<a style="cursor:pointer;" onclick="javascript: pay_submit();" class="btn-pay">선결제 신청하기</a>
				</div>
			</section>
		</div>

		
			<footer class="footer pay-footer" id="footer">
		    <div class="container footer-box ">
		        <div class="clr">
                    <p class="f-pay-txt">
                        궁금하시면 전화주세요! <span>(상담시간 평일 10:00 ~ 18:00)</span>
                    </p>
                    <p class="f-cs-txt"><a href="tel:1666-4570">고객센터 1666-4570</a></p>
		        </div>
		        
		        <div class="show-xs clr">
                   <p class="f-pay-txt2">
                       서울시 강남구 테헤란로 82길 15, 11층 (대치동,디아이타워)   (주)누리펀딩<br>
                       ※ 미리페이 서비스는 핀테크 전문 P2P금융회사인 누리펀딩이 함께 하는 서비스입니다.
                   </p>
		           <img src="https://nurifunding.co.kr/img/nuripay/m/f_logo.png" alt="누리펀딩로고">
		        </div>
		    </div>
		</footer>
	</div>
</body>

</html>
<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/config/closedb.php");
?>
