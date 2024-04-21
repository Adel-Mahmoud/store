<div class="d-flex align-items-center justify-content-center">
  <div class="container" style="overflow:scroll;">
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        تعديل بيانات المستخدم 
      </h2>
      <form class="login-container" method="post" dir="rtl">
        <p>
        <input name="username" value="<?php echo str_replace("_"," ",$data["user"]->username);?>" type="text" class="form-control" dir="auto" required="required" placeholder="اسم المستخدم">
        </p>
        <p>
        <input name="password" value="<?php echo str_replace("_"," ",$data["user"]->password);?>" type="text" class="form-control" dir="auto" required="required" placeholder="كلمة المرور ">
        </p>
        <p>
          <label for="rol" class="float-right">
          الصلاحية 
          </label>
          <select id="rol" name="rol" class="form-control">
           <option value="2" <?php if($data["user"]->rol=="0"){echo "selected";}?> >
             مدير
           </option>
           <option value="1" <?php if($data["user"]->rol=="1"){echo "selected";}?> >
             مسؤول مشتريات
           </option>
           <option value="0" <?php if($data["user"]->rol=="0"){echo "selected";}?> >
             مسؤول مبيعات
           </option>
          </select>
        </p>
        <p><input name="editUser" type="submit" value="حفظ"></p>
      </form>
    </div>
  </div>
</div>