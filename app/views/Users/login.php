    <div style="height:100vh;" class="d-flex align-items-center justify-content-center">
      <div class="login" style="width:350px;">
        <?php if( $data["error"] !== ""){?>
         <div class="alert alert-danger text-center">
           <?php echo $data["error"];?>
         </div>
        <br>
        <?php }?>
        <h2 class="login-header">
          تسجيل الدخول 
        </h2>
        <form class="login-container" method="post">
          <p><input name="username" type="text" required="required" placeholder="اسم المستخدم"></p>
          <p><input name="password" type="password" required="required" placeholder="كلمة المرور"></p>
          <p><input name="login" type="submit" value="تسجيل الدخول "></p>
        </form>
      </div>
    </div>