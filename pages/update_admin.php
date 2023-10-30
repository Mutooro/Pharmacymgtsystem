
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
	$sql = "UPDATE admin SET first_name='$fname', last_name='$lname', staff_id='$sid',
  postal_address='$postal', phone='$phone', email='$email', username='$username', password='$hashed_password' WHERE username='$username'";
  
	// You should execute the SQL query here using mysqli_query()
  
	if ($sql) {
	  header("location:http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/admin_add.php");
	} else {
	  $message1 = "<font color=red>Update Failed, Try again</font>";
	}
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'My Pharmacy'; ?>- My Pharmacy</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Link to Bootstrap JS (Optional, needed for certain features) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="style/mystyle.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" />
<script src="js/function.js" type="text/javascript"></script>


<style>#left-column {height: 550px;}
#main {height: 550px;}</style>
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
    <h1>My Pharmacy</h1>
  </div>
  
  <div id="main">
    <div id="tabbed_box" class="tabbed_box"><br>
      <h4>Manage Users</h4>
      <hr/>
      <div class="tabbed_area">
        <ul class="tabs">
          <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update User</a></li>
        </ul>
        <div id="content_1" class="content">
          <?php echo $message1; ?>
          <form name="myform" onsubmit="return validateForm(this);" action="" method="post">
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
