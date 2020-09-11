<?php 
if(isset($_POST['submit'])){

    require 'connection.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        header("Location: ../views/login.php?error=emptyfields&email=".$email);
        exit();
    }
    else{
        $sql = "SELECT * FROM korisnik WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($password, $row['lozinka']);
                if ($pwdCheck == false) {
                    print_r($row);
                    header("Location: ../views/login.php?error=wrongpwd");
                    exit();     
                }
                else if($pwdCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    header("Location: ../views/index.php?login=succes");
                    exit();
                }
                else{
                    header("Location: ../views/login.php?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../views/login.php?error=nouser");
                exit(); 
            }
        }
    }
}
else {
    header("Location: ../views/login.php");
    exit();
}