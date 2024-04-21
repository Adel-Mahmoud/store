<!--
|======================================
|
|      programming  : Adel Mahmoud
|      phone number : +201018646196
|   
|======================================
-->
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title><?php if(isset($data["titlePage"])){echo $data["titlePage"];}?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
    <link rel="icon shortcut" href="<?php echo URL_ROOT.'logo.png';?>">
    <style>
       <?php 
       $filesCss = ["bootstrap.min","style"];
        for($css = 0; $css < count($filesCss); $css++){
          include_once 'assets/css/' . $filesCss[$css] . '.css';
        }
        // include_once 'assets/css/bootstrap.min.css';
        // include_once 'assets/css/style.css';
       ?>
     </style>
  </head>
  <body>
    <!--
  	<div class="loading">
      <div class="loader"></div>
    </div>
    -->