<div style="height:100vh;" class="d-flex align-items-center justify-content-center">
  <div class="login" style="width:350px;">
    <?php if(isset($data["status"])){echo $data["status"];}?>
    <h2 class="login-header ">
      تعديل نسبة الربح 
    </h2>
    <form class="login-container" method="post">
      <p><input name="type" type="text" value="<?php echo $data["rate"]->type;?>" dir="auto" placeholder="نسبة الربح"></p>
      <p><input name="editCat" type="submit" value="حفظ"></p>
    </form>
  </div>
</div>