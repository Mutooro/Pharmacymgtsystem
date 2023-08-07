<?php
session_start();
include("dbcon.php");
$message="";

if (isset($_SESSION['user_session'])) {
  $invoice_number = "CA-" . invoice_number();
  header("location: home.php?invoice_number=$invoice_number");
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $position = $_POST['position'];

  switch ($position) {
    case 'Admin':
      $result = mysqli_query($con, "SELECT admin_id, username FROM admin WHERE username='$username' AND password='$password'");
      $row = mysqli_fetch_array($result);
      if ($row > 0) {
        session_start();
        $_SESSION['admin_id'] = $row[0];
        $_SESSION['username'] = $row[1];
        $invoice_number = "CA-" . invoice_number(); // Generate random invoice number
        
    $_SESSION['user_session'] = 'admin'; // Set user_session for admin
        
        header("location: pages/admin_dashboard.php");
      } else {
        $message = "<font color=red>Invalid login Try Again </font>";
      }
      break;

      case 'Pharmacist':
        $result = mysqli_query($con, "SELECT pharmacist_id, first_name, last_name, staff_id, username FROM pharmacist WHERE username='$username' AND password='$password'");
        $row = mysqli_fetch_array($result);
        if ($row > 0) {
          session_start();
          $_SESSION['pharmacist_id'] = $row[0];
          $_SESSION['first_name'] = $row[1];
          $_SESSION['last_name'] = $row[2];
          $_SESSION['staff_id'] = $row[3];
          $_SESSION['username'] = $row[4];
          $invoice_number = "CA-" . invoice_number(); // Generate random invoice number
          $_SESSION['user_session'] = 'pharmacist'; // Set user_session for pharmacist
          header("location: home.php?invoice_number=$invoice_number");
        } else {
          $message = "<font color=red>Invalid login Try Again</font>";
        }
        break;
  }
}

// Function to generate random invoice number
function invoice_number()
{
  $chars = "09302909209300923";
  srand((double)microtime() * 1000000);
  $i = 1;
  $pass = '';
  while ($i <= 7) {
    $num = rand() % 10;
    $tmp = substr($chars, $num, 1);
    $pass = $pass . $tmp;
    $i++;
  }
  return $pass;
}



echo <<<LOGIN
<!DOCTYPE html>
<html>



<head>
<title>My Pharmacy</title>
<link rel="stylesheet" type="text/css" href="pages/style/mystyle_login.css">

<style>
#content {
    width: 100%;
height: 100%;
}
#main{
  width: 100%;
height: 100%;
}

</style>

</head>
<body>
<div id="content">
<div id="header">
<h1>My Pharmacy </h1>
</div>
<div id="main">

 
  <form method="post" action="index.php">
    <div class="vid-container">

    <div class="inner-container">
      
      <div class="box">
        <h1>Login</h1>
        <input type="text" name="username" value="" placeholder="Username"/>
        <input type="password" name="password" value="" placeholder="Password"/>
        <center>		<p><select name="position"> </center>
        		<option>--Select position--</option>
        			<option>Admin</option>
        			<option>Pharmacist</option>
        			</select></p>
              <button type="submit" name="submit" value="Login">Login</button>


      </div>
    </div>
  </div>
</div>
</form>


</div>
</body>

</html>
LOGIN;
?>
<!-- Your HTML code goes here -->
