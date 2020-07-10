<html>
<head>
    <title>Start</title>
</head>
<body>
    <h2>시작 페이지 입니다.</h2>
    <h4>서비스를 이용 하시려면 로그인을 해주십시오.</h4>
    <form method="post" action="loginCheckPage.php">
        아이디 <input type="text" name="id">
        비밀번호 <input type="password" name="pwd"><br><br>
    <input type="submit" value="로그인">
    </form>
    <button onclick="location.href='sign.php'">회원가입</button>
    
</body>
</html>


<?php
