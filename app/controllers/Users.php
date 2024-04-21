<?php

class Users extends Controller {
  
  public function __construct(){
    $this->userModel = $this->model('User');
  }
  
  public function index(){
    if(isset($_SESSION["management"])){
      $data = [
           'titlePage' => 'Users Page',
           "allUsers"=>$this->userModel->getAllUsers(),
      ];
      $this->view('Users/index',$data);
    }
  }
  
  public function addUser(){
    if(isset($_SESSION["management"])){
    $data = [
         'titlePage' => 'Add User Page',
         "username"=>str_replace(" ","_",$this->post("username")),
         "password"=>str_replace(" ","_",$this->post("password")),
         "rol"=>$this->post("rol"),
         'status'=>""
    ];
      if($data["username"]!==""&&$data["password"]!==""){
        if (strlen($data["username"]) > 2) {
         if (strlen($data["password"]) > 3) {
           if($this->userModel->addUser($data)){
            $data["status"]='
              <div class="alert alert-success text-center" id="status">
      	         تم الاضافه بنجاح
      	       </div><br>
            ';
          //  $this->redirect(URL_ROOT."Users/addUser",1);
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
              كلمة المرور قصيرة جدا
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
      $this->view('Users/addUser',$data);
    }
  }
  
  public function editUser($id=null){
    if(isset($_SESSION["management"])){
      if($id!==null){
        $data = [
             'titlePage' => 'Edit User Page',
             "username"=>str_replace(" ","_",$this->post("username")),
             "password"=>str_replace(" ","_",$this->post("password")),
             "rol"=>$this->post("rol"),
             "id"=>$id,
             "user"=>$this->userModel->getUserById(strip_tags($id)),
             'status'=>""
        ];
        if($data["username"]!==""&&$data["password"]!==""){
          if (strlen($data["username"]) > 2) {
           if (strlen($data["password"]) > 3) {
             if($this->userModel->editUser($data)){
              $data["status"]='
                <div class="alert alert-success text-center" >
        	         تم التعديل بنجاح
        	       </div><br>
              ';
              $this->redirect(URL_ROOT."users/index",1);
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
                كلمة المرور قصيرة جدا
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
        $this->view('Users/editUser',$data);
      }else{
        $this->redirect(URL_ROOT."pages/login");
      }  
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }
  }
  
  public function deleteUser($id=null){
    if(isset($_SESSION["management"])){
      if($id!==null){
        $this->userModel->deleteUser(strip_tags($id));
      }
      $this->redirect(URL_ROOT."users/index");
    }else{
      $this->redirect(URL_ROOT."pages/login");
    }  
  }
  
} // end class 
?>