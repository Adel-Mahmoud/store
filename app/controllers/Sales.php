<?php

class Sales extends Controller {
  
  public function __construct(){
    $this->catModel = $this->model('Category');
    $this->modModel = $this->model('Model');
    $this->saleModel = $this->model('Sale');
    $this->rateModel = $this->model('Rate');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage'=>'Add Sale Page',
           "allSales"=>$this->saleModel->getAllSales(),
      ];
      if (isset($_POST["btnBarcode"])) {
         $data["getData"] = $this->saleModel->getProductByBarcode($this->post("barc"));
         if ($data["getData"]!==false) {
           $data["status"]='
                 <div class="alert alert-danger text-center">
                 المنتج غير موجود
                 </div>
              ';
         }
      }
      if (isset($_POST["addS"])) {
         $data["dataS"] = $this->saleModel->productsSale($data["proId"]);  
         // var_export($data["dataS"]);
        if ($this->post("proId")!==""&&$this->post("Sqty")!==""){
          if($this->saleModel->addSale($data)){
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافة بنجاح
        	       </div><br>
              ';
              // $this->redirect(URL_ROOT."sales/index",1);
           }else{
             $data["status"]='
                <div class="alert alert-danger text-center">
        	         هناك مشكلة 
        	       </div><br>
              ';
           }
        } 
        
      } 
      $this->view('Sales/index',$data); 
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function addSale(){
    if(isset($_SESSION["management"]) || isset($_SESSION["sales"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage'=>'Sales Page',
           "cat"=>$this->post("ScName"), // str_replace(" ","_",$this->post("cName")),
           "mod"=>$this->post("SmName"),
           "mod"=>$this->post("SpName"),
           "proId"=>$this->post("p_id"),
           "Sprice"=>$this->post("price"),
           "Sqty"=>$this->post("Sqty"),
           "rate"=>$this->post("rate"),
           "dataS"=>"",
           "getData"=>"",
           "api"=>"sales",
           'status'=>""
      ];
      if (isset($_POST["addS"])) {
         $data["dataS"] = $this->saleModel->productsSale($data["proId"]);  
         // var_export($data["dataS"]);
        if ($this->post("proId")!==""&&$this->post("Sqty")!==""){
          if($this->saleModel->addSale($data)){
           echo 'add data';
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافة بنجاح
        	       </div><br>
              ';
              // $this->redirect(URL_ROOT."sales/addSale",1);
           }else{
             $data["status"]='
                <div class="alert alert-danger text-center">
        	         هناك مشكلة 
        	       </div><br>
              ';
           }
        } 
        
      } 
      /*
      if (isset($_POST["btnBarcode"])) {
         $data["getData"] = $this->saleModel->getProductByBarcode($this->post("barc"));
         if ($data["getData"]==false) {
           $data["status"]='
                 <div class="alert alert-danger text-center">
                 المنتج غير موجود
                 </div>
              ';
         }
      }
      */
      $this->view('Sales/addSale',$data); 
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  public function addSale2(){
    if(isset($_SESSION["management"]) || isset($_SESSION["sales"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage'=>'Sales Page',
           "proId"=>$this->post("p_id"),
           "Sqty"=>$this->post("Sqty"),
           "rate"=>$this->post("rate"),
           "dataS"=>"",
           "getData"=>"",
           "api"=>"sales",
           'status'=>""
      ];
           // echo json_encode($data);
      if (isset($_POST["addS"])) {
         $data["dataS"] = $this->saleModel->productsSale($data["proId"]);  
         // var_export($data["dataS"]);
        if ($this->post("proId")!=="a"&&$this->post("Sqty")!==""){
           
          if($this->saleModel->addSale($data)){
            echo $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافة بنجاح
        	       </div><br>
              ';
              // $this->redirect(URL_ROOT."sales/addSale",1);
           }else{
             $data["status"]='
                <div class="alert alert-danger text-center">
        	         هناك مشكلة 
        	       </div><br>
              ';
           }
        } 
        
      } 
      /*
      if (isset($_POST["btnBarcode"])) {
         $data["getData"] = $this->saleModel->getProductByBarcode($this->post("barc"));
         if ($data["getData"]==false) {
           $data["status"]='
                 <div class="alert alert-danger text-center">
                 المنتج غير موجود
                 </div>
              ';
         }
      }
      */
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  /*
  public function addSale(){
    if(isset($_SESSION["management"]) || isset($_SESSION["sales"]) || isset($_SESSION["product"])){
      $data = [
           "allCategories"=>$this->catModel->getAllCategories(),
           "allModels"=>$this->modModel->getAllModels(),
           'titlePage'=>'Sales Page',
           "cat"=>$this->post("category"), // str_replace(" ","_",$this->post("cName")),
           "mod"=>$this->post("model"),
           "proId"=>$this->post("proId"),
           "Sprice"=>$this->post("prices"),
           "Sqty"=>$this->post("qty"),
           "dataS"=>"",
           "getData"=>"",
           "api"=>"sales",
           'status'=>""
      ];
      if (isset($_POST["btnBarcode"])) {
         $data["getData"] = $this->saleModel->getProductByBarcode($this->post("barc"));
         if ($data["getData"]==false) {
           $data["status"]='
                 <div class="alert alert-danger text-center">
                 المنتج غير موجود
                 </div>
              ';
         }
      }
      if (isset($_POST["addS"])) {
         $data["dataS"] = $this->saleModel->productsSale($data["proId"]);  
         // var_export($data["dataS"]);
        if ($this->post("proId")!==""&&$this->post("Sqty")!==""){
          if($this->saleModel->addSale($data)){
            $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافة بنجاح
        	       </div><br>
              ';
              // $this->redirect(URL_ROOT."sales/addSale",1);
           }else{
             $data["status"]='
                <div class="alert alert-danger text-center">
        	         هناك مشكلة 
        	       </div><br>
              ';
           }
        } 
        
      } 
      $this->view('Sales/addSale',$data); 
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  */
  public function getDataByBarcode($bar=null){
    if($bar!==null){
      echo json_encode($this->saleModel->getProductByBarcode(strip_tags($bar)));
    }
  }
  
  public function getCategoresByProductName($name=null){
    if($name!==null){
      echo json_encode($this->saleModel->getCategoresByProductName(strip_tags($name)));
    }
  }
  
  public function getModelsByProductName($name=null,$cat=null){
    if($name!==null && $cat!==null){
      echo json_encode($this->saleModel->getModelsByProductName(strip_tags($name),strip_tags($cat)));
    }
  }
  
  public function getAllProduct(){
    echo json_encode($this->saleModel->getAllProduct());
  }
  
  public function getAllProductInBarcode(){
    echo json_encode($this->saleModel->getAllProductInBarcode());
  }
  
  public function getAllCategories(){
      if(isset($_SESSION["management"]) || isset($_SESSION["product"]) || isset($_SESSION["sales"])){
      	echo json_encode($this->saleModel->getAllCategories());
      }
  }
  
  public function getModelsByCategory($cat=null){
    if($cat!==null){
      echo json_encode($this->saleModel->getModelsByCategory(strip_tags($cat)));
    }
  }
  
  public function productData($cat=null,$mod=null){
    if ($cat!==null && $mod!==null) {
      echo json_encode($this->model('Store')->productStore(strip_tags($cat),strip_tags($mod)));
    }
  }
  
  public function getQty($id=null){
    if($id!==null){
      echo json_encode($this->model('Store')->getProductById(strip_tags($id)));
    }
  }
  
  public function getRate(){
  	echo json_encode($this->rateModel->getRateById());
  }
  
  public function report(){
    if(isset($_SESSION["management"])){
      $data = [
           'titlePage'=>'Report Page',
           "allCategories"=>$this->catModel->getAllCategories(),
           "allModels"=>$this->modModel->getAllModels(),
           "allSales"=>$this->saleModel->getAllSales(),
           "cat"=>$this->post("category"), // str_replace(" ","_",$this->post("cName")),
           "mod"=>$this->post("model"),
           "proId"=>$this->post("proId"),
           "Sprice"=>$this->post("prices"),
           "rate"=>$this->rateModel->getRateById()->type,
           "Sqty"=>$this->post("qty"),
           "dataS"=>"",
           "getData"=>"",
           'status'=>"",
      ];
      $this->view('Sales/report',$data); 
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function editSale(){
    $this->view('Sales/editSale',$data);
  }
  
  public function deleteSale($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if($id!==null){
        $this->saleModel->deleteSale(strip_tags($id));
      }
      $this->redirect(URL_ROOT."sales/index");
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
}

?>
