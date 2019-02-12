<?php
    $page_type = "member";

    include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/top.php");
?>

        <h2 class="com-ft">법인 투자 정보 입력</h2>
       
        <section class="member-info com-mg">
            <div class="container">

                <div class="mi-box com-box type-01 row br3">
                    
                    <!-- 법인회원일경우 : STEP03 -->
                    <div class="company-join step03">
                        <p class="mib-p1">
                            <span class="label">
                                <label for="companyName">법인명</label>
                            </span>
                            <input type="text" name="company" id="companyName" class="nr-text" placeholder="법인명을 입력해주세요.">
                        </p>
                        <p class="mib-p1">
                            <span class="label">
                                <label for="companyNum">사업자등록번호</label>
                            </span>
                            <input type="number" name="company_num" id="companyNum" class="nr-text" placeholder="'-'없이 숫자만 입력해주세요.">
                        </p>
                        <p class="mib-p1">
                            <span class="label">
                                <label for="companyName2">담당자 이름</label>
                            </span>
                            <input type="text" name="owner" id="companyName2" class="nr-text" placeholder="담당자명을 입력해주세요.">
                        </p>
                        <p class="mib-p1">
                            <span class="label">
                                <label for="companyPhone">담당자 휴대폰</label>
                            </span>
                            <input type="tel" name="phone" id="companyPhone" class="nr-text" placeholder="담당자 휴대폰을 입력해주세요.">
                        </p>
                        <p class="mib-p1">
                            <span class="label">
                                <label for="companyAddr-1">주소</label>
                            </span>
                            <input type="text" name="phone" id="companyAddr-1" class="nr-text" placeholder="주소를 입력해주세요.">
                            <input type="text" name="phone" id="companyAddr-2" class="nr-text detail" placeholder="">
                        </p>
                        
                        <p class="mib-p3"><a href="#none" onclick="javascript: join_02();" class="btn fc-white bg-blue center-block align-center br4">투자 정보 입력 완료</a></p>
                    </div>
                    
                </div>
                
            </div>
        </section>


<?php
    include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/bottom.php");
?>