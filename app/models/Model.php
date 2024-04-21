<?php

class Model {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getAllModels(){
    return $this->db->getAllData("*","models JOIN categories ON categories.c_id=models.c_id ");
    // return $this->db->getAllData("*","models JOIN categories ON categories.c_id=models.c_id GROUP BY cName");
  }
  
  public function getAllModels2($id){
    return $this->db->getData("*","models JOIN categories ON categories.c_id=models.c_id JOIN products ON products.m_id=models.m_id ","products.p_id=?",[$id],"fetch");
    // return $this->db->getData("*","models","c_id=?",[$cat],"fetch");
    // return $this->db->getAllData("*","models JOIN categories ON categories.c_id=models.c_id GROUP BY cName");
  }
  
  public function addMod($data){
    if($this->db->checkfield("*","models","c_id=? AND mName=?",[$data['cName'],$data['mName']])==0){
      $this->db->insertData('models','c_id,mName,mDate','?,?,now()',[$data['cName'],$data['mName']]);
      return  true;
    }else{
      return false;
    }
  }
  
  public function getModelsById($id){
    return $this->db->getData("*","models","m_id=?",[$id]);
  }
  
  public function editMod($data){
    if ($this->db->checkfield("*","models","c_id=? AND mName=?",[$data['cName'],$data['mName']])>0) {
      return false;
    }else{
      $this->db->updateData("models","mName=?,c_id=?,mDate=now()","m_id=?",[$data['mName'],$data['cName'],$data["id"]]);
      return true;
    }
  }
  
  public function deleteMod($id){
    $this->db->deleteData("models","m_id=?",[$id]);
  }
  
  public function modelsCount(){
    return $this->db->countData("m_id","models");
  }
  
} // End Class  
?>