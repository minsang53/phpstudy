<?php
include "DB.php";
$db = new DB("test");
$id=$_POST['id'];
$pwd=$_POST['pwd'];
$pwd2=$_POST['pwd2'];
$name=$_POST['usr_name'];

if($pwd!=$pwd2){
    echo "비밀번호가 서로 일치하지 않습니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}

if($id==NULL||$pwd==NULL||$pwd2==NULL||$name==NULL){
    echo "비어있는 부분이 있습니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}

if(!$db->selectDB($id)){
    echo "중복된  ID입니다.";
    echo "<a href=sign.php>뒤로가기</a>";
    exit();
}
if($db->signUser($id, $pwd, $name)){
    echo "회원가입 성공";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
