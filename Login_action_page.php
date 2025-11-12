<?php
session_start();
require("connect.php");

// Get the submitted form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Prepare and bind
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = ?");
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $user);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();
if ($result === false) {
    die("Get result failed: " . $stmt->error);
}

if ($result->num_rows > 0) {
    // User found, verify the password
    $row = $result->fetch_assoc();

    // Use password_verify() to check the hash
    if (password_verify($pass, $row['Password'])) { 
        // Password is correct, start a session
        $_SESSION['username'] = $user;
        $_SESSION['user_id'] = $row['ID']; // Store user ID in session
        $_SESSION['user_role'] = $row['Role']; // Store user role in session

        // Redirect based on user role
        if ($row['Role'] == 'Admin') {
            header("Location: HomePage.php?role=admin");
        } elseif ($row['Role'] == 'Recipe Owner') {
            header("Location: HomePage.php?role=owner");
        } else {
            header("Location: HomePage.php");
        }
        exit;
    } else {
        // Incorrect password
        echo "Incorrect password.";
    }
} else {
    // User not found
    echo "User not found.";
}

$stmt->close();
$conn->close();
?>
