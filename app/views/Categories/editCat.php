<div class="d-flex align-items-center justify-content-center">
  <div class="container" >
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header ">
        تعديل اسم الصنف
      </h2>
      <form class="login-container" method="post">
        <p><input name="cName" type="text" value="<?php echo str_replace("_"," ",$data["category"]->cname);?>" dir="auto" required="required" placeholder="اسم الصنف"></p>
        <p><input name="editCat" type="submit" value="حفظ"></p>
      </form>
    </div>
  </div>
</div>