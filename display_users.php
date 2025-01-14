<?php
include 'connect.php';

$sql = "SELECT ID, Username, Email, Password, Role FROM tblusers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html class="display_users">
<head>
    <title>Users Table</title>
    <link rel="stylesheet" href="Submission.css">
    <link rel = "icon" href="Images/Hilda's Recipes.png" type = "image/png">
</head>

<body class="display_usersbody">
    <h2 class="display_usersh2"><b>Users List</b></h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["ID"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Username"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Password"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Role"]) . "</td>";
                echo '<td><a href="edit_user.php?ID=' . urlencode($row["ID"]) . '">Edit</a></td>';
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No users found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
    <div class="Back">
        <p><b>Back to <a href="admin_dashboard.php">Dashboard</a></b></p>
        <p><b>Back to <a href="HomePage.php">Home</a></b></p>
    </div>


</body>
</html>
