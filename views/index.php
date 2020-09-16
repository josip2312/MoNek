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
	
	<?php include './layout/header.php';?>
		<main>

			<?php 
				if(isset($_SESSION['userId']) && $_SESSION['uloga'] == "admin") {
					echo '<div class="button__create">
							  <a class="btn" href="/2019/g13/views/create.php">Objavi novi stan!</a>
						  </div>';
				}
			?>
			
			<div class="showcase">
				<?php
					include_once '../controller/connection.inc.php';
					
					if (isset($_GET['pageno'])) {
						$pageno = $_GET['pageno'];
					} else {
						$pageno = 1;
					}

					$no_of_records_per_page = 2;
					$offset = ($pageno-1) * $no_of_records_per_page; 

					
					$total_pages_sql = "SELECT COUNT(*) FROM stanovi";
					$result = mysqli_query($conn,$total_pages_sql);
					$total_rows = mysqli_fetch_array($result)[0];
					$total_pages = ceil($total_rows / $no_of_records_per_page);
									
					$sql = "SELECT * FROM stanovi ORDER BY id DESC LIMIT $offset, $no_of_records_per_page";
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
											loading="lazy"
											width="1200"
											height="800"
											src="../assets/img/gallery/' .$row['putanja'].'"
											alt="House 1"
										/>
									</div>				
									<div class="home__name"> '.$row['naziv'].'</div>				
									<div class="home__outer">
										<div class="home__location">
											<img src="../assets/img/icons/location.svg" alt="" />
											<span>
											Lokacija: '.$row['lokacija'].'
											</span>
										</div>
										<div class="home__price">
											<img src="../assets/img/icons/price.svg" alt="" />
											<span>
											Cijena: '.$row['cijena'].'
											</span>
										
										</div>
									</div>
									<div class="home__inner">
										<div class="home__area">
											<img src="../assets/img/icons/area.svg" alt="" />
											<span>
											Kvadratura: '.$row['dimenzije'].'
											</span>
										</div>
										<div class="home__rooms">
											<img src="../assets/img/icons/bed.svg" alt="" />
											<span>
											Broj soba: 2
											</span>
										</div>
									</div>
									<a class="btn" href="/2019/g13/views/details.php?id='.$row['id'].'">Rezerviraj</a>
									';
									if(isset($_SESSION['userId']) && $_SESSION['uloga'] == "admin") {
										echo '<div class="home__buttons">
												<a class="btn" href="/2019/g13/controller/delete.inc.php?id='.$row['id'].'">Ukloni</a>
												<a class="btn" href="/2019/g13/views/update.php?id='.$row['id'].'">Uredi</a>
											</div>';
									}

									echo '</div>';
						}
					}
				
				?>
				<div class="pagination">
					<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
						<img src="../assets/img/icons/arrowleft.svg" alt="">
					</a>
					<a href="" class="active">
						<?= $pageno ?>
					</a>
					<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
						<img src="../assets/img/icons/arrowright.svg" alt="">
					</a>
				</div>
			

			</div>

			
		</main>
		

		<?php 
			if(isset($_GET['msg'])){
                include './layout/modal.php';
            }
			include './layout/footer.php';
		?>

		<script src="../js/header.js"></script>
	</body>
</html>
