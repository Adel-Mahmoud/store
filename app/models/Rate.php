<?php

class Rate {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getRateById(){
    return $this->db->getData("*","rate","id=?",[1]);
  }
  
  public function editRate($data){
     $this->db->updateData("rate","type=?","id=?",[$data['type'],1]);
      return true;
  }
  
} // end class 
?>