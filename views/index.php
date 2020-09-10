<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>Document</title>
		<link rel="stylesheet" href="../assets/css/app.css" />
	</head>
	<body>
		
	<?php include './layout/header.php';?>

		<main>
			<div class="button__create">
			
				<a class="btn" href="/2019/g13/views/create.php">Objavi novi stan!</a>
			</div>
			<div class="showcase">
				<?php
					include_once '../controller/connection.inc.php';

					$sql = "SELECT * FROM stanovi ORDER BY id DESC";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						echo "SQL statement failed!";
					} else {
						mysqli_stmt_execute($stmt);
						$result = mysqli_stmt_get_result($stmt);
						$brojac = 1;

						while ($row = mysqli_fetch_assoc($result)) {
							if($brojac == 1){
								$num = "one";
								$brojac ++;
							} else {
								$num = "two";
								$brojac --;
							}

							echo '<div class="home home-'.$num.'">
									<div class="home__image">
										<img
											width="1200"
											height="800"
											src="../assets/img/gallery/'.$row['putanja'].'"
											alt="House 1"
										/>
									</div>
				
									<div class="home__name"> Naziv:  '.$row['naziv'].'</div>
				
									<div class="home__outer">
										<div class="home__location">Lokacija:  '.$row['lokacija'].'</div>
										<div class="home__price">Cijena:  '.$row['cijena'].'</div>
									</div>
									<div class="home__inner">
										<div class="home__area">Kvadratura:  '.$row['dimenzije'].'</div>
										<div class="home__rooms">Broj soba: 2</div>
									</div>
									 <a class="btn" href="/2019/g13/views/details.php?id='.$row['id'].'">Rezerviraj</a>
									
								</div>';
						}
					}
				
				?>

			
				<div class="home home-two">
					<div class="home__image">
						<img
							width="1200"
							height="800"
							src="https://source.unsplash.com/random/1200x800"
							alt="House 1"
						/>
					</div>
					<div class="home__name">Naziv</div>
					<div class="home__outer">
						<div class="home__location">Lokacija</div>
						<div class="home__price">Cijena</div>
					</div>
					<div class="home__inner">
						<div class="home__area">Kvadratura</div>
						<div class="home__rooms">Broj soba</div>
					</div>
					<a class="btn" href="#">Rezerviraj</a>
				</div>
				<div class="home home-three">
					<div class="home__image">
						<img
							width="1200"
							height="800"
							src="https://source.unsplash.com/random/1200x800"
							alt="House 1"
						/>
					</div>
					<div class="home__name">Naziv</div>
					<div class="home__outer">
						<div class="home__location">Lokacija</div>
						<div class="home__price">Cijena</div>
					</div>
					<div class="home__inner">
						<div class="home__area">Kvadratura</div>
						<div class="home__rooms">Broj soba</div>
					</div>

					<a class="btn" href="#">Rezerviraj</a>
				</div>
				<div class="home home-four">
					<div class="home__image">
						<img
							width="1200"
							height="800"
							src="https://source.unsplash.com/random/1200x800"
							alt="House 1"
						/>
					</div>
					<div class="home__name">Naziv</div>
					<div class="home__outer">
						<div class="home__location">Lokacija</div>
						<div class="home__price">Cijena</div>
					</div>
					<div class="home__inner">
						<div class="home__area">Kvadratura</div>
						<div class="home__rooms">Broj soba</div>
					</div>
					<a class="btn" href="#">Rezerviraj</a>
				</div>
			</div>
		</main>

		<?php include './layout/footer.php';?>

		<script src="../js/header.js"></script>
	</body>
</html>
