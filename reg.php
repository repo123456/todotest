<?php

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
    <title>Sign Up</title>

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
                        <h2 class="form-title">Create account</h2>


                        <div class="form-group">
                            <input type="text" class="form-input" name="titel" id="name" placeholder="TITLE" required="" />
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email" required="" />
                        </div>

                       <div class="form-group">
                            <input type="text" class="form-input" name="descr" id="email" placeholder="Description"/>
                        </div>

                         <div class="form-group">
                            <input type="date" class="form-input" name="date" id="email" placeholder="Date"/>
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>

                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>


<?php
   
  


  if (isset($_POST['submit'])) {


      $titel= $_POST['titel'];
      $email= $_POST['email'];
      $descr= $_POST['descr'];
      $date= $_POST['date'];

      // if (empty($date or $descr)) {
      //    $descr=NULL;
      //    $date=;
      // }

      if (!empty($titel && $email)) {


        $req = $conn -> prepare("INSERT INTO register (email,title,descr,date)
                                VALUES(:email,:titel,:descr,:date)");
        $req -> execute(array(
            'email' => $email,
            'titel' => $titel,
            'descr' => $descr,
            'date' => $date
        ));

        if ($req) {
            header('Location: login.php');
        }else{
            echo "false";
        }
      }
  }




?>
    
</body>
</html>