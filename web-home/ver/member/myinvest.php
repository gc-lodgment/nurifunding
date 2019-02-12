<?php
	$page_type = "myinvest";
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/top.php");
	include_once ('/home/ebizdev/web-home/nurifunding.co.kr/config/aes.class.php');

	$aqry = "select * from auto_pay where uid = '".$member_info["num"]."' and state = 'Y'";
	$ares = mysql_query($aqry);
	$arow = mysql_fetch_array($ares);

	$auto_state = !empty($arow) ? "사용함" : "사용안함";
	$auto_price = !empty($arow) ? $arow['price'] : "50000";
	$auto_month = !empty($arow) ? $arow['month']." 개월" : "";

	$qry = 'select
				sum(case when gubun="-" and type="none" then price else 0 end) as fund,
				sum(case when type="repay" and type2="money" then price else 0 end) as refund
			from
				pay
			where
				state="Y" and uid='.$member_info['num'];
	$res = mysql_query($qry, $dbconn);
	while($row = @mysql_fetch_assoc($res)) {
		$fund	= $row['fund'];
		$refund	= $row['refund'];
	}
?>
<script type="text/javascript">
	function myinvest_sel(num) {
		$(".myinvest_sel").removeClass("on");
		$("#invest_"+num).addClass("on");

		//var mode = '<?=XOREncode("pay_info")?>';
		var mode = '<?=XOREncode("invest")?>';

		$.ajax({
			type	:	"POST",
			url		:	"/inc/state.php",
			data	:	{"mode":mode, "num":num},
			success	:	function(data) {
				var result = data.split("||");
				if(result[0] == "SUCC") {
					$("#pay_info").html(result[1]);
					$("#pay_price").html(result[2]);
					//$("#_money").html(result[3]);
				} else {
					return false;
				}
			}
			
		});
	}
	function auto_invest() {
		if($("input[name='auto_month']").val() == "") {
			alert("채권기간 범위를 선택해주세요");
			return false;
		}
		if($("input:checkbox[name='auto_sms']").is(":checked")) {
			sms = "Y";
		} else {
			sms = "N";
		}
		$.ajax({
			type	:	"POST",
			data	:	{"mode":"<?=XOREncode('auto_invest')?>", "money":$("input[name='auto_money']").val(), "month":$("input[name='auto_month']").val(), "is_sms":sms},
			url		:	"/inc/state.php",
			success	:	function (data) {
				var result = data.split("||");
				if(result[0] == "SUCC") {
					alert(result[1]);
					window.location.reload();
				} else {
					alert(result[1]);
				}
			}
		})
	}
	<?php
		if(!empty($arow["num"])) {
			if($arow["sms"] == "Y")
			$auto_sms = $arow["sms"] == "Y" ? "checked" : "";
	?>
			$(document).ready(function() {
				$(".dropdown").each(function(idx, item) {
					var thTxt = "<?=$arow['month']?>개월";
					var thHtml = thTxt + "<span class='pull-right'>▼</span>";
					$(this).closest(".dropdown").find("#auto_month").html(thHtml);
					$(this).closest(".dropdown").find("#auto_month").addClass("on");

					var thTxt2 = "<?=($arow['price']/10000)?>만원";
					var thHtml2 = thTxt2 + "<span class='pull-right'>▼</span>";
					$(this).closest(".dropdown").find("#auto_money").html(thHtml2);
					$(this).closest(".dropdown").find("#auto_money").addClass("on");

					event.preventDefault();
					opt_sel("auto_money", "<?=$arow['price']?>");
					opt_sel("auto_month", "<?=$arow['month']?>");
				});
			});
	<?php
		} else {
			$auto_sms = "";
		}
	?>

	$("document").ready( function (){
		myinvest_sel(1);
	});

	function bank_insert() {
		var name	= "예치금계좌 발급받기";
		var url		= "/member/bank_insert.php";
		var ww		= window.open(url, name, "toolbar=no,scrollbars=yes,directories=no,status=no,menubar=no,width=500,height=500,resizable=no, top=50, left="+((screen.width - 450)/2)+"");
		ww.focus();
	}

	function show_fee(pay_num) {
		var name	= "원리금수취증서";
		var url		= "/member/fee.php?pnum="+pay_num;
		var ww		= window.open(url, name, "toolbar=no,scrollbars=yes,directories=no,status=no,menubar=no,width=600,height=835,resizable=no, top=50, left="+((screen.width - 450)/2)+"");
		ww.focus();
	}


