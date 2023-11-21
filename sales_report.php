<?php

   session_start();

  if(!isset($_SESSION['user_session'])){
    
      header("location:index.php");

  }

?>
<!DOCTYPE html>
<html>
<head>
 <title>Sales Report- Ask</title>
    <link rel="icon" href="images/oip-p.jpg" type="image/png" sizes="70x70">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="src/facebox.css">
  <link rel="stylesheet" type="text/css" href="css/tcal.css">
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/facebox.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
    $("a[id*=popup]").facebox({
      loadingImage : 'src/img/loading.gif',
      closeImage   : 'src/img/closelabel.png'
    })
  }) 
    </script>
    <script type="text/javascript" src="js/tcal.js"></script>
    <script type="text/javascript">

      function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=700, height=400, left=100, top=25"; 
  var content_vlue = document.getElementById("content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('</head><body onLoad="self.print()" style="width: 700px; font-size:11px; font-family:arial; font-weight:normal;">');          
   docprint.document.write(content_vlue); 
   docprint.document.close(); 
   docprint.focus(); 
}

      
    </script>


     
</head>
<body>
  <body style="height: 100%">
<?php
  require_once "header.php";
  ?>
  <!--*****Header******-->

      <div class="container">


    <div class="row">
      <div class="contentheader">

        <h2>Sales Report</h2>
  
      </div><br>
  
  
   <center> <form action="sales_report.php?invoice_number=<?php echo $_GET['invoice_number']?>" method="POST">
  <strong>From : <input type="date" style="width: 223px; padding:14px;" name="d1" class="tcal" autocomplete="off" value="" /> To: <input type="date" style="width: 223px; padding:14px;" name="d2" autocomplete="off" class="tcal" value="" />
   <button class="btn btn-info" style="width: 123px; height:50px; margin-top:-8px;margin-left:8px;" type="submit" name="submit"><i class="icon icon-search icon-large"></i> Search</button>
  </strong>
  </form></center>
  
  
  
              <div style="overflow-x:auto; overflow-y: auto;">
  
  
       <table class="table table-bordered table-striped table-hover">
  
       <thead>
       <tr style="background-color: #383838; color: #FFFFFF;" >
              <th>Date</th>
              <th>Receipt No.</th>
             <th>Medicines</th>
             <!-- <th>Qty (Type)</th> -->
              <th>Total Amount</th>
              <th>Total Profit</th>  
              <!-- <th>Action</th> -->
            <!--  <th>Action</th>-->
            </tr></thead>
  
          <?php
  
              include("dbcon.php");
              error_reporting(1);
              if(isset($_POST['submit'])){
              $d1=$_POST['d1'];
              $d2=$_POST['d2'];
              $select_sql = "SELECT * FROM sales where Date BETWEEN '$d1' and '$d2' order by Date desc";
              $select_query = mysqli_query($con,$select_sql);
              while($row = mysqli_fetch_array($select_query)) :
           ?>
            <tbody>
            <tr>
              <td><?php echo $row['Date']?></td>
              <td><?php $invoice_number =  $row['invoice_number'];
  
                   echo $invoice_number;
  
                   ?></td>
            
              <td><?php echo $row['medicines']?></td>
              <!-- <td><?php echo $row['quantity']?></td> -->
              <td><?php echo $row['total_amount']?></td>
              <td><?php echo $row['total_profit']?></td>
                
               </td>
  
                                       <?php endwhile;?>
  
            </tr>
            </tbody>
  
            <th colspan="3">Total:</th>
                <th>
                  <?php
  
                  $select_sql = "SELECT sum(total_amount) from sales where Date BETWEEN '$d1' and '$d2'";
  
                  $select_query = mysqli_query($con, $select_sql);
  
                  while($row = mysqli_fetch_array($select_query)){
  
                     echo 'ugx.'.$row['sum(total_amount)'];
  
                }
  
                  ?>
                </th>
                <th colspan="2">
                  <?php
  
                  $select_sql = "SELECT sum(total_profit) from sales where Date BETWEEN '$d1' and '$d2'";
  
                  $select_query = mysqli_query($con, $select_sql);
  
                  while($row = mysqli_fetch_array($select_query)){
  
                     echo 'ugx.'.$row['sum(total_profit)'];
                }
                  ?>
                            <?php }else{
  
  
  
  
                            $select_sql = "SELECT * FROM sales where Date = '$date'";
                            $select_query = mysqli_query($con,$select_sql);
                            while($row = mysqli_fetch_array($select_query)) :
  
  
                              ?>
  
                               <tbody>
            <tr> 
              <td><?php echo $row['Date']?>&nbsp;&nbsp;(<font size='2' color='#009688;'>Today</font>)</td>
              <td><?php $invoice_number =  $row['invoice_number'];
  
                   echo $invoice_number;
  
                   ?></td>
            
             <td><?php echo $row['medicines']?></td>
             <!-- <td><?php echo $row['quantity']?></td> -->
             
  
              <td><?php echo $row['total_amount']?></td>
              <td><?php echo $row['total_profit']?></td>
              <!-- <td><a href="download.php?invoice_number=<?php echo $invoice_number?>"><button class="btn btn-success btn-md"><span class="icon-download-alt"></span> Download</button></a> -->
          </td>
         <?php endwhile;?>
  
            </tr>
            </tbody>
  
             <th colspan="3">Total:</th>
                <th>
                  <?php
  
                  $select_sql = "SELECT sum(total_amount) from sales where Date = '$date'";
  
                  $select_query = mysqli_query($con, $select_sql);
  
                  while($row = mysqli_fetch_array($select_query)){
  
                     echo 'shs.'.$row['sum(total_amount)'];
  
                }
  
                  ?><!-- For more projects: Visit codeastro.com  -->
                </th>
                <th colspan="2">
                  <?php
  
                  $select_sql = "SELECT sum(total_profit) from sales where Date = '$date'";
  
                  $select_query = mysqli_query($con, $select_sql);
  
                  while($row = mysqli_fetch_array($select_query)){
  
                     echo 'shs.'.$row['sum(total_profit)'];
                }
                  ?>
  
                            <?php } ?>
                            
                </th>
  
        </table>
        <a href="download_sales_report.php?date=<?php echo $date; ?>">
    <button class="btn btn-primary">
        <span class="icon-download-alt"></span> Download Sales Report
    </button>
</a>

        
      </div>
    </div>
  </div>
  </body>
</html>
<!-- For more projects: Visit codeastro.com  -->
