<?php

class Stores extends Controller {
  
  public function __construct(){
    $this->storeModel = $this->model('Store');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Stores Page',
           "allStores"=>$this->storeModel->getAllStores()
      ];
      $this->view('Stores/index',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  

  }
  
  public function addStore(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Stores Page',
           "storeName"=>str_replace(" ","_",$this->post("storeName")),
           "storeActive"=>$this->post("storeActive"),
           "active"=>"0",
           "checkActive"=>$this->storeModel->checkStore(),
           'status'=>""
      ];
      if($data["storeName"]!==""){
        if (strlen($data["storeName"]) > 3) {
           if($data["storeActive"]==1){
             $data["active"] = $data["storeActive"];
           }
           if($this->storeModel->addStore($data)){
            $data["status"]='
              <div class="alert alert-success text-center">
      	         تم الاضافه بنجاح
      	       </div><br>
            ';
            $this->redirect(URL_ROOT."Stores/index",1);
           }else{
            $data["status"]='
               <div class="alert alert-warning text-center">
               الاسم موجود بالفعل
               </div>
            ';
          }
      	}else{
      	   $data["status"] = ' 
             <div class="alert alert-danger text-center">
              الاسم قصير جدا   
             </div>
             ';
        }
      }
      $this->view('Stores/addStore',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  

  }
  
  public function editStore($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if ($id!==null) {
        $data = [
             'titlePage' => 'Edit Store Page',
             "storeName"=>str_replace(" ","_",$this->post("storeName")),
             "id"=>strip_tags($id),
             "storeActive"=>$this->storeModel->checkStoreEdit(strip_tags($id)),
             "active"=>"0",
             "store"=>$this->storeModel->getStoresById(strip_tags($id)),
             'status'=>""
        ];
        if($this->post("storeActive")==1){
          $data["active"] = 1;
        }
        if($data["storeName"]!==""){
          if (strlen($data["storeName"]) > 3) {
             if($this->storeModel->editStore($data)){
              $data["status"]='
                <div class="alert alert-success text-center">
        	         تم التعديل بنجاح
        	       </div><br>
              ';
              $this->redirect(URL_ROOT."Stores/index",1);
            }else{
              $data["status"]='
                 <div class="alert alert-warning text-center">
                 الاسم موجود بالفعل
                 </div>
              ';
            }
        	}else{
        	   $data["status"] = ' 
               <div class="alert alert-danger text-center">
                الاسم قصير جدا   
               </div>
               ';
          }
        }
      }
      $this->view('Stores/editStore',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function viewStore($id=null){
    if(isset($_SESSION["management"])){
      if ($id!==null) {
       $data = [
          "store_id"=>$id,
          "store2_id"=>$this->post("store2_id"),
          "storeName"=>$this->storeModel->getStoreNameById(strip_tags($id)),
          "storeData"=>"",
          "a_id"=>$this->post("a_id"),
          "qty"=>$this->post("qty"),
          "allStores"=>$this->storeModel->getAllStores(),
          "status"=>""
         ];
         if(isset($_POST["addQty"])){
          if($this->post("qty")!==""){
            $this->storeModel->addQty($this->post("a_id"),$this->post("qty"));
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافه بنجاح
        	       </div><br>
              ';
            // $this->redirect(URL_ROOT."stores/viewStore/".$id,1);
           }
          }
         if(isset($_POST["transfer"])){
          if($this->post("tqty")!==""){
            $this->storeModel->transferQty($this->post("a_id"),$id,$this->post("store2_id"),$this->post("p_id"),$this->post("tqty"));
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم نقل الكمية بنجاح
        	       </div><br>
              ';
            // $this->redirect(URL_ROOT."stores/viewStore/".$id,1);
           }
          } 
       $data["storeData"]=$this->storeModel->getStoreDataById(strip_tags($id));
       $this->view('Stores/viewStore',$data); 
      }
    }else{
      $this->redirect(URL_ROOT."Pages/login");
    }  
  }
  
  public function deleteProduct($id=null){
    if(isset($_SESSION["management"])){
      if ($id!==null) {
        $this->storeModel->deleteProduct(strip_tags($id));
      }
      header('Location:'.$_SERVER['HTTP_REFERER']);
    }else{
      $this->redirect(URL_ROOT."Pages/login");
    }  
  }
  
  public function deleteStore($id=null){
    if(isset($_SESSION["management"])){
      if ($id!==null) {
        $this->storeModel->deleteStore(strip_tags($id));
      }
      $this->redirect(URL_ROOT."Stores/index");
    }else{
      $this->redirect(URL_ROOT."Stores/login");
    }  
  }
  
} // end class 
?>