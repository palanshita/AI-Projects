<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="login.css">
</head>
<body >
  <nav>
    <h1 class="logo">Traffic Sign Recognition</h1>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="login.html">Login</a></li>
    </ul>
</nav>

  <form action="registrationcon.php" method="post">
    <center><h2>SIGN UP</h2></center>
     <label for="name">User Name:</label>
    <input type="text" id="username" name="username" required> 
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
     <!-- <label for="gender">Gender:</label> -->
    <!-- <select id="gender" name="gender">
      <option value="male">Male</option>
      <option value="female">Female</option>
      <option value="other">Other</option>
    </select> 
     -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required> 
    <br><br>
    <center>
    <input style="padding: 10px;" type="submit" name="register" value="register"></center>

    

  </form>

    </body>
</html>
