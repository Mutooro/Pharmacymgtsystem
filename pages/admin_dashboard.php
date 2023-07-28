<?php
session_start();
include_once('../dbcon.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/../index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?> - My Pharmacy</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="style/dashboard_styles.css"  media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<style>
#left_column{
height: 550px;
}
.grid_7 span{
	color: black;
}

</style>
</head>
<body background="">
<div id="content">
<div id="header">
<h1> My Pharmacy</h1></div> 
<?php

?>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="sales_repot.php">Dashboard</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="../logout.php">Logout</a></li>
		</ul>
</div>
		</div>
<div id="main">

 <!-- Dashboard icons -->
            <div class="grid_7">
            	<a href="../sales_report.php" class="dashboard-module">
                	<img src="images/dashboard(1).png" width="75" height="75" alt="edit" />
                	<span>Dashboard</span>
                </a>
                <a href="../sales_report.php" class="dashboard-module">
                	<img src="images/pharmacist.png"  width="75" height="75" alt="edit" />
                	<span>Pharmacist</span>
                </a>

			</div>
</div>

</div>
</body>
</html>
