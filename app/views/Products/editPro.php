<!-- Camera -->
<!-- Modal -->
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
  <div class="container" style="overflow:scroll;">
    <br>
    <div class="login">
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        تعديل المنتج 
      </h2>
      <form class="login-container" method="post">
        <p>
          <select class="form-control" id="catName" name="cName" dir="auto" required>
            <option value="">
              اختار اسم الصنف
            </option>
            <?php
            foreach($data["allCategories"] as $category){
              echo '
              <option value="'.$category->c_id.'"';
              echo '>
              '.str_replace("_"," ",$category->cname).'
              </option>
              ';
            }
            ?>
          </select>
        </p>
        <p>
          <select class="form-control" id="modName" name="mName" dir="auto" required>
            <option value="">
              اختار اسم الفئة
            </option>
            <?php
            /*
            foreach($data["allModels"] as $model){
              echo '
              <option value="'.$model->m_id.'"';
              echo '>
              '.str_replace("_"," ",$model->mname).'
              </option>
              ';
            }
            */
            ?>
          </select>
        </p>
        <p><input name="pName" id="pName" type="text" value="" dir="auto" required placeholder=" اسم المنتج"></p>
        <p style="position:relative;">
          <span style="z-index:10;position:absolute;top:25px;left:20px;" id="openCamera" data-toggle="modal" data-target="#exampleModalCenter">
            📷
          </span>
          <input name="barcode" id="resultBarcode" value="" style="padding-left:30px" type="text" required placeholder="Part Number">
        </p>
        <!--
        <p><input name="qty" id="qty" type="number" value="" dir="auto" placeholder="الكمية"></p>
        -->
        <p><input name="price" id="price" type="number" value="" dir="auto" placeholder="السعر"></p>
        <!--
        <div class="container text-center" style="padding:0; margin:0;">
          <svg id="barcode" style="padding:0; margin:0;width:100;"></svg>
        </div>
        -->
        <p><input name="addPro" type="submit" value="حفظ"></p>
        <p>
        <a href="<?php echo URL_ROOT;?>products/index" class="float-right text-primary">
         الرجوع لصفحة المنتجات
        </a>
        </p>
        <br>
      </form>
    </div>
  </div>
</div>