<?php

class Category {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getAllCategories(){
    // return $this->db->getAllData("*","categories JOIN models ON models.c_id=categories.c_id ORDER BY `categories`.`cDate` ASC");
    return $this->db->getAllData("*","categories ORDER BY `categories`.`cDate` ASC");
  }
  
  public function addCat($data){
    if($this->db->checkfield("*","categories","cName=?",[$data['cName']])==0){
      $this->db->insertData('categories','cName,cDate','?,now()',[$data['cName']]);
      return  true;
    }else{
      return false;
    }
  }
  
  public function getCategoryById($id){
    return $this->db->getData("*","categories","c_id=?",[$id]);
  }
  
  public function editCat($data){
    if ($this->db->checkfield("*","categories","cName=?",[$data['cName']])>0) {
      return false;
    }else{
      $this->db->updateData("categories","cName=?,cDate=now()","c_id=?",[$data['cName'],$data["id"]]);
      return true;
    }
  }
  
  public function deleteCat($id){
    $this->db->deleteData("categories","c_id=?",[$id]);
  }
  
  public function categoriesCount(){
    return $this->db->countData("c_id","categories");
  }
  
} // End Class 
?>