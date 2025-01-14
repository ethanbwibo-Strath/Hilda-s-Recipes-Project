<?php
include 'connect.php';

// Get the cuisine from the query string
$cuisine = isset($_GET['cuisine']) ? $_GET['cuisine'] : '';

// Fetch recipes based on the selected cuisine
$stmt = $conn->prepare("SELECT * FROM tblrecipes WHERE Cuisine = ?");
$stmt->bind_param("s", $cuisine);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($cuisine); ?> Recipes</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="icon" href="Images/Logo.png" type="image/png">
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>



<div class="container">
    <h2 class="ViewRecipesTitle"><?php echo htmlspecialchars($cuisine); ?> Recipes</h2>
    <div class="recipes-grid">
        <?php while ($recipe = $result->fetch_assoc()): ?>
        <div class="recipe-card">
            <img src="Images/<?php echo htmlspecialchars($recipe['Image']); ?>" alt="Recipe Image">
            <div class="recipe-content">
                <div class="recipe-title"><b><?php echo htmlspecialchars($recipe['Title']); ?></b></div>
                <div class="recipe-description"><?php echo htmlspecialchars($recipe['Description']); ?></div>
                <a href="recipe_details.php?RecipeID=<?php echo $recipe['RecipeID']; ?>" class="view-btn">View Recipe</a>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

    <p class="Home">Back to <a href="HomePage.php">Home</a></p>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
