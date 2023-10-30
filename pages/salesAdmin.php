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
 <link rel="icon" href="oip-p.jpg" type="image/png" sizes="70x70">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-responsive.css">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../src/facebox.css">
  <link rel="stylesheet" type="text/css" href="../css/tcal.css">
    <script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/facebox.js"></script>
    <script type="text/javascript">
      jQuery(document).ready(function($) {
    $("a[id*=popup]").facebox({
      loadingImage : '../src/img/loading.gif',
      closeImage   : '../src/img/closelabel.png'
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

//function for clock
var timerID = null;
var timerRunning = false;
function stopclock (){
if(timerRunning)
clearTimeout(timerID);
timerRunning = false;
}

function showtime() {
// Get the current date and time
var now = new Date();

// Extract hours, minutes, and seconds from the current time
var hours = now.getHours();
var minutes = now.getMinutes();
var seconds = now.getSeconds();

// Add leading zeros if needed to ensure two-digit format
var formattedHours = (hours < 10 ? "0" : "") + hours;
var formattedMinutes = (minutes < 10 ? "0" : "") + minutes;
var formattedSeconds = (seconds < 10 ? "0" : "") + seconds;

// Construct the time string in 24-hour clock format (HH:mm:ss)
var timeValue = formattedHours + ":" + formattedMinutes + ":" + formattedSeconds;

// Display the timeValue in the specified input field (assuming there is an input field with the name 'face')
document.clock.face.value = timeValue;

// Set a timer to call the showtime() function again after 1000 milliseconds (1 second)
timerID = setTimeout(showtime, 1000);

// Indicate that the timer is running
timerRunning = true;
}

function startclock() {
stopclock();
showtime();
}
window.onload=startclock;

//Clock
 
      
    </script>


     
</head>
<body>
  <body style="height: 100%">

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
        <li class="active">
          <a href="salesAdmin.php"><span class="icon-home"></span> Home <span class="sr-only">(current)</span></a>
        </li>
        <li>
          <a href="admin_pharmacist.php"><span class="icon-user"></span> Users</a>
        </li>
        <li >
          <a href="adminProducts.php"><span class="icon-th"></span> Products  </a>
        </li>
        <li class="dropdown active" >
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: blue;" >
        Hi, <?php echo $_SESSION['username']?></span>
        <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li><a href="adminChange.php" id="popup"><font color='green'><span class="icon-key"></span></font> Change Password</a></li>
        <li><a href="admin_add.php"><font color='green'><span class="icon-user"></span></font> Add Admin</a></li>
        <li><a href="../logout.php"><font color='red'><span class="icon-off"></span></font> Logout</a></li>
      </ul>
    </li>
      </ul>
    </div>
  </div>
</nav>

  <!--*****Header******-->
  <div class="container">
    <div class="row">
        <div class="col-md-6">
            <form name="clock" method="POST" action="#">
                <!--*****Clock******-->
                <input style="width:150px;background: #098;color: #fff;border-radius: 5px;height: 30px;"
                       readonly type="submit" class="trans" name="face" value="">
            </form>
            <!--*****Clock******-->
        </div>
        <div class="col-md-6 text-right">
            <font>Today's Sales:</font>
            <strong>
    <?php
    include("../dbcon.php");
    $date = date("Y-m-d");
    $select_sql = "SELECT SUM(total_amount) AS total_sales FROM sales WHERE Date = '$date'";
    $select_query = mysqli_query($con, $select_sql);
    $row = mysqli_fetch_assoc($select_query);
    $total_sales = $row['total_sales'];
    echo 'shs.' . $total_sales;
    ?>
</strong>

        </div>
        <div class="clearfix"></div> <!-- Clear the float to ensure proper alignment -->
        <div class="col-md-12">
        <i class="glyphicon glyphicon-calendar"></i>

            <?php
            $Today = date('y:m:d', mktime(12, 0, 0, 7, 23, 2023));
            $new = date('l, F d, Y', strtotime($Today));
            echo $new;
            ?><br><br>
        </div>
    </div>
</div>

      <div class="container">


    <div class="row">
      <div class="contentheader">

        <h2>Sales Report</h2>
  
      </div><br>
  <!--display sample report of all sales made by every user-->

  <?php
include("../dbcon.php");

// Retrieve summary of sales by user session
$summary_sql = "SELECT user_session, SUM(total_amount) AS total_sales FROM sales where Date='$date' GROUP BY user_session";
$summary_query = mysqli_query($con, $summary_sql);
?>

<div style="display: flex; align-items: center;">
    <table class="table table-bordered table-striped table-hover" style="max-width: 300px; margin-right: 10px;">
        <!-- ... Your table content ... -->
        <thead>
        <tr>
            <th>User</th>
            <th>Total Sales&nbsp;&nbsp;(<font size='2' color='#009688;'>Today</font>)</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($summary_query)) {
            $user_session = $row['user_session'];
            $total_sales = $row['total_sales'];
            echo "<tr>";
            echo "<td>$user_session</td>";
            echo "<td>shs.$total_sales</td>";
            echo "</tr>";
        }
        ?>
    </tbody>

    </table>

    <form action="salesAdmin.php" method="POST">
        <strong>From : 
            <input type="date" style="width: 223px; padding: 14px;" name="d1" class="tcal" autocomplete="off" value="" />
            To: 
            <input type="date" style="width: 223px; padding: 14px;" name="d2" autocomplete="off" class="tcal" value="" />
            <button class="btn btn-info" style="width: 123px; height: 50px; margin-top: -8px; margin-left: 8px;" type="submit" name="submit">
                <i class="icon icon-search icon-large"></i> Search
            </button>
        </strong>
    </form>
</div>

  

              <div style="overflow-x:auto; overflow-y: auto;">
  
  
       <table class="table table-bordered table-striped table-hover">
  
       <thead>
       <tr style="background-color: #383838; color: #FFFFFF;" >
              <th>Date</th>
              <th>Receipt No.</th>
             <th>Medicines</th>
             
             <!-- <th>User Session</th> -->
              <th>Total Amount</th>
              <th>Total Profit</th>  
              <th>Action</th>
            <!--  <th>Action</th>-->
            </tr></thead>
  
          <?php
  
              include("../dbcon.php");
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
             
              <!-- <td><?php
                    $user_session = $row['user_session']; // Assuming the user session is stored in 'user_session' column
                    echo $user_session;
                ?></td> -->
              <td><?php echo $row['total_amount']?></td>
              <td><?php echo $row['total_profit']?></td>
                  <td><a href="dwn.php?invoice_number=<?php echo $invoice_number?>"><button class="btn btn-success btn-md"><span class="icon-download-alt"></span> Download</button></a>
               </td>
  
                                       <?php endwhile;?>
  
            </tr>
            </tbody>
  
            <th colspan="4">Total:</th>
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
                            <?php }else {
    // Define and format the current date
    $date = date("Y-m-d"); // Format: YYYY-MM-DD

    // Query to fetch sales for today
    $select_sql = "SELECT * FROM sales WHERE Date BETWEEN '$date' AND '$date'";
    $select_query = mysqli_query($con, $select_sql);

    // Render the table
    while ($row = mysqli_fetch_array($select_query)) :
        ?>
        <tbody>
        <tr>
            <td><?php echo $row['Date'] ?>&nbsp;&nbsp;(<font size='2' color='#009688;'>Today</font>)</td>
            <td><?php
                $invoice_number = $row['invoice_number'];
                echo $invoice_number;
                ?></td>

            <td><?php echo $row['medicines'] ?></td>
            

            <td><?php echo $row['total_amount'] ?></td>
            <td><?php echo $row['total_profit'] ?></td>
            <td><a  href="dwn.php?invoice_number=<?php echo $invoice_number?>"><button
                            class="btn btn-success btn-md"><span class="icon-download-alt"></span> Download</button></a>
            </td>
        </tr>
        </tbody>
        <?php
    endwhile;

?>
</tr>
</tbody>
<th colspan="4">Total:</th>
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
  
                            <?php }?>
                </th>
  
  
        </table>
       
        
      </div>
    </div>
  </div>
  </body>
</html>



