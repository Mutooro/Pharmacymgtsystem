<?php

   session_start();
   $username=$_SESSION['username'];

  if(!isset($_SESSION['user_session'])){
    
      header("location:../index.php");

  }

?><!-- For more projects: Visit codeastro.com  -->


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $username;?> - My Pharmacy</title>
  <link rel="icon" href="oip-p.jpg" type="image/png" sizes="70x70">
  <!-- Link to Bootstrap CSS -->
  <!-- Add this in the <head> section of your HTML file -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Link to Bootstrap JS (Optional, needed for certain features) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="../src/facebox.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../src/facebox.js"></script>
    <script type="text/javascript">

       jQuery(document).ready(function($) {//*****POP_UP FORMS*********
    $("a[id*=popup").facebox({
      loadingImage : '../src/img/loading.gif',
      closeImage   : '../src/img/closelabel.png'
    })
  })//*****POP_UP FORMS*********

    </script>
</head>
<body style="height: 100%">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: black;">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color:#FFFFFF;">Ask Pharmacy Limited</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li >
          <a href="salesAdmin.php"><span class="icon-home"></span> Home</a>
        </li>
        <li>
          <a href="admin_pharmacist.php"><span class="icon-user"></span>Users</a>
        </li>
        <li class="active">
          <a href="#"><span class="icon-th"></span> Products  <span class="sr-only">(current)</span></a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>



  <!-- Your page content here -->
  <div class="container"><!---****SEARCHES_CONTENT*****--->

<div class="">
  <br>

      <input type="text"  id="name_med1" size="4"  onkeyup="med_name1()" placeholder="Filter using BarCode" title="Type BarCode">
      <input type="text" size="4"  id="med_quantity" onkeyup="quanti()" placeholder="Filter using Medicine Name" title="Type Medicine Name">
      <input type="text" size="4" id="med_exp_date" onkeyup="exp_date()" placeholder="Filter using Registered Date" title="Type in registered date">
      <input type="text" size="4" id="med_status" onkeyup="stat_search()" placeholder="Filter using Profit Margin" title="Type in profit amount">
    
        
</div>

<!-- For more projects: Visit codeastro.com  -->
</div><!---****SEARCHES_CONTENT*****--->


<?php

 include('../dbcon.php');

   $select_sql = "SELECT * FROM stock order by quantity";
   $select_query = mysqli_query($con,$select_sql);
   $row = mysqli_num_rows($select_query);

?>

<div style="text-align:center;">
  Total Medicines : <font color="green" style="font:bold 22px 'Aleo';">[<?php echo $row;?>]</font>
</div>
<!-- <div class="container" style="overflow-x:auto; overflow-y: auto;"> -->
<div class="container">
<!---***CONTENT****----->
<div class="row">
<div class="col-12">
  <form method="POST">
    <!-- <div style="overflow-x:auto; overflow-y: auto; height: auto;"> -->
      <div style="height: auto;">
    <table id="table0" class="table table-bordered table-striped table-hover">
     <thead>
       <tr style="background-color: #383838; color: #FFFFFF;" >
       <th width="3%">Code</th>
       <th width="3%">Medicine</th>
       <th width="1%">Category</th>
       <th width="5%">Registered Qty</th>
       <th width="1%">Sold Qty</th>
       <th  width="1%">Remain Qty</th>
       <th width="1%">Registered</th>
       <th style="background-color: #c53f3f;" width="1%">Expiry</th>
        
       <th width="2%">Acutal Price</th>
       <th width="2%">Selling Price</th>
       <th width="2%">Profit</th>
       <th width = "3%">Status</th>
       
       </tr>
     </thead>
      <tbody>

  <?php include("../dbcon.php"); ?>
  <?php $sql = "SELECT  id,bar_code, medicine_name, category, quantity,used_quantity, remain_quantity,act_remain_quantity, register_date, expire_date, company, sell_type , actual_price, selling_price, profit_price, status FROM stock order by id desc"; ?>
  <?php $result =  mysqli_query($con,$sql); ?>
<!--Use a while loop to make a table row for every DB row-->
  <?php while( $row =  mysqli_fetch_array($result)) : ?>
  <!-- For more projects: Visit codeastro.com  -->

  <tr >
      <!--Each table column is echoed in to a td cell-->
      <td><?php echo $row['bar_code']; ?></td>
      <td><?php echo $row['medicine_name']; ?></td>
      <td><?php echo $row['category']; ?></td>
      <td><?php echo $row['quantity']."&nbsp;&nbsp;(<strong><i>".$row['sell_type']."</i></strong>)"?></td>              
      <td><?php echo $row['used_quantity']; ?></td>
      <td><?php echo $row['remain_quantity']; ?></td>
      <td><?php echo  date("d-m-Y", strtotime($row['register_date'])); ?></td>
      <td><?php echo date("d-m-Y", strtotime($row['expire_date'])); ?></td>
     
      <td><?php echo $row['actual_price']; ?></td>
      <td><?php echo $row['selling_price']; ?></td>
      <td><?php echo $row['profit_price']; ?></td>
      <td><?php $status = $row['status'];

          if($status == 'Available'){
            echo '<span class="label label-success">'.$status.'</span>';
          }else{
            echo '<span class="label label-danger">'.$status.'</span>';
          }

      ?></td>
     
      </tr>
  <?php endwhile ?>
</tbody>
     </table>
   </div>
</form> 
</div>
</div>
</div>
</body>
</html>

<script type="text/javascript">
function med_name1() {//***Search For Medicine *****
  var input, filter, table, tr, td, i;
  input = document.getElementById("name_med1");
  filter = input.value.toUpperCase();
  table = document.getElementById("table0");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


function quanti() {//***Search For quantity *****
  var input, filter, table, tr, td, i;
  input = document.getElementById("med_quantity");
  filter = input.value.toUpperCase();
  table = document.getElementById("table0");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function exp_date() {//***Search For expireDate *****
  var input, filter, table, tr, td, i;
  input = document.getElementById("med_exp_date");
  filter = input.value.toUpperCase();
  table = document.getElementById("table0");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[6];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


function stat_search() {//***Search For Status*****
  var input, filter, table, tr, td, i;
  input = document.getElementById("med_status");
  filter = input.value.toUpperCase();
  table = document.getElementById("table0");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[11];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

$(".delete").click(function(){//***Showing Alert When Deleting*****

  var element = $(this);

  var del_id = element.attr("id");

  var info = 'id='+del_id;
 
  if(confirm("Delete This Product!! Are You Sure??")){

    $.ajax({

      type :"GET",
      url  :'delete.php',
      data :info,
      success:function(){
        location.reload(true);
      },
      error:function(){
        alert("error");
      }

    });
    
  }
  return false;

});//***Showing Alert When Deleting********



</script>