<div class="d-flex align-items-center justify-content-center">
  <div class="container">
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        اضافة فئة
      </h2>
      <form class="login-container" method="post">
       <p>
          <select class="form-control" id="cName" name="cName" dir="auto" required>
            <option value="">
              اختار اسم الصنف
            </option>
            <?php
            foreach($data["allCategories"] as $category){
              echo '
              <option value="'.$category->c_id.'">
              '.str_replace("_"," ",$category->cname).'
              </option>
              ';
            }
            ?>
          </select>
        </p>
       <p>
        <input name="mName" class="form-control" dir="auto" required="required" placeholder="الفئة">
        </p>
        <p><input name="addMod" type="submit" value="حفظ"></p>
        <p>
          <a href="<?php echo URL_ROOT.'models/index';?>" class="float-right text-primary">
          الرجوع للفئات 
          </a>
        </p>
        <br>
      </form>
    </div>
  </div>  
</div>    