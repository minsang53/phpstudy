<?php
/**
 * DB 처리 함수 클래스
 * @author Hwang Minsang
 *
 */
class DB{
    /**
     * DB 클래스 생성자 
     * @protected $dbname 사용할 DB 이름
     * @protected $db DB연결된 변수
     * @param String $dbname 사용할 DB 이름
     */
    protected $dbname; 
    protected $db;
    public function __construct($dbname) {
        $this->dbname = $dbname;
        $this->db=mysqli_connect("localhost","root","",$this->dbname);
    }
    /**
     * 회원 id 중복확인
     * @param String $id 사용자 id
     * @return boolean $result 결과 여부 확인
     */
    public function selectDB($id){
        $check="SELECT * from usr_table WHERE id='$id'";
        $result=mysqli_query($this->db,$check);
        if(mysqli_fetch_row($result))
            return false;
        else
            return true;
    }
    /**
     * 로그인
     * @param String $id 사용자 id
     * @param String $pwd 사용자 password
     * @return boolean $result 결과 여부 확인
     */
    public function loginUser($id,$pwd){
        $check="SELECT * from usr_table WHERE id='$id' and pwd=password($pwd)";
        $result=mysqli_query($this->db,$check);
        if(mysqli_fetch_row($result)){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * 사용자 이름 가져오기
     * @param String $id 사용자 id
     * 
     * @return String $name[0] 쿼리 수행 결과
     */
    public function getName($id) {
        $check="SELECT name from usr_table WHERE id='$id'";
        $result= mysqli_query($this->db,$check);
        $name=mysqli_fetch_row($result);
        return $name[0];
    }
    /**
     * 게시판 글쓰기
     * @param String $id 사용자 id
     * @param String $name 사용자 이름
     * @param String $title 글 제목
     * @param String $content 글 내용
     * @return boolean $result 결과 여부 확인
     */
    public function storeData($id,$name,$title,$content) {
        $check="INSERT INTO free_board(id,name,title,content) values('$id','$name','$title','$content')";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else
            return false;
    }
    /**
     * 조회수 증가
     * @param Integer $no 글 번호
     * @return boolean $result 결과 여부 확인
     */
    public function updateHit($no) {
        $check="UPDATE free_board set hit=hit+1 where no='$no'";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else
            return false;
    }
    /**
     * 회원가입
     * @param String $id 사용자 id
     * @param String $pwd 사용자 password
     * @param String $name 사용자 이름
     * @return boolean $result 결과 여부 확인
     */
    public function signUser($id,$pwd,$name) {
        $check="INSERT INTO usr_table(id,pwd,name) values('$id',password($pwd),'$name')";
        $result=mysqli_query($this->db, $check);
        if($result)
            return true;
        else
            return false;
    }
    /**
     * 게시판 리스트 나열
     * @param Integer $page 게시판 페이지 번호
     * @return array[][] $info 게시판 페이지에 해당하는 글 정보 반환
     */
    public function viewFreeBoard($page) {
        $check="SELECT * from free_board order by no desc LIMIT ".(5*($page-1)).",".$page*5;
        $result=mysqli_query($this->db, $check);
        //2차원 배열 선언
        $info=array(array());
        $i=0;
        //리스트로 저장
        //$info[$i] DB에 저장된 튜플
        //$info[$i][$j] DB에 저장된 튜플의 내용 $j 0:id 1:name 2:title 3:content 4:hit 5:no(순번)
        while($row=mysqli_fetch_row($result)){
            for($j=0;$j<count($row);$j++)
                $info[$i][$j]=$row[$j];
            $i++;
        }
        return $info;
    }
    /**
     * 페이지 상세보기
     * @param Integer $no 글 번호
     * @return Array $info 쿼리 결과로 얻어진 글의 정보
     */
    public function viewPage($no){
        $check="SELECT * from free_board where no='$no'";
        $result=mysqli_query($this->db,$check);
        $row=mysqli_fetch_row($result);
        $info=array('id'=>$row[0],
              'name'=>$row[1],
              'title'=> $row[2],
              'content'=> $row[3],
              'hit'=> $row[4]);
        return $info;
    }
    /**
     * 게시판의 글의 개수 반환
     * @return Integer $count 게시판의 글의 개수
     */
    public function boardNum() {
        $check="SELECT * from free_board";
        $result=mysqli_query($this->db,$check);
        $count=mysqli_num_rows($result);
        return $count;
    }
    /**
     * 글 수정
     * @param Integer $no 글의 번호
     * @param String $title 글의 제목 
     * @param String $content 글의 내용
     * @return boolean $result 처리 결과 반환
     */
    public function modifyContent($no,$title,$content) {
        $check="UPDATE free_board set title='$title', content='$content' where no='$no'";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else 
            return false;
    }
    /**
     * 글 삭제
     * @param Integer $no 글의 번호
     * @return boolean $result 처리 결과 반환
     */
    public function deleteContent($no) {
        $check="DELETE from free_board where no='$no'";
        $result=mysqli_query($this->db,$check);
        if($result)
            return true;
        else
            return false;
    }
}