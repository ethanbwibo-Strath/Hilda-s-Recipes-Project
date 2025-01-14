<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
    <link rel = "stylesheet" href = "RecipeForm.css">
    <title>Submit A Recipe ~ Hilda's Recipes</title>
</head>

<body>

    <div class ="Form" id="NewRecipe">
    <h1>Hilda's Recipes</h1>
    <h2>Add New Recipes</h2>
    <p>Uploading personal recipes is easy! Add yours to your favorites, share with friends, family, or the community.</p>

        <form action="recipeForm_action.php" method="post"> 
            <div id = "RecipeForm">
                <div id = "pt1">
                    <div id = "pt1.1">
                        <label for="title"><b>Title</b></label>
                        <input type="text" id="title" name="Title" required placeholder="Give your recipe a title.">
                        <br>
            
                        <label for="description"><b>Description</b></label>
                        <textarea id="description" name="Description" required placeholder="Share the story behind your recipe and what makes it special."></textarea>
                        <br>
                    </div>
                
                    <div id = "pt1.2">
                        <label for="image"><b>Image (Optional)</b></label>
                        <input type="file" id="image" name="Image" required>
                        <br>
                    </div>
                </div>
            
                <div id = "pt2">
                    <div id = "pt2.1" =>
                        <label for="ingredients"><b>Ingredients</b></label>
                        <p>Include the quantity (i.e. cups, tablespoons) and any special preparation (i.e. sifted, softened, chopped)</p>
                        <textarea id="ingredients" name="Ingredients" required placeholder="eg. 2 cups flour, sifted"></textarea>
                        <br>
                    </div>
            
                        <div id = "pt2.2">
                            <label for="Directions"><b>Directions</b></label>
                            <p>Explain how to make your recipe, including oven temperatures, baking or cooking times, and pan sizes, etc. Use optional headers to organize the different parts of the recipe (i.e. Prep, Bake, Decorate).</p>
                            <textarea id="directions" name="Directions" required placeholder="e.g Preheat oven to... "></textarea>
                            <br>
                        </div>
                </div>
        
                    <div id = "pt3">
                        <div>
                            <label for = "servings"><b>Servings</b></label>
                            <input type="number" id = "servings" name="Servings" placeholder="e.g  8 ">
                            <br>
                        </div>


                        <div>
                            <label for = "time"><b>Total Time</b></label>
                            <input type="text" id = "time" name="Time" placeholder="e.g 30 mins">
                            <br>
                        </div>
                    </div>

                <div id = "pt4">
                    <div id = "category">
                    <label for="category"><b>Category:</b></label>
                    <select name="Category" required>
                    <option value="">Select a category</option>

                        <?php
                        include('connect.php');
                        
                        $category = "SELECT CategoryName FROM categories";
                        $category_names = $conn->query($category);

                        if($category_names -> num_rows > 0) {
                            while($row = $category_names -> fetch_assoc()) {
                                echo "<option>" . $row["CategoryName"] . "</option>";
                            }
                        }else{
                            echo "No option available";
                        }
                        ?>
                    </select>
                    </div>

                    <div id = "category">
                    <label for="cuisine"><b>Cuisine:</b></label>
                    <select name="Cuisine" required>
                    <option value="">Select a cuisine</option>

                        <?php
                        include('connect.php');
                        
                        $cuisine = "SELECT CuisineName FROM cuisines";
                        $cuisine_names = $conn->query($cuisine);

                        if($cuisine_names -> num_rows > 0) {
                            while($row = $cuisine_names -> fetch_assoc()) {
                                echo "<option>" . $row["CuisineName"] . "</option>";
                            }
                        }else{
                            echo "No option available";
                        }
                        ?>
                    </select>
                    </div>
                </div>
                    
                <div id = "end">
                    <button class = "button" type="submit">Submit recipe</button>
                    <p>Back to <a href="HomePage.php">Home</a></p>
                </div>
                
            </div>
        </form>

    </div>
</body>
</html>