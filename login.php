<?php
session_start();

$conn = new PDO("mysql:host=localhost;dbname=todo", "root", "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // if ($conn) {
    //    echo "string";
    // }else{
    //     echo "err";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Login</h2>
                        
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required="" />
                        </div>
                      
                        
                        <div class="form-group">
                            <input type="submit" name="login" id="submit" class="form-submit" value="Login"/>
                        </div>
                    </form>
                    <p class="loginhere">
                       Dont Have already an account ? <a href="reg.php" class="loginhere-link">Register here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

<?php

    if(isset($_POST['login'])){
$email = $_POST['email'];


if(empty($email)) {
    $messeg = "email con't be empty";
} else {
    $sql = "SELECT email FROM register WHERE email=? ";
    $query = $conn->prepare($sql);
    $query->execute(array($email));

    if($query->rowCount() >= 1) {
        $_SESSION['user'] = $email;
        header("location: index.php");
    } else {
        $messeg = "email is wrong";
    }
}
}


?>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>