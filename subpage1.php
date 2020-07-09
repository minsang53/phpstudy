<?php
include "DB.php";
$db = new DB("test");
if(!isset($_POST['id']) or !isset($_POST['pwd']))
    echo "권한이 없습니다";
    echo "<a href=main.php>메인으로</a>";
    exit();
    
$id = $_POST['id'];
$pwd = $_POST['pwd'];

if($id==NULL||$pwd==NULL){
    echo "비어있는 곳이 있습니다.";
    echo "<a href=main.php>뒤로가기</a>";
    exit();
}

$result=$db->loginUser($id,$pwd);
if($result){
    echo "<script>alert('로그인이 완료되었습니다.');</script>";
    echo "<script>location.replace('./subpage2.php?page=1');</script>";
    session_start();
    $_SESSION['id']=$id;
}else{
    echo "<script>alert(\"입력된 정보가 일치하지 않습니다. 다시 로그인 해주십시오.\");</script>";
    echo "<script>location.replace('./main.php');</script>";
}