<!-- <php

require("connect.php");

if (!isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["role"])) {
    die("Please fill out all fields.");
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"]; -->

<?php

require("connect.php");

if(!isset($_POST["username"], $_POST["email"], $_POST["password"])) {
    die("Please fill out all fields.");
}

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = "Recipe Owner";

// --- START PASSWORD STRENGTH CHECK ---
$errors = [];
if (strlen($password) < 8) {
    $errors[] = "Password must be at least 8 characters long.";
}
if (!preg_match('/[A-Z]/', $password)) {
    $errors[] = "Password must contain at least one uppercase letter.";
}
if (!preg_match('/[a-z]/', $password)) {
    $errors[] = "Password must contain at least one lowercase letter.";
}
if (!preg_match('/[0-9]/', $password)) {
    $errors[] = "Password must contain at least one number.";
}

// If there are any errors, stop the script and show them.
if (!empty($errors)) {
    echo '
<!DOCTYPE html>
<html>
<head>
<title>Record Creation</title>
<meta charset="UTF-8">
<link rel="icon" href="Images/Hilda\'s Recipes.png" type="image/png">
<link rel="stylesheet" href="Submission.css">
</head>

<body>
<div class="message_error">
    <h1>Password is not strong enough.</h1>';

    foreach ($errors as $error) {
        echo "<p>" . htmlspecialchars($error) . "</p>";
    }

    echo '<a href="SignUp.html"><p><b>Go back</b></p></a>
</div>
</body>
</html>';

    $conn->close(); // Close the connection
    exit(); // Stop the script from running further
}
// --- END PASSWORD STRENGTH CHECK ---

// --- 1. HASH THE PASSWORD ---
// This creates a secure, salted hash using the default (bcrypt) algorithm.
$hashed_password = password_hash($password, PASSWORD_DEFAULT);


// --- 2. USE A PREPARED STATEMENT (to prevent SQL Injection) ---

// First, check if the username already exists
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username already exists
    echo '
<!DOCTYPE html>
<html>
<head>
<title>Record Creation</title>
<meta charset="UTF-8">
<link rel="icon" href="Images/Hilda\'s Recipes.png" type="image/png">
<link rel="stylesheet" href="Submission.css">
</head>

<body>
<div class="message_error">
    <h1>The username "' . htmlspecialchars($username) . '" is already taken.</h1>
    <p>Please choose a different username.</p>
    <a href="SignUp.html"><p><b>Go back</b></p></a>
</div>
</body>
</html>';
} else {
    // Username is available, insert the new record with the HASHED password
    $stmt = $conn->prepare("INSERT INTO tblusers (Username, Email, Password, Role) VALUES (?, ?, ?, ?)");
    
    // Bind the HASHED password, not the original $password
    $stmt->bind_param("ssss", $username, $email, $hashed_password, $role);
    
    if ($stmt->execute()) {
        echo 
'
  <!DOCTYPE html>
  <html>
  <head>
    <title>Record Creation</title>
    <meta charset="UTF-8">
    <link rel="icon" href="Images/Hilda\'s Recipes.png" type="image/png">
    <link rel="stylesheet" href="Submission.css">
  </head>

  <body>
    <div class="message_success">
        <h1>Account Created Successfully</h1>
        <a href="HomePage.php"><p><b>Go back to Home</b></p></a>
    </div>
  </body>
  </html>';

  } else {
  echo 
  '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Record Creation</title>
        <meta charset="UTF-8">
        <link rel="icon" href="Images/Hilda\'s Recipes.png" type="image/png">
        <link rel="stylesheet" href="Submission.css">
    </head>

    <body>
        <h1> "Kindly Try Again"</h1>
        <h2> "Error creating account"</h2>
        <a href="SignUp.html">Go back</a>
    </body>
    </html>';
  }
}

$stmt->close();
$conn->close();

?>