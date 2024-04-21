  <br><br>
  <script>
  <?php 
    $filesJs = ["jquery.min","bootstrap.bundle","barcode","ajax","script"];
    for($js = 0; $js < count($filesJs); $js++){
      include_once './assets/js/' . $filesJs[$js] . '.js';
    }
    /*
     include_once './assets/js/jquery.min.js';
     include_once './assets/js/bootstrap.bundle.js';
     include_once './assets/js/barcode.js';
     include_once './assets/js/script.js';
     */
   ?>
   </script>
  </body>
</html>
<!--
|======================================
|
|      programming  : Adel Mahmoud
|      phone number : +201018646196
|   
|======================================
-->