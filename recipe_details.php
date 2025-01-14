<?php
session_start();
include 'connect.php';

// Check if the RecipeID is provided in the URL
if (!isset($_GET['RecipeID'])) {
    echo "No recipe ID provided!";
    exit();
}

$recipe_id = $_GET['RecipeID'];

// Fetch the recipe details from the database
$stmt = $conn->prepare("SELECT * FROM tblrecipes WHERE RecipeID = ?");
$stmt->bind_param("i", $recipe_id);
$stmt->execute();
$result = $stmt->get_result();
$recipe = $result->fetch_assoc();

if (!$recipe) {
    echo "Recipe not found!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($recipe['Title']); ?></title>
    <link rel="icon" href="Images/Logo.png" type="image/png">
    <link rel="stylesheet" href="Login.css">
    
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>

<div class="container">
    <h2><?php echo htmlspecialchars($recipe['Title']); ?></h2>
    
    <div class="recipe-img">
        <img src="Images/<?php echo htmlspecialchars($recipe['Image']); ?>" alt="<?php echo htmlspecialchars($recipe['Title']); ?>">
    </div>

    <div class="recipe-details">

        <div class="recipe-sub-details">
            <div class="recipe-sub-details1">
                <h3>Servings</h3>
                <p><?php echo htmlspecialchars($recipe['Servings']); ?></p>
            </div>

            <div class="recipe-sub-details1">
                <h3>Total Time</h3>
                <p><?php echo htmlspecialchars($recipe['TotalTime']); ?></p>
            </div>

            <div class="recipe-sub-details1">
                <h3>Category</h3>
                <p><?php echo htmlspecialchars($recipe['Category']); ?></p>
            </div>

            <div class="recipe-sub-details1">
                <h3>Cuisine</h3>
                <p><?php echo htmlspecialchars($recipe['Cuisine']); ?></p>
            </div>
        </div>

        <h3>Description</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['Description'])); ?></p>

        <h3>Ingredients</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['Ingredients'])); ?></p>

        <h3>Directions</h3>
        <p><?php echo nl2br(htmlspecialchars($recipe['Directions'])); ?></p>
        
    </div>

    
    <div class="button-container">
        <a href="All_Recipes.php"><button class="button2">Back to Recipes</button></a>
    </div>

</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
