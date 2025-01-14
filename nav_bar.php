<style>

nav {
    display: flex;
    align-items: center; /* Align items vertically in the center */
    background-color: #000000;
    background-attachment: fixed;
    justify-content: space-between;
}

nav ul {
    list-style-type: none; /* Remove the default list bullet points */
    display: flex; /* Use flexbox */
}

nav ul li {
    margin-right: 25px; /* Add spacing between the list items */
}


#Nav_Bar{
    width: 100%;
    height: 2.2cm;
    margin: auto, 1cm,auto,1cm ;
    padding: 0.01cm;
    text-overflow: clip;
}


nav img {
    
    height: 2cm;
    width: 2cm;
}

nav ul li a {
    font-size: x-large;
    text-decoration: none; /* Remove underline from links */
    padding: 5px 10px; /* Add padding to create space around the links */
    border: 2px solid transparent; /* Add transparent border */
    transition: color 0.3s, border-color 0.3s; /* Add transition effect */
    border-radius: 25px;
    color: #f9f6f6;
}

nav ul li a:hover {
    color: #846434; /* Change text color on hover */
    border-color: #846434; /* Change border color on hover */
    box-shadow: 0px, 0px, 20px, 0px rgba(255,255,255,0.7);
}

/* Dropdown menu */
.dropdown {
  position: relative;
  display: inline-block;
}
#dropdown2{
  margin-left: 15px;
}
.dropbtn{
  font-size: x-large;
  text-decoration: none; /* Remove underline from links */
  padding: 5px 10px; /* Add padding to create space around the links */
  border: 2px solid transparent; /* Add transparent border */
  transition: color 0.3s, border-color 0.3s; /* Add transition effect */
  border-radius: 25px;
  color: #f9f6f6;
  margin-right: 10px;
  margin-top: 5px;

}
.dropdown-content {
  display: none;
  position: absolute;
  left: 0.001cm;
  background-color: #000000;
  min-width: 160px;
  box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
  z-index: 1;
  border-radius: 25px;
  margin-top: 0.3cm;
  align-items: center;
}

.dropdown-content a {
    display: block;
    font-size: x-large;
    text-decoration: none; /* Remove underline from links */
    padding: 5px 10px; /* Add padding to create space around the links */
    border: 2px solid transparent; /* Add transparent border */
    transition: color 0.5s, border-color 0.5s; /* Add transition effect */
    border-radius: 25px;
    color: #f9f6f6;
    margin: auto;
}

.dropdown-content a:hover {
    color: #846434; /* Change text color on hover */
    border-color: #846434; /* Change border color on hover */
    box-shadow: 0px, 0px, 20px, 0px rgba(255,255,255,0.7);
    transform: scale(1.1);
}

.dropdown:hover .dropdown-content {
  display:contents;
}

li + .button{
  padding: 5px, 10px;
  margin: auto;
}

.button {
    cursor: pointer;
    position: relative;
    padding: 10px 24px;
    font-size: 20px;
    color: #846434;
    border: 2px solid #846434;
    border-radius: 34px;
    background-color: transparent;
    font-weight: 600;
    transition: all 0.9s cubic-bezier(0.23, 1, 0.320, 1);
    overflow: hidden;
  }
  
  

  .button::before {
    content: '';
    position: absolute;
    inset: 0;
    margin: auto;
    width: 50px;
    height: 50px;
    border-radius: inherit;
    scale: 0;
    z-index: -1;
    background-color: #212121;
    border: 2px solid #846434;
    transition: all 0.9s cubic-bezier(0.23, 1, 0.320, 1);
  }
  
  .button:hover::before {
    scale: 3;
  }
  
  .button:hover {
    color: #f9f6f6;
    scale: 1.1;
    box-shadow: 0 0px 20px rgba(193, 163, 98,0.4);
  }
  
  .button:active {
    scale: 1;
  }

  .button, #Login{
    margin-right: 10px;
  }
</style>

<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
        <a href="HomePage.php"><img id="Logo" src="Images/Hilda's Recipes.png"></a>
        <ul>

            <li class="dropdown">
                <a href="#Meals"><b>Meals</b></a>
                <ul class="dropdown-content">
                    <li><a href="category_recipes.php?category=Breakfast"><b>Breakfast</b></a></li>
                    <li><a href="category_recipes.php?category=Lunch"><b>Lunch</b></a></li>
                    <li><a href="category_recipes.php?category=Dinner"><b>Dinner</b></a></li>
                    <li><a href="category_recipes.php?category=Dessert"><b>Dessert</b></a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="#Meals"><b>Cuisines</b></a>
                <ul class="dropdown-content">
                    <li><a href="cuisine_recipes.php?cuisine=Italian"><b>Italian</b></a></li>
                    <li><a href="cuisine_recipes.php?cuisine=Chinese"><b>Chinese</b></a></li>
                    <li><a href="cuisine_recipes.php?cuisine=American"><b>American</b></a></li>
                    <li><a href="Allcuisines.php"><b>View All</b></a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a href="Allmeals.php"><b>More</b></a>
                <ul class="dropdown-content">
                    <li><a href="category_recipes.php?category=Diet"><b>Diet</b></a></li>
                    <li><a href="category_recipes.php?category=Drinks"><b>Drinks</b></a></li>
                    <li><a href="category_recipes.php?category=Side Dish"><b>Side Dish</b></a></li>                    
                    <li><a href="category_recipes.php?category=Appetizers"><b>Appetizers</b></a></li>                    
                </ul>
            </li>

            <li class="dropdown">
                <a href="All_Recipes.php"><b>All Recipes</b></a>
                
            </li>

        </ul>
    
        <div>

        <?php if (isset($_SESSION['username'])): ?>

            <li class="dropdown" id = "dropdown2">
                <a class = "dropbtn" href="#"><b><?php echo $_SESSION['username']; ?></b></a>

            <ul class="dropdown-content">

                <li><a href="profile.php">Account</a></li>

                    <?php if ($_SESSION['user_role'] === 'Recipe Owner'): ?>
                    <li><a href="my_recipes.php">My Recipes</a></li>
                    <?php endif; ?>

                    <?php if ($_SESSION['user_role'] === 'Admin'): ?>
                    <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
                    <?php endif; ?>
                <li><a href="logout.php">Log Out</a></li>
                
            </ul>
            </li>

        <?php else: ?> 
            <a href="SignUp.html"><button class="button">Sign Up</button></a>
            <a href="Login.html"><button class="button" >Login</button></a>
        <?php endif; ?>
        </div>
    </nav>
