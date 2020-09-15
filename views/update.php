<!DOCTYPE html>
				<html lang="en">
					<head>
						<meta charset="UTF-8" />
						<meta name="viewport" content="width=device-width, initial-scale=1.0" />
						<title>MoStan</title>
						<link rel="stylesheet" href="../assets/css/app.css" />
						<link rel="icon" type="image/png" href="../assets/img/icons/favicon-32x32.png" sizes="32x32" />
						<link rel="icon" type="image/png" href="../assets/img/icons/favicon-16x16.png" sizes="16x16" />
					</head>
					<body>

<?php
    include './layout/header.php';
    


	if (isset($_SESSION['userId']) && $_SESSION['uloga'] == "admin") {

        include_once '../controller/connection.inc.php';
		$id = $_GET['id'];
		$sql = "SELECT * FROM stanovi WHERE id = $id ";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement failed!";
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
            $naziv = $row['naziv'];
            $cijena = $row['cijena'];
            $dimenzije = $row['dimenzije'];
            $lokacija = $row['lokacija'];
            $opis = $row['opis'];
            $putanja = $row['putanja'];
        }
        

		echo '	
						<section class="wrapping create">
							<form class="form form-grid" action="../controller/update.inc.php?id='.$id.'" method="post" enctype="multipart/form-data">
								<div class="form-group heading">
									<h3 class="heading-3">Postavi stan</h3>
								</div>
								<div class="form-left">
									<div class="form-group">
										<label for="name">Naziv</label>
										<input
											type="text"
											name="name"
                                            id="name"
                                            value='.$naziv.'
											autocomplete="on"
											required
										/>
									</div>
									<div class="form-group">
										<label for="price">Cijena</label>
										<input
											type="number"
											name="price"
                                            id="price"
                                            value='.$cijena.'
											autocomplete="on"
											required
										/>
									</div>
									<div class="form-group">
										<label for="location">Lokacija</label>
										<input
											type="text"
											name="location"
                                            id="location"
                                            value='.$lokacija.'
											autocomplete="on"
											required
										/>
									</div>
								</div>
								<div class="form-right">
									<div class="form-group">
										<label for="dimensions">Dimenzije</label>
										<input
											type="number"
											name="dimensions"
                                            id="dimensions"
                                            value='.$dimenzije.'
											autocomplete="on"
											required
										/>
									</div>
									<div class="form-group">
										<label for="description">Opis</label>
										<textarea
											name="description"
											id="description"
                                            cols="10"
											rows="4"
											required
										>'.$opis.'</textarea>
									</div>
								</div>
								<div class="form-group file">
									<input
										type="file"
										name="file"
										id="photo"
										style="display: none"
									/>
									<div class="dropzone">
										<img src="../assets/img/icons/upload.svg" alt="" />
										<span>
											Povuci i pusti ili klikni kako bi dodao sliku
										</span>
									</div>
								</div>
								<div class="form-group files"></div>
								<div class="form-group button">
									<button type="submit" name="update" class="btn">Uredi</button>
								</div>
							</form>
						</section>
				
						
		';
	} else {
		echo 'Nemate pristup ovoj ruti!';
	}
	include './layout/footer.php';
?>


						<script src="../js/header.js"></script>
						<script src="../js/create.js"></script>
					</body>
				</html>