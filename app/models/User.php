<?php

class User {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function login($name,$pass){
    if($this->db->checkfield("*","users","username=? AND password=? AND rol=?",[$name,$pass,"0"])==1){
      return  0;
    }elseif($this->db->checkfield("*","users","username=? AND password=? AND rol=?",[$name,$pass,"1"])==1){
      return  1;
    }elseif($this->db->checkfield("*","users","username=? AND password=? AND rol=?",[$name,$pass,"2"])==1){
      return  2;
    }else{
      return 3;
    }
  }
  
  public function getAllUsers(){
    return $this->db->getAllData("*","users");
  }
  
  public function addUser($data){
    if($this->db->checkfield("*","users","username=? AND password=? ",[$data['username'],$data['password']])==0){
      $this->db->insertData('users','username,password,rol,Date','?,?,?,now()',[$data['username'],$data['password'],$data['rol']]);
      return  true;
    }else{
      return false;
    }
  }
  
  public function getUserById($id){
    return $this->db->getData("*","users","id=?",[$id]);
  }
  
  public function editUser($data){
    if ($this->db->checkfield("*","users","username=? AND password=? AND rol=?",[$data['username'],$data['password'],$data['rol']])>0) {
      return false;
    }else{
      $this->db->updateData("users","username=?,password=?,rol=?,Date=now()","id=?",[$data['username'],$data['password'],$data['rol'],$data["id"]]);
      return true;
    }
  }
  
  public function deleteUser($id){
    $this->db->deleteData("users","id=?",[$id]);
  }
  
  public function usersCount(){
    return $this->db->countData("id","users");
  }
  
} // End Class 
?>