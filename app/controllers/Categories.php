<?php

class Categories extends Controller {
  
  public function __construct(){
    $this->categoryModel = $this->model('Category');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
        $data = [
             'titlePage' => 'Categories Page',
             "allCategories"=>$this->categoryModel->getAllCategories(),
        ];
        $this->view('Categories/index',$data);  
      }else{
        $this->redirect(URL_ROOT."pages/login");
      }  
  }
  
  public function addCat(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
        $data = [
             'titlePage' => 'Categories Page',
             "cName"=>str_replace(" ","_",$this->post("cName")),
             'status'=>""
        ];
        if($data["cName"]!==""){
          if (strlen($data["cName"]) > 2) {
             if($this->categoryModel->addCat($data)){
              $data["status"]='
                <div class="alert alert-success text-center" id="status">
        	         تم الاضافه بنجاح
        	       </div><br>
              ';
             // $this->redirect(URL_ROOT."categories/addCat",1);
            }else{
              $data["status"]='
                 <div class="alert alert-warning text-center" id="status">
                 الاسم موجود بالفعل
                 </div>
              ';
            }
        	}else{
        	   $data["status"] = ' 
               <div class="alert alert-danger text-center" id="status">
                الاسم قصير جدا   
               </div>
               ';
          }
        }
        $this->view('Categories/addCat',$data);  
      }else{
        $this->redirect(URL_ROOT."pages/login");
      }  
  }
  
  public function editCat($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if($id!==null){
        $data = [
             'titlePage' => 'Edit Category Page',
             "cName"=>str_replace(" ","_",$this->post("cName")),
             "id"=>$id,
             "category"=>$this->categoryModel->getCategoryById(strip_tags($id)),
             'status'=>""
        ];
        if($data["cName"]!==""){
          if (strlen($data["cName"]) > 2) {
             if($this->categoryModel->editCat($data)){
              $data["status"]='
                <div class="alert alert-success text-center">
        	         تم التعديل بنجاح
        	       </div><br>
              ';
              $this->redirect(URL_ROOT."categories/index",1);
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
        $this->view('Categories/editCat',$data);
      }
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function deleteCat($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if($id!==null){
        $this->categoryModel->deleteCat($id);
        $this->redirect(URL_ROOT."categories/index");
      }
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
} // end class 
?>