<?php
include "DB.php";
$db=new DB("test");
session_start();
$id=$_SESSION['id'];
//세션 권한 확인
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
$getNo= $_GET['no'];
//조회수 증가
$db->updateHit($getNo);
$info=$db->viewPage($getNo);
$_SESSION['no']=$getNo;
?>

<html>
<head>
</head>
<body>
    <table border=1>
        <tr><td>제목</td><td><?=$info['title']?></td></tr>
        <tr><td>작성자</td><td><?=$info['name']?></td><td>조회수</td><td><?=$info['hit']?></td></tr>
        <tr><td>내용</td></tr>
        <tr><td><?=$info['content']?></td></tr>
    </table>
    <a href="./mainPage.php?page=1"><button>목록</button></a>
    <?php 
    //글 작성자와 세션을 가진 사용자가 같을 경우 수정 과 삭제 가능
    if($id==$info['id']){
        echo "<a href='./modifyPage.php'><button>수정</button></a>";
        echo "<a href='./deletePage.php'><button>삭제</button></a>";
    }
    ?>
</body>

</html>