<?php
session_start();
include "DB.php";
$db=new DB("test");
//세션 권한 확인
if(!isset($_SESSION['id'])){
    echo "권한이 없습니다.";
    echo "<a href=startPage.php>시작페이지로</a>";
    exit();
}
echo "<script>
          var con;
          con=confirm('삭제 하시겠습니까?');
          if(con){
              ".$db->deleteContent($_SESSION['no']).";
          }else{
              alert('취소 하셧습니다.');
          }</script>";
echo "<script>location.replace('./mainPage.php?page=1');</script>";