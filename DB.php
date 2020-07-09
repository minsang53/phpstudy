<?php
class DB{
    protected $dbname;
    protected $db;
    public function __construct($dbname) {
        $this->dbname = $dbname;
        $this->db=mysqli_connect("localhost","root","",$this->dbname);
    }
    //DB연결
    public function connectDB(){
        $this->db=mysqli_connect("localhost","root","",$this->dbname);
        /*
        if($this->db)
            echo "success";
        else
            echo "fail";
        */
    }
    //중복 검색
    public function selectDB($id){
        $check="SELECT * from usr_table WHERE id='$id'";
        $result=mysqli_query($this->db,$check);
        if(mysqli_fetch_row($result))
            return false;
        else
            return true;
    }
    //로그인
    public function loginUser($id,$pwd){
        $check="SELECT * from usr_table WHERE id='$id' and pwd=password($pwd)";
        //echo $check;
        $result=mysqli_query($this->db,$check);
        if(mysqli_fetch_row($result)){
            return true;
        }
        else{
            return false;
        }
    }
    //사용자 이름 가져오기
    public function getName($id) {
        $check="SELECT name from usr_table WHERE id='$id'";
        $result= mysqli_query($this->db,$check);
        $test=mysqli_fetch_row($result);
        return $test[0];
    }
    //게시글 작성
    public function storeData($id,$name,$title,$content) {
        $check="INSERT INTO free_board(id,name,title,content) values('$id','$name','$title','$content')";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else
            return false;
    }
    //조회수 증가
    public function updateHit($no) {
        $check="UPDATE free_board set hit=hit+1 where no='$no'";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else
            return false;
    }
    //회원가입
    public function signUser($id,$pwd,$name) {
        $check="INSERT INTO usr_table(id,pwd,name) values('$id',password($pwd),'$name')";
        $result=mysqli_query($this->db, $check);
        if($result)
            return true;
        else
            return false;
    }
    //게시글 정보 가져오기
    public function viewFreeBoard($page) {
        $check="SELECT * from free_board order by no desc LIMIT ".(5*($page-1)).",".$page*5;
        $result=mysqli_query($this->db, $check);
        $info=array(array());
        $i=0;
        //리스트로 저장
        while($row=mysqli_fetch_row($result)){
            for($j=0;$j<count($row);$j++)
                $info[$i][$j]=$row[$j];
            $i++;
        }
        return $info;
    }
    public function viewPage($no){
        $check="SELECT * from free_board where no='$no'";
        $result=mysqli_query($this->db,$check);
        $row=mysqli_fetch_row($result);
        $info=array('name'=>$row[1],
              'title'=> $row[2],
              'content'=> $row[3],
              'hit'=> $row[4]);
        return $info;
    }
    public function boardNum() {
        $check="SELECT * from free_board";
        $result=mysqli_query($this->db,$check);
        $count=mysqli_num_rows($result);
        return $count;
    }
}