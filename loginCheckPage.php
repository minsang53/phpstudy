<?php
include "DB.php";
$db = new DB("test");
//post로 값이 들어왔는지 확인
if(!isset($_POST['id']) || !isset($_POST['pwd'])){
    echo "권한이 없습니다";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}
$id = $_POST['id'];
$pwd = $_POST['pwd'];
//post로 들어온 값의 유무 확인
if($id==NULL||$pwd==NULL){
    echo "비어있는 곳이 있습니다.";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}

$result=$db->loginUser($id,$pwd);
if($result){
    echo "<script>alert('로그인이 완료되었습니다.');</script>";
    echo "<script>location.replace('./mainPage.php?page=1');</script>";
    session_start();
    //세션 할당
    $_SESSION['id']=$id;
}else{
    echo "<script>alert(\"입력된 정보가 일치하지 않습니다. 다시 로그인 해주십시오.\");</script>";
    echo "<script>location.replace('./startPage.php');</script>";
}