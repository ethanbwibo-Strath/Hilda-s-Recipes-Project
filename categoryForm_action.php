<?php

require("connect.php");

if(isset($_POST["Category"] , $_POST["Description"]))

$category = $_POST["Category"];
$description = $_POST["Description"];

$checkUsernameQuery = "SELECT * FROM categories WHERE CategoryName = '$category'";
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
    <h1>The category "' . htmlspecialchars($category) . '" is already exists.</h1>
    <a href="CategoryForm.html"><p><b>Go back</b></p></a>
</div>
</body>
</html>';

} else {
// Username is available, insert the new record
$sql = "INSERT INTO categories (CategoryName, Description)
    VALUES ('$category', '$description')";
    
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
        <h1>Category Created Successfully</h1>
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
        <h2> "Error creating category"</h2>
        <a href="CategoryForm.html">Go back</a>
    </body>
    </html>';
  }
}

$conn->close();

?>