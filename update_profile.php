
<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Connect to database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "foodpicky_db";
$conn = mysqli_connect($host, $user, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form has been submitted
if (isset($_POST['submit'])) {

    // print_r($_POST);
    // die();

    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE `users` SET `username`='$username',`email`='$email',`phone`='$phone',`address`='$address' WHERE `u_id` = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>
            alert('Profile Update Successfully :)');
            window.location.href = 'profile.php';
        </script>";
    }
}

?>

<html>

<head>
    <style>
        /* Center the form vertically and horizontally */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f7f7f7;
        }

        /* Add an overlay effect to the form */
        form {
            width: 600px;
            /* adjust the width to your liking */
            height: auto;
            /* set the height to auto to allow the form to expand vertically */
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            transition: background-color 0.3s ease-in-out;
        }

        form:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

        /* Add a background image */
        body {
            background-image: url('images/murg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Add a semi-transparent overlay to the background image */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        /* Add a hover effect to the submit button */
        input[type="submit"] {
            transition: all 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        /* Add a border-radius and some padding to the input fields */
        input[type="text"],
        input[type="email"],
        textarea {
            border-radius: 5px;
            padding: 10px;
            border: none;
            background-color: #f7f7f7;
        }

        /* Add a border-radius to the input labels */
        label {
            border-radius: 5px;
            padding: 5px 10px;
            background-color: #fff;
        }

        /* Style the input fields when they are focused */
        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            outline: none;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 3px;
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #007bff;
            color: #fff;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        textarea:hover {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        body {
            font-family: Arial, sans-serif;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            background-color: #fff;
            font-weight: bold;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        textarea:hover {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        input[type="submit"] {
            display: block;
            margin-top: 10px;
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            color: #fff;
            background-color: #007bff;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        textarea {
            height: 100px;
        }

        form {
            transition: background-color 0.3s ease-in-out;
        }

        form:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

        #navbar {
            background-color: #343a40;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        #navbar a {
            color: #fff;
        }

        #navbar .navbar-brand img {
            height: 50px;
        }

        #navbar .nav-item a:hover {
            color: #007bff;
        }

        #navbar .nav-item.active a {
            color: #007bff;
        }

        #navbar .navbar-toggler {
            border-color: #fff;
        }

        #navbar .navbar-toggler:hover {
            background-color: #fff;
            color: #343a40;
        }

        #navbar .navbar-toggler:focus {
            box-shadow: none;
        }

        #navbar .navbar-nav {
            margin-right: auto;
        }

        #navbar .nav-item {
            margin-left: 20px;
        }

        @media (max-width: 991px) {
            #navbar {
                background-color: #fff;
                box-shadow: none;
            }

            #navbar a {
                color: #333;
            }

            #navbar .navbar-toggler {
                border-color: #333;
            }

            #navbar .navbar-toggler:hover {
                background-color: #333;
                color: #fff;
            }

            #navbar .navbar-nav {
                margin: 0;
            }

            #navbar .nav-item {
                margin: 10px 0;
            }
        }
    </style>
</head>

<body>
    
    
    <?php
    $user_id = $_SESSION['user_id'];
    // die($user_id);
    $sql = "SELECT * FROM `users` WHERE u_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
    }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="text" name="id" value="<?php echo $row['u_id'] ?>">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $row['username'] ?>">
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $row['email'] ?>">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $row['phone'] ?>">
        <label for="address">Address:</label>
        <textarea name="address"><?php echo $row['address'] ?></textarea>
        <input type="submit" name="submit" value="Update Profile">
    </form>
</body>

</html>