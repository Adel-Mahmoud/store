  <br><br>
  <h1 class="text-center" style="color:#09f;"><b>
  برنامج إدارة المخازن 
  </b></h1>
  <br><br>
  <div class="container-floid"  style="padding:0;">
    <div class="containe" style="padding:5%;">
      <div class="row text-center" dir="rtl" style="padding:0;">
      
      
      <?php 
            $Url_ = new Core();
           $Url_ = $Url_->getUrl();
           if(count($Url_)>2){$Url_ = $Url_[2];}
            if(isset($_SESSION["management"]) && $Url_!=="purchases" &&
               isset($_SESSION["management"]) && $Url_!=="control" ||
               isset($_SESSION["product"])    && $Url_!=="purchases"){?>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'sales/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn btn-outline-primary" style="height:90%">
              <div class="text-center">
                <h5>
                	المبيعات
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'pages/index/purchases';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn btn-outline-success " style="height:90%">
              <div class="text-center">
                <h5>
                	المشتريات 
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'stores/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn btn-outline-secondary" style="height:90%">
              <div class="text-center">
                <h5>
                	المخازن
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <?php } if(isset($_SESSION["management"]) && $Url_!=="purchases" &&
                   isset($_SESSION["management"]) && $Url_!=="control"){?>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'pages/index/control';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn btn-outline-info" style="height:90%">
              <div class="text-center">
                <h5>
                	لوحة التحكم 
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <?php } if(isset($_SESSION["management"]) && $Url_=="purchases" || isset($_SESSION["product"]) && $Url_=="purchases"){?>
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'categories/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-warning text-dark" style="height:90%">
              <div class="text-center">
                <h1> <?php echo $data["categoriesCount"];?> </h1>
                <h5>
                  عدد الاصناف
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'models/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-warning text-light" style="height:90%; background:#CF4DCE !important;">
              <div class="text-center">
                <h1> <?php echo $data["modelsCount"];?> </h1>
                <h5>
                  عدد الفئات 
                </h5>
              </div>
            </div>
          </a>
        </div>

        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'products/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-primary text-light" style="height:90%">
              <div class="text-center">
                <h1> <?php echo $data['productsCount'];?> </h1>
                <h5>
                  عدد المنتجات 
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <?php }?>
        
        <?php if(isset($_SESSION["management"]) && $Url_=="control"){?>
        <!-- Admin control -->
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'users/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-success text-light" style="height:90%">
              <div class="text-center">
                <h1> <?php echo $data['usersCount'];?> </h1>
                <h5>عدد المستخدمين</h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'sales/report';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-danger text-light" style="height:90%;background:#6D67E4 !important;">
              <div class="text-center">
                <h1> 📝 </h1>
                <h5>
                  التقارير 
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'ratios/index';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-danger text-light" style="height:90%;background:#472183 !important;">
              <div class="text-center">
                <h1> <?php echo $data["rate"]->type;?> </h1>
                <h5>
                  معدل الربح
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'Products/remaning';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-secondary text-light" style="height:90%">
              <div class="text-center">
                <h1> <?php echo $data['productsRemaning'];?> </h1>
                <h5>
                  منتجات المتبقية 
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <div class="container-home col-6 col-md-4 col-lg-3 col-xl-2">
          <a href="<?php echo URL_ROOT.'Products/runOut';?>">
            <div class="d-flex justify-content-center align-items-center shadow rounded btn-danger text-light" style="height:90%">
              <div class="text-center">
                <h1> <?php echo $data['ProductsRunOutCount'];?> </h1>
                <h5>
                  منتجات نفذت كمياتها
                </h5>
              </div>
            </div>
          </a>
        </div>
        
        <?php }?>
      
      
      </div>
    </div>
    <br><br>
  </div>
