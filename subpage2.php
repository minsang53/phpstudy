<?php
session_start();
include "DB.php";
$db=new DB("test");
$page=$_GET['page'];
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
?>
<h2>환영 합니다.<?= $id ?>님</h2>

<div>
    <h4>자유 게시판</h4>
    <select name='viewNo'>
        <option value='5' selected>5개씩 보기</option>
        <option value='10'>10개씩 보기</option>
    </select>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
    <script type="text/javascript">
		var a=$("select[name=viewNo]").val();
		document.write(a);
    </script>
    <table border=1>
        <tr><td>번호</td>
        <td>글 제목</td>
        <td>작성자</td>
        <td>조회수</td></tr>
        <?php
        $test=$db->viewFreeBoard($page);
        echo $db->boardNum();
        echo count($test);
        for($i=0;$i<count($test);$i++){
            echo "<tr><td>".($db->boardNum()-(5*($page-1))-$i)."</td>";
            echo "<td><a href='./viewpage.php?no=".$test[$i][5]."'>".$test[$i][2]."</a></td>";
            echo "<td>".$test[$i][1]."</td>";
            echo "<td>".$test[$i][4]."</td></tr>";
        }
        $_SESSION['name']=$db->getName($id);
        ?>
    </table>
</div>
<?php for($i=1;$i<ceil($db->boardNum()/5)+1;$i++) echo "<p>-<a href='./subpage2.php?page=".$i."'>".$i."</a>-</p>";?>
<br><br>

<button onclick="location.href='nextpage.php'">게시글 작성</button>
<button onclick="location.href='logout.php'">로그 아웃</button>
