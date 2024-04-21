 <nav class="navbar navbar-expand-md navbar-light bg-light" dir="rtl">
  <a class="navbar-brand" href="<?php echo URL_ROOT.'pages/index';?>">
    الصفحة الرئيسية 
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav text-left">
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">
          <?php 
            if(isset($_SESSION["sales"])){
              echo str_replace("_"," ",$_SESSION["sales"]);
            }elseif(isset($_SESSION["product"])){
              echo str_replace("_"," ",$_SESSION["product"]);
            }elseif(isset($_SESSION["management"])){
              echo str_replace("_"," ",$_SESSION["management"]);
            }
          ?>
        </a>
      </li>
      <a class="nav-item nav-link active text-danger" href="<?php echo URL_ROOT.'pages/logout';?>">
        تسجيل الخروج 
        <span class="sr-only">(current)</span></a>
    </div>
  </div>
</nav>
