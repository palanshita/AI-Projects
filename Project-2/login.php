<?php
session_start();

// ✅ Show logout success message
if (isset($_GET['logout_success']) && $_GET['logout_success'] == 1) {
    echo "<script>showToast('Logout successful!');</script>";
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="login.css">
  <!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
</head>
<body>



  <nav>
    <h1 class="logo">Traffic Sign Recognition</h1>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
    </ul>
</nav>

<?php
    // Check if registration was successful
    // Check if registration was successful
    if (isset($_GET['registration_success']) && $_GET['registration_success'] == 1) {
      echo "<script>
          Swal.fire({
              icon: 'success',
              title: 'Registration Successful!',
              text: 'Please log in.',
              showConfirmButton: false,
              timer: 1500
          });
      </script>";
  }
  

?>
  <form  id="login-form" action="logincon.php" method="post">
    <center><h2>LOGIN</h2></center>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <input type="submit" name="login" value="LOGIN" >
  <br>

    Dont't have an account? <a href="registration.php">Sign up</a>

  </form>

  <?php 
include("db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email != "" && $password != "") {
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if (password_verify($password, $row["password"])) {
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['username'];

                // ✅ Redirect to index-2.php after successful login
                header("Location: index-2.php");
                exit;
            } else {
                // ✅ Show incorrect password message
                echo "<script>showToast('Incorrect password. Please try again.');</script>";
            }
        } else {
            // ✅ Show user not found message
            echo "<script>showToast('User not found. Please register first.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>showToast('Please fill in all fields.');</script>";
    }
}
?>
</body>
</html>

 
