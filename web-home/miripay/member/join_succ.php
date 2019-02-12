<?php
	$page_type = "member";

	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/top.php");
?>

 		<!-- 20180329 타이틀 -->
        <h2 class="com-ft">회원가입</h2>

       
 		<!-- 20180620 회원가입 - 일반/법인 -->
        <section class="member-info com-mg">
            <div class="container">
                <!-- type-01 멀티클래스 추가 -->
                <div class="mi-box com-box type-01 row br3">
                    
                    <!-- 개인회원일경우 : STEP04-END -->
                    <div class="personal-join">
                       <h3 class="align-center">회원가입 및 가상계좌 생성 완료!</h3>
                       <p class="mib-p0 align-center">
                        <?=$member_info["name"];?>님 <br>
						누리펀딩의 회원가입을 축하드립니다.<br/> 
						투자금을 입금할 <?=$member_info["name"];?>님만의 가상계좌가 <br/>
						발급되었습니다. <br/><br/>

						고객님의 가상계좌정보는<br/>
                        <em class="c-blue">로그인 후 내정보 / 나의투자정보</em>에서도<br/>확인가능합니다.
                        </p>
                       
                        <p class="mib-p1">
                            <span class="label">은행명</span>
                            <span class="nr-silmular"><?=$member_info["debank"];?></span>
                        </p>
                        
                        <p class="mib-p1">
                            <span class="label">계좌번호</span>
                            <span class="nr-silmular"><?=$member_info["debank_no"];?></span>
                        </p>
						
                        <p class="mib-p3"><a href="/invest" class="btn fc-white bg-blue center-block align-center br4">투자상품 보러가기</a></p>
                    </div>
                    
                </div>
                
            </div>
        </section>


<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/bottom.php");
?>