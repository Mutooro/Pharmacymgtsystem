<?php
session_start();
include_once('../dbcon.php');
$message = "";
$message1 = "";
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
$fname=$_POST['first_name'];
$lname=$_POST['last_name'];
$sid=$_POST['staff_id'];
$postal=$_POST['postal_address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$user=$_POST['username'];
$pas=$_POST['password'];
$hashed_password = password_hash($pas, PASSWORD_DEFAULT);
$sql1=mysqli_query($con, "SELECT * FROM admin WHERE username='$user'")or die(mysqli_error());
 $result=mysqli_fetch_array($sql1);
if($result>0){
$message="<font color=blue>sorry the username entered already exists</font>";
 }else{
$sql=mysqli_query($con, "INSERT INTO admin(first_name,last_name,staff_id,postal_address,phone,email,username,password,date)
VALUES('$fname','$lname','$sid','$postal','$phone','$email','$user','$hashed_password',NOW())");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_add.php");
}else{
$message1="<font color=red>Registration Failed, Try again</font>";
}
	}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $username;?>Ask Pharmacy</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<!-- <script src="js/validation_script.js" type="text/javascript"></script> -->
  <!-- Link to Bootstrap JS (Optional, needed for certain features) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <style>#left-column {height: 550px;}
 #main {height: 550px;}
</style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Ask Pharmacy  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto"> <!-- Added ml-auto class here -->
     
        <li class="nav-item ">
          <a class="nav-link" href="salesAdmin.php"><span class="icon-home"></span> Home </a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="#"><span class="icon-user"></span> Users <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adminProducts.php"><span class="icon-th"></span> Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../logout.php"><font color='red'><span class="icon-off"></span></font>Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Your page content here -->
<div id="content">
<div id="header">
<h1>My Pharmacy</h1></div>

<div id="main">
<div id="tabbed_box" class="tabbed_box"><br>
    <h4>Manage Admins</h4>
<hr/>
    <div class="tabbed_area">

        <ul class="tabs">
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View User</a></li>
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add User</a></li>

        </ul>

        <div id="content_1" class="content">
		<?php echo $message;
			  echo $message1;
		/*
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('../dbcon.php');
       // get results from database
       $result = mysqli_query($con, "SELECT * FROM admin")or die(mysqli_error());
		// display data in table
        echo "<table border='1' cellpadding='5'align='center'>";
        echo "<tr> <th>ID</th><th>Firstname </th> <th>Lastname </th> <th>Username </th><th>Update </th><th>Delete</th></tr>";
        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['admin_id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
				echo '<td>' . $row['last_name'] . '</td>';
				echo '<td>' . $row['username'] . '</td>';
				?>
				<td><a href="update_admin.php?username=<?php echo $row['username']?>"><img src="images/update-icon.png" width="35" height="35" border="0" /></a></td>
				<td><a href="delete-admin.php?admin_id=<?php echo $row['admin_id']?>"><img src="images/delete-icon.jpg" width="35" height="35" border="0" /></a></td>
				<?php
		 }
        // close table>
        echo "</table>";
?>
        </div>
        <div id="content_2" class="content">
		           <!--Pharmacist-->
				   <?php echo $message;
			  echo $message1;
			  ?>
		<form name="form1" onsubmit="return validateForm(this);" action="admin_add.php" method="post" >
			<table width="220" height="106" border="0" >
				<tr><td align="center"><input name="first_name" type="text" style="width:170px" placeholder="First Name" required="required" id="first_name" /></td></tr>
				<tr><td align="center"><input name="last_name" type="text" style="width:170px" placeholder="Last Name" required="required" id="last_name" /></td></tr>
				<tr><td align="center"><input name="staff_id" type="text" style="width:170px" placeholder="Staff ID" required="required" id="staff_id"/></td></tr>
				<tr><td align="center"><input name="postal_address" type="text" style="width:170px" placeholder="Address" required="required" id="postal_address" /></td></tr>
				<tr><td align="center"><input name="phone" type="text" style="width:170px"placeholder="Phone"  required="required" id="phone" /></td></tr>
				<tr><td align="center"><input name="email" type="email" style="width:170px" placeholder="Email" required="required" id="email" /></td></tr>
				<tr><td align="center"><input name="username" type="text" style="width:170px" placeholder="Username" required="required" id="username" /></td></tr>
				<tr><td align="center"><input name="password" type="password" style="width:170px" placeholder="Password" required="required" id="password"/></td></tr>
				<tr><td align="right"><input name="submit" type="submit" value="Submit"/></td></tr>
            </table>
		</form>
        </div>
    </div>
</div>
</div>

</div>
<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}

if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}


if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

if(document.form1.password.value=="")
{
alert("Password Field is Empty ");
document.form1.password.focus();
return false;
}
	
if(document.form1.password.length<6)
{
alert("Password must be atleast 6 characters long");
document.form1.password.focus();
return false;
}

}

</script>
</body>
</html>
