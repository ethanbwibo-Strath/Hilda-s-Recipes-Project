CREATE TABLE `hilda's_recipes`.`tblusers` (
    `ID` INT(11) NOT NULL AUTO_INCREMENT , 
    `Username` VARCHAR(255) NOT NULL , 
    `Email` VARCHAR(255) NOT NULL , 
    `Password` VARCHAR(255) NOT NULL , 
    `Role` VARCHAR(255) NOT NULL , 
    PRIMARY KEY (`ID`)) ENGINE = InnoDB;


CREATE TABLE `hilda's_recipes`.`tblrecipes` (
    `RecipeID` INT(11) NOT NULL AUTO_INCREMENT , 
    `Title` VARCHAR(255) NOT NULL , 
    `Description` VARCHAR(1000) NOT NULL , 
    `Ingredients` VARCHAR(1000) NOT NULL , 
    `Directions` VARCHAR(1000) NOT NULL , 
    `Servings` VARCHAR(255) NOT NULL , 
    `TotalTime` VARCHAR(255) NOT NULL , 
    `Image` VARCHAR(1000) NOT NULL , 
    `Category` VARCHAR(255) NOT NULL , 
    `Cuisine` VARCHAR(255) NOT NULL , 
    `Owner_ID` INT(11) NOT NULL , 
    PRIMARY KEY (`RecipeID`)) ENGINE = InnoDB;


CREATE TABLE `hilda's_recipes`.`categories` (
    `CategoryID` INT(11) NOT NULL AUTO_INCREMENT , 
    `CategoryName` VARCHAR(50) NOT NULL , 
    `Description` VARCHAR(50) NOT NULL , 
    PRIMARY KEY (`CategoryID`)) ENGINE = InnoDB;





CREATE TABLE `hilda's_recipes`.`cuisines` (
    `CuisineID` INT(11) NOT NULL AUTO_INCREMENT , 
    `CuisineName` VARCHAR(50) NOT NULL , 
    `Description` VARCHAR(50) NOT NULL , 
    PRIMARY KEY (`CuisineID`)) ENGINE = InnoDB;