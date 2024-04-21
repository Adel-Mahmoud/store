<?php

class Api extends Controller {
  
  public function __construct(){
    $this->categoryModel = $this->model('Category');
    $this->modelModel    = $this->model('Model');
    $this->productModel  = $this->model('Product');
    $this->storeModel    = $this->model('Store');
    $this->rateModel     = $this->model('Rate');
  }
  
  public function getModelsByCategory($cat=null){
    if (isset($cat)) {
      $dataModel = $this->productModel->getModelsByCategory(strip_tags($cat)); 
      if(count($dataModel)>0){
        echo '<option value="">
        اختار اسم الفئة 
        </option>';
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
  
  public function getModelsByCategory2($cat=null){
    if (isset($cat)) {
      $dataModel = $this->productModel->getModelsByCategory2(strip_tags($cat)); 
      if(count($dataModel)>0){
        echo '<option value="">
        اختار اسم الفئة 
        </option>';
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
  
  public function productData($cat=null,$mod=null){
    if (isset($cat) && isset($mod)) {
      $dataP = $this->storeModel->productStore(strip_tags($cat),strip_tags($mod));
      if(count($dataP)>0){
        echo '<option value="">
        اختار اسم المنتج 
        </option>';
        foreach( $dataP as $pro ){
          echo '<option value="'.$pro->p_id.'">'.str_replace("_"," ",$pro->pname)."</option>";
        }
      }else{
        echo "<option value=''>
          المنتج غير موجود
             </option>";
      }
    }
  }
  
  public function getDataByBarcode($bar=null){
    if($bar!==null){
      $product = $this->saleModel->getProductByBarcode(strip_tags($bar));
      if($product){
        echo ' 
        <div>
           <input class="form-control" value="'.$product->pname.'" disabled>
        </div>
        ';
      }else{
        echo "No";
      }
    }
  }
  
  public function getQty($id=null){
    if($id!==null){
      $product = $this->storeModel->getProductById(strip_tags($id));
      if ($product->aqty !== "") {
        echo '<option value="">
        اختار الكمية
        </option>';
         for( $q = 1; $q <= $product->aqty; $q++ ){
            echo "<option value='".$q."'>".$q."</option>";
          }
        }else{
          echo "<option value=''>1</option>";
        }
      
    }
        
  }
  
  public function getPrice($id=null){
    if($id!==null){
      $product = $this->storeModel->getPrice(strip_tags($id));
      $rate    = $this->rateModel->getRateById();
      $price   = $rate->type * $product->price;
      echo $price;
    }
  }
  
} // end class