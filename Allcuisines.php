<?php
include 'connect.php';

// Fetch distinct cuisines
$cuisine_stmt = $conn->prepare("SELECT DISTINCT Cuisine FROM tblrecipes WHERE Cuisine != 'N/A' ORDER BY Cuisine ASC");
$cuisine_stmt->execute();
$cuisine_result = $cuisine_stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cuisines</title>
    <link rel="stylesheet" href="Login.css">
    <link rel="icon" href="Images/Logo.png" type="image/png">
    
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>

<div class="All___container">
    <h2 class="All___Title">Cuisines</h2>
    <div class="grid">
        <?php while ($cuisine = $cuisine_result->fetch_assoc()): ?>
        <a href="cuisine_recipes.php?cuisine=<?php echo urlencode($cuisine['Cuisine']); ?>" class="All___card">
            <div class="">
                <div class="card-title"><b><?php echo htmlspecialchars($cuisine['Cuisine']); ?></b></div>
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
$cuisine_stmt->close();
$conn->close();
?>
