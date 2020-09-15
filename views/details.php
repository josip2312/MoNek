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
		
		include_once '../controller/connection.inc.php';
		$id = $_GET['id'];
		$user_id = null;
		if(isset($_SESSION['userId'])){
			$user_id = $_SESSION['userId'];
		}

		$sql = "SELECT * FROM stanovi WHERE id = $id ";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			echo "SQL statement failed!";
		} else {
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
			$putanja = "../assets/img/gallery/".$row['putanja'];
		}
	?>

        <div class="details">
			<div class="details__image">
				<img
					width="1200"
					height="800"
					src=<?=$putanja?>
					alt="House 1"
				/>
			</div>
			<div class="details__info">
				<div class="details__outer">
					<div class="details__location">
						<img src="../assets/img/icons/location.svg" alt="" />
						<span> Lokacija: <?=$row['lokacija']?> </span>
					</div>
					<div class="details__price">
						<img src="../assets/img/icons/price.svg" alt="" />
						<span> Cijena:  <?=$row['cijena']?></span>
					</div>
				</div>
				<div class="details__inner">
					<div class="details__area">
						<img src="../assets/img/icons/area.svg" alt="" />
						<span> Kvadratura:  <?=$row['dimenzije']?> </span>
					</div>
					<div class="details__rooms">
						<img src="../assets/img/icons/bed.svg" alt="" />
						<span> Broj soba: 2 </span>
					</div>
				</div>
			</div>
			<div class="details__datepicker">
				<form class="form" action="../controller/rezervacija.inc.php?stan_id=<?=$id?>&&user_id=<?=$user_id?>" method="post">
					<div class="form-group heading">
						<h3 class="heading-3">Rezerviraj mjesto</h3>
					</div>
					<div class="form-left">
						<div class="form-group">
							<label for="start">Dan useljenja</label>
							<input type="date" name="start" id="start" />
						</div>
					</div>

					<div class="form-right">
						<div class="form-group">
							<label for="end">Dan iseljenja</label>
							<input type="date" name="end" id="end" />
						</div>
					</div>
					<div class="form-group button">
						<button class="btn" type="submit" name="sumit">Rezerviraj</button>
					</div>
				</form>
			</div>
		</div>

		<?php include './layout/footer.php';?>

		<script src="../js/header.js"></script>
	</body>
</html>
