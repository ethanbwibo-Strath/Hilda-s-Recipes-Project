<?php

require("connect.php");

if(isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["role"]))

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$role = $_POST["role"];

// Check if the username already exists
$checkUsernameQuery = "SELECT * FROM tblusers WHERE Username = '$username'";
$result = $conn->query($checkUsernameQuery);

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
// Username is available, insert the new record
$sql = "INSERT INTO tblusers (Username, Email, Password, Role)
    VALUES ('$username', '$email', '$password', '$role')";



    
if ($conn->query($sql) === TRUE) {
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
        <a href="Homepage.php"><p><b>Go back to Home</b></p></a>
    </div>
  </body>
  </html>';

  } 
else {
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

$conn->close();


?>
