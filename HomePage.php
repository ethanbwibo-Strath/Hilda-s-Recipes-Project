<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
    <title id="Title">Hilda's Recipes</title>
    <link rel="stylesheet" href="HomePage.css">
</head>


<body>

<?php include 'nav_bar.php'; ?>
    


<!--------------------------------------------------------------------- Intro Section ---------------------------------------------------->
<?php if (isset($_SESSION['username'])): ?>
    <section class="intro">
        <div class="content">
            <div class="intro-text">
                <p id="Headline"><b>Welcome to Hilda's Recipes</b></p>
                <p id="Sub Headline">Welcome to Hilda's Recipes, where we proudly share delightful culinary creations that will inspire your kitchen adventures.</p>
                <p>Explore our world of recipes where every dish is crafted with passion and flavor. From appetizers to desserts, discover new flavors and techniques to elevate your cooking game.</p>
                
            </div>
            <div id="image">
                <img src="Images/introimg.jpg" alt="Intro Image">
            </div>
        </div>
    </section>

    <?php else: ?> 
    <section class="intro">
        <div class="content">
            <div class="intro-text">
                <p id="Headline"><b>Welcome to Hilda's Recipes</b></p>
                <p id="Sub Headline">Welcome to Hilda's Recipes, where we proudly share delightful culinary creations that will inspire your kitchen adventures.</p>
                <p>Explore our world of recipes where every dish is crafted with passion and flavor. From appetizers to desserts, discover new flavors and techniques to elevate your cooking game.</p>
                
                <a href = "SignUp.html"><button class="button">Sign Up</button></a>
            </div>
            <div id="image">
                <img src="Images/introimg.jpg" alt="Intro Image">
            </div>
        </div>
    </section>
    <?php endif; ?>




<!---------------------------------------------------------------Meals Section ---------------------------------------------------------->
    <section class="meals">
        <div id="Mealsh2"><h2>Browse</h2></div>
    
        <div id="MealsContainer">
            <a id="MealsLink" href="Allmeals.php">
                <div id="Meals">
                    <img src="Images/istockphoto-1829241109-612x612.jpg">
                    <h2>Meals</h2>
                    <p>Discover our diverse meal options! From classic breakfast to healthy lunch, our meal menu is perfect for any and all occasions. Welcome to Hilda's Recipes.</p>
                </div>
            </a>
    
        
    
            <a id="MealsLink" href="Allcuisines.php">
                <div id="Meals">
                    <img src="Images/sukaina-rajabali-butter-chicken-with-naan.jpg" >
                    <h2>Cuisines</h2>
                    <p>Explore our diverse cuisines with our wide variety of dishes. From Chinese to Mexican, our cuisines offer a taste of every corner of the world.</p>
                </div>
            </a>
    
            <a id="MealsLink" href="All_Recipes.php">
                <div id="Meals">
                    <img src="Images/03.jpg" id="imgMore">
                    <h2>All</h2>
                    <p>Explore our world of recipes where every dish is crafted with passion and flavor. From appetizers to desserts, discover new flavors and techniques to elevate your cooking game.</p>
                </div>
            </a>
        </div>
    </section>



<!------------------------------------------------ New Recipe, Admin Dashboard Section ------------------------------------------------->
    <?php if (isset($_SESSION['username'])): ?>

        <?php if ($_SESSION['user_role'] === 'Recipe Owner'): ?>
            <section id = "newrecipe">
                <div id="Mealsh2"><h2>New Recipe...?</h2></div>
                <div id="newcontainer">
                    <div class = "NewRecipe">
                        <p>Uploading personal recipes is easy! Add yours to your favorites, share with friends, family, or the community.</p>
                        <a href = "RecipeForm.php"><button class="button2">Add A Recipe</button></a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($_SESSION['user_role'] === 'Admin'): ?>
            <section id = "newrecipe">
                <div id="Mealsh2"><h2>Admin Dashboard...</h2></div>
                <div id="newcontainer">
                    <div class = "NewRecipe">
                        <p>Perform admin duties.</p>
                        <a href = "admin_dashboard.php"><button class="button2">Admin Dashboard</button></a>
                    </div>
                </div>
            </section>
        <?php endif; ?>

<?php else: ?> 
    <section id = "newrecipe">
        <div id="Mealsh2"><h2>New Recipe...?</h2></div>
        <div id="newcontainer">
            <div class = "NewRecipe">
                <p><b>Uploading personal recipes is easy!</b></p>
                <p>Sign up or Login to add yours to your favorites, share with friends, family, or the community.</p>
                <div class = "NewRecipebtn">

                    <a href = "SignUp.html"><button class="button2">SignUp</button></a>
                    <a href="Login.html"><button class="button2" id = "Loginbtn">Login</button></a>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>


<!-------------------------------------------------------------- Contact Section -------------------------------------------------------->
    <section class="contact">
        <h2>Interact with Us</h2>
        <div class="socials-container">

            <a href="#twitter" class="social twitter">
                <svg height="1em" viewBox="0 0 512 512">
                    <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"></path>
                </svg>
            </a>

            <a href="#facebook" class="social facebook">
                <svg height="1em" viewBox="0 0 320 512">
                    <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"></path>
                </svg>
            </a>

            <a href="#instagram" class="social instagram">
                <svg height="1em" viewBox="0 0 448 512">
                    <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path>
                </svg>
            </a>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
