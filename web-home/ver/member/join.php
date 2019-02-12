<?php
	$page_type = "member";
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/top.php");
	//setcookie(XOREncode("userid"), XOREncode("test"), 0, "/", base_cookie);

	$url = empty($_GET["url"]) ? "/" : $_GET["url"];

	$mode	= !empty($_GET["mode"]) && $_GET["mode"] == XOREncode('phone_fail') ? "phone_fail" : "";
	$mode	= "";
?>
<script type="text/javascript">

//# 이용약관 전체동의
function policy_all_chk() {
	if($('input[name="all_chk"]').is(":checked") == true) {
		$("#chk-1").prop('checked', true);
		$("#chk-2").prop('checked', true);
		$("#chk-3").prop('checked', true);
		$("#chk-4").prop('checked', true);
	} else {
		$("#chk-1").prop('checked', false);
		$("#chk-2").prop('checked', false);
		$("#chk-3").prop('checked', false);
		$("#chk-4").prop('checked', false);
	}
}

function member_type(typeNum) {
	if(typeNum == 2) {
		$('.personal-join').hide();
		$('.company-join').show();
	} else {
		$('.company-join').hide();
		$('.personal-join').show();
	}
}

//# 다음단계 1/3
function join_01() {

	var mtype		= $('input[name="mtype"]').val();
	var userid		= $('input[name="userid"]').val();
	var password	= $('input[name="password"]').val();

	if($("input[name='userid']").val() == "") {
		alert("아이디로 사용하실 휴대폰번호를 입력해주세요.");
		return false;
	}

	if($("input[name='password']").val() == "") {
		alert("비밀번호를 입력해주세요.");
		return false;
	}

	if($("input[name='password_chk']").val() == "") {
		alert("비밀번호 확인을 위해 다시한번 입력해주세요.");
		return false;
	}

	if($("input[name='password_chk']").val() != $("input[name='password']").val()) {
		alert("입력하신 비밀번호가 일치하지 않습니다.");
		return false;
	}
	
	if($("input[name='chk-1']").is(":checked") == false) {
		alert("서비스이용약관 동의 후 투자하실 수 있습니다");
		return false;
	}
	if($("input[name='chk-2']").is(":checked") == false) {
		alert("투자이용약관 동의 후 투자하실 수 있습니다");
		return false;
	}
	if($("input[name='chk-3']").is(":checked") == false) {
		alert("개인정보취급방침 동의 후 투자하실 수 있습니다");
		return false;
	}
	if($("input[name='chk-4']").is(":checked") == false) {
		alert("대부거래기본약관 동의 후 투자하실 수 있습니다");
		return false;
	}

	$('form[name="join01"]').attr('action', '/member/join_info.php');
	$('form[name="join01"]').submit();


/*
	$.ajax({
		type	:	"POST",
		data	:	{"mode":"<?=XOREncode('join_new')?>", "userid":userid, "password":password, "mtype":mtype},
		url		:	"/member/state.php",
		success	:	function(data) {
			var ret	= data.split("^");

			if(ret[0] == 'SUCC') {
				location.href = '/member/join_info.php';
			} else {
				alert(ret[1]);
				return false;
			}
		}			
	});
*/
}

function join_02() {

	var mtype		= $('input[name="mtype"]').val();
	var company		= $('input[name="company"]').val();
	var company_num	= $('input[name="company_num"]').val();
	var owner		= $('input[name="owner"]').val();
	var email		= $('input[name="email"]').val();
	var phone		= $('input[name="phone"]').val();

	if($("input[name='company']").val() == "") {
		alert("법인명을 입력해주세요.");
		return false;
	}
	if($("input[name='company_num']").val() == "") {
		alert("사업자등록번호를 입력해주세요.");
		return false;
	}
	if($("input[name='owner']").val() == "") {
		alert("담당자 이름을 입력해주세요.");
		return false;
	}
	if($("input[name='email']").val() == "") {
		alert("담당자의 이메일을 입력해주세요.");
		return false;
	}
	if($("input[name='phone']").val() == "") {
		alert("담당자의 연락처를 입력해주세요.");
		return false;
	}

	$.ajax({
		type	:	"POST",
		data	:	{"mode":"<?=XOREncode('join_company')?>", "company":company, "company_num":company_num, "email":email, "owner":owner, "phone":phone},
		url		:	"/member/state.php",
		success	:	function(data) {
			var ret	= data.split("^");

			if(ret[0] == 'SUCC') {
				location.href = '/member/join_company.php';
			} else {
				alert(ret[1]);
				return false;
			}
		}			
	});
}

