
<?php
error_reporting(1);
session_start();
include("dbcon.php");
if(isset($_SESSION['user_session'])){
  
  $invoice_number="CA-".invoice_number();
	header("location:home.php?invoice_number=$invoice_number");
}

   if(isset($_POST['submit'])){  //******Login Form*******
  $username =$_POST['username'];

  $password = $_POST['password'];

  $password = sha1($password);

  $select_sql = "SELECT * FROM users ";

  $select_query = mysqli_query($con,$select_sql);
   
  if($select_query){

  	while ($row =mysqli_fetch_array($select_query)) {
  		$s_username = $row['user_name'];
  		$s_password = $row['password'];
  	}
  }

 if($s_username == $username && $s_password == $password){
          
         $_SESSION['user_session'] = $s_username;
         $invoice_number="CA-".invoice_number();
 	       header("location:home.php?invoice_number=$invoice_number");


 }else{
 	  	    $error_msg = "<center><font color='red'>Login Failed</font></center>";
 }

}                  //******Login Form*******

  function invoice_number(){   //********Outputting Random Number For Invoice Number********

    $chars = "09302909209300923";

    srand((double)microtime()*1000000);

    $i = 1;

    $pass = '';

    while($i <=7){

      $num  = rand()%10;
      $tmp  = substr($chars, $num,1);
      $pass = $pass.$tmp;
      $i++;
    }
    return $pass;
                        //********Outputting Random Number For Invoice Number********
  }                       
?>

<!DOCTYPE html>
<html>
<!DOCTYPE html>
<html>
<head>

	<title>SPMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    
</head>
<body>

	<center>
		<h1>ASK Wholesale Pharmacy</h1>
	</center>

	<div class="content" style="width: 400px">

		<form method="POST">
    <?php echo $error_msg;?>
		<table class="table table-bordered table-responsive " >
			<tr>
			  <td><label for="username">Username</label></td>
			  <td><input type="text" autocomplete="off" name="username" class="form-group" required></td>
			</tr>
			<tr>
				<td><label for="password">Password</label></td>
				<td><input type="password" name="password" required></td>
			</tr>
      <input type="hidden" aucomplete="off" name="invoice_number" value="<?php echo 'CA-'.invoice_number()?>">

		</table>
    

		<input type="submit" name="submit" class="btn btn-success btn-large" value="Login">

    

	</form>

		
  </div>
  
  
 
</body>
</html>