function profit(e) {
	$.ajax({
		type	:	'post',
		data	:	{'mode': '<?=XOREncode("profit")?>', 'a': e},
		url		:	'/inc/state.php',
		success	:	function(data) {
			$('#profit-list-' + e).html(data);
			$('#profit-list-' + e).slideToggle();
		}
	});
}

function profit2(e) {
	$.ajax({
		type	:	'post',
		data	:	{'mode': '<?=XOREncode("profit2")?>', 'a': e},
		url		:	'/inc/state.php',
		success	:	function(data) {
			//alert(data);
			var res = data.split("||");
			$('.profit-' + e).html(res[0]);
			//$('.profit-' + e).html(res[0]);
		}
	});
}

function cancel(e) {
	if(confirm('선택하신 투자건을 취소하시겠습니까?') == true) {
		$.ajax({
			type	:	'post',
			data	:	{'mode': '<?=XOREncode("cancel")?>', 'a': e},
			url		:	'/inc/state.php',
			success	:	function(data) {
				alert('취소되었습니다.');
				myinvest_sel(1);			
			}
		});
	}
}
</script>
<!--01.나의 투자-->
    <section class="contents com-mg">
      <div class="container">
       
        <!--div class="mode com-box row br3">
          <h2><img class="mode-icon" src="<?=base_img2?>/mode_icon.png" alt="자동투자">자동투자 모드 : <span class="use"><?=$auto_state;?></span><span class="hidden-xs">동일한 금액을 자동으로 투자하여 최적의 포트폴리오를 구성할 수 있습니다.</span></h2>
          <div class="modify-tab" id="modify-tab">
            - 각 채권당 <span class="td-under"><?=number_format($auto_price);?> 원</span>씩 <?=$auto_month;?> 자동으로 투자 <a href="" class="on-btn fc-white">수정</a>
          </div>
          <div class="modify-box clearfix" id="modify-box">
            - 각 채권당
            <div class="dropdown mode-prc" id="mode-prc">
				<input type="hidden" name="auto_money" value="50000" />
              <button type="button" class="btn" id="auto_money">5만원<span class="pull-right">▼</span></button>
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_money','50000')">5만원</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_money','100000')">10만원</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_money','200000')">20만원</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_money','500000')">50만원</a></li>
              </ul>
            </div>
            <div class="dropdown mode-range" id="mode-range">
				<input type="hidden" name="auto_month" />
              <button type="button" class="btn" id="auto_month">채권기간 범위<span class="pull-right">▼</span></button>
              <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','6')">6개월</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','12')">12개월</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','18')">18개월</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','24')">24개월</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','30')">30개월</a></li>
                <li><a href="javascript:void(0);" onclick="javascript:opt_sel('auto_month','36')">36개월</a></li>
              </ul>
            </div>
            자동투자
            <p class="mod-p1 nr-box"><input type="checkbox" name="auto_sms" id="auto_sms" value="Y" <?=$auto_sms?> class="nr-check"><span><label for="auto_sms">예치금 잔액부족 문자 알림받기 (SMS)</label></span></p>
            <p class="mod-p2"><a href="" class="cancle-btn br4">취소</a><a href="javascript: auto_invest();" class="save-btn fc-white bg-blue br4">저장</a></p>
          </div>
        </div-->
        
        <div class="row lg-wrapper">
          <div class="myi-dep com-box row br3">
            <h2><span class="fc-blue"><?=$member_info["name"]?></span><a href="/member/mypage.php" class="user-btn"><img src="<?=base_img2?>/myp_icon.png" alt="회원정보"></a></h2>
            <div class="md-bank">
                <h3>나의출금계좌<a href="https://www.nurifunding.co.kr/mydeposit" class="histry-btn">거래내역 &gt;</a></h3>
			<?php
				if($member_info["bank"] == "") {
			?>
			
				<p class="mdb-p1">&nbsp;</p>
				<p class="mdb-p2">
					투자의 원리금을 수취할 본인명의의 은행 계좌 정보를 입력해 주세요<br><br>
					반드시 "<?=$member_info["name"];?>"님 본인명의의 계좌를 등록해 주십시오.
				</p>
				<p class="mdw-p2"><a href="/member/account.php" class="btn fc-white bg-blue br4">나의 출금계좌 등록하기</a></p>  

			<?php
				} else {
			?>
            <!-- 실계좌 등록 -->
              <!--p class="mdb-p1"><?=$member_info["email"]?></p-->
			  <p class="mdb-p1">&nbsp;</p>
              <p class="mdb-p2">은행명 : <?=$member_info["bank"]?></p>
              <p class="mdb-p2">계좌번호 : <?=$member_info["bank_no"]?></p>
			  <p class="mdb-p2">예금주 : <?=$member_info["name"];?></p>
			<?php
				}
			?>
            </div>
			<?php
				if($member_info["debank"] == "") {
			?>
            <div class="md-with">
              <h3>나의 예치금<a href="https://www.nurifunding.co.kr/mydeposit" class="histry-btn">거래내역 &gt;</a></h3>
			  <p class="mdw-p0" style="text-align:left;">
			  투자를 진행하시려면 먼저 예치금 가상계좌를 발급받아주세요.<br/><br/>
			  고객님의 가상계좌로 입금후 투자가 가능합니다.
			  </p>
              <!--p class="mdw-p0">
                본인명의 은행계좌가 있다면<br/>
                바로 누리펀딩전용 예치금 가상계좌를<br/>
                발급받으실 수 있습니다.
              </p-->

            <p class="mdw-p2"><a href="javascript: bank_insert();" class="btn fc-white bg-blue br4">예치금 가상계좌 발급받기</a></p>            

            </div>
            <!--div class="md-bank2">
              <p class="mdb-p1">예치금 계좌</p>
              <p class="mdb-p2">정보없음</p>
              <p class="mdb-p1">예금주</p>
              <p class="mdb-p2">정보없음</p>
            </div-->
			<?php
				} else {
					$nonce			= $member_info["num"].time();
					$name			= $member_info["name"];
					$phoneNo		= $member_info["phone"];

					//## =========================== 멤버 잔액조회 ===========================
					$url			= "/v5/member/seyfert/inquiry/balance";

					$val			= "reqMemGuid=".$Guid;
					$val			.= "&_method=GET";
					$val			.= "&nonce=".$member_info["num"].time();
					$val			.= "&_lang=ko";
					$val			.= "&dstMemGuid=".$member_info["guid"];
					$val			.= "&crrncy=KRW";

					$result			= apiAct($url, $val, "GET", $Guid, $KeyP);

					if($result["status"] == "SUCCESS") {
						$cash	= $result["data"]["moneyPair"]["amount"];
					} else {
						$cash	= 0;
					}
					//## =========================== 멤버 잔액조회 - 끝 ===========================				
				
			?>
			
			<div class="md-with">
				<h3>나의 예치금<a href="https://www.nurifunding.co.kr/mydeposit" class="histry-btn">거래내역 &gt;</a></h3>
				<div class="md-bank2">
					<p class="mdb-p2">은행명 : <?=$member_info["debank"]?></p>
					<p class="mdb-p2">계좌번호 : <?=$member_info["debank_no"]?></p>
					<p class="mdb-p2">예금주 : <?=$member_info["debank_name"]?></p>					
				</div>
				<p class="p-1 clr"><span class="pull-left s-gray">예치금</span><span class="pull-right s-1"><?=number_format($cash)?>원</span></p>
				<p class="p-1 clr"><span class="pull-left s-purple">이벤트</span><span class="pull-right s-1"><span class="s-purple"><?=number_format($member_info["cash"])?></span>원</span></p>
				<p class="p-1 clr"><span class="pull-left s-gray">투자액</span><span class="pull-right s-1"><?=number_format($fund - $refund)?>원</span></p>
				<hr class="sun clr"> 
				<p class="p-1 total clr"><span class="pull-left s-gray">합계</span><span class="pull-right s-1"><span class="s-blue"><?=number_format($cash + $member_info["cash"] + $fund - $refund)?></span>원</span></p>
				<p class="mdw-p2"><a href="/mydeposit/" class="btn fc-white bg-blue br4">출금 하기</a></p>
			</div>
			<?php
			}
			?>
          </div>
          
          <div class="row md-wrapper">
            <div class="revenue com-box row br3">
				<?php
					$p = 0;
					$m = 0;
					$su_qry	= mysql_query("
SELECT COUNT(b.num) as cnt, SUM(b.profit) as profit FROM pay AS a LEFT JOIN goods AS b ON a.goodsno = b.num WHERE a.uid = ".$member_info["num"]." AND a.state = 'Y' AND a.gubun = '-' AND a.type = 'none'");
					//echo "SELECT SUM(price) as price ,gubun FROM pay WHERE state = 'Y' AND uid = '".$member_info["num"]."' and goodsno != 0 GROUP BY gubun";
					$su = @mysql_fetch_array($su_qry);
					$total_su	= @number_format($su["profit"]/$su["cnt"], 2);
				?>
              <h3>
				예상평균 수익율<br/><br/>
				<!--p style="font-size:13px;">( <?=date("Y년 m월 d일")?> 기준 )</p-->
				<span class="fc-blue"><?=$total_su?> %</span>
			  </h3>
            </div>
            
            <div class="total-payment com-box row br3">
              <h3>총 수익</h3>

			  <?php		
				$a = 'select sum(price) as price, type2 from pay where state="Y" and (type2="money" or type2="profit") and uid='.$member_info['num'].' group by type2';
				$b = mysql_query($a, $dbconn);
				while($c = @mysql_fetch_assoc($b))
				{
					$_info[$c['type2']] = $c['price'];
				}
			  ?>
			  <div class='tp-box'>
              <p class="tp-p1 clearfix"><span class="pull-left">회수원금</span><span class="pull-right" id='_money'><?=number_format($_info['money'])?> 원</span></p>
              <p class="tp-p1 clearfix"><span class="pull-left">이자수익(세후)</span><span class="pull-right" id='_profit'><?=number_format($_info['profit'])?> 원</span></p>
			  </div>
              <!--p class="tp-p1 clearfix"><span class="pull-left">기타</span><span class="pull-right"><?=number_format($eprice_cnt)?> 원</span></p-->
              <p class="tp-p2"><span class="c-blue"><?=number_format($_info['money'] + $_info['profit'])?></span> 원</p>
			  <!--이부분 어떻게 뭘 뽑을지 모르겠음, 윗금액이랑 뭐가다른지...-->
              <!--p class="tp-p3"><span class="pull-left">지급 예정중</span><span class="pull-right">0 원</span></p-->

            </div>
            
            <div class="total-invest com-box row br3">
				<?php
					$toja = @mysql_fetch_array(mysql_query("select sum(price) as price from pay where uid = '".$member_info["num"]."' and gubun = '-' and state = 'Y' and type= 'none' and goodsno != 0"));
				?>
              <h3>누적 총 투자금액</h3>
			  
              <p class="ti-p1"><span class="c-blue"><?=number_format($toja["price"])?></span> 원</p>
              <!--p class="ti-p2"><span class="pull-left">투자 신청중</span><span class="pull-right">0 원</span></p-->

            </div>
          </div>
          
          <div class="portfolio com-box row br3">
            <h3>나의 포트폴리오</h3>
            <div class="pf-tab-box" id="pf-tab-box">
              <a href="" class="btn br4 on">상품</a>
              <a href="" class="btn br4">수익률</a>
              <a href="" class="btn br4">리스트 등급</a>
            </div>
            <ul class="chart-box">
              <li class="on">
                <div class="chart-area-empty" style="display:none;"></div>
                <div id="canvas-holder-pdt"><span class="in-txt">상품</span><canvas id="chart-area-pdt"/></div>
				<?php
					$ptype = array();
					$_product_type = mysql_query("select * from pay where uid = '".$member_info["num"]."' and state = 'Y' and goodsno != 0 group by goodsno");
					while($_product_row = @mysql_fetch_array($_product_type)) {
						$product_type = mysql_query("select gtype from goods where num = '".$_product_row["goodsno"]."'");
						while($product_row = mysql_fetch_array($product_type)) {
							$ptype[$product_row["gtype"]] += 1;
						}
					}
					// 원랜 상품종류 (법인, 개인, 부동산)인데, 부동산으로만 한다하셔서 바꿈
					$ptype['동산'] = empty($ptype['동산']) ? 0 : $ptype['동산'];
					$ptype['부동산'] = empty($ptype['부동산']) ? 0 : $ptype['부동산'];
				?>
                <script>
                  var dataGroupPdt = [ <?=$ptype['동산']?>, <?=$ptype['부동산']?>];
                  if ( dataGroupPdt[0] == 0 && dataGroupPdt[1] == 0 ) {
                    $("#canvas-holder-pdt").prev().css("display", "block");
                  }
				  //$("#canvas-holder-pdt").prev().css("display", "block");
          
                  var configPdt = {
                    type: 'doughnut',
                    data: {
                      datasets: [{
                        data: [
                          dataGroupPdt[0],
                          dataGroupPdt[1],
                        ],
                        backgroundColor: [
                          "#575A8D",
                          "#B2B1C3",
                        ],
                        borderWidth: 4,
                      }],
                      labels: [
                        "동산",
                        "부동산",
                      ]
                    },
                    options: {
                      responsive: true,
                      legend: {
                        position: 'bottom',
                        labels: {
                            usePointStyle: 'circle'
                        }
                      },
                      animation: {
                        animateScale: false,
                        animateRotate: true
                      }
                    }
                  };
          
                </script>
                
              </li>
              <li>
                <div class="chart-area-empty"></div>
                <div id="canvas-holder-rev"><span class="in-txt">수익률</span><canvas id="chart-area-rev"/></div>
				<?php
					$profit_qry = "select * from pay where state = 'Y' and uid = '".$member_info["num"]."' and not (gubun = '+' and type='none') and goodsno != 0 group by goodsno";
					$profit_res = mysql_query($profit_qry);
					while($profit_row = @mysql_fetch_array($profit_res)) {
						$gprofit_qry = "select * from goods where num = '".$profit_row["goodsno"]."'";
						$gprofit_res = mysql_query($gprofit_qry);
						$gprofit_row = mysql_fetch_array($gprofit_res);

						if($gprofit_row["profit"] < 8) {
							$profit_8 += 1;
						} else if ($gprofit_row["profit"] < 10) {
							$profit_10 += 1;
						} else if ($gprofit_row["profit"] < 12) {
							$profit_12 += 1;
						} else {
							$profit += 1;
						}

					}
					$profit_total = $profit_8+$profit_10+$profit_12+$profit;
				?>
                <script>
                  var dataGroupRev = [ <?=($profit_8)?>, <?=($profit_10)?>, <?=($profit_12)?>, <?=($profit)?> ];
                  if ( dataGroupRev[0] == 0 && dataGroupRev[1] == 0 && dataGroupRev[2] == 0 && dataGroupRev[3] == 0 ) {
                    $("#canvas-holder-rev").prev().css("display", "block");
                  }
          
                  var configRev = {
                    type: 'doughnut',
                    data: {
                      datasets: [{
                        data: [
                          dataGroupRev[0],
                          dataGroupRev[1],
                          dataGroupRev[2],
                          dataGroupRev[3],
                        ],
                        backgroundColor: [
                          "#393A7B",
                          "#585A8A",
                          "#83859E",
                          "#AFB0C2"
                        ],
                        borderWidth: 2,
                      }],
                      labels: [
                        "8%미만",
                        "8%~10%",
                        "10.1~12%",
                        "12%초과",
                      ]
                    },
                    options: {
                      responsive: true,
                      legend: {
                        position: 'bottom',
                        labels: {
                          usePointStyle: 'circle'
                        }
                      },
                      animation: {
                        animateScale: false,
                        animateRotate: true
                      }
                    }
                  };
          
                </script>
              </li>
              <li>
                <div class="chart-area-empty"></div>
                <div id="canvas-holder-grade"><span class="in-txt">리스크 등급</span><canvas id="chart-area-grade"/></div>
				<?php
					$r_safty	= 0;
					$r_think	= 0;
					$r_agree	= 0;
					$r_reject	= 0;

					$risk_qry	= mysql_query("select goodsno from pay where uid = '".$member_info["num"]."' and state = 'Y' and goodsno != 0 group by goodsno");
					while($risk_row	= @mysql_fetch_array($risk_qry)) {
						$info_qry	= "select * from goods_info where goods_no = '".$risk_row["goodsno"]."'";
						$info_res	= mysql_query($info_qry);
						$info		= mysql_fetch_array($info_res);
			
						$g_qry	= "select * from grade_total where mapx = '".$info["grade2"]."' and mapy = '".$info["grade1"]."'";
						$g_sql	= mysql_query($g_qry);
						$g_row	= mysql_fetch_array($g_sql);
						
						switch($g_row["total"]) {
							case "S":	$r_safty	+= 1;	break;
							case "A":	$r_think	+= 1;	break;
							case "B":	$r_agree	+= 1;	break;
							case "C":	$r_reject	+= 1;	break;
						}
					}
					
				?>
                <script>
                  var dataGroupGrade = [ <?=$r_safty;?>, <?=$r_think;?>, <?=$r_agree;?>, <?=$r_reject;?> ];
                  if ( dataGroupGrade[0] == 0 && dataGroupGrade[1] == 0 && dataGroupGrade[2] == 0 && dataGroupGrade[3] == 0 ) {
                    $("#canvas-holder-rev").prev().css("display", "block");
                  }
          
                  var configGrade = {
                    type: 'doughnut',
                    data: {
                      datasets: [{
                        data: [
                          dataGroupGrade[0],
                          dataGroupGrade[1],
                          dataGroupGrade[2],
                          dataGroupGrade[3],
                        ],
                        backgroundColor: [
                          "#2AA3FF",
                          "#3ACC00",
                          "#FFD600",
                          "#FF9100"
                        ],
                        borderWidth: 2,
                      }],
                      labels: [
                        "SAFTY",
                        "THINK",
                        "AGREE",
                        "REJECT",
                      ]
                    },
                    options: {
                      responsive: true,
                      legend: {
                        position: 'bottom',
                        labels: {
                          usePointStyle: 'circle'
                        }
                      },
                      animation: {
                        animateScale: false,
                        animateRotate: true
                      }
                    }
                  };
          
                </script>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- 181005 -->
        <div class="recState com-box row br3">
        	<h3 class="colr-org">[리워드 이벤트] 나의 추천인 현황</h3>
        	<div class="rec-list">
				<div class="thead">
					<ul class="tr">
						<li class="th nth-1">추천인 아이디</li>
						<li class="th nth-2">가입일</li>
						<li class="th nth-3 hidden-xs">상태</li>
						<li class="th nth-4">리워드금액</li>
						<li class="th nth-5 show-xs">상태</li>
					</ul>
				</div>
				<div class="tbody">
					<ul class="tr">
						<li class="td nth-1">01012345678</li>
						<li class="td nth-2">2018.10.10</li>
						<li class="td nth-3 hidden-xs">회원 가입 완료</li>
						<li class="td nth-4">0원</li>
						<li class="td nth-5 show-xs">회원 가입 완료</li>
					</ul>
					<ul class="tr">
						<li class="td nth-1">01012345679</li>
						<li class="td nth-2">2018.10.10</li>
						<li class="td nth-3 hidden-xs">펀드상품 투자완료</li>
						<li class="td nth-4">0원</li>
						<li class="td nth-5 show-xs">펀드상품 투자완료</li>
					</ul>
					<ul class="tr">
						<li class="td nth-1">01012345670</li>
						<li class="td nth-2">2018.10.10</li>
						<li class="td nth-3 hidden-xs"><span class="c-blue">투자하신 펀드상품 투자 모집기간 만기</span></li>
						<li class="td nth-4"><span class="c-blue">5,000원</span></li>
						<li class="td nth-5 show-xs"><span class="c-blue">투자하신 펀드상품 투자 모집기간 만기</span></li>
					</ul>
				</div>
			</div>
			<p class="add-exp"><span class="dot">※</span> 추천해 주신 신규가입자가 실투자 후 투자만기 시점에 5천원을 지급해 드립니다.</p>
        </div>

        <div class="bond-pdt com-box row br3"><h3>나의 투자상품<!--a href="/member/myrepay.php">월별 지급 스케쥴 &gt;</a--></h3></div>
		<?php			
		## Y: 모집중, S: 모집완료, G: 상환중, E: 상환완료
		$qry = 'select goodsno from pay where state="Y" and type!="cancel" and uid='.$member_info['num'].' and goodsno > 0 group by goodsno';
		$res = mysql_query($qry, $dbconn);
		while($row = mysql_fetch_assoc($res)) {

			$a = mysql_fetch_assoc(mysql_query('select state2 from goods where num='.$row['goodsno'], $dbconn));

			switch($a['state2']) {
				case $a['state2']:		$state[$a['state2']]++;		break;
			}
		}

		## 2018.09.18 부도삭제, 연체는 해당사항이 없음
		$total[0] = $state['Y'] + $state['S'] + $state['G'] + $state['E'];
		$total[1] = $state['Y'] + $state['S'];
		$total[2] = $state['G'];
		$total[3] = $state['E'];
		?>
        
		<div class="pdt-cat-box">
			<ul class="pdt-cate clearfix">
				<li class="on br4 ml0 clearfix myinvest_sel" id="invest_1" onclick="javascript: myinvest_sel('1');"><span class="pull-left">전체</span><span class="pull-right"><?=number_format($total[0])?></span></li>
				<li class="br4 clearfix myinvest_sel" id="invest_2" onclick="javascript: myinvest_sel('2');"><span class="pull-left">투자신청</span><span class="pull-right"><?=number_format($total[1])?></span></li>
				<li class="br4 clearfix myinvest_sel" id="invest_3" onclick="javascript: myinvest_sel('3');"><span class="pull-left">상환중</span><span class="pull-right"><?=number_format($total[2])?></span></li>
				<li class="br4 ml0 clearfix myinvest_sel" id="invest_4" onclick="javascript: myinvest_sel('4');"><span class="pull-left">상환완료</span><span class="pull-right"><?=number_format($total[3])?></span></li>
				<li class="br4 clearfix myinvest_sel" id="invest_5" onclick="javascript: myinvest_sel('5');"><span class="pull-left">연체중</span><span class="pull-right">0</span></li>
			</ul>
		</div>

		<div class="mypdt-num com-box row br3" id="pay_price">
			<span class="pull-left nth-1"><?=date("y").".".date("m").".".date("d")?> 기준</span>
			<span class="pull-left nth-2"><?=number_format($gdata["total_cnt"])?>개의 채권에 투자</span>
		</div>
        
		<div id="pay_info"></div>
	</div>
	</section>
    
    <script>
      window.onload = function() {
        var ctxPdt = document.getElementById("chart-area-pdt").getContext("2d");
        window.myDoughnut = new Chart(ctxPdt, configPdt);

        var ctxRev = document.getElementById("chart-area-rev").getContext("2d");
        window.myLine = new Chart(ctxRev, configRev);
          
        
        var ctxGrade = document.getElementById("chart-area-grade").getContext("2d");
        window.myDoughnut = new Chart(ctxGrade, configGrade);

      };
    </script>
<?php
	include_once("/home/ebizdev/web-home/nurifunding.co.kr/www/web-home/common/bottom.php");
?>