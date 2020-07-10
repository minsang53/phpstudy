<?php
//sign.php에서의 아이디 중복 처리
include "DB.php";
$db = new DB("test");
$id=$_POST['id'];

if($db->selectDB($id)){
    echo "true";
}else{
    echo "false";
}