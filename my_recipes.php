<?php
session_start();
include 'connect.php';

// Check if the user is logged in and is a Recipe Owner
if (!isset($_SESSION['username']) || $_SESSION['user_role'] !== 'Recipe Owner') {
    header("Location: HomePage.php");
    exit();
}

// Fetch recipes added by the logged-in Recipe Owner
$stmt = $conn->prepare("SELECT * FROM tblrecipes WHERE Owner_ID = ?");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Recipes</title>
    <link rel="icon" href="Images/Logo.png" type="image/png">
    <link rel="stylesheet" href="Login.css">
    
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>


<div class="container2">
<h1 class="MyRecipesH1">My Recipes</h1>

<table border="1">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>

    <?php while ($recipe = $result->fetch_assoc()): ?>
        <tr>
            
            <td><?php echo htmlspecialchars($recipe['Title']); ?></td>
            <td><?php echo htmlspecialchars($recipe['Description']); ?></td>
            <td><img src="Images/<?php echo htmlspecialchars($recipe['Image']); ?>" alt="Recipe Image" width="100"></td>
            <td>
                <a href="edit_recipe.php?RecipeID=<?php echo urlencode($recipe['RecipeID']); ?>">Edit</a>
            </td>
        </tr>
    <?php endwhile; ?>

</table>

<a href = "RecipeForm.php"><button class="button2" id = "Addbtn">Add Another Recipe</button></a>
<p class="Home">Back to <a href="HomePage.php">Home</a></p>
</div>

<?php include 'footer.php'; ?>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
