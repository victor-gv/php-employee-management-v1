<!-- TODO Application entry point. Login view -->
<?php

require_once('./src/library/loginManager.php');
$alert = checkSession();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/login.css">
    <title>Document</title>
</head>
<body>
    <div class="login__container--box">
        <h2 class="login__container--title">LOGIN</h2>
            <form class="login__form" action="./src/library/loginController.php" method="post">
                <div class="user__input">
                    <label for="">Email address</label>
                    <input type="email" name="email" id="">
                    <i class='bx bxs-user icon__user--log'></i>
                </div>
                <div class="user__input">
                    <label for="">Password</label>
                    <input type="password" name="pass" id="">
                    <i class='bx bxs-lock icon__pass--log' ></i>
                </div>
                <div class="login__user--container">
                    <button class="login__user--button" type="submit" name="login" value="login">Sign in</button>
                </div>
                <?php
                echo $alert;
                ?>
            </form>
    </div>
    
</body>
</html>

<!-- CRUD => Create, Read, Update and Delete -->