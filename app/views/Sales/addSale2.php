<!-- Camera -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Camera</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="w-100" id="qr-reader">
          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">أغلاق</button>
      </div>
    </div>
  </div>
</div>
<!-- Camera -->
<div class="d-flex align-items-center justify-content-center">
  <div class="container">
    <?php if ($data["report"]!=="report"){?>
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        المبيعات
      </h2>
      <form class="login-container" method="post">
       <p>
        <div class="input-group mb-3 form-control " style="background:transparent;border-color:transparent;position:relative;">
          <span style="z-index:10;position:absolute;top:13px;left:20px;" id="openCamera" data-toggle="modal" data-target="#exampleModalCenter">
            📷
          </span> 
          <input type="text" name="barc" id="resultBarcode" style="padding-left:30px" class="form-control" placeholder="
         Part Number   
          " >
          <div class="input-group-append">
            <button name="btnBarcode" class="btn btn-success" type="submit">
              بحث
            </button>
          </div>
        </div>
       </p>
       <p>
        <div class="input-group mb-3 form-control " style="background:transparent;border-color:transparent;position:relative;">
          <input type="text" name="barc" id="resultBarcode" style="padding-left:30px" class="form-control" placeholder="
          اسم المنتج   
          " >
          <div class="input-group-append">
            <button name="btnBarcode" class="btn btn-success" type="submit">
              بحث
            </button>
          </div>
        </div>
       </p>
      </form>
      <form class="login-container" id="saleData" dir="rtl" method="post">
        
        <div class="searchManual">
          <p>
            <select class="form-control" id="ScName" name="ScName" dir="auto" required >
            <?php
            if($data["getData"]->cname==""){
              echo ' 
              <option value="">
                اختار اسم الصنف
              </option>';
              foreach($data["allCategories"] as $category){
                echo '
                <option value="'.$category->c_id.'">
                '.str_replace("_"," ",$category->cname).'
                </option>
                ';
              }
            }else{
              echo '<option value="'.$data["getData"]->cname.'">'.str_replace("_"," ",$data["getData"]->cname).'</option>';
            }?>
            </select>
          </p>
          <p>
            <select class="form-control" id="SmName" name="SmName" dir="auto" required>
            <?php
            if($data["getData"]==""){
              echo ' 
              <option value="">
                اختار الفئة
              </option>';
            }else{
              echo '<option value="'.$data["getData"]->m_id.'">'.str_replace("_"," ",$data["getData"]->mname).'</option>';
            }?>
            </select>
          </p>
          <p>
            <select class="form-control" id="SpName" name="SpName" dir="rtl" required>
            <?php
            if($data["getData"]->pname==""){
              echo ' 
              <option value="">
                اختار اسم المنتج
              </option>';
            }else{
              echo '<option value="'.$data["getData"]->p_id.'">'.str_replace("_"," ",$data["getData"]->pname).'</option>';
            }?>
            </select>
          </p>
          <p>
            <select class="form-control" id="Sqty" name="Sqty" dir="auto" required>
              <option value="">
                اختار الكمية
              </option>
              <?php
                for( $q = 1; $q <= $data["getData"]->aqty; $q++ ){
                  echo "<option value='".$q."'>".$q."</option>";
                }
              }
              ?>
            </select>
          </p>
          <h1 class="d-none" id="resultPrice"><?php echo $data["getData"]->price*$data["rate"];?></h1>
          <p>
            <input type="text" style="text-align:right" id="pPrice" value="
            سعر المنتج : 
            <?php echo $data["getData"]->price*$data["rate"];?>" disabled/>
          </p>
          <p id="conPrice">
            <input type="hidden" name="price" id="price" required>
            <input class="text-center" type="text" name="" id="totalP" dir="rtl" disabled value="
            السعر الاجمالي : 
            <?php echo $data["getData"]->price*$data["rate"];?>
            " />
          </p>
          <input name="proId" id="product" value="<?php echo $data["getData"]->p_id;?>" type="hidden" >
          <input name="qty" id="qty" type="hidden" >
          <input name="prices" id="prices" type="hidden" >
          <p><input name="addS" type="submit" value="حفظ"></p>
          <p>
            <?php
            if(isset($_SESSION["management"])){
             echo '<a href="'.URL_ROOT.'Sales/index" class="float-left btn text-primary">
            الرجوع للمبيعات
             </a>';
            }?>
             <a href="<?php echo URL_ROOT;?>Sales/addSale" class="float-right text-info">
            اعادة البحث 
             </a> 
          </p>
          <br>
        </div>
      
      </form>
    </div>
  </div>
</div>