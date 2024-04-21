<?php

class Product {
  
  private $db;
  private $barcode;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getAllProducts(){
     return $this->db->getAllData("*","products JOIN models ON products.m_id=models.m_id JOIN categories ON products.c_id=categories.c_id JOIN stores ON products.store_id=stores.store_id");
     //return $this->db->getAllData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON products.p_id=amounts.p_id JOIN stores ON stores.store_id=amounts.store_id ORDER BY  products.p_id DESC");
    // return $this->db->getAllData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id ORDER BY  products.pDate DESC");
  }
  
  public function getModelsByCategory($cat){
    return $this->db->getData("*","models","c_id=?",[$cat],"fetch");
  } 
  
  public function getRemaining(){
    return $this->db->getAllData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON amounts.p_id=products.p_id JOIN stores ON amounts.store_id=stores.store_id AND stores.active=0 AND amounts.aQty > 0 ORDER BY  products.pDate DESC");
  }

  public function getRunOut(){
    return $this->db->getAllData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON amounts.p_id=products.p_id JOIN stores ON amounts.store_id=stores.store_id AND stores.active=0 AND amounts.aQty = 0 ORDER BY  products.pDate DESC");
  }
  
  public function addPro($data){
	    if($this->db->checkfield("*","products","c_id=? AND m_id=? AND pName=? AND store_id=?",[$data['c_id'],$data['m_id'],$data['pName'],$data['store_id']])>0){
  		return 2;
  	}else{
  	  if($this->db->checkfield("*","products","barcode=?",[ $data['barcode'] ])>0){
	    	return 1;
	    }else{
	      $this->db->insertData('products','c_id,m_id,pName,barcode,store_id,pQty,price,pDate','?,?,?,?,?,?,?,now()',
	      [ $data['c_id'],$data['m_id'],$data['pName'],$data['barcode'],$data['store_id'],$data['qty'],$data['price'] ]);
	        
	      $this->barcode = $this->db->getData("*","products","barcode=?",[$data["barcode"]]);
	      $this->db->insertData('amounts','store_id,p_id,aQty,aDate','?,?,?,now()',[$data['store_id'],$this->barcode->p_id,$data['qty']]);
	      return 0;
	    }
    }
  }
  
  public function getProductById($id){
    return $this->db->getData("*","products JOIN categories ON categories.c_id=products.c_id JOIN models ON models.m_id=products.m_id","p_id=?",[$id]);
  }
  
  public function getProductById2($id){
    return json_encode($this->db->getData("*","products JOIN categories ON categories.c_id=products.c_id JOIN models ON models.m_id=products.m_id","p_id=?",[$id]));
  }
  
  public function editPro($data){
    if($this->db->checkfield("*","products","c_id=? AND m_id=? AND pName=? AND barcode=? AND price=?",[$data['c_id'],$data['m_id'],$data['pName'],$data["barcode"],$data['price']])>0) {
      return false;
    }else{
      $this->db->updateData("products","c_id=?,m_id=?,pName=?,barcode=?,price=?,pDate=now()","p_id=?",[$data['c_id'],$data['m_id'],$data['pName'],$data['barcode'],$data["price"],$data["id"]]);
      return true;
    }
  }
  
  public function productsCount(){
    return $this->db->countData("p_id","products");
  }
  
  public function deletePro($id){
    $this->db->deleteData("products","p_id=?",[$id]);
  }
  
} // End Class
?>