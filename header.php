<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<div class="navbar navbar-inverse navbar-fixed-top" ><!--*****Header******-->
<div class="navbar-inner">
  <div class="container-fluid">

    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
    </a>

    <a class="brand" href="#"><b>Ask Pharmacy </b></a>

    <div class="nav-collapse">
      <ul class="nav pull-right">
         
         <li>

         
  <?php 
  
  include("dbcon.php");

    $quantity = "5";
    $select_sql1 = "SELECT * FROM stock where remain_quantity <= '$quantity' and status='Available'";
    $result1 = mysqli_query($con,$select_sql1);
    $row2 = $result1->num_rows;

   if($row2 == 0){

      echo ' <a  href="#" class="notification label-inverse" >
          <span class="icon-exclamation-sign icon-large"></span></a>';

    }else{
      echo ' <a  href="qty_alert.php" class="notification label-inverse" id="popup">
          <span class="icon-exclamation-sign icon-large"></span>
          <span class="badge">'.$row2.'</span></a>';


    }


    ?> 
  </li>
    <li>
      <?php
        @$date = date('Y-m-d');    
  $inc_date = date("Y-m-d", strtotime("+6 month", strtotime($date))); 
  $select_sql = "SELECT  * FROM stock WHERE expire_date <= '$inc_date' and status='Available' ";
   $result =  mysqli_query($con,$select_sql); 
    $row1 = $result->num_rows;

      if($row1 == 0){

           echo ' <a  href="#" class="notification label-inverse" >
          <span class="icon-bell icon-large"></span></a>';

    }else{
      echo ' <a  href="ex_alert.php" class="notification label-inverse" id="popup">
          <span class="icon-bell icon-large"></span>
          <span class="badge">'.$row1.'</span></a>';

      }
      ?>
      
    </li>
  
     
        
  <li><a href="home.php?invoice_number=<?php echo $_GET['invoice_number']?>"><span class="icon-home"></span>Home</a></li>

   <li><a href="product/view.php?invoice_number=<?php echo $_GET['invoice_number']?>"><span class="icon-th"></span> Products</a></li>

   <li><a href="backup.php?invoice_number=<?php echo $_GET['invoice_number']?>"><span class="icon-folder-open"></span> Backup</a></li>

   <li><a href="logout.php" class="link"><font color='red'><span class="icon-off"></span></font>Logout</a></li>
 </ul>
</div>
  </div>
</div>
</div>
</body>
</html>