<html>
<?php include 'script_link.php'?>
</html>

<body>
    <?php include 'header.php' ?>
    
<?php include 'dbconfig.php';?>
  <div class="container" >
    <div class="row">
      <div class="col-md-2">
        <img src="image/logo_daimler.png" style="margin-top: 16px;margin-left: -90px;">
      </div>
      <div class="col-md-8 ">
        <h1 class="text-center text-info" style="margin-bottom:75px;">Casting Cost Calculation</h1>
      </div>
      <div class="col-md-2">
        <img src="image/logo_casting.jpg" style="height:150px;width:220px">
      </div>
    </div>
    <div class="row">
      <div class="col-mod-10 col-md-offset-1">
  <?php 
    if(isset($_GET['error']))
    {
      
      echo "<div class='alert alert-danger'>".$_GET['error']."</div>";
    }

  ?>
        </div>
      </div>
  </div>
<?php
include 'dashboard.php';
?>
</body>