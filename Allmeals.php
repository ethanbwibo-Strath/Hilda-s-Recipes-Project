<?php
include 'connect.php';

// Fetch distinct meal types
$meal_stmt = $conn->prepare("SELECT DISTINCT Category FROM tblrecipes ORDER BY Category ASC");
$meal_stmt->execute();
$meal_result = $meal_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Meals</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="icon" href="Images/Logo.png" type="image/png">
   
</head>


<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>


<div class="All___container">
    <h2 class="All___Title">Meals</h2>
    <div class="grid">
        <?php while ($meal = $meal_result->fetch_assoc()): ?>
        <a href="category_recipes.php?category=<?php echo urlencode($meal['Category']); ?>" class="All___card">
            <div class="">
                <div class="card-title"><b><?php echo htmlspecialchars($meal['Category']); ?></b></div>
            </div>
        </a>
        <?php endwhile; ?>
    </div>

    <p class="Home">Back to <a href="HomePage.php">Home</a></p>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$meal_stmt->close();
$conn->close();
?>
