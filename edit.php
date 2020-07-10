<?php
session_start();
include "DB.php";
$db = new DB("test");
//세션 값 존재 여부 확인
if(!isset($_SESSION['id'])){
    echo "권한이 없습니다.";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}
$id=$_SESSION['id'];
$name=$_SESSION['name'];
$title=$_POST['title'];
$content=$_POST['content'];

if($db->storeData($id, $name, $title, $content)){
    echo "<script>alert('작성이 완료되었습니다.');</script>";
    echo "<script>location.replace('./mainPage.php?page=1');</script>";
}

