<?php
include("db.php");
session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            // ✅ Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            echo "Login successful!";
            header("Location: index-2.php"); // ✅ Redirect to protected page after login
            exit;
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "User not found. Please register first.";
    }
    
    

    $stmt->close();
    $conn->close();
}
?>
