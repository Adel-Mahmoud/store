<?php

class Models extends Controller {
  
  public function __construct(){
    $this->modelModel = $this->model('Model');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Models Page',
           "allModels"=>$this->modelModel->getAllModels(),
      ];
      $this->view('Models/index',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  

  }
  
  public function addMod(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Add Models Page',
           "allCategories"=>$this->model('Category')->getAllCategories(),
           "cName"=>str_replace(" ","_",$this->post("cName")),
           "mName"=>str_replace(" ","_",$this->post("mName")),
           'status'=>""
      ];
      if($data["mName"]!==""){
        if (strlen($data["mName"]) > 2) {
           if($this->modelModel->addMod($data)){
            $data["status"]='
              <div class="alert alert-success text-center" id="status">
      	         تم الاضافه بنجاح
      	       </div><br>
            ';
            // $this->redirect(URL_ROOT."Models/addMod",1);
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
      $this->view('Models/addMod',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  

  }
  
  public function editMod($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if ($id!==null) {
        $data = [
             'titlePage' => 'Edit Model Page',
             "cName"=>str_replace(" ","_",$this->post("cName")),
             "mName"=>str_replace(" ","_",$this->post("mName")),
             "id"=>strip_tags($id),
             "model"=>$this->modelModel->getModelsById(strip_tags($id)),
             "allCategories"=>$this->model('Category')->getAllCategories(),
             'status'=>""
        ];
        if($data["mName"]!==""){
          if (strlen($data["mName"]) > 2) {
             if($this->modelModel->editMod($data)){
              $data["status"]='
                <div class="alert alert-success text-center">
        	         تم التعديل بنجاح
        	       </div><br>
              ';
              $this->redirect(URL_ROOT."models/index",1);
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
      $this->view('Models/editMod',$data);  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  public function deleteMod($id=null){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      if ($id!==null) {
        $this->modelModel->deleteMod(strip_tags($id));
      }
      $this->redirect(URL_ROOT."models/index");
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
  
}
?>