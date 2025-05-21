
<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

$prediction = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['sign_image'])) {
    $file = $_FILES['sign_image'];

    $url = 'http://localhost:5000/predict';

    $cfile = new CURLFile($file['tmp_name'], $file['type'], $file['name']);

    $data = ['file' => $cfile];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if(curl_errno($ch)) {
        $prediction = 'cURL Error: ' . curl_error($ch);
    } else {
        $prediction = $response;
    }

    curl_close($ch);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Recognition</title>
    <link rel="stylesheet" href="{{ url_for('static', filename='style.css') }}">
<style>
    body {
  font-family: Arial, sans-serif;
  background-image: linear-gradient(rgba(0,0,50,0.3),rgba(0,0,50,0.3)),url(website-bg.jpg);
  margin: 0;
  padding: 20px;
}

/* Navbar Styling */
nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: rgba(0, 0, 0, 0); 
  padding: 10px 15px;
  color: white;
  position: relative;
}

/* Logo Styling */
.logo {
  font-size: 24px;
  font-weight: bold;
  color: white;
  margin: 0;
}

/* Navbar Links */
.nav-links {
  list-style: none;
  display: flex;
  gap: 20px; /* Space between Home and Login */
  padding: 0;
  margin: 0;
}

.nav-links li {
  display: inline-block;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-size: 20px;
  padding: 8px 12px;
  transition: background 0.3s ease-in-out;
  border-radius: 5px;
  display: inline-block;
}

.nav-links a:hover {
  background-color: rgba(18, 0, 222, 0.5);
}


/* Form Styling */
h2 {
  color: #0b0b0b;
}

/* Glassmorphism Form */
/* Form Styling */
/* Form Styling */
form {
  background: rgba(0, 0, 0, 0.6); /* Dark translucent background */
  backdrop-filter: blur(10px); /* Blur effect */
  padding: 35px;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(255, 0, 0, 0.5); /* Soft red shadow */
  width: 320px; /* Reduced width */
  margin: 50px auto;
  color: white;
}

/* Form Title */
form h2 {
  text-align: center;
  font-size: 22px; /* Slightly smaller */
  color: #1ca9fa;
  text-transform: uppercase;
  font-weight: bold;
  margin-bottom: 18px; /* Adjusted spacing */
  text-shadow: 0 0 10px rgba(28, 169, 250, 0.8);
}

/* Labels */
label {
  display: block;
  margin-bottom: 6px; /* More space */
  color: #fff;
  font-size: 14px;
  font-weight: bold;
}

/* Input Fields */
input[type="text"],
input[type="email"],
input[type="password"],
select {
  width: 100%;
  padding: 10px;
  margin-bottom: 14px; /* Slightly reduced spacing */
  border: 1px solid rgba(28, 169, 250, 0.8);
  background: rgba(255, 255, 255, 0.1);
  color: white;
  border-radius: 5px;
  box-sizing: border-box; /*it gives better adjustment to the box, like once box width is defined then the padding and margin is cal within it, ie play only in that 200 area*/
  outline: none;
  transition: 0.3s;
  font-size: 14px;
}

/* Input Hover & Focus */
input[type="text"]:hover,
input[type="email"]:hover,
input[type="password"]:hover,
select:hover,
input[type="text"]:focus,
input[type="email"]:focus,
input[type="password"]:focus,
select:focus {
  border-color: rgba(255, 0, 0, 0.8);
  box-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
}

/* Submit Button */
input[type="submit"] {
  background: linear-gradient(45deg, #1ca9fa, #ff3b3b);
  color: white;
  padding: 12px 0;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 15px;
  font-weight: bold;
  text-transform: uppercase;
  transition: 0.3s;
  width: 100%;
  margin-top: 10px; /* Extra spacing from inputs */
}

/* Hover Effect for Submit Button */
input[type="submit"]:hover {
  background: linear-gradient(45deg, #11699c, #d60000);
  box-shadow: 0 0 10px rgba(228, 6, 6, 0.986);
}

/* Add extra space between labels for Login form */
#login-form label {
  margin-bottom: 10px; /* More space between labels */
}

/* Ensure spacing below Submit Button in Login form */
#login-form input[type="submit"] {
  margin-bottom: 15px; /* Extra spacing from the text below */
}

/* Consistent Spacing for Registration Form */
#registration-form label {
  margin-bottom: 8px;
}

/* Responsive Design */
@media (max-width: 480px) {
  form {
    width: 90%;
    padding: 30px;
  }

  input[type="submit"] {
    padding: 10px;
  }
}


</style>
</head>
<body>

<nav>
    <h1 class="logo">Traffic Sign Recognition</h1>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>


<!-- This sends the image directly to Flask -->
<form action="http://localhost:5000/predict" method="POST" enctype="multipart/form-data">
    <h2>Upload Sign Image</h2>
    <input type="file" name="file" accept="image/*" required>
    <br>
    <br>
    <button type="submit">Recognize</button>
</form>

</body>
</html>

