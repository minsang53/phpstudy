<?php
session_start();
include "DB.php";
$db = new DB("test");
$id=$_SESSION['id'];
$info = $db->viewPage($_SESSION['no']);
//세션 권한 확인
if(!isset($id) or $id!=$info['id']){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}

?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<div> 제목 <input type="text" name="title" value="<?=$info['title']?>"/></div>
<div> 내용 <textarea name="content" cols="40" rows="10"><?=$info['content']?></textarea></div>
<input type="submit" value="수정하기"/>
</form>
<a href="./viewPage.php?no=<?=$_SESSION['no']?>"><button>뒤로가기</button></a>

<?php 
if(isset($_POST['title'])&&isset($_POST['content'])){
    if($_POST['title']!=NULL&&$_POST['content']!=NULL){
        $result = $db->modifyContent($_SESSION['no'],$_POST['title'],$_POST['content']);
        if($result){
            echo "<script>alert('수정이 완료되었습니다.');</script>";
            echo "<script>location.replace('./mainPage.php?page=1');</script>";
        }
    }else{
        echo "<script>alert('내용이 비어있는 것이 있으면 수정할 수 없습니다.');</script>";
        unset($_POST['title']);
        unset($_POST['content']);
        echo "<script>location.replace('./modifyPage.php?no=".$_SESSION['no']."');</script>";
    }
}
    
?>