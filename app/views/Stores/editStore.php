<div style="height:100vh;" class="d-flex align-items-center justify-content-center">
  <div class="login" style="width:350px;">
    <?php if(isset($data["status"])){echo $data["status"];}?>
    <h2 class="login-header ">
      تعديل اسم المخزن 
    </h2>
    <form class="login-container" method="post">
      <p><input name="storeName" type="text" value="<?php echo str_replace("_"," ",$data["store"]->storename);?>" dir="auto" required="required" placeholder="اسم المخزن"></p>
      <?php if($data['storeActive']==1){?>
        <div class="container checkActive" dir="rtl">
          <br>
          <label for="flexCheckDefault" class="float-right">
             جاهز للمبيعات :&nbsp;&nbsp;
          </label>
          <input type="checkbox" name="storeActive" value="1" id="flexCheckDefault" checked>
        </div>
        <br>
        <?php } ?>
      <p><input name="editStore" type="submit" value="حفظ"></p>
    </form>
  </div>
</div>