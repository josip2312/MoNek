<?php 
if(isset($_POST['submit'])){

    require 'connection.inc.php';

    $name = $_POST['name'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $admin = "user";

    if(empty($name) || empty($lastName) || empty($email) || empty($password)){
        header("Location: ../views/register.php?error=emptyfields&name=".$name."&lastname=".$lastName."&email=".$email);
        exit();
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../views/register.php?error=emptyfields&name=".$name."&lastname=".$lastName);
        exit();
    }
    else {
        $sql = "SELECT email FROM korisnik WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../views/register.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../views/register.php?msg=Email zauzet");
                exit();
            }
            else{
                $sql = "INSERT INTO korisnik (ime,prezime,email,lozinka,uloga) VALUES (?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../views/register.php?msg=sqlerror1");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    mysqli_stmt_bind_param($stmt,"sssss",$name,$lastName,$email,$hashedPwd,$admin);
                    mysqli_stmt_execute($stmt);
                    
                    header("Location: ../views/login.php?msg=Uspješna registracija. Prijavite se !");
                    
                    exit();
                }
            }
        }
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else {
    header("Location: ../views/register.php");
    exit();
}