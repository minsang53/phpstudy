<?php
include "DB.php";
$db = new DB("test");
$id=$_POST['id'];
$pwd=$_POST['pwd'];
$pwd2=$_POST['pwd2'];
$name=$_POST['usr_name'];
//패스워드 일치 여부 확인
if($pwd!=$pwd2){
    echo "비밀번호가 서로 일치하지 않습니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}
//비어있는 부분 확인
if($id==NULL||$pwd==NULL||$pwd2==NULL||$name==NULL){
    echo "비어있는 부분이 있습니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}
//중복 확인
if(!$db->selectDB($id)){
    echo "중복된  ID입니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}
//회원가입
if($db->signUser($id, $pwd, $name)){
    echo "회원가입 성공";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}
