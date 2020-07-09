<?php
//header('Content-Type: text/html; charset=utf-8');
session_start();
include "DB.php";
$db = new DB("test");
if(!isset($_POST['id'])){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
    
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
$name=$_SESSION['name'];
$title=$_POST['title'];
$content=$_POST['content'];

if($db->storeData($id, $name, $title, $content)){
    echo "<script>alert('작성이 완료되었습니다.');</script>";
    echo "<script>location.replace('./subpage2.php?page=1');</script>";
}else{
    print 실패;
}

//subpage2.php로 이동
