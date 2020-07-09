<?php
session_start();
$name=$_SESSION['name'];
$id=$_SESSION['id'];
if(!isset($id)){
    echo "권한이 없습니다.";
    echo "<a href=main.php>메인으로</a>";
    exit();
}
?>
<html>
<head>
    <style>
        
    </style>
</head>
<body>
    <form method='post' action='edit.php'>
    	<div>글 제목 <input type='text' name='title'/></div>
    	<div>내용<textarea name='content'></textarea></div>
    	<div>글쓴이<input type='text' name='name' <?php echo "value='$name'"?> readonly/></div>
    	<div>파일첨부</div>
    	<div><input type='submit' value='글 작성'/></div>
    </form>
</body>
</html>