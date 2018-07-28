<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-cn" xml:lang="zh-cn"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta content="" name="keywords">
	<meta content="" name="description">
	<title>支付平台</title>
	<link href="./register-files/reset.css" rel="stylesheet">
	<link href="./register-files/common.css" rel="stylesheet">
	<link href="./register-files/index.css" rel="stylesheet">
	<script src="./register-files/jquery-1.4.1.min.js"></script>
	<script src="./register-files/popup_layer.js"></script>
	<script src="./register-files/json.js"></script>
	<script src="./register-files/jsDialog.js"></script>
	<script src="./register-files/pay_center.js"></script>
</head>
<body>
	<div id="header">
		<div class="headerBox clearfix">
			<div class="bodyWidth">
				<div class="stateInfo">
					<div id="div_head_before_login" <span="" class="helpSpan"><s></s>支付遇到问题？
					</div>
					<div id="div_head_after_login" style="display:none">
						<a href="javascript:void(0);"><div id="head_userName"></div></a><span class="helpSpan"><s></s><a href="https://trade.hfbpay.com/standard/gateway/manager.cgi?m=payProblem">支付遇到问题？</a></span>
					</div>
				</div>
				<div class="clear"></div>	
			</div>
		</div>
	</div>

<script type="text/javascript">

function onChecked(obj,id,value)
{	
	document.getElementById(obj).checked = true;
	document.getElementById(id).value = value;
	var bankCode=document.getElementById(obj).value;
	if(value=="6")
	{
		strs=obj.split("_"); //字符分割
		bankCode = bankCode+"_"+"A"
	}else if (value=="7")
	{
		strs=obj.split("_"); //字符分割
		bankCode = bankCode+"_"+"B2B"
	}
	document.getElementById(bankCode).checked = true;
	
}

function onChecked1(obj,id,value,formid)
{	
	document.getElementById(obj).checked = true;
	$("#"+formid+"").find("#"+id+"").val(value);
	var bankCode=document.getElementById(obj).value;
	if(value=="6")
	{
		strs=obj.split("_"); //字符分割
		bankCode = bankCode+"_"+"A"
	}else if (value=="7")
	{
		strs=obj.split("_"); //字符分割
		bankCode = bankCode+"_"+"B2B"
	}
	document.getElementById(bankCode).checked = true;
	
}		
function choose_BankType(type)
{
	document.getElementById("chooseBankType").value=type;
	if(type == '2'){
		document.getElementById("payType").value='6';
	}else{
		document.getElementById("payType").value='0';
	}
}
		
</script>
<script type="text/javascript">
$(function(){
	$(".tabUl li").click(function(){
		var obj=$(this)
	    var id=$(obj).parent().children().index($(obj));
		$(obj).siblings().removeClass("on");
		$(obj).addClass("on");
	    $(obj).parent().parent().next().children().removeClass('on');
	    $(obj).parent().parent().next().children().eq(id).addClass('on');
	});
	$(".tdInfo").hover(function(){
		$(this).children().eq(0).show();
	},function(){
		$(this).children().eq(0).hide();
	});
	$(".proInfo").hover(function(){
		$(".infoLayer").show();
	},function(){
		$(".infoLayer").hide();
	});
	$(".orderInfoList").click(function(){
		$(".orderListLayer").show()
	});
	$(".orderListLayer .closed").click(function(){
		$(".orderListLayer").hide()
	});
		$(".moreBankLayer").click(function(){
		$(".chooseBankLayer").show()
	});
	$(".chooseBankLayer .closed").click(function(){
		$(".chooseBankLayer").hide()
	});
	})
var t = "1532595989089";
function trim(str){ //删除左右两端的空格
　　     return str.replace(/(^\s*)|(\s*$)/g, "");
}

