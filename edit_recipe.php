<?php
session_start();
include 'connect.php';

// Check if the user is logged in and is a Recipe Owner
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'Recipe Owner') {
    header("Location: HomePage.php");
    exit();
}

if (!isset($_GET['RecipeID'])) {
    echo "No recipe ID provided!";
    exit();
}

$recipe_id = $_GET['RecipeID'];

// Fetch the recipe details
$stmt = $conn->prepare("SELECT * FROM tblrecipes WHERE RecipeID = ? AND Owner_ID = ?");
$stmt->bind_param("ii", $recipe_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    echo "Recipe not found!";
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['Title'];
    $description = $_POST['Description'];
    $ingredients = $_POST['Ingredients'];
    $directions = $_POST['Directions'];
    $servings = $_POST['Servings'];
    $time = $_POST['TotalTime'];
    $category = $_POST['Category'];
    $cuisine = $_POST['Cuisine'];
    $image = $recipe['Image']; // Keep the old image if no new image is uploaded

    // Check if a new image is uploaded
    if (!empty($_FILES['Image']['name'])) {
        $target_dir = "Images/";
        $target_file = $target_dir . basename($_FILES["Image"]["name"]);
        move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
        $image = basename($_FILES["Image"]["name"]);
    }

    // Update the recipe in the database
    $stmt = $conn->prepare("UPDATE tblrecipes SET Title = ?, Description = ?, Image = ?, Ingredients = ?, Directions = ?, Servings = ?, TotalTime = ?, Category = ?, Cuisine = ? WHERE RecipeID = ? AND Owner_ID = ?");
    $stmt->bind_param("sssssisssii", $title, $description, $image, $ingredients, $directions, $servings, $time, $category, $cuisine, $recipe_id, $_SESSION['user_id']);
    
    if ($stmt->execute()) {
        header("Location: my_recipes.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Recipe</title>
    <link rel="icon" href="Images/Logo.png" type="image/png">
    <link rel="stylesheet" href="Login.css"> 
   
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>


<div class="container">
    <h2 class="ViewRecipesTitle">Edit Recipe</h2>

    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Title">Title:</label>
            <input type="text" id="Title" name="Title" value="<?php echo htmlspecialchars($recipe['Title']); ?>" required>
        </div>

        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea id="Description" name="Description" required><?php echo htmlspecialchars($recipe['Description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="Ingredients">Ingredients:</label>
            <textarea id="Ingredients" name="Ingredients" required><?php echo htmlspecialchars($recipe['Ingredients']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="Directions">Directions:</label>
            <textarea id="Directions" name="Directions" required><?php echo htmlspecialchars($recipe['Directions']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="Servings">Servings:</label>
            <input type="number" id="Servings" name="Servings" value="<?php echo htmlspecialchars($recipe['Servings']); ?>" required>
        </div>
        <div class="form-group">
            <label for="TotalTime">Total Time:</label>
            <input type="text" id="TotalTime" name="TotalTime" value="<?php echo htmlspecialchars($recipe['TotalTime']); ?>" required>
        </div>
        <div class="form-group">
            <label for="Category">Category:</label>
            <input type="text" id="Category" name="Category" value="<?php echo htmlspecialchars($recipe['Category']); ?>" required>
        </div>
        <div class="form-group">
            <label for="Cuisine">Cuisine:</label>
            <input type="text" id="Cuisine" name="Cuisine" value="<?php echo htmlspecialchars($recipe['Cuisine']); ?>" required>
        </div>
        <div class="form-group">
            <label for="Image">Image:</label>
            <input type="file" id="Image" name="Image">
            <img src="Images/<?php echo htmlspecialchars($recipe['Image']); ?>" alt="Current Image">
        </div>

        <div class="button-container">
            <button type="submit" class="button2">Update Recipe</button>
        </div>

    </form>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
