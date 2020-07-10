<?php
session_start();
include "DB.php";
$db=new DB("test");
$page=$_GET['page'];
$id=$_SESSION['id'];
//세션 값 존재 여부 확인
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
if(isset($_SESSION['no']))
    unset($_SESSION['no']);
?>
<h2>환영 합니다.<?= $id ?>님</h2>

<div>
    <h4>자유 게시판</h4>
    <select name='viewNo'>
        <option value='5' selected>5개씩</option>
        <option value='10'>10개씩</option>
    </select>
    <table border=1>
        <tr><td>번호</td>
        <td>글 제목</td>
        <td>작성자</td>
        <td>조회수</td></tr>
        <?php
        $list=$db->viewFreeBoard($page);
        for($i=0;$i<count($list);$i++){
            echo "<tr><td>".($db->boardNum()-(5*($page-1))-$i)."</td>";
            echo "<td><a href='./viewPage.php?no=".$list[$i][5]."'>".$list[$i][2]."</a></td>";
            echo "<td>".$list[$i][1]."</td>";
            echo "<td>".$list[$i][4]."</td></tr>";
        }
        $_SESSION['name']=$db->getName($id);
        ?>
    </table>
</div>
<!-- 게시판의 총 글의 개수를 가져와서 5(viewNo)로 나누고 올림한 값+1 까지 반복하여 게시판의 페이지 개수를 가져옴 -->
<?php for($i=1;$i<ceil($db->boardNum()/5)+1;$i++) echo "<p>-<a href='./mainPage.php?page=".$i."'>".$i."</a>-</p>";?>
<br><br>

<button onclick="location.href='editPage.php'">게시글 작성</button>
<button onclick="location.href='logout.php'">로그 아웃</button>
