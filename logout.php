<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "권한이 없습니다";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}else{
    //세션 초기화
    $_SESSION=array();
    echo "<a href=startPage.php>시작페이지로</a>";
}