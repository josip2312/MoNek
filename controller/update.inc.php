<?php 
include_once "connection.inc.php";
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    if (!$_POST['name']) {
        $name = "NoName";
    } else {
        $name = strtolower(str_replace(" ", "-", $name));
    }

    $dimensions = $_POST['dimensions'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $price = $_POST['price'];

    $file = $_FILES['file'];
    $fileName = $file["name"];
    $fileType = $file["type"];
    $fileTempName = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];


    
    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (!$file['name']) {
        $sql = "UPDATE stanovi SET naziv=?,dimenzije=?,cijena=?,lokacija=?, opis=? WHERE id=?";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statment failed";
        } else {
            mysqli_stmt_bind_param($stmt, "sddsss", $_POST['name'], $dimensions, $price, $location, $description, $_GET['id']);
            mysqli_stmt_execute($stmt);
            
            header("Location: ../views/index.php?msg=Uspješno ste ažurirali podatke o stanu!");
        }
    } else {
        
        if (in_array($fileActualExt, $allowed)) {
            if($fileError === 0){
                if ($fileSize < 2000000){
                    $imageFullName = $name . "." . uniqid("", true) . "." . $fileActualExt;
                    $fileDestination = "../assets/img/gallery/" . $imageFullName;

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
                       
                        $sql = "UPDATE stanovi SET naziv=?,dimenzije=?,cijena=?,lokacija=?, opis=?, putanja=? WHERE id='$id'";
                        mysqli_stmt_prepare($stmt, $sql);
                        mysqli_stmt_bind_param($stmt, "sddsss", $_POST['name'], $dimensions, $price, $location, $description,$imageFullName);
                        mysqli_stmt_execute($stmt);
           
                        $moved = move_uploaded_file($fileTempName, $fileDestination);

                        if( $moved ) {
                            echo "Successfully uploaded";
                            header("Location: ../views/index.php?msg=Uspješno ste ažurirali stan!");
                        exit();         
                        } else {
                            echo "Not uploaded because of error #".$_FILES["file"]["error"];
                        } 
                    }
                } else {
                    echo "Prevelika datoteka";
                    exit();
                }
            } else {
                echo "Dogodila se pogreška";
                exit();
            }
            } else {
                echo "Morate uploadati jpg, jpeg ili png tip datoteke.";
                exit();
            }
        }

    }
    

