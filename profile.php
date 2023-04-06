<?php include 'include/header.php' ?>
<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$dbname = "foodpicky_db";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get user information from database
$id = $_SESSION["user_id"];
// die($id);
$sql = "SELECT * FROM users WHERE u_id=$id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
} else {
    echo "Error: User not found.";
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="newstyle.css" rel="stylesheet">
    <title>User Profile</title>
    
</head>

<body>
    <div class="profile-wrapper">
        <div class="profile-content" style="margin:10px;">
            <h1>Welcome <?php echo $username; ?>!</h1>
            <div class="profile-details">
                <p><strong>Username:</strong> <?php echo $username; ?></p>
                <p><strong>Email:</strong> <?php echo $email; ?></p>
                <p><strong>Phone:</strong> <?php echo $phone; ?></p>
                <p><strong>Address:</strong> <?php echo $address; ?></p>
            </div>
            <a href="update_profile.php" class="edit-profile-btn">Edit Profile</a>
        </div>
    </div>

</body>

</html>


<?php include 'include/footer.php' ?>