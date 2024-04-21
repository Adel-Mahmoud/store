<div class="d-flex align-items-center justify-content-center">
  <div class="container">
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        اضافة مخزن 
      </h2>
      <form class="login-container" method="post">
        <p>
          <input name="storeName" class="form-control" dir="auto" required="required" placeholder="المخزن">
        </p>
        <?php if($data["checkActive"]!==1){?>
        <div class="container checkActive" dir="rtl">
          <br>
          <label for="flexCheckDefault" class="float-right">
             جاهز للمبيعات :&nbsp;&nbsp;
          </label>
          <input type="checkbox" name="storeActive" value="1" id="flexCheckDefault">
        </div>
        <br>
        <?php } ?>
        <p><input name="addStore" type="submit" value="حفظ"></p>
        <p>
          <a href="<?php echo URL_ROOT.'Stores/index';?>" class="float-right text-primary">
            الرجوع للمخازن 
          </a>
        </p>
        <br>
      </form>
        </div>
  </div>
</div>