<?php

class Ratios extends Controller {
  
  public function __construct(){
    $this->rateModel = $this->model('Rate');
  }
  
  public function index(){
    if(isset($_SESSION["management"]) || isset($_SESSION["product"])){
      $data = [
           'titlePage' => 'Edit Profit Ratio Page',
           "type"=>$this->post("type"),
           "rate"=>$this->rateModel->getRateById(),
           'status'=>""
      ];
      if($data["type"]!==""){
         if($this->rateModel->editRate($data)){
          $data["status"]='
            <div class="alert alert-success text-center" id="status">
               تم التعديل بنجاح
             </div><br>
          ';
           $this->redirect(URL_ROOT."pages/index/control",1);
        }
      }
      $this->view('Ratios/index',$data);
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
} // end class
?>