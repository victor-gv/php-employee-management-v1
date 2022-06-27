<?php
//Validate Session
function validate(){
    
    $users = json_decode(file_get_contents('../../resources/users.json'), true);
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    session_start();

    if($email === $users['users'][0]['email']){

        if(password_verify($pass, $users['users'][0]['password'])){

            session_start();

            $_SESSION['email'] = $email;
            $_SESSION['pass'] = $pass;
            $_SESSION["time"] = time();//set the start time session
           
            header ("Location: ../dashboard.php");
        }else {
            $_SESSION['loginerror'] = "<div class='pass__error--container'><p class='pass__error--p'>Incorrect Password</p></div>";

            header ("Location: ../../index.php");
        }

    }else {
        $_SESSION['loginerror'] = "<div class='email__error--container'><p class='email__error--p'>Incorrect Email</p></div>";

        header ("Location: ../../index.php");
    }

}   

//Check Session
function checkSession(){

    session_start();

    $urlFile = basename($_SERVER['REQUEST_URI'],'?'.$_SERVER['QUERY_STRING']);

    if($urlFile === 'index.php') {
        if(isset($_SESSION['email'])) {
    
            header ("Location: ../dashboard.php");

        }else {
            if($errorLog = checkLoginError()){
                return $errorLog;
            }
            if($errorLog = checkLoginOut()){
                return $errorLog;
            }
                return $errorLog = '';
        }
    }else{
        if(!isset($_SESSION["email"])){
            header("Location: ./index.php");
        }
    }
}

//logOut session
function logoutSession() {
session_start();
unset($_SESSION);
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

session_destroy();

header("Location:../../index.php?logout=true");
}

//Check Login error
function checkLoginError(){

    if(isset($_SESSION['loginerror'])) {
        return "<p>".$_SESSION['loginerror']."</p>";
    }
}

//Check Logout
function checkLoginOut(){

    if(isset($_GET['logout']) && !isset($_SESSION['email'])){
        return "<div class='logout__success--container'>
            <p class='logout__success--p'>Logout successfully</p>
        </div>";
    }
}
