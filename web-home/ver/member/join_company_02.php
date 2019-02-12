<?php
	$page_type = "member";

	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/top.php");
?>

        <h2 class="com-ft">회원가입</h2>
       
        <section class="member-info com-mg">
            <div class="container">

                <div class="mi-box com-box type-01 row br3">
                    
                    <!-- 법인회원일경우 : STEP02 -->
                    <div class="company-join step02">
                        <h3 class="align-center">법인 회원가입 완료</h3>
                        <p class="mib-p0 align-center">
                        정상적으로 가입이 완료되었습니다.<br>
						법인회원의 투자 진행을 위해 아래 사항을 진행해 주십시오.<br/> 
                        </p>

                        <p class="mib-p0 align-center">
                            <em class="c-blue f-bd">1. 투자 정보 입력하기</em><br>
                            <em class="c-blue f-bd">2. 사업자 등록번호 인증</em>
                        </p>

                        <p class="mib-p3"><a href="" class="btn fc-white bg-blue center-block align-center br4">투자정보 입력하기</a></p>
                        <p class="mib-p3"><a href="/invest" class="btn c-blue bor-blue center-block align-center br4">투자상품 둘러보기</a></p>
                    </div>
                    
                </div>
                
            </div>
        </section>


<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/bottom.php");
?>