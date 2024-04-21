<?php

class Pages extends Controller {
  
  public function __construct() {
    $this->userModel = $this->model("User");
  } 
  
  public function Index() {
    if (isset($_SESSION["management"]) || isset($_SESSION["product"])) {
      $data = array("titlePage" => "Admin-Panel", "usersCount" => $this->userModel->usersCount(), "categoriesCount" => $this->model("Category")->categoriesCount(), "productsCount" => $this->model("Product")->productsCount(), "modelsCount" => $this->model("Model")->modelsCount(), "salesCount" => $this->model("Sale")->salesCount(), "storesCount" => $this->model("Store")->storesCount(), "productsRemaining" => count($this->model("Product")->getRemaining()), "productsRunOutCount" => count($this->model("Product")->getRunOut()), "rate" => $this->model("Rate")->getRateById());
      $this->view("home", $data);
    } else {
      $this->redirect(URL_ROOT . "pages/login");
    }
  } 
  
  public function login() {
    $data = array("titlePage" => "Login Page", "username" => str_replace(" ", "_", $this->post("username")), "password" => str_replace(" ", "_", $this->post("password")), "error" => '');
    if ($data["username"] !== '' && $data["password"] !== '') {
      $response = $this->userModel->login($data["username"], $data["password"]);
      if ($response == 0) {
        $_SESSION["sales"] = $data["username"];
        $this->redirect(URL_ROOT . "sales/addSale");
      } elseif ($response == 1) {
        $_SESSION["product"] = $data["username"];
        $this->redirect(URL_ROOT . "products/index");
      } elseif ($response == 2) {
        $_SESSION["management"] = $data["username"];
        $this->redirect(URL_ROOT . "pages/index");
      } else {
        $data["error"] = "<a href=\"#\"> نأسف على الكلمة السرية التي ادخلتها اكتب كلمة اخرى </a>";
      }
    }
    if (isset($_SESSION["sales"])) {
      $this->redirect(URL_ROOT . "Sales/addSale");
    } elseif (isset($_SESSION["product"])) {
      $this->redirect(URL_ROOT . "products/index");
    } elseif (isset($_SESSION["management"])) {
      $this->redirect(URL_ROOT . "Pages/index");
    }
    $this->view("Users/login", $data);
  } 
  
  public function logout() {
    session_destroy();
    $this->redirect(URL_ROOT . "pages/login");
  } 
  
  public function error() {
    echo "<h1>Not  Found</h1>";
  } 
  
  public function about() {
    $data = array("title" => "About Us", "description" => "App to share posts with other users");
    echo "<h1 style=\"text-align: center;\">About Page</h1>";
  }
}
