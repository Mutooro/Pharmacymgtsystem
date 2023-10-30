<!-- For more projects: Visit codeastro.com  -->
<?php

session_start();

if(!isset($_SESSION['user_session'])){

    header("location:index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/tcal.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
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
    <style>
  @media print {
    .table-print {
      font-size: 10px; /* Adjust as needed */
    }
  }
</style>

</head>
<body>

  <div class="container">

  	<a href="home.php?invoice_number=<?php echo $_GET['invoice_number']?>"><button class="btn btn-default"><i class="icon-arrow-left"></i> Back to Sales</button></a>

    <div id="content">
<br>
	<div style="font:bold 25px 'Arial';">Ask Pharmacy Limited<br></div>
  <h5>Nakiwala House - Kansanga Near KIU <br>  0703251153/0776283063</h5>
                       
	<br>

	<?php 
  
  $invoice_number = $_GET['invoice_number'];
  $date           = $_POST['date'];
  $paid_amount   = $_POST['paid_amount'];
	?>

<?php


// Check if the username is set in the session
if(isset($_SESSION['username'])) {
    $printed_by = $_SESSION['username']; // Retrieve the username
} else {
    $printed_by = "Unknown"; // Default if username is not set
}
?>


  <form method="POST" action="save_invoice.php">
  <table class="table table-bordered table-hover table-print"  cellpadding="4" cellspacing="0" style="font-family: arial; font-size: 12  px; text-align: left; width: 40%;">
      <tr>
       <strong><h3>Receipt Number:<?php echo $invoice_number?></h3></strong>
       Print Date: <?php echo $date?>
      </tr>
		<thead>
			<tr>
				<th> Medicine </th>
			
				<th> Price </th>
        <th>Qty</th>
				<th> Amount </th>
			</tr>
		</thead>
    <tbody>
      <?php

         include("dbcon.php");

         $select_sql = "SELECT * FROM on_hold where invoice_number = '$invoice_number'";

         $select_query =mysqli_query($con,$select_sql);

          while($row =mysqli_fetch_array($select_query)):
      ?>
        <tr class="record">
        <td><h4><?php echo $row['medicine_name'];?></h4>
          <input type="hidden" name="medicine_name[]" value="<?php echo $row['medicine_name']?>"></td>
          
        
       
        <td>
        <?php
        echo "<h5>".$row['cost']."<h5>";
        ?>
        </td>
        <td>
                     <?php
      
                        $quantity =  $row['qty'];
                        $type     =  $row['type'];
                       ?>
                       <h4> <?php echo $quantity ; ?></h4>
                        
                        
                                     
                     </td>
        <td>
        <?php
         echo "<h5>".$row['amount']."<h5>";
        ?>
        </td>
        </tr>
      <?php endwhile;?>
      <!-- For more projects: Visit codeastro.com  -->
        <tr>
          <td colspan="3" style=" text-align:right;"><strong style="font-size: 12px;">Total: &nbsp;</strong></td>
          <td colspan="2"><strong style="font-size: 12px;">
          <?php

          $select_sql = "SELECT sum(amount) from on_hold where invoice_number = '$invoice_number'";

          $select_sql = mysqli_query($con,$select_sql);

          while($row = mysqli_fetch_array($select_sql)){

            $amount =  $row['sum(amount)'];

            echo '<h5>'.$amount.'</h5>';

          }
          
          ?>
          </strong></td>
        </tr>

         <tr>
          <td colspan="3" style=" text-align:left;"><strong style="font-size: 12px;">Paid Amount: &nbsp;</strong></td>
          <td colspan="1"><strong style="font-size: 12px;">
          <?php

          echo '<h3>'.'ugx.'.$paid_amount.'</h3>';


          ?>
          </strong></td>
        </tr>
       
         <!-- <tr>
          <td colspan="3" style=" text-align:left;"><strong style="font-size: 18px;">&nbsp;&nbsp;Change Amount: &nbsp;</strong></td>
          <td colspan="2"><strong style="font-size: 12px;">
          <?php

          echo '<h3>'.'ugx.'.($paid_amount - $amount).'</h3>';
          
          ?>
          </strong></td>
        </tr> -->
      
    </tbody>
  </table><br/>
  <strong style="font-size: 12px;">Printed by: <?php echo $printed_by; ?>&nbsp;, <?php echo date("d-m-Y H:i:s"); ?> For ASK Pharmacy Limited
</strong>

  </div>

  <input type="hidden" name="paid_amount" value="<?php echo $paid_amount?>">
  <input type="hidden" name="invoice_number" value="<?php echo $invoice_number?>">
  <input type="hidden" name="date" value="<?php echo $date?>">
  <input type="submit" name="submit" class="btn btn-success btn-large" value="Submit and Make new Sales" >
  <a href="javascript:Clickheretoprint()" class="btn btn-danger btn-md"><i class="icon icon-print"></i> Print</a>

  </form>
  

  </body>
  </html>
 