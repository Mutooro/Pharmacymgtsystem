<?php
session_start();
include("dbcon.php");
$message="";
$date = date("Y");

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
      $result = mysqli_query($con, "SELECT admin_id, username, password FROM admin WHERE username='$username'");
      $row = mysqli_fetch_array($result);
      if ($row && password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['username'] = $row['username'];
        $invoice_number = "CA-" . invoice_number();
        $_SESSION['user_session'] = 'admin';
        header("location: pages/salesAdmin.php?invoice_number=$invoice_number");
      } else {
        $message = "<center><font color=red>Invalid login Try Again</font></center>";
      }
      break;

    case 'Pharmacist':
      $result = mysqli_query($con, "SELECT pharmacist_id, first_name, last_name, staff_id, username, password FROM pharmacist WHERE username='$username'");
      $row = mysqli_fetch_array($result);
      if ($row && password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['pharmacist_id'] = $row['pharmacist_id'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['staff_id'] = $row['staff_id'];
        $_SESSION['username'] = $row['username'];
        $invoice_number = "CA-" . invoice_number();
        $_SESSION['user_session'] = 'pharmacist';
        header("location: home.php?invoice_number=$invoice_number");
      } else {
        $message = "<center><font color=red>Invalid login Try Again</font></center>";
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

<!-- Your HTML code goes here -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="icon" href="images/oip-p.jpg" type="image/png" sizes="70x70">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
    body {
      background-color: #f1f1f1;
  }
  
  .reset-password {
      max-width: 300px;
      margin: 0 auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      
  }
  
  
  .reset-password h1 {
      text-align: center;
      color: green;
  }
  
  .reset-password form {
      display: flex;
      flex-direction: column;
    
  }
  
  .reset-password label {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
  }
  
  .reset-password label i {
      margin-right: 10px;
  }
  
  .reset-password input[type="text"],
  .reset-password input[type="password"] {
      padding: 10px;
      color:green;
      border: none;
      border-bottom: 1px solid green;
  }
  
  .reset-password input[type="submit"] {
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
  }
  .reset-password select{
    padding: 10px;
    border: none;
    display: flex;
</style>
    </style>
</head>
<body>
    <div class="reset-password">
        <h1>Login</h1>
        $message
        <form action="" method="post">
            <!-- Your form elements here -->
            <label for="username">
                <i class="fas fa-user"></i>
                <input type="text" name="username" placeholder="Username" id="username" required>
            </label>
            <label for="password">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" id="password" required>
            </label>
           
            <label for="role">
                <i class="fas fa-users"></i>
                <select name="position" id="role" required>
                <option>--Select Role--</option>
        			<option>Admin</option>
        			<option>Pharmacist</option>
                </select>
            </label>
            <input type="submit" value="Login" name="submit">

        </form>
        <center><div class="footer" ><hr>
        <p>&copy; $date Ask Pharmacy Limited. All rights reserved.</p>
    </div></center>
    </div>

    
</body>
</html>
LOGIN;