function doSubmit(type)
{
	if(type=='balance')
	{
		var islogin=document.getElementById("islogin").value;
		if(islogin!=1)
		{
			var mobileRule = /^1[0-9]{10}$/;
			var emailRule = /^[a-zA-Z0-9_\.\$-]{1,20}@[a-zA-Z0-9]{1,10}(\.[a-zA-Z0-9]{1,5}){1,3}$/;
			var name =$("#accounts").val();
			if(name==""||name=="手机号码或电子邮箱")
			{
				$("#mobopay_errorMsg").css("display","block"); 
				$("#mobopay_errorMsg").html("<s></s>账户名不能为空");
			    return false;
			}
			if(!mobileRule.test(trim(name)) && ! emailRule.test(trim(name))){
			  	$("#mobopay_errorMsg").css("display","block"); 
				$("#mobopay_errorMsg").html("<s></s>账户名应为手机号码或电子邮箱地址");
			    return false;
			}
			var pwd =getIBSInput("powerpass", t ,"mobopay_errorMsg", "登录密码输入错误：");
			if(pwd==''||pwd==null)
			{
			    return false;
			}
			if(pwd!=null&&name!=""){
				document.getElementById("mngPin").value=pwd;
				//$("#ebalanceForm").submit();
				var http = new CHttpRequest(__DoAccountLogin,true,1);
				var orderId =  document.getElementById("orderId").value;
				var accounts = document.getElementById("accounts").value;
				var checkFlag = document.getElementById("checkFlag").value;
				http.Get("/standard/gateway/manager.cgi","mngPin="+pwd+"&orderId="+orderId+"&checkFlag="+checkFlag+"&accounts="+accounts+"&m=accountLogin",300);
			}
		}
	}else if(type=='bank')
	{
		var bankchoose=document.depositBankCardForm.payType1.value;
		if(bankchoose=="0")
		{		
			alert("请选择需要支付的银行");
			return false;
		}else
		{	
			EasyMask.init({ width:800, opacity: 3, molor: 'black', fclose: false });
			$("#bankLayer").show();
			document.getElementById("depositBankCardForm").target="blank";
			$("#depositBankCardForm").submit();
		}
	}else if(type=='xbank')
	{
		var bankchoose=document.xBankCardForm.payType1.value;
		if(bankchoose=="0")
		{		
			alert("请选择需要支付的银行");
			return false;
		}else
		{	
			EasyMask.init({ width:800, opacity: 3, molor: 'black', fclose: false });
			$("#bankLayer").show();
			document.getElementById("xBankCardForm").target="blank";
			$("#xBankCardForm").submit();
		}
	}else if(type=='submit')
	{	
		var m =document.ebalanceForm.m.value;
		var pwd =getIBSInput("afert_powerpass", t ,"mobopay_errorMsg_after", "支付密码输入错误：");
		var smType =document.ebalanceForm.smType.value;
		if(pwd==''||pwd==null)
		{
		    return false;
		}
		if(smType==1)
		{
			var smsCode = $("#smsCode").val();
			if(smsCode=='')
			{
				$("#mobopay_errorMsg_after").css("display","block"); 
				$("#mobopay_errorMsg_after").html("<s></s>短信验证码不能为空");
				return false;
			}
			if(smsCode.length!=6)
			{
				$("#mobopay_errorMsg_after").css("display","block"); 
				$("#mobopay_errorMsg_after").html("<s></s>短信验证码只能是6位数字");
				return false;
			}
		}
		if(pwd!=null){
			document.getElementById("password").value=pwd;
			$("#ebalanceForm").submit();
		}
		
	}else if(type=='shortCut')
	{
		var html=document.getElementById("bankInfo").innerHTML;
		document.getElementById("bankHtml").value=html;
		$("#shortCutPay").submit();
	}else if(type=='wxPay')
	{
		$("#wxPayForm").submit();
	}
}
function eventButton(type)
{
	if(type=='balance')
	{
		$("#ebalanceForm").submit();
	}else
	{
		$("#depositBankCardForm").submit();
	}
}
function hiddenErrorInfo()
{
	document.getElementById("bankNotic").style.display="none";
}

