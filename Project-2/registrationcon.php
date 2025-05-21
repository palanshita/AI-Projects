<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]); // ✅ Check password correctly

    if (!empty($email) && !empty($username) && !empty($password)) {
        // Hash the password before inserting it into the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users  ( username,email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username,  $email, $hashed_password);

        if ($stmt->execute()) {
            // echo "<p style='color: green;'>Registration successful!</p>";
            header("Location: login.php?registration_success=1");
            exit;
        } else {
            echo "<script>showToast('Registration failed. Try again.');</script>";
        }

        $stmt->close();
    } else {
        echo "<script>showToast('Registration failed. Please fill all the fields.');</script>";


    }
}
?>
