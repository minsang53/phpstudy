<?php
include "DB.php";
$db=new DB("test");
session_start();
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
$getNo= $_GET['no'];
$db->updateHit($getNo);
$info=$db->viewPage($getNo);

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

</body>

</html>