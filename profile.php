<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.html");
    exit;
}

require("connect.php");

// Fetch user profile details
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username = ?");
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    <link rel="stylesheet" href="Login.css">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
</head>


<body>

    <div id="logo">
        <a href="HomePage.php">
        <img src="Images/Hilda's Recipes.png" alt="Logo">
        </a>
    </div>

   

    <div class="profile">  
        <h2 class="profileh2">My Profile</h2>  
        <p class="Welcome"> Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></p>


        <table>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Password</th>
            </tr>

            <tr>
                <td><?php echo htmlspecialchars($user['Username']); ?></td>
                <td><?php echo htmlspecialchars($user['Email']); ?></td>
                <td><?php echo htmlspecialchars($user['Role']); ?></td>
                <td><?php echo htmlspecialchars($user['Password']); ?></td>
            </tr>

        </table>

        <a href="edit_user.php?ID=<?php echo urlencode($user['ID']); ?>"><button class="button2">Edit Profile</button></a>
        <p class="back"><a href="HomePage.php">Back</a></p>
    </div>

     
</body>
</html>

