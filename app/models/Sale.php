<?php

class Sale {
  
  private $db;

  public function __construct(){
    $this->db = new Database();
  }
  
  public function getAllSales(){
    return $this->db->getAllData("*","sales ORDER BY `sales`.`s_id` DESC");
  }
  
  public function getAllCategories(){
    return $this->db->getAllData("*","categories JOIN products ON categories.c_id=products.c_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1 GROUP BY products.c_id");
  }
  
  public function getProductByBarcode($barcode){
    if($this->db->checkfield("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","products.barcode=? AND amounts.aQty>0",[$barcode])>0){
      return $this->db->getData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","barcode=?",[$barcode]); 
    }else{
      return false;
    }
  }
  
  public function getCategoresByProductName($name){
    if($this->db->checkfield("*","products JOIN categories ON products.c_id=categories.c_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","products.pName=?",[$name])>0){
      return $this->db->getData("*","products JOIN categories ON products.c_id=categories.c_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","pName=? GROUP BY pName",[$name],"fetch"); 
    }else{
      return false;
    }
  }
  
  public function getModelsByProductName($name,$cat){
    if($this->db->checkfield("*","products JOIN models ON products.m_id=models.m_id JOIN categories ON products.c_id=categories.c_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","products.pName=? AND categories.c_id=?",[$name,$cat])>0){
      return $this->db->getData("*","products JOIN models ON products.m_id=models.m_id JOIN categories ON products.c_id=categories.c_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","pName=? AND categories.c_id=?",[$name,$cat],"fetch"); 
    }else{
      return false;
    }
  }
 
  public function getAllProduct(){
   return $this->db->getAllData("*","products JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1 GROUP BY products.pName"); 
  }
  
  public function getAllProductInBarcode(){
   return $this->db->getAllData("*","products JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1"); 
  }
 
  public function getModelsByCategory($cat){
    if($this->db->checkfield("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","products.c_id=? AND amounts.aQty>0",[$cat])>0){
      return $this->db->getData("*","products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id JOIN amounts ON products.p_id=amounts.p_id AND amounts.aQty>0 JOIN stores ON amounts.store_id=stores.store_id AND stores.active=1","products.c_id=?  GROUP BY products.m_id",[$cat],"fetch"); 
    }else{
      return false;
    }
  }
 
  public function productsSale($id){
    return $this->db->getData("*"," products JOIN categories ON products.c_id=categories.c_id JOIN models ON products.m_id=models.m_id","products.p_id=?",
    [$id]);
  }
  
  public function addSale($data){
  	if (isset($_SESSION["sales"])) {
  		$seller = $_SESSION["sales"];
  	} elseif(isset($_SESSION["management"])){
  		$seller = $_SESSION["management"];
  	}else{
  		$seller = $_SESSION["product"];
  	}
    $this->db->insertData('sales','ScName,SmName,pName,barcode,seller,qty,price,total,Date','?,?,?,?,?,?,?,?,now()',
    [ $data["dataS"]->cname,$data["dataS"]->mname,$data["dataS"]->pname,$data["dataS"]->barcode,$seller,$data['Sqty'],$data['dataS']->price*$data["rate"],$data['dataS']->price*$data["rate"]*$data['Sqty'] ]);
    $this->db->updateData("amounts JOIN stores ON stores.store_id=amounts.store_id AND stores.active=1","aQty=aQty-?","p_id=?",[$data['Sqty'],$data['proId']]);
    return true;
  }
  /*
  public function addSale($data){
  	if (isset($_SESSION["sales"])) {
  		$seller = isset($_SESSION["sales"]);
  	} elseif(isset($_SESSION["management"])){
  		$seller = isset($_SESSION["management"]);
  	}else{
  		$seller = isset($_SESSION["product"]);
  	}
    $this->db->insertData('sales','ScName,SmName,pName,barcode,seller,qty,price,total,Date','?,?,?,?,?,?,?,?,now()',
    [ $data["dataS"]->cname,$data["dataS"]->mname,$data["dataS"]->pname,$data["dataS"]->barcode,$seller,$data['Sqty'],$data['dataS']->price*$data["rate"],$data['dataS']->price*$data["rate"]*$data['Sqty'] ]);
    $this->db->updateData("amounts JOIN stores ON stores.store_id=amounts.store_id AND stores.active=1","aQty=aQty-?","p_id=?",[$data['Sqty'],$data['proId']]);
    return true;
  }
  */
  public function deleteSale($id){
    $this->db->deleteData("sales","s_id=?",[$id]);
  }
  
  public function salesCount(){
    return $this->db->countData("s_id","sales");
  }
  
} // End Class 
?>