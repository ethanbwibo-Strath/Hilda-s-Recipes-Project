<?php
session_start();
if ($_SESSION['user_role'] !== 'Admin') {
    header("Location: HomePage.php");
    exit;
}

require("connect.php");

// Fetch all users
$result = $conn->query("SELECT * FROM tblusers");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="HomePage.css">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
</head>
<body class="AllRecipesBody">

<div>
<?php include 'nav_bar.php'; ?>
</div>


    <!--Add New Recipe-->
<section id = "newrecipe">
    <div id="Adminsh2"><h2><b>Admin Dashboard</b></h2></div>
    <div id="newcontainer">


        <div class = "NewRecipe">
            <p class="Welcome"><b>Welcome, <?php echo $_SESSION['username']; ?></b></p>
        </div>

        <div id="newcontainer2">

            <div id="newcontainer2pt1">
                <div class = "NewCuisine"> 
                    <p>Add a new cuisine for your recipes.</p>
                    <a href = "CuisineForm.html"><button class="button2">Add A Cuisine</button></a>
                </div>
            </div>

            <div id="newcontainer2pt2">
                <div class = "DisplayUsers"> 
                    <p>Display all current users</p>
                    <a href = "display_users.php"><button class="button2">Display users</button></a>
                </div>
            </div>

            <div id="newcontainer2pt3">
                <div class = "NewCategory"> 
                    <p>Add a new category for your recipes.</p>
                    <a href = "CategoryForm.html"><button class="button2">Add A Category</button></a>
                </div>
            </div>
        </div>

        <div class = "Logout">
            <a href = "logout.php"><button class="button2">Log Out</button></a>
        </div>

        <p>Back to <a href="HomePage.php" class="Home">Home</a></p>
    </div>
</section>

<?php include 'footer.php'; ?>

</body>
</html>
<?php
$conn->close();
?>