function __getBankInfo()
{
		var mobileRule = /^1[0-9]{10}$/;
		var emailRule = /^[a-zA-Z0-9_\.\$-]{1,20}@[a-zA-Z0-9]{1,10}(\.[a-zA-Z0-9]{1,5}){1,3}$/;
		var name =$("#username").val();
		if(name=="")
		{
			$("#mobopay_errorMsg_shortcut").css("display","block"); 
			$("#mobopay_errorMsg_shortcut").html("<s></s>账户名不能为空");
			   return false;
		}
		if(!mobileRule.test(trim(name)) && ! emailRule.test(trim(name))){
			$("#mobopay_errorMsg_shortcut").css("display","block"); 
			$("#mobopay_errorMsg_shortcut").html("<s></s>账户名应为手机号码或电子邮箱地址");
		    return false;
		}
		var pwd =getIBSInput("powerpass1", t ,"mobopay_errorMsg_shortcut", " 登录密码输入错误：");
		if(pwd==''||pwd==null)
		{
		    return false;
		}
		if(pwd!=null&&name!=""){
			document.getElementById("shortcutpay_mngPin").value=pwd;
		}
		document.getElementById("accounts").value=name;
		var http = new CHttpRequest(__DoBankInfo1,true,1);
		http.Get("/standard/gateway/manager.cgi","mngPin="+pwd+"&checkFlag=1&onclickType=0&accID="+name+"&m=getBankInfo",300);
}

function __getBankInfo1()
{
	var islogin=document.getElementById("islogin").value;
	var name = document.ebalanceForm.mobile.value;
	if(name=='')
	{
		name= document.ebalanceForm.email.value;
	}
	if(islogin==1)
	{
		var http = new CHttpRequest(__DoBankInfo,true,1);
		http.Get("/standard/gateway/manager.cgi","checkFlag=0&onclickType=1&accID="+name+"&m=getBankInfo",300);
	}
}
function changePayType()
{
	var islogin=document.ebalanceForm.islogin.value;
	if(islogin=="1")
	{
		var checkFlag="0";
		var accounts = document.ebalanceForm.mobile.value;
		if(accounts=='')
		{
			accounts= document.ebalanceForm.email.value;
		} 
		if(accounts=='')
		{
			accounts= document.ebalanceForm.internalIdentity.value;
		}
		$('#code_button').attr('disabled',"true");
		var orderId =  document.getElementById("orderId").value;
		var http = new CHttpRequest(__DoAccountLogin,true,1);
		http.Get("/standard/gateway/manager.cgi","mngPin=&orderId="+orderId+"&checkFlag="+checkFlag+"&accounts="+accounts+"&m=accountLogin",300);
	}

}

function _getCode()
{		
		$('#code_button').attr('disabled',"true");
		var smNo=document.getElementById("smNo").value;
		var http = new CHttpRequest(__Dosms,true,1);
		http.Get("/cgi-bin/sms/verify.cgi","smNo="+smNo+"&m=ereget");
		
}
function countDown(secs){        
	if(--secs>0){
		$('#code_button').attr('disabled',"true");
		document.getElementById("code_button").value="("+secs+"秒后)重新获取手机短信验证码";
	    setTimeout("countDown("+secs+")",1000);     
	}else
	{
		$('#code_button').removeAttr("disabled");
		document.getElementById("code_button").value="获取手机短信验证码";
	}    
}
function countDown1(secs){        
	if(--secs>0){
		$('#code_button1').attr('disabled',"true");
		document.getElementById("code_button1").value="("+secs+"秒后)重新获取手机短信验证码";
	    setTimeout("countDown1("+secs+")",1000);     
	}else
	{
		$('#code_button1').removeAttr("disabled");
		document.getElementById("code_button1").value="获取手机短信验证码";
	}    
}

function doSearch()
{
	$("#paysearch").submit()
}
function choosePayType()
{
		document.getElementById('payType').value="0";
		$("#ebalanceForm").submit();
}

