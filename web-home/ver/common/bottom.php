
	<div class="side-banner">
	<?php if($page_type =='service' || $page_type == 'idx' || $page_type == 'faq') { ?>
	    <a href="/notice/view.php?var=HUY=&page=1" class="hidden-md"><img src="https://nurifunding.co.kr/img/side_banner_01.png" alt="카카오톡 플러스 친구" /></a>
	<?php } ?>
	<?php

		if($page_type == "idx" || ($_SERVER["PHP_SELF"] != "/invest/application.php" && $_SERVER["PHP_SELF"] != "/invest/end.php" && $_SERVER["PHP_SELF"] != "/member/join.php" && $_SERVER["PHP_SELF"] != "/member/join_info.php" && $_SERVER["PHP_SELF"] != "/member/join_add.php")) {
	?>
		<!-- <a href="https://www.nurifunding.co.kr/notice/view.php?var=HEw=&page=1"><img src="https://nurifunding.co.kr/img/side_banner_02.jpg" alt="가상계죄개설시1만원지급" /></a> -->
		
		<!-- 181005 -->
		<a href="https://www.nurifunding.co.kr/notice/view.php"><img src="https://nurifunding.co.kr/img/evt/new50Rew/evtBn.png" alt="5천원 리워드" /></a>
	<?php
		}
	?>		
	</div>

	<script>
		$(function() { 
			var scrNum = 300 
			$(window).scroll(function() { 
				var scr = $(window).scrollTop(); 
				//console.log(scr); 
				if (scr > scrNum) { 
					$(".side-banner").fadeOut(); 
				} else { 
					$(".side-banner").fadeIn(); 
				} 
			}); 
		});
	</script>

	
	<!--footer class="footer container-fluid">
		<div class="container footer-box">
			<div class="row d-logo">
				<img class="fLogo-m show-xs" src="https://nurifunding.co.kr/img/fLogo_m.png" alt="푸터로고">
				<img class="fLogo hidden-xs" src="https://nurifunding.co.kr/img/fLogo.png" alt="푸터로고">
			</div>

			<div class="row a-txt">
				<a href="/service/">회사소개</a>
				<a href="/policy/service.php">서비스이용약관</a>
				<a href="/policy/invest.php">투자이용약관</a>
				<a href="/policy/policy.php">개인정보취급방침</a>
				<a href="/policy/basic.php">대부거래기본약관</a>
			</div>
			<div class="row f-txt">
				<address>
				<span class="min-xs-br"><span class="xs-br"><?=_company?></span><span class="hidden-xs"> ㅣ </span>대표이사: <?=_ceo?> ㅣ 사업자등록번호 <?=_company_no1?></span>
				고객센터 <?=_tel?> ㅣ E-mail <?=_email?> ㅣ 주소: <?=_address?>
				</address>
				<address>
				<span class="min-xs-br"><span class="xs-br"><br/><?=_2company?></span><span class="hidden-xs"> ㅣ </span>대표이사: <?=_2ceo?> ㅣ 사업자등록번호 <?=_2company_no1?> ㅣ P2P연계대부업 : 2018-금감원-1486 ㅣ 등록기관 : 금융감독원</span>
				고객센터 <?=_2tel?> ㅣ E-mail <?=_2email?> ㅣ 주소: <?=_2address?>
				</address>
			</div>
			<div class="row c-txt"><small>COPYRIGHT <span class="fc-yellow">NURIFUNDING</span> ALL RIGHTS RESERVED.</small></div>


			<div class="row f-txt">
				당사는 투자상품에 관하여 충분하게 설명할 의무가 있으며, 투자자는 약관을 통해 위험성, 수익성, 수수료 등에 대하여 인지 후 투자하시기 바랍니다. <span class="c-blue">누리펀딩은 투자원금과 수익을 보장하지 않으며, 투자손실에 대한 책임은 모두 투자자에게 있습니다.</span> 또한 대출 시 귀하의 신용등급이 하락할 수 있습니다.
			</div>
			<div class="row f-txt mt-2">
				대출금리 연 19% 이내 (연체이자율 연 24% 이내) 채무의 조기상환수수료율 등 조기상환조건 없으며 플랫폼 이용료, 법무비 등 부대비용 별도 부담입니다.<br>
				중개수수료를 요구하거나 받는 행위는 불법입니다. 과도한 빚은 당신에게 큰 불행을 안겨줄 수 있습니다. 대출 시 귀하의 신용등급이 하락할 수 있습니다.
			</div>
			<div class="row a-link hidden-xs">
				<a href="http://p2plending.or.kr" target="_blank" class="nth-1"><img src="https://nurifunding.co.kr/img/common/bt_footer_01.jpg" alt="한국 P2P 금융협회"></a>
				<a href="http://www.clfa.or.kr" target="_blank" class="nth-3"><img src="https://nurifunding.co.kr/img/common/bt_footer_03.jpg" alt="한국대부금융협회"></a>
				<a href="http://www.crowdfunding.or.kr" target="_blank" class="nth-4"><img src="https://nurifunding.co.kr/img/common/bt_footer_04.jpg" alt="한국크라우드 펀딩협회"></a>
				<a href="http://korfin.kr" target="_blank" class="nth-5"><img src="https://nurifunding.co.kr/img/common/bt_footer_05.jpg" alt="한국핀테크 산업협회"></a>
			</div>
		</div>
    </footer-->


	<footer class="footer-01">
		    <div class="container footer-box">
				<div class="logo">
				    <img class="" src="https://nurifunding.co.kr/img/fLogo_02.jpg" alt="푸터로고">
				</div>
                <div class="a-txt">
                    <a href="/service/">회사소개</a>
                    <a target="_blank" href="/policy/service.php">서비스이용약관</a>
                    <a target="_blank" href="/policy/invest.php">투자이용약관</a>
                    <a target="_blank" href="/policy/policy.php" class="nth-4">개인정보취급방침</a>
                    <a target="_blank" href="/policy/basic.php">대부거래기본약관</a>
                </div>
        
                <div class="f-adr-box clr">
                    <div class="f-adr">
                        <address>
                            <span>(주) 누리펀딩</span>
                            서울시 강남구 테헤란로 82길 15, 10층 (대치동,디아이타워)<br>
                            대표이사: 김정권 ㅣ 사업자등록번호 677-81-00871<br>
                            E-mail : help@nurifunding.co.kr
                        </address>
                        <ul class="f-link-list clr">
                            <li><a href=" http://www.fss.or.kr" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/bt_main.png" alt="금융감독원 승인기업 2018-금감원-1486"></a></li>
                        </ul>
                    </div>
                    <div class="f-adr">
                        <address>
                            <span>(주)누리펀딩대부</span>
                            서울시 강남구 테헤란로 82길 15, 10층 (대치동,디아이타워)<br>
                            대표이사: 김정권 ㅣ 사업자등록번호 791-86-00662<br>
                            P2P연계대부업 : 2018-금감원-1486 ㅣ 등록기관 : 금융감독원<br>
                            E-mail : help@nurifunding.co.kr
                        </address>
                    </div>
                    <div class="f-adr last">
                        <address>
                            <span class="fc-yellow">고객센터 1666-4570</span>
                            평일 : 09시~18시   |   점심휴무 : 13시~14시<br>
                            토.일.공휴일 : 휴무
                        </address>
                        <ul class="f-link-list clr">
                            <li><a href="https://blog.naver.com/jkkim317" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/bt_blog.png" alt="누리펀딩 블로그"></a></li>
                            <li><a href="https://www.nurifunding.co.kr/notice/view.php?var=HUY=&page=1" class="a-link"><img src="https://nurifunding.co.kr/img/bt_kakaotalk.png" alt="카카오톡 플러스 친구 @누리펀딩"></a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="f-txt-box">
                    <div class="f-txt">
                        당사는 투자상품에 관하여 충분하게 설명할 의무가 있으며, 투자자는 약관을 통해 위험성, 수익성, 수수료 등에 대하여 인지 후 투자하시기 바랍니다. <br>
                        <span class="c-blue">누리펀딩은 투자원금과 수익을 보장하지 않으며, 투자손실에 대한 책임은 모두 투자자에게 있습니다.</span> 또한 대출 시 귀하의 신용등급이 하락할 수 있습니다.<br>
                        대출금리 연 19% 이내 (연체이자율 연 24% 이내) 채무의 조기상환수수료율 등 조기상환조건 없으며 플랫폼 이용료, 법무비 등 부대비용 별도 부담입니다.<br>
                        중개수수료를 요구하거나 받는 행위는 불법입니다. 과도한 빚은 당신에게 큰 불행을 안겨줄 수 있습니다.
                    </div>
                </div>
                
                <div class="f-link-box">
                    <ul class="f-link-list clr">
                        <li><a href="http://p2plending.or.kr" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/common/bt_footer_01.jpg" alt="한국 P2P 금융협회"></a></li>
                        <li class="hidden-xs"><a href="http://www.clfa.or.kr" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/common/bt_footer_03.jpg" alt="한국대부금융협회"></a></li>
                        <li class="hidden-xs"><a href="http://www.crowdfunding.or.kr" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/common/bt_footer_04.jpg" alt="한국크라우드 펀딩협회"></a></li>
                        <li class="hidden-xs"><a href="http://korfin.kr" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/common/bt_footer_05.jpg" alt="한국핀테크 산업협회"></a></li>
                        <li class="hidden-xs"><a href="http://www.paygate.net" target="_blank" class="a-link"><img src="https://nurifunding.co.kr/img/bt_footer_06.jpg" alt="payGate"></a></li>
                    </ul>
                </div>
		    </div>
		</footer>
</div>


	<div id="goods_content" class="goods_content" style="display:none;" onclick="javascript: close_more_txt();">
		<div>
			<p id="g_content_tt"></p>
			<p id="g_content_ct"></p>
			<input type="button" value="X" />
		</div>
	</div>

</body>

</html>
<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/config/closedb.php");
?>
