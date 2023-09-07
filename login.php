<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/login.css">
    <style type="text/css">
        body {
            background-image: url('images/murg.jpg');
            background-size: cover;
            background-position: center;
        }

        .form-module {
            background-color: rgba(255, 255, 255, 0.6); /* Set a semi-transparent background for the form module */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            margin: auto;
            margin-top: 50px;
        }

        .form-module h2 {
            margin-top: 0;
        }

        #buttn {
            color: #fff;
            background-color: #ff3300;
        }
    </style>
</head>
<body>
    <?php
    // Include the database connection file
    include("connection/connect.php");
    
    // Initialize error message
    $message = "";
    
    // Start a session
    session_start();
    
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (!empty($username) && !empty($password)) { // Check if username and password are not empty
            $loginquery = "SELECT * FROM users WHERE username='$username' AND password='" . md5($password) . "'";
            $result = mysqli_query($db, $loginquery);
            $row = mysqli_fetch_array($result);
            
            if (is_array($row)) {
                $_SESSION["user_id"] = $row['u_id'];
                header("Location: index.php"); // Redirect to the index page
                exit();
            } else {
                $message = "Invalid Username or Password!";
            }
        } else {
            $message = "Username and Password are required!";
        }
    }
    ?>

    <div class="module form-module">
        <div class="toggle">
            <!-- Add any additional elements here if needed -->
        </div>
        <div class="form">
            <h2>Login to your account</h2>
            <span style="color: red;"><?php echo $message; ?></span>
            <form action="" method="post">
                <input type="text" placeholder="Username" name="username" required />
                <input type="password" placeholder="Password" name="password" required />
                <input type="submit" id="buttn" name="submit" value="Login" />
            </form>
        </div>
        <div class="cta">Not registered? <a href="registration.php" style="color: #f30;">Create an account</a></div>
        <div class="cta">Want to Head Back? <a href="index.php" style="color: #f30;">Here You Go</a></div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