function doWebShortCutPay()
{
	var bankCardNo =$("#bankCardNo").val();
	var mobileNo =$("#mobileNo").val();
	var smsCode =document.webShortCutPayForm.smsCode.value;
	var cardExpire =$("#cardExpire").val();
	var cardCvn2 =$("#cardCvn2").val();
	var smNo =document.webShortCutPayForm.smNo.value;
	if(bankCardNo=="")
	{
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>信用卡号不能为空");
	    return false;
	}
	if(mobileNo=="")
	{
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>银行绑定手机号不能为空");
	    return false;
	}
	if(smNo=="")
	{
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>请点击获取短信验证码");
	    return false;
	}
	if(smsCode=="")
	{
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>短信验证码不能为空");
	    return false;
	}
	if(cardExpire=="")
	{
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>信用卡有效期不能为空");
	    return false;
	}
	var cvn2 =getIBSInput("powerpass2", t ,"error_webShortCutPay", " CVN2错误：");
	if(cvn2==''||cvn2==null)
	{
	    return false;
	}
	$("#cardCvn2").val(cvn2); 
	$("#webShortCutPayForm").submit();
}

function _getCode_webShortCutPay()
{		
		var bankCode=document.getElementById("bankCode").value;
		var bankCardNo=document.getElementById("bankCardNo").value;
		var mobileNo=document.getElementById("mobileNo").value;
		var orderId=document.getElementById("orderId").value;
		if(bankCardNo=="")
		{
			$("#error_webShortCutPay").css("display","block"); 
			$("#error_webShortCutPay").html("<s></s>信用卡号不能为空");
		    return false;
		}
		if(mobileNo=="")
		{
			$("#error_webShortCutPay").css("display","block"); 
			$("#error_webShortCutPay").html("<s></s>银行绑定手机号不能为空");
		    return false;
		}
		$('#code_button1').attr('disabled',"true");
		var smNo=document.webShortCutPayForm.smNo.value;
		if(smNo!=""&&smNo!="0")
		{
			var http = new CHttpRequest(__DosmsReSend,true,1);
			http.Get("/cgi-bin/sms/verify.cgi","smNo="+smNo+"&m=ereget");
		}else
		{
			var http = new CHttpRequest(__DoWebShortCutPay,true,1);
			http.Get("/standard/gateway/manager.cgi","bankCode="+bankCode+"&orderId="+orderId+"&bankCardNo="+bankCardNo+"&mobileNo="+mobileNo+"&orderId="+orderId+"&m=selWebShortcutPay",300);
		}
}
function _getNoBankCardType()
{
	var merchNo=document.getElementById("merchNo").value;
	var http = new CHttpRequest(__DoNoBankCardType,true,1);
	http.Get("/standard/gateway/manager.cgi","merchNo="+merchNo+"&m=getBankCardProduct");
}
function doNoBankPay()
{
	var cardType =$("#cardType").val();
	var cardNo =$("#cardNo").val();
	var cardPwd =$("#cardPwd").val();
	var faceAmt =$("#faceAmt").val();
	if(cardType=="-1")
	{
		$("#error_noBankPay").css("display","block"); 
		$("#error_noBankPay").html("<s></s>请选择卡类型");
	    return false;
	}
	if(cardNo=="")
	{
		$("#error_noBankPay").css("display","block"); 
		$("#error_noBankPay").html("<s></s>卡号不能为空");
	    return false;
	}
	if(cardPwd=="")
	{
		$("#error_noBankPay").css("display","block"); 
		$("#error_noBankPay").html("<s></s>卡密码不能为空");
	    return false;
	}
	
	if(faceAmt=="-1")
	{
		$("#error_noBankPay").css("display","block"); 
		$("#error_noBankPay").html("<s></s>请选择卡面值");
		 return false;
	}else if(faceAmt=="0")
	{
		var otherAmt =$("#otherAmt").val();
		if(otherAmt=="")
		{
			$("#error_noBankPay").css("display","block"); 
			$("#error_noBankPay").html("<s></s>其他金额不能为空");
			 return false;
		}else
		{
			if(!isfloat(otherAmt))
			{
				alert("其他金额必须为浮点数");
				return false;
			}
		}
	}
	
	
	EasyMask.init({ width:800, opacity: 3, molor: 'black', fclose: false });
	$("#waitDiv").show();
	$("#noBankPayForm").submit();
}

