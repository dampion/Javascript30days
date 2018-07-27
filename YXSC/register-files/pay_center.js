
function CHttpRequest(fCallback, mode, restype) {
//创建对象
	this.m_HttpRequest = createXMLHttpRequest();
//属性
	this.m_bAsyncFlag = mode;
	if (restype) {
		this.m_iResType = restype;
	} else {
		this.m_iResType = 2;
	}	//responseXml
//方法
	this.Post = CHttpRequest_Post;
	this.Get = CHttpRequest_Get;
	this.m_fCallBack = fCallback;
}
function CHttpRequest_Get(dst, para) {
	var now = new Date();
	var rnd = Math.floor(Math.random() * 100000);
	var ptm = now.getSeconds().toString() + rnd.toString() + now.getMinutes().toString();
	para += "&ptm=" + ptm.toString();
	var http = this;
	function tm_back() {
		if (http.m_HttpRequest.readyState == 4) {
			if (http.m_HttpRequest.status == 200) {
				if (http.m_iResType == 1) {
					http.m_fCallBack(4, 200, http.m_HttpRequest.responseText);
				} else {
					http.m_fCallBack(4, 200, http.m_HttpRequest.responseXML);
				}
			} else {
				http.m_fCallBack(4, http.m_HttpRequest.status, null);
			}
		} else {
			http.m_fCallBack(http.m_HttpRequest.readyState, null, null);
		}
	}
	this.m_HttpRequest.onreadystatechange = tm_back;
	this.m_HttpRequest.open("GET", dst + "?" + para, this.m_bAsyncFlag);
	this.m_HttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=GB2312");
	this.m_HttpRequest.setRequestHeader("Cache-Control", "no-cache");
	this.m_HttpRequest.send("");
}
function CHttpRequest_Post(dst, para) {
	var http = this;
	function tm_back() {
		if (http.m_HttpRequest.readyState == 4) {
			if (http.m_HttpRequest.status == 200) {
				if (http.m_iResType == 1) {
					http.m_fCallBack(4, 200, http.m_HttpRequest.responseText);
				} else {
					http.m_fCallBack(4, 200, http.m_HttpRequest.responseXML);
				}
			} else {
				http.m_fCallBack(4, http.m_HttpRequest.status, null);
			}
		} else {
			http.m_fCallBack(http.m_HttpRequest.readyState, null, null);
		}
	}
	this.m_HttpRequest.onreadystatechange = tm_back;
	this.m_HttpRequest.open("POST", dst, this.m_bAsyncFlag);
	this.m_HttpRequest.setRequestHeader("Content-Length", para.length);
	this.m_HttpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//	this.m_HttpRequest.setRequestHeader("Content_Type","application/x-www-form-urlencoded;charset=GB2312");
//this.m_HttpRequest.setRequestHeader("Content_Type","text/xml;charset=GB2312");
	this.m_HttpRequest.send(para);
}
function getXMLPrefix() {
	if (getXMLPrefix.prefix) {
		return getXMLPrefix.prefix;
	}
	var prefixes = ["MSXML3", "MSXML2", "MSXML", "Microsoft"];
	var obj, obj2;
	for (var i = 0; i < prefixes.length; i++) {
		try {
//Attempt to create an XmlHttp object using the current prefix
			obj = new ActiveXObject(prefixes[i] + ".XmlHttp");
			return getXMLPrefix.prefix = prefixes[i];
		}
		catch (ex) {
		}
	}
	throw new Error("\u60a8\u6ca1\u6709\u5b89\u88c5XML\u89e3\u6790\u5668,\u8bf7\u4f7f\u7528INTERNET EXPLORE 5\u4ee5\u4e0a\u7684\u6d4f\u89c8\u5668.");
}
function createXMLHttpRequest() {
	try {
// Attempt to create it "the Mozilla way"
		if (window.XMLHttpRequest) {
			return new XMLHttpRequest();
		}
// Guess not - now the IE way
		if (window.ActiveXObject) {
			return new ActiveXObject(getXMLPrefix() + ".XmlHttp");
		}
	}
	catch (ex) {
		alert(ex.message);
	}
	return false;
}
function __DoCustRealBank(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showCustRealBank(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __Dosms(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showM(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DosmsIcbcEPay(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showIcbcEPay(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DoBankInfo(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showBankInfo(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DoBankInfo1(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showBankInfo1(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DoAccountLogin(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showAccountLogin(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}

function __DoWebShortCutPay(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showWebShortCutPay(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DosmsReSend(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showReSend(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}
function __DoNoBankCardType(state, sts, str) {
	switch (state) {
	  case 0://initting
	  case 1://reading
	  case 2://readed
	  case 3://interact
		break;
	  case 4://complete
		switch (sts) {
		  case 200://success
			showNoBankCardType(str);
			break;
		  case 404://notfound
			alert("\u670d\u52a1\u5668\u7e41\u5fd9,\u8bf7\u7a0d\u540e\u5728\u8bd5!");
		  default:
			break;
		}
	  default:
		break;
	}
}


function showCustRealBank(msg) {
	var strs = new Array();
	strs = msg.split("&#&"); //字符分割      
	if (strs[0] == "00") {
		$("#error_msg1").css("display", "none");
		$("#haveBankDiv").html(strs[1]);
	} else {
		var s_style ="<s style=\"left:120px\"></s>";
		$("#error_msg1").html(s_style+msg);
		$("#error_msg1").css("display", "block");
	}
}
function showIcbcEPay(msg) {
	var strs = new Array();
	strs = msg.split("&"); //字符分割      
	if (strs[0] == "ok") {
		countDown(60);
		$("#error_msg").css("display", "none");
		$("#error_msg").html("\u52a8\u6001\u5bc6\u7801\u5df2\u7ecf\u53d1\u9001\uff0c\u8bf7\u67e5\u6536\uff01");
		$("#sessionID").val(strs[1]);
	} else {
		var s_style ="<s style=\"left:120px\"></s>";
		$("#code_button").removeAttr("disabled");
		$("#error_msg").html(s_style+msg);
		$("#error_msg").css("display", "block");
	}
}
function showM(msg) {
	if (msg == "ok") {
		countDown(60);
		$("#msg_note").html("");
		$("#msg_note").html("\u77ed\u4fe1\u9a8c\u8bc1\u7801\u5df2\u7ecf\u91cd\u53d1\u5230\u60a8\u7684\u624b\u673a\uff0c\u8bf7\u67e5\u6536!");
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS2");
		$("#msg_note").addClass("tpTS3");
	} else {
		$("#code_button").removeAttr("disabled");
		$("#msg_note").html("");
		$("#msg_note").html(msg);
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS3");
		$("#msg_note").addClass("tpTS2");
		$("#smsCode").addClass("tpInput2");
	}
}

function showBankInfo(msg) {
	var strs = new Array();
	strs = msg.split("&#&");
	$("#bankInfo").html("");
	$("#bankInfo").html(strs[1]);
}
function showBankInfo1(msg) {
	var strs = new Array();
	strs = msg.split("&#&");
	if (strs[0] == 0) {
		$("#bankInfo").html("");
		$("#bankInfo").html(strs[1]);
		var mobile=strs[3];
		var email = strs[4];
		var accName=strs[5];
		var useableAmt=strs[6];
		var account=strs[7];
		document.ebalanceForm.mobile.value=mobile;
		document.ebalanceForm.email.value=email;
		document.ebalanceForm.accounts.value=account;
		document.shortCutPay.accNo.value = strs[2];
		document.ebalanceForm.islogin.value = "1";
		document.getElementById("divBeforeLogin").style.display = "none";
		document.getElementById("divAfterLogin").style.display = "block";
		document.ebalanceForm.checkFlag.value = "0";
		document.getElementById("div_head_before_login").style.display = "none";
		document.getElementById("div_head_after_login").style.display = "block";
		$("#head_userName").html(accName);
		$("#head_useableAmt").html(useableAmt);
	} else {
		document.getElementById("mobopay_errorMsg_shortcut").style.display = "block";
		$("#mobopay_errorMsg_shortcut").html("<s></s>" + strs[1]);
	}
}
function showAccountLogin(msg) {
	var obj = JSON.parse(msg);
	var respCode = obj.respCode;
	var respDesc = obj.respDesc;
	if (respCode == "00") {
		var smType = obj.smType;
		var smNo = obj.smNo;
		var accName = obj.accName;
		var useableAmt = obj.useableAmt;
		var amt = obj.Amt;
		var smType =obj.smType;
		var accNo = obj.accNo;
		var mobile = obj.Mobile;
		var email = obj.Email;
		document.ebalanceForm.smNo.value = smNo;
		document.ebalanceForm.smType.value = smType;
		document.ebalanceForm.islogin.value = "1";
		document.ebalanceForm.internalIdentity.value = accNo;
		document.ebalanceForm.smNo.value = smNo;
		document.ebalanceForm.smType.value = smType;
		document.ebalanceForm.mobile.value = mobile;
		document.ebalanceForm.email.value = email;
		document.getElementById("div_head_before_login").style.display = "none";
		document.getElementById("div_head_after_login").style.display = "block";
		//document.shortCutPay.accNo.value=accNo;
		$("#mobopay_errorMsg_after").css("display", "none");
		$("#head_userName").html(accName);
		$("#head_useableAmt").html(useableAmt);
		//$("#code_button").attr("disabled", "true");
		var banlanc = ForDight(Number(useableAmt) - Number(amt),2);
		if (banlanc < 0 && useableAmt > 0) {
			document.getElementById("mobaopay_msg_1").style.display = "none";
			document.getElementById("mobaopay_msg_2").style.display = "block";
			$("#mobaopay_banlanc").html(Math.abs(banlanc));
			$("#mobaopay_useableAmt2").html(useableAmt);
			document.ebalanceForm.m.value ="moboBalanceWebPay";
			document.ebalanceForm.banlanc.value=Math.abs(banlanc);
			document.getElementById("haveBanlancDiv").style.display = "block";
			document.getElementById("subimtButton").style.display = "block";
			document.getElementById("noBanlancDiv").style.display = "none";
		} else if (banlanc >= 0) {
				document.getElementById("mobaopay_msg_1").style.display = "block";
				document.getElementById("mobaopay_msg_2").style.display = "none";
				$("#mobaopay_useableAmt1").html(useableAmt);
				document.getElementById("haveBanlancDiv").style.display = "block";
				document.getElementById("subimtButton").style.display = "block";
				document.getElementById("noBanlancDiv").style.display = "none";
				document.ebalanceForm.m.value ="moboWebPay";
			
		}else if(useableAmt==0)
			{
				document.getElementById("mobaopay_msg_1").style.display = "block";
				document.getElementById("mobaopay_msg_2").style.display = "none";
				$("#mobaopay_useableAmt1").html(useableAmt);
				document.getElementById("haveBanlancDiv").style.display = "none";
				document.getElementById("subimtButton").style.display = "none";
				document.getElementById("noBanlancDiv").style.display = "block";
			}
		if(smType!="1")
		{
				$('#code_button').attr('disabled',"true");
				document.getElementById("mobileCodeDiv").style.display = "none";
		}else
		{
			document.getElementById("mobileCodeDiv").style.display = "block";
			$("#mobileOfHidden").html("");
			$("#mobileOfHidden").html(mobile.replace(/(\d{3})(\d{4})(\d{4})/,"$1****$3"));
			var code_button_value = document.getElementById("code_button").value;
			if(code_button_value=="获取手机短信验证码")
			{
				countDown(60);
			}
		}
		document.getElementById("divBeforeLogin").style.display = "none";
		document.getElementById("divAfterLogin").style.display = "block";
	} else {
		if(respCode == "21"||respCode == "49"||respCode == "48")
		{
			var url="https://person.mobaopay.com/view/mobo/findPWD.jsp";
			respDesc =respDesc+"。<a href=\""+url+"\" target=\"blank\">找回登录密码</a>"
		}
	
		
		document.getElementById("divBeforeLogin").style.display = "block";
		document.getElementById("divAfterLogin").style.display = "none";
		$("#mobopay_errorMsg").css("display", "block");
		$("#mobopay_errorMsg").html("<s></s>" + respDesc);
		
	}
}
function showWebShortCutPay(msg) {
	var strs = new Array();
	strs = msg.split("&#&");
	if (strs[0] == "00") {
		countDown1(60);
		document.webShortCutPayForm.smNo.value=strs[1];
		$("#bankCardNo").attr("readonly","readonly");
		$("#mobileNo").attr("readonly","readonly");
		$("#msg_note").html("");
		$("#msg_note").html("\u77ed\u4fe1\u9a8c\u8bc1\u7801\u5df2\u7ecf\u91cd\u53d1\u5230\u60a8\u7684\u624b\u673a\uff0c\u8bf7\u67e5\u6536!");
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS2");
		$("#msg_note").addClass("tpTS3");
	} else {
		$("#code_button1").removeAttr("disabled");
		$("#msg_note").html("");
		$("#msg_note").html(msg);
		$("#error_webShortCutPay").css("display","block"); 
		$("#error_webShortCutPay").html("<s></s>"+strs[1]);
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS3");
		$("#msg_note").addClass("tpTS2");
		$("#smsCode").addClass("tpInput2");
	}
	
}

function showReSend(msg) {
	if (msg == "ok") {
		countDown1(60);
		$("#msg_note").html("");
		$("#msg_note").html("\u77ed\u4fe1\u9a8c\u8bc1\u7801\u5df2\u7ecf\u91cd\u53d1\u5230\u60a8\u7684\u624b\u673a\uff0c\u8bf7\u67e5\u6536!");
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS2");
		$("#msg_note").addClass("tpTS3");
	} else {
		$("#code_button1").removeAttr("disabled");
		$("#msg_note").html("");
		$("#msg_note").html(msg);
		$("#msg_note").removeClass("tpTS1");
		$("#msg_note").removeClass("tpTS3");
		$("#msg_note").addClass("tpTS2");
		$("#smsCode").addClass("tpInput2");
	}
}

function showNoBankCardType(msg) {
	if(msg!="")
	{
		var array = msg.split(",");
		for (var i = 0;i< array.length;i++){
			if(array[i]!="")
			{
				var value=array[i].split("|")[0];
				var name=array[i].split("|")[1];
				//("<option value='"+ value + "'>"+name+"</option>").appendTo("#cardType");
				//document.getElementById("cardType").options.add(new Option(value,name));
				 var oOption= document.createElement("OPTION");  
			     oOption.value=value;
			     oOption.text=name; 
			     document.getElementById("cardType").options.add(oOption);
			}
		}
		//document.getElementById("cardType").innerHTML=html;
	}
}

function ForDight(Dight, How) {
	Dight = Math.round(Dight * Math.pow(10, How)) / Math.pow(10, How);
	return Dight;
}
