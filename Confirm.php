<?php
class Confirm{
    var $value = array();
    public function __construct($data) {
        ;
    }
    public function comparePwd($pwd1,$pwd2){
        if($pwd1==$pwd2)
            true;
        else
            false;
    }
    
}