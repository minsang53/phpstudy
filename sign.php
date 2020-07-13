<html>
<head>
<title>Sign</title>
</head>
<h3>회원가입</h3>
<form method="post" action="signPage.php">
아이디 <input type="text" name="id" id="id"/><p id="check"></p>
비밀번호 <input type="password" name="pwd" id="pw" onchange="check()"><p id="pwdCheck"></p>
비밀번호 확인<input type="password" id="pw2" name="pwd2" onchange="comparePwd()"/><p id="pwdCheck2"></p>
이름 <input type="text" name="usr_name"/>
<input type="submit" value="회원가입"/>
</form>
</html>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript">

//비밀번호 정규표현식 체크
function check(){
    //영문+숫자+대문자1개이상+특수문자1개이상인 8자리 이상 문자열
	var pattern=/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8}/;
	var pwd = document.getElementById("pw").value;
	
	if(pattern.test(pwd)){
	    document.getElementById("pwdCheck").innerHTML="확인";
	    return true;
	}
	else{
      	document.getElementById("pwdCheck").innerHTML="대소문자1개+특수문자1개+숫자를 포함하여 비밀번호를 구성해 주십시오.";
      	return false;
	}
}
//비밀번호의 값이 동일한지 확인
function comparePwd(){
	if(check()){
		var pwd1 = document.getElementById("pw").value;
		var pwd2 = document.getElementById("pw2").value;
		if(pwd1===pwd2){
		    document.getElementById("pwdCheck2").innerHTML="일치";
		}else{
			document.getElementById("pwdCheck2").innerHTML="불일치";
		}
	}
}
//아이디 중복체크
$("#id").change(function(){
	//alert($("#id").val());
    $.ajax({url:"test.php",
    type:"post",
    data:{id:$("#id").val()},
    success:function(result){
        //alert(result);
        if(result=="true"){
        	$("#check").html("사용하실 수 있는 아이디 입니다.");
        }else{
        	$("#check").html("중복된 아이디 입니다.");
        }
    }
    });    
})
</script>
<?php


     
    
