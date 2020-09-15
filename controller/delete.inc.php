<?php
    include_once "connection.inc.php";
    $id = $_GET['id'];
    

    $sql = "SELECT * FROM stanovi WHERE id = '$id';";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL statment failed";
    } else {
        mysqli_stmt_execute($stmt);
        $res = mysqli_stmt_get_result($stmt);
        $result = $res->fetch_assoc();
        unlink("../assets/img/gallery/" . $result['putanja']);
        
        $sql = "DELETE FROM stanovi WHERE id='$id'";
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        header("Location: ../views/index.php?msg=Uspješno ste izbrisali stan!");
    }
?>