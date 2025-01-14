<?php
session_start(); 
require "connect.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

if(isset($_POST["Title"], $_POST["Description"], $_POST["Image"], $_POST["Ingredients"], $_POST["Directions"], $_POST["Servings"], $_POST["Time"], $_POST["Category"], $_POST["Cuisine"]))

$title = mysqli_real_escape_string      ($conn, $_POST["Title"]);
$description = mysqli_real_escape_string($conn, $_POST["Description"]);
$image = mysqli_real_escape_string      ($conn, $_POST["Image"]);
$ingredients = mysqli_real_escape_string($conn,$_POST["Ingredients"]);
$directions = mysqli_real_escape_string ($conn,$_POST["Directions"]);
$servings = mysqli_real_escape_string   ($conn,$_POST["Servings"]);
$time = mysqli_real_escape_string       ($conn,$_POST["Time"]);
$category = mysqli_real_escape_string   ($conn,$_POST["Category"]);
$cuisine = mysqli_real_escape_string    ($conn,$_POST["Cuisine"]);

$owner_id = $_SESSION['user_id']; // Get the user ID from the session


$sql = "INSERT INTO tblrecipes (Title, Description, Image, Ingredients, Directions, Servings, TotalTime, Category, Cuisine, Owner_ID)
    VALUES ('$title', '$description', '$image', '$ingredients', '$directions', '$servings', '$time', '$category', '$cuisine', '$owner_id')";
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
        <h1>Recipe Submitted Successfully</h1>
        <a href="Homepage.php"><p><b>Go back to Home</b></p></a>
        <a href="RecipeForm.php"><p><b>Submit another recipe</b></p></a>
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
      <h2> "Error submitting recipe"</h2>
      <a href="RecipeForm.php">Go back</a>
  </body>
  </html>';
}

$conn->close();
?>