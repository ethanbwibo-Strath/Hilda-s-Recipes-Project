<?php
session_start();
include 'connect.php'; 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in!";
    exit();
}

// Use the logged-in user's ID if no ID parameter is provided
$id = isset($_GET['ID']) ? $_GET['ID'] : $_SESSION['user_id'];

// Prepare the SQL statement to prevent SQL injection
$stmt = $conn->prepare("SELECT ID, Username, email, Password FROM tblusers WHERE ID=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found!";
    exit();
}

// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['ID'];
    $new_username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // The new plain-text password

    // Hash the new password before saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE tblusers SET Username=?, email=?, Password=? WHERE ID=?");
    // Bind the HASHED password, not the original $password
    $stmt->bind_param("sssi", $new_username, $email, $hashed_password, $id);

    if ($stmt->execute()) {
        // Redirect to display_users.php after successful update for admin, or to the home page for regular users
        if ($_SESSION['user_role'] == 'Admin') {
            header("Location: HomePage.php");
        } else {
            header("Location: HomePage.php");
        }
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html class="edit_user">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="Submission.css">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
</head>
<body>

<div class="edit_user_container">
    <div class="container">
        <h2>Edit User</h2>

        <form method="post" action="">
            <input type="hidden" name="ID" value="<?php echo htmlspecialchars($user['ID']); ?>">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($user['Password']); ?>" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</div>


</body>
</html>
