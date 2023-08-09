<?php
session_start();

if (!isset($_SESSION['user_session'])) {
    header("location:../index.php");
    exit;
}
$error ="";
// Include your database connection code here
$servername = "localhost"; // Change this to your server name if not localhost
$username = "root";
$password = "";
$dbname = "simplepharmacy";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = ""; // Initialize the error message variable

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Additional validation and checks can be added here

    // Get the username from the session
    $username = $_SESSION['username'];

    // Query to retrieve the current hashed password from the database
    $passwordQuery = "SELECT password FROM pharmacist WHERE username = '$username'";
    $result = mysqli_query($conn, $passwordQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];

        // Verify the current password
        if (password_verify($password, $storedPassword)) {
            if ($newPassword !== $confirmPassword) {
                
            } else {
                // Hash the new password before storing it
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Query to update password in the database
                $updateQuery = "UPDATE pharmacist SET password = '$hashedPassword' WHERE username = '$username'";

                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                  echo "<script type='text/javascript'>
                            alert('Password updated successfully!');
                            window.top.location='home.php?invoice_number=$invoice_number';
                        </script>";
              }
               else {
                    $error_message = "Error updating password: " . mysqli_error($conn);
                }
            }
        } else {
          echo "<script type='text/javascript'>
                    
                    window.top.location='home.php?invoice_number=$invoice_number';
                </script>";  
      }
    } else {
        $error_message = "Error retrieving password: " . mysqli_error($conn);
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .error-message {
            color: red;
        }
    </style>
</head>
<body>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="passwordChangeForm">
        <h3>Change Password</h3>

        <table id="table" style="width: 400px; margin: auto; overflow-x: auto; overflow-y: auto;">
            <tr>
                <td>Current Password:</td>
                <td><input type="password" name="password" id="bar_code" size="10" placeholder="" required></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="error-message" id="currentPassError"></div></td>
            </tr>
            <tr id="row1">
                <td>New password:</td>
                <td><input type="password" name="new_password" id="med_name" size="10" required ></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="error-message" id="newPassError"></div></td>
            </tr>
            <tr>
                <td>Confirm Pass:</td>
                <td><input type="password" name="confirm_password" id="category" size="10"  required></td>
            </tr>
            <tr>
                <td></td>
                <td><div class="error-message" id="confirmPassError"></div></td>
            </tr>
            <tr>
                <td></td>
                <td> <input type="submit" name="submit" class="btn btn-success btn-large" style="width: 230px" value="Save"> </td>
            </tr>
        </table>
        <br>
    </form>

    <script>
        $(document).ready(function() {
            

            // Validating the new password input field
            $("#med_name").on("keyup", function() {
                var newPassword = $(this).val();

                if (newPassword.length < 6) {
                    $("#newPassError").text("Password must be at least 6 characters long");
                } else {
                    $("#newPassError").text("");
                }

                validatePasswordsMatch(); // Check if passwords match
            });

            // Validating the confirm password input field
            $("#category").on("keyup", function() {
                validatePasswordsMatch(); // Check if passwords match
            });

            // Function to validate if new password and confirm password match
            function validatePasswordsMatch() {
                var newPassword = $("#med_name").val();
                var confirmPassword = $("#category").val();

                if (newPassword !== confirmPassword) {
                    $("#confirmPassError").text("Passwords do not match");
                } else {
                    $("#confirmPassError").text("");
                }
            }
        });
    </script>
</body>
</html>

