<div class="d-flex align-items-center justify-content-center">
  <div class="container" style="overflow:scroll;">
    <br>
    <div class="login" >
      <?php if(isset($data["status"])){echo $data["status"];}?>
      <h2 class="login-header">
        اضافة مستخدم 
      </h2>
      <form class="login-container" method="post" dir="auto">
        <p>
        <input name="username" type="text" class="form-control" dir="auto" required="required" placeholder="اسم المستخدم">
        </p>
        <p>
        <input name="password" type="password" class="form-control" dir="auto" required="required" placeholder="كلمة المرور ">
        </p>
        <p>
          <label for="rol" class="float-right">
          الصلاحية 
          </label>
          <select id="rol" name="rol" class="form-control">
           <option value="2"  >
         مدير
           </option>
           <option value="1" >
         مسؤول مشتريات
       </option>
           <option value="0" >
         مسؤول مبيعات
       </option>
          </select>
        </p>
        <p><input name="addUser" type="submit" value="حفظ"></p>
        <p>
          <a href="<?php echo URL_ROOT.'Users/index';?>" class="float-right text-primary">
            الرجوع للمستخدمين 
          </a>
        </p>
        <br>
      </form>
    </div>
    <br>
  </div>
</div>