<?php
session_start();
if(!isset($_SESSION['id'])){
    echo "권한이 없습니다";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}else{
    $_SESSION=array();
    echo "<a href=main.php>메인으로</a>";
}