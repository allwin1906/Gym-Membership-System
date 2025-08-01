<?php 
ob_start();  // Start output buffering
session_start(); 
include('dbcon.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gym System Admin</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="css/matrix-style.css" />
    <link rel="stylesheet" href="css/matrix-login.css" />
    <link href="font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link href="font-awesome/css/all.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <style>
        body {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('img/gym_background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            font-family: 'Open Sans', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.5s ease-in-out;
        }

        #loginbox {
            background: rgba(0, 0, 0, 0.8); 
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.6);
            width: 350px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        h3 img {
            width: 90px;
            margin-bottom: 30px;
            transition: transform 0.5s ease;
        }

        h3 img:hover {
            transform: rotate(360deg);
        }

        .control-group input[type="text"],
        .control-group input[type="password"] {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 10px;
            color: #333;
            font-size: 16px;
            padding: 15px;
            margin-bottom: 20px;
            width: 100%;
            transition: all 0.3s ease-in-out;
        }

        .control-group input[type="text"]:focus,
        .control-group input[type="password"]:focus {
            border: 2px solid #00bcd4;
            outline: none;
            box-shadow: 0 0 10px rgba(0, 188, 212, 0.7);
            background-color: rgba(0, 188, 212, 0.1);
        }

        .form-actions button {
            background-color: #00bcd4;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 18px;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-actions button:hover {
            background-color: #0097a7;
            transform: scale(1.05);
        }

        .alert {
            background-color: #f44336;
            color: white;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
        }

        .alert.show {
            transform: scale(1.05);
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
            font-size: 14px;
            margin: 0 10px;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer-links a:hover {
            color: #00bcd4;
            transform: scale(1.1);
        }

        .footer-links h6 {
            font-size: 16px;
            font-weight: bold;
        }

        .footer-links {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            background: rgba(0, 0, 0, 0.7);
            padding: 15px;
            border-radius: 10px;
        }

        .footer-links a:hover {
            color: #00bcd4;
            transform: translateY(-5px);
        }

        .footer-links a {
            color: #ccc;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div id="loginbox">
    <form id="loginform" method="POST" class="form-vertical" action="#">
        <div class="control-group normal_text">
            <h3><img src="img/icontest3.png" alt="Logo" /></h3>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_lg"><i class="fas fa-user-circle"></i></span>
                    <input type="text" name="user" placeholder="Username" required/>
                </div>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <div class="main_input_box">
                    <span class="add-on bg_ly"><i class="fas fa-lock"></i></span>
                    <input type="password" name="pass" placeholder="Password" required/>
                </div>
            </div>
        </div>
        <div class="form-actions center">
            <button type="submit" class="btn btn-block btn-large btn-info" title="Log In" name="login" value="Admin Login">Admin Login</button>
        </div>
    </form>

    <?php
        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($con, $_POST['user']);
            $password = mysqli_real_escape_string($con, $_POST['pass']);

            $password = md5($password);  // Make sure password is hashed

            $query = mysqli_query($con, "SELECT * FROM admin WHERE password='$password' AND username='$username'");
            $row = mysqli_fetch_array($query);
            $num_row = mysqli_num_rows($query);

            if ($num_row > 0) {
                $_SESSION['user_id'] = $row['user_id'];
                header('location:admin/index.php');
                exit(); // Ensure no further code is executed
            } else {
                echo "<div class='alert alert-danger alert-dismissible show' role='alert'>
                        Invalid Username or Password
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
            }
        }
    ?>

    <div class="footer-links">
        <a href="customer/index.php"><h6>Customer Login</h6></a>
        <a href="staff/index.php"><h6>Staff Login</h6></a>
    </div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/matrix.login.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/matrix.js"></script>
</body>
</html>

<?php
ob_end_flush();  // End and flush output buffer
?>
