<div class="d-flex align-items-center justify-content-center">
  <div class="container" >
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        اضافة صنف
      </h2>
      <form class="login-container" method="post">
       <p>
        <input name="cName" class="form-control" dir="auto" required="required" placeholder="الصنف">
        </p>
        <p><input name="addCat" type="submit" value="حفظ"></p>
        <p>
          <a href="<?php echo URL_ROOT.'Categories/index';?>" class="float-right text-primary">
            الرجوع للاصناف 
          </a>
        </p>
        <br>
      </form>
    </div>
  </div>
</div>