<?php
  
class Products extends Controller {
  
  public function __construct(){
    $this->productModel = $this->model('Product');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
          'titlePage' => ' Products Page',
           "allProducts"=>$this->productModel->getAllProducts()
        ];
      $this->view('Products/index',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function getModelsByCategory($cat=null){
    if (isset($cat)) {
      echo json_encode($this->productModel->getModelsByCategory($cat)); 
    }
  }
  
  /*
  public function getModelsByCategory($cat=null){
    if (isset($cat)) {
      $dataModel = $this->productModel->getModelsByCategory($cat); 
      if(count($dataModel)>0){
        echo '<option value="">اختار اسم الفئة </option>';
        foreach( $dataModel as $model ){
          echo '<option value="'.$model->m_id.'">'.str_replace("_"," ",$model->mname)."</option>";
        }
      }else{
        echo "<option value=''>
          الفئة غير موجودة 
             </option>";
      }
    }
  }
  */
  public function addPro(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Add Product Page',
           "c_id"=>$this->post("cName"), // str_replace(" ","_",$this->post("cName")),
           "m_id"=>$this->post("mName"),
           "pName"=>str_replace(" ","_",$this->post("pName")),
           "barcode"=>$this->post("barcode"),
           "store_id"=>$this->post("store_id"),
           "qty"=>$this->post("qty"),
           "price"=>$this->post("price"),
           "allCategories"=>$this->model('Category')->getAllCategories(),
           "allModels"=>$this->model('Model')->getAllModels(),
           "allStores"=>$this->model('Store')->getAllStores(),
           "allProducts"=>"",
           "status"=>""
      ];
      if($this->post("cName")!==""&&$this->post("mName")!==""&&$this->post("pName")!==""&&$this->post("barcode")!==""&&$this->post("qty")!==""&&$this->post("price")!==""){
        if (strlen($this->post("pName")) > 2){
            if($this->productModel->addPro($data)==0){
              $data["status"]='
                  <div class="alert alert-success text-center" id="status">
          	         تم الاضافة بنجاح
          	       </div><br>
                ';
                // $this->redirect(URL_ROOT."products/addPro",1);
            }elseif($this->productModel->addPro($data)==1){
              $data["status"]='
                 <div class="alert alert-warning text-center">
                 Part number موجود بالفعل
                 </div>
              ';
            }elseif($this->productModel->addPro($data)==2){
              $data["status"]='
                 <div class="alert alert-warning text-center">
                 المنتج موجود بالفعل
                 </div>
              ';
            }
          /*
          if ($this->productModel->checkByBarcode($data['barcode'])) {
            if($this->productModel->addPro($data)){
              $data["status"]='
                  <div class="alert alert-success text-center">
          	         تم الاضافة بنجاح
          	       </div><br>
                ';
                $this->redirect(URL_ROOT."products/addPro",1);
            }else{
              $data["status"]='
                 <div class="alert alert-warning text-center">
                 الاسم موجود بالفعل
                 </div>
              ';
            }
          }else{
            $data["status"]='
                 <div class="alert alert-warning text-center">
                 رقم الباركود موجود بالفعل
                 </div>
              ';
          }*/
        }else{
          $data["status"] = ' 
             <div class="alert alert-danger text-center">
              الاسم قصير جدا   
             </div>
             ';
        }
      } 
      $this->view('Products/addPro',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function editPro($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      //$product=$this->productModel->getProductById(strip_tags($id));
      $product=json_decode($this->productModel->getProductById2(strip_tags($id)),true);
      $data = [
           'titlePage'=>'Edit Product Page',
           "c_id"=>$this->post("cName"), // str_replace(" ","_",$this->post("cName")),
           "Dc_id"=>$product["c_id"], // str_replace(" ","_",$this->post("cName")),
           "m_id"=>$this->post("mName"),
           "pName"=>str_replace(" ","_",$this->post("pName")),
           "barcode"=>$this->post("barcode"),
           "qty"=>$this->post("qty"),
           "price"=>$this->post("price"),
           "id"=>strip_tags($id),
           "allCategories"=>$this->model('Category')->getAllCategories(),
           "allModels"=>$this->model('Model')->getAllModels2(strip_tags($id)),
           "product"=>$product,
           "api"=>"edit",
           "status"=>""
      ];
      /*
      $data = [
           'titlePage'=>'Edit Product Page',
           "c_id"=>$this->post("cName"), // str_replace(" ","_",$this->post("cName")),
           "m_id"=>$this->post("mName"),
           "pName"=>str_replace(" ","_",$this->post("pName")),
           "barcode"=>$this->post("barcode"),
           "price"=>$this->post("price"),
           "id"=>strip_tags($id),
           "allCategories"=>$this->model('Category')->getAllCategories(),
           "allModels"=>$this->model('Model')->getAllModels(),
           
           "status"=>""
      ];
      */
      if($this->post("cName")!==""&&$this->post("mName")!==""&&$this->post("pName")!==""&&$this->post("barcode")!==""&&$this->post("price")!==""){
        if (strlen($this->post("pName")) > 2){
          if($id!==null){
            if($this->productModel->editPro($data)!==false){
              $data["status"]='
                  <div class="alert alert-success text-center">
          	         تم التعديل بنجاح
          	       </div><br>
                ';
                $this->redirect(URL_ROOT."products/index",1);
            }else{
              $data["status"]='
                 <div class="alert alert-warning text-center">
                 الاسم موجود بالفعل
                 </div>
              ';
            }
          }
        }else{
          $data["status"] = ' 
             <div class="alert alert-danger text-center">
              الاسم قصير جدا   
             </div>
             ';
        }
      }
      
      $this->view('Products/editPro',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function getProductById($id=null){
  	$product = $this->productModel->getProductById2(strip_tags($id));
  	echo $product;
  }
  
  public function remaning(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){ 
      $data = [
        "titlePage"=>"Products Remaining Page",
        "allProducts"=>"",
        "status"=>""
      ];
      if(isset($_POST["addQty"])){
          if($this->post("qty")!==""){
            $this->model('Store')->addQty($this->post("a_id"),$this->post("qty"));
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافه بنجاح
        	       </div><br>
              ';
            // $this->redirect(URL_ROOT."stores/viewStore/".$id,1);
           }
          }
      $data["allProducts"]=$this->productModel->getRemaining();
      $this->view('Products/remaining',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function runout(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){ 
      $data = [
        "titlePage"=>"Products Run Out Page",
        "allProducts"=>""
      ];
      if(isset($_POST["addQty"])){
        if($this->post("qty")!==""){
          $this->model('Store')->addQty($this->post("a_id"),$this->post("qty"));
          $data["status"]='
              <div class="alert alert-success text-center" id="status">
      	         تم الاضافه بنجاح
      	       </div><br>
            ';
          // $this->redirect(URL_ROOT."stores/viewStore/".$id,1);
        }
      }
      $data["allProducts"]=$this->productModel->getRunOut();
      $this->view('Products/runOut',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function deletePro($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if($id!==null){
        $this->productModel->deletePro(strip_tags($id));
      }
      $this->redirect(URL_ROOT."Products/index");
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
} // end class 

?>