<?php
include 'connect.php';

// Handle the search query
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
}

// Fetch recipes based on the search query
if ($search_query) {
    $stmt = $conn->prepare("SELECT * FROM tblrecipes WHERE Title LIKE ? OR Category LIKE ? ORDER BY Title ASC");
    $search_param = "%" . $search_query . "%";
    $stmt->bind_param("ss", $search_param, $search_param);
} else {
    $stmt = $conn->prepare("SELECT * FROM tblrecipes ORDER BY Title ASC");
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Recipes</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="icon" href="Images/Logo.png" type="image/png">
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>


<div class="container">
    <h2 class="ViewRecipesTitle">All Recipes</h2>

    <!-- Search Bar -->
    <form method="GET" action="All_recipes.php" class="search-form">
        <input type="text" name="search" value="<?php echo htmlspecialchars($search_query); ?>" placeholder="Search for recipes or category...">
        <button type="submit">Search</button>
    </form>

    <div class="recipes-grid">
        <?php while ($recipe = $result->fetch_assoc()): ?>
        <div class="recipe-card">
            <img src="Images/<?php echo htmlspecialchars($recipe['Image']); ?>" alt="<?php echo htmlspecialchars($recipe['Title']); ?>">
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
