
<?php
session_start();
include_once('../dbcon.php');
$message1 = "";


if (isset($_POST['submit'])) {
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$sid = $_POST['staff_id'];
	$postal = $_POST['postal_address'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password']; // Get the raw password from the form
  
	// Create a password hash
	$hashed_password = password_hash($password, PASSWORD_DEFAULT);
  
	// get value of id that sent from address bar
	$user = $_POST['user'];
  
	// Retrieve data from database
	$sql = "UPDATE pharmacist SET first_name='$fname', last_name='$lname', staff_id='$sid',
  postal_address='$postal', phone='$phone', email='$email', username='$username', password='$hashed_password' WHERE username='$username'";
  
	// You should execute the SQL query here using mysqli_query()
  
	if ($sql) {
	  header("location:http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/admin.php");
	} else {
	  $message1 = "<font color=red>Update Failed, Try again</font>";
	}
  }
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'My Pharmacy'; ?>- My Pharmacy</title>

<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<script src="js/function.js" type="text/javascript"></script>
<style>#left-column {height: 550px;}
#main {height: 550px;}</style>
</head>
<body>
<div id="content">
  <div id="header">
    <h1>My Pharmacy</h1>
  </div>
  <div id="left_column">
    <div id="button">
      <ul>
        <li><a href="admin.php">Dashboard</a></li>
        <li><a href="admin_pharmacist.php">Pharmacist</a></li>
        <li><a href="admin_manager.php">Manager</a></li>
        <li><a href="admin_cashier.php">Cashier</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
  <div id="main">
    <div id="tabbed_box" class="tabbed_box">
      <h4>Manage Users</h4>
      <hr/>
      <div class="tabbed_area">
        <ul class="tabs">
          <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update User</a></li>
        </ul>
        <div id="content_1" class="content">
          <?php echo $message1; ?>
          <form name="myform" onsubmit="return validateForm(this);" action="admin_pharmacist.php" method="post">
            <table width="420" height="106" border="0">
              <tr>
                <td align="center"><input name="first_name" type="text" style="width:170px" placeholder="First Name" value="<?php echo isset($_GET['first_name']) ? $_GET['first_name'] : ''; ?>" id="first_name" /></td>
              </tr>
			  <tr><td align="center"><input name="last_name" type="text" style="width:170px" placeholder="Last Name" id="last_name" value="<?php include_once('../dbcon.php'); echo isset($_GET['first_name']) ? $_GET['first_name'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="staff_id" type="text" style="width:170px" placeholder="Staff ID" id="staff_id" value="<?php include_once('../dbcon.php'); echo isset($_GET['staff_id']) ? $_GET['staff_id'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="postal_address" type="text" style="width:170px" placeholder="Address" id="postal_address" value="<?php include_once('../dbcon.php'); echo isset($_GET['postal_address']) ? $_GET['postal_address'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="phone" type="text" style="width:170px" placeholder="Phone" id="phone" value="<?php include_once('../dbcon.php'); echo isset( $_GET['phone']) ? $_GET['phone'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="email" type="email" style="width:170px" placeholder="Email" id="email"value="<?php include_once('../dbcon.php'); echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="username" type="text" style="width:170px" placeholder="Username" id="username"value="<?php include_once('../dbcon.php'); echo isset($_GET['username']) ? $_GET['username'] : ''; ?>" /></td></tr>
				<tr><td align="center"><input name="password" placeholder="Password" id="password"value="<?php include_once('../dbcon.php'); echo isset($_POST['password']) ? $_POST['password'] : ''; ?>"type="password" style="width:170px"/></td></tr>
              <tr>
                <td align="center"><input name="submit" type="submit" value="Update" /></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
