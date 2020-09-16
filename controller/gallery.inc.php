<?php 

if (isset($_POST['submit'])) {

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

    if (in_array($fileActualExt, $allowed)) {
        if($fileError === 0){
            if ($fileSize < 2000000){
                $imageFullName = $name . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../assets/img/gallery/" . $imageFullName;

                include_once "connection.inc.php";

                $sql = "SELECT * FROM stanovi;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "SQL statment failed";
                } else {
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $rowCount = mysqli_num_rows($result);
                    $setImageOrder = $rowCount + 1;

                    $sql = "INSERT INTO stanovi (naziv,dimenzije,cijena,lokacija,opis,putanja) VALUES (?,?,?,?,?,?);";

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        echo "SQL statment failed";
                    } else {
                        mysqli_stmt_bind_param($stmt, "sddsss", $_POST['name'], $dimensions, $price, $location, $description, $imageFullName);
                        mysqli_stmt_execute($stmt);

                        
                        $moved = move_uploaded_file($fileTempName, $fileDestination);

                        if( $moved ) {
                            echo "Successfully uploaded";
                            header("Location: ../views/index.php?msg=Objavili ste stan!");
                        exit();         
                        } else {
                            echo "Not uploaded because of error #".$_FILES["file"]["error"];
                        }

                        
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