</script>

		<h2 class="com-ft">회원가입</h2>

		<!-- 20180620 회원가입 - 일반/법인 -->
        <section class="member-info com-mg">
			<form name="join01" method="post">
				<div class="container">
					<!-- type-01 멀티클래스 추가 -->
					<div class="mi-box com-box type-01 row br3">
						<p class="mib-p1 fir">
							<span class="label">회원구분</span>
							<input class="nr-radio" type="radio" value="1" name="mtype" id="mtype1" onclick="javascript: member_type(1);" checked=""> <label for="mtype1">개인회원</label>
							<input class="nr-radio ml" type="radio" value="2" name="mtype" id="mtype2" onclick="javascript: member_type(2);"> <label for="mtype2">법인회원</label>
						</p>
						
						<!-- 개인회원일경우 : STEP01 -->
						<div class="personal-join">
							<p class="mib-p1">
								<span class="label">
									<label for="memberName">휴대폰번호(아이디)</label>
								</span>
								<input type="tel" name="userid" id="memberName" onkeyup="javascript:checktype('number', 'userid')" onchange="javascript:checktype('number', 'userid')" maxlength="11" class="nr-text" placeholder="아이디로 사용할 본인의 휴대폰번호를 입력하세요.">
							</p>
							<p class="mib-p1">
								<span class="label">
									<label for="memberPwd">비밀번호</label>
								</span>
								<input type="password" id="memberPwd" name="password" class="nr-text" placeholder="비밀번호를 입력해주세요.">
							</p>
							<p class="mib-p1">
								<span class="label">
									<label for="memberPwd2">비밀번호 확인</label>
								</span>
								<input type="password" id="memberPwd2" name="password_chk" class="nr-text" placeholder="비밀번호를 다시한번 입력해주세요.">
							</p>
							<!-- 181005 -->
							<p class="mib-p1">
								<span class="label colr-org">
									<label for="memberRec">[리워드 이벤트] 추천인 휴대폰번호 (아이디)</label>
								</span>
								<input type="tel" id="memberRec" name="recid" class="nr-text" placeholder="추천해 주신 누리펀딩 회원님의 휴대폰 번호를 입력해주세요.">
							</p>
							
							<div class="chk-area">
								<p class="all-agree">
									<input type="checkbox" name="all_chk" onclick="javascript: policy_all_chk();" id="all" name="전체 이용약관 동의" />
									<label for="all"><span></span>전체 이용약관 동의</label>
								</p>
								<div class="chk-box">
									<p class="chk-p1">
										<input type="checkbox" id="chk-1" name="chk-1" />
										<label for="chk-1">
											<span></span><a href="/policy/service.php" target="_blank" alt="서비스이용약관">서비스이용약관 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-2" name="chk-2" />
										<label for="chk-2">
											<span></span><a href="/policy/invest.php" target="_blank" alt="투자이용약관">투자이용약관 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-3" name="chk-3" />
										<label for="chk-3">
											<span></span><a href="/policy/policy.php" target="_blank" alt="개인정보취급방침">개인정보취급방침 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-4" name="chk-4"/>
										<label for="chk-4">
											<span></span><a href="/policy/basic.php" target="_blank" alt="대부거래기본약관">대부거래기본약관 (필수)</a>
										</label>
									</p>
								</div>
							</div>
								
							<p class="mib-p3"><a href="#none" onclick="javascript: join_01();" class="btn fc-white bg-blue center-block align-center br4">다음단계 (1/3)</a></p>
						</div>

						<!-- 181005 법인회원일경우 : STEP01 -->
						<div class="company-join step01" style="display:none;">
							<p class="mib-p1">
								<span class="label">
									<label for="companyName">아이디</label>
								</span>
								<input type="tel" name="company" id="companyName" class="nr-text" placeholder="아이디를 입력해주세요.">
							</p>
							<p class="mib-p1">
								<span class="label">
									<label for="companyNum">비밀번호</label>
								</span>
								<input type="password" name="company_num" id="companyNum" class="nr-text" placeholder="비밀번호를 입력해주세요.">
							</p>
							<p class="mib-p1">
								<span class="label">
									<label for="companyName2">비밀번호 확인</label>
								</span>
								<input type="password" name="owner" id="companyName2" class="nr-text" placeholder="비밀번호를 다시한번 입력해주세요.">
							</p>
							<p class="mib-p1">
								<span class="label">
									<label for="companyEmail">담당자 이메일</label>
								</span>
								<input type="text" name="email" id="companyEmail" class="nr-text" placeholder="담당자 이메일을 입력해주세요.">
							</p>
							<div class="chk-area">
								<p class="all-agree">
									<input type="checkbox" name="all_chk" onclick="javascript: policy_all_chk();" id="all-cp" name="전체 이용약관 동의" />
									<label for="all"><span></span>전체 이용약관 동의</label>
								</p>
								<div class="chk-box">
									<p class="chk-p1">
										<input type="checkbox" id="chk-1-cp" name="chk-1" />
										<label for="chk-1-cp">
											<span></span><a href="/policy/service.php" target="_blank" alt="서비스이용약관">서비스이용약관 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-2-cp" name="chk-2" />
										<label for="chk-2-cp">
											<span></span><a href="/policy/invest.php" target="_blank" alt="투자이용약관">투자이용약관 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-3-cp" name="chk-3" />
										<label for="chk-3-cp">
											<span></span><a href="/policy/policy.php" target="_blank" alt="개인정보취급방침">개인정보취급방침 (필수)</a>
										</label>
									</p>
									<p class="chk-p1">
										<input type="checkbox" id="chk-4-cp" name="chk-4"/>
										<label for="chk-4-cp">
											<span></span><a href="/policy/basic.php" target="_blank" alt="대부거래기본약관">대부거래기본약관 (필수)</a>
										</label>
									</p>
								</div>
							</div>
							
							<p class="mib-p3"><a href="#none" onclick="javascript: join_02();" class="btn fc-white bg-blue center-block align-center br4">가입완료</a></p>
						</div>
						
					</div>
					
				</div>
			</form>
        </section>
<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/bottom.php");
?>