function chooseFaceAmt()
{
	var faceAmt =$("#faceAmt").val();
	
	if(faceAmt=="0")
	{
		$("#otherAmtDiv").css("display","block"); 
	}else
	{
		$("#otherAmtDiv").css("display","none"); 
	}
}

function isfloat(oNum){
	if(!oNum) return false;
	var strP=/^\d+(\.\d+)?$/;
	if(!strP.test(oNum)) return false;
		try{
			if(parseFloat(oNum)!=oNum) return false;
		}catch(ex){
		  return false;
		}
	return true;
}

</script>
	<div id="contenter">
		<!--=S 主体部分-->
		<div class="bodyWidth">
			<div class="contentBox">
				﻿<h3>订单信息<s class="orderS"></s></h3>
	<div class="listInfo">
		<div class="liDl">
			<dl class="borderBottom clearfix"><dt>订单金额：</dt><dd class="ddInfo"><span class="price"><?php echo $_GET["_deposit"]; ?></span>元</dd></dl>
										<dl class="borderBottom widthL clearfix"><dt>收款方：</dt><dd class="ddInfo"><strong>江西畅源信息科技</strong></dd></dl>
							<div class="clear"></div>
				<dl class="borderBottom clearfix"><dt>订单号：</dt><dd class="ddInfo">QLcoin-153259<?php echo rand(1000, 9999); ?></dd></dl>
								<dl class="borderBottom widthL proInfo clearfix">
						<dt>商品名称：</dt>
						<dd class="ddInfo">线上储值</dd>
						<dd class="infoLayer" style="display: none;"><s></s><p>商品名称：线上储值</p></dd>
					</dl>
								<div class="clear"></div>			
		</div>
				<div class="infoTips"><s></s>本次交易是 即时到账交易，货款立即到账，无需“支付确认”。 </div>
			<div class="clear"></div>
	</div>			<div class="positionRelative">
					<h3 class="part2">选择支付方式<s class="payS"></s></h3>
					<div class="paymentChoose">
						<div class="tabs clearfix">
							<ul class="tabUl clearfix">
																																			<li class="on"><span><s></s>网银储蓄卡支付</span></li>
																																																											</ul>					
						</div>
						<div class="tabs-content">
																						<div class="box on">
		<form method="post" name="depositBankCardForm" id="depositBankCardForm" action="https://trade.hfbpay.com/standard/gateway/pay.cgi" style="padding:0;margin:0">
			<input type="hidden" name="accName2" id="accName2" value="江西畅源信息科技">
			<input type="hidden" name="tradeType" id="tradeType" value="1">
			<input type="hidden" name="orderNo" id="orderNo" value="42622005">
			<input type="hidden" name="tradeNo" id="tradeNo" value="ADtest06-1532595985">
			<input type="hidden" name="summary" id="summary" value="线上储值">
			<input type="hidden" name="amt" id="amt" value="555.00 ">
			<input type="hidden" name="platformID" id="platformID" value="210000360002520 ">
			<input type="hidden" name="orderId" id="orderId" value="3C3152D7007BFA467171831B34D16F014FE6D6302444F77B4536C0DD3701626141654EDC59FD029B">
			<input type="hidden" name="payType" id="payType">
			<input type="hidden" name="merchNo" id="merchNo" value="210000360002520">
			<input type="hidden" name="payType1" id="payType1" value="8">
			<input type="hidden" name="__token" id="__token" value="0243D21361D3A78C5356C5AB2DC3CBB87937563B53693E28797026835689A276F451664C3EAC2E1FC730A6715355FBD01F78C55443A9CB89B111A64353FE952627547CA0E3C69EC1D7F198D242354E11C7D5C1F2ADEAD9AADF708AEF111712F1CC6A25F9C30E564BC1C4D3F53A40993CFEDD66313A5CDF953445718EDAB3D0AF">
			<input type="hidden" name="m" id="m" value="selBankWebPay">
			<input type="hidden" name="payTypes" id="payTypes" value="19,23,29,8">
						<h4 class="titleH4"><s></s>选择网上银行储蓄卡进行支付
	</h4>
	<div class="bankList">
		<ul class="clearfix">
			<li><input name="pt" value="J_ICBC" type="radio"  id="ICBC_J"><img src="./register-files/ICBC.gif" alt="工商银行" ></li>
			<li><input name="pt" value="J_CMB" type="radio" id="CMB_J"><img src="./register-files/CMB.gif" alt="招商银行" ></li>
			<li><input name="pt" value="J_CCB" type="radio" id="CCB_J"><img src="./register-files/CCB.gif" alt="建设银行"></li>
			<li><input name="pt" value="J_COMM" type="radio" id="COMM_J"><img src="./register-files/COMM.gif" alt="交通银行"></li>
			<li><input name="pt" value="J_ABC" type="radio" id="ABC_J"><img src="./register-files/ABC.gif" alt="农业银行"></li>
			<li><input name="pt" value="J_BOC" type="radio" id="BOC_J"><img src="./register-files/BOC.gif" alt="中国银行"></li>
			<li><input name="pt" value="J_PSBC" type="radio" id="PSBC_J"><img src="./register-files/PSBC.gif" alt="邮政储蓄银行"></li>
		  <li><input name="pt" value="J_SPDB" type="radio" id="SPDB_J"><img src="./register-files/SPDB.gif" alt="浦发银行" ></li>
			<li><input name="pt" value="J_HXB" type="radio" id="HXB_J"><img src="./register-files/HXB.gif" alt="华夏银行" ></li>
			<li><input name="pt" value="J_PAB" type="radio" id="PAB_J"><img src="./register-files/PAB.gif" alt="平安银行"></li>
			<li><input name="pt" value="J_GDB" type="radio"  id="GDB_J"><img src="./register-files/GDB.gif" alt="广发银行" ></li>
							<li><input name="pt" value="J_CEB" type="radio"  id="CEB_J"><img src="./register-files/CEB.gif" alt="光大银行" ></li>
			<li><input name="pt" value="J_CIB" type="radio" "=""  id="CIB_J"><img src="./register-files/CIB.gif" alt="兴业银行" ></li>
			<li><input name="pt" value="J_CMBC" type="radio" id="CMBC_J"><img src="./register-files/CMBC.gif" alt="民生银行" ></li>
			<li><input name="pt" value="J_CNCB" type="radio" id="CNCB_J"><img src="./register-files/CNCB.gif" alt="中信银行"></li>
		</ul>
	</div>
							<div class="operateDiv borderLine marginTop20 clearfix">
				<a href="javascript:void(0)" onclick="doSubmit(&#39;bank&#39;)" class="operateA onlinePay"><span class="positionRelative">登录到网上银行支付<s></s></span></a>
			</div>
		</form>
	</div>																																										</div>
					</div>
					<!--=E选择支付方式-->
				</div>
				<!--=Epart2-->
				<div class="clear"></div>
			</div>
		</div>
		<!--=E主体部分-->
	</div>
	﻿<!--=S 订单列表 -->
	<div class="orderListLayer">

	<div id="footer">
		<div class="footerBox">
			<div class="bodyWidth">
				<div class="fbInfo">
					<span class="fAbout"><s></s>关于我们</span>|<span class="fHelp"><s></s>帮助中心</span>|<span class="fContact"><s></s>联系我们</span>
				</div>
				<div class="fbCopyright">
					<p>Copyright <em>©</em> 2015-2016 HFBao All Rights Reserved 版权所有</p>
					
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>

</body></html>