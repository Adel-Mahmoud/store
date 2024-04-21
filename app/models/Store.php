<?php

class Store {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getAllStores(){
    return $this->db->getAllData("*","stores");
    //return $this->db->getAllData("*","stores JOIN amounts ON stores.store_id=amounts.store_id GROUP BY storeName");
  }
  
  public function getStoreNameById($id){
    return $this->db->getData("*","stores","store_id=?",[$id]);
  }
  
  public function getStoreDataById($id){
    return $this->db->getData("*","amounts JOIN products ON amounts.p_id=products.p_id JOIN models ON models.m_id=products.m_id JOIN categories ON categories.c_id=products.c_id","amounts.store_id=?",[$id],"feach"); 
  }
  
  public function checkStore(){
    if($this->db->checkfield("*","stores","active=?",[1])>0){
      return 1;
    }
  }
  
  public function checkStoreEdit($id){
    if($this->db->checkfield("*","stores","active=? AND store_id=?",[1,$id])>0 || $this->db->checkfield("*","stores","active=?",[1])==0){
      return 1;
    }
  }
  
  public function addStore($data){
    if($this->db->checkfield("*","stores","storeName=?",[$data['storeName']])==0){
      $this->db->insertData('stores','storeName,active,storeDate','?,?,now()',[$data['storeName'],$data['active']]);
      return  true;
    }else{
      return false;
    }
  }
  
  public function getStoresById($id){
    return $this->db->getData("*","stores","store_id=?",[$id]);
  }
  
  public function editStore($data){
    /* if($this->db->checkfield("*","stores","storeName=?",[$data['storeName']])>0) { 
      return false;
    }else{*/
      $this->db->updateData("stores","storeName=?,active=?,storeDate=now()","store_id=?",[$data['storeName'],$data["active"],$data["id"]]);
      return true;
    // }
  }
  
  public function addQty($a_id,$qty){
    $this->db->updateData("amounts","aQty=aQty+?,aDate=now()","a_id=?",[$qty,$a_id]);
  }
  
  public function transferQty($id,$store1,$store2,$p_id,$qty){
    $store = $this->db->getData("*","amounts","a_id=?",[$id]);
    $storeTwo = $this->db->getData("*","amounts","store_id=? AND p_id=?",[$store2,$p_id]);
    $this->db->updateData("amounts","aQty=aQty-?,aDate=now()","a_id=?",[$qty,$id]);
    if($this->db->checkfield("*","amounts","store_id=? AND p_id=?",[$store2,$p_id])>0){
    	$this->db->updateData("amounts","aQty=aQty+?,aDate=now()","a_id=?",[$qty,$storeTwo->a_id]);
    }else{
      $this->db->insertData('amounts','store_id,p_id,aQty,aDate','?,?,?,now()',[$store2,$store->p_id,$qty]);
    }
  }
  public function productStore($cat,$mod){
    //return $this->db->getData("*"," products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id","products.c_id=? AND products.m_id=?",[$cat,$mod],"feach"); 
    return $this->db->getData("*"," amounts JOIN stores ON amounts.store_id=stores.store_id AND amounts.aQty>0 AND stores.active>0 JOIN products ON amounts.p_id=products.p_id JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id","products.c_id=? AND products.m_id=?",[$cat,$mod],"feach"); 
  }
  
  public function getProductById($id){
    return $this->db->getData("*","amounts JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1 JOIN products ON amounts.p_id=products.p_id","amounts.p_id=? ",[$id]); 
  }
 
  public function getPrice($id){
    return $this->db->getData("*","products","p_id=? ",[$id]); 
  }
  
  public function deleteProduct($id){
    $this->db->deleteData("amounts","a_id=?",[$id]);
  }
  
  public function deleteStore($id){
    $this->db->deleteData("stores","store_id=?",[$id]);
  }
  
  public function storesCount(){
    return $this->db->countData("store_id","stores");
  }
  
} // End Class  
?>