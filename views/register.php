<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>MoStan</title>
		<link rel="stylesheet" href="../assets/css/app.css" />
		<link rel="icon" href="../assets/img/icons/MoStan.png" >
		<link rel="icon" type="image/png" href="../assets/img/icons/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="../assets/img/icons/favicon-16x16.png" sizes="16x16" />
	</head>
	<body>
	<?php 

		include './layout/header.php';
	?>

        <section class="wrapping">
            <form class="form" action="../controller/register.inc.php" method="post">
				<div class="form-group">
					<h3 class="heading-3">Registracija</h3>
				</div>
				<div class="form-group">
					<label for="name">Ime</label>
					<input
						type="text"
						name="name"
						id="name"
						autocomplete="on"
						required
					/>
				</div>
				<div class="form-group">
					<label for="lastname">Prezime</label>
					<input
						type="text"
						name="lastname"
						id="lastname"
						autocomplete="on"
						required
					/>
				</div>
				<div class="form-group">
					<label for="email">Email Adresa</label>
					<input
						type="email"
						name="email"
						id="email"
						autocomplete="on"
						required
					/>
				</div>
				<div class="form-group">
					<label for="password">Lozinka</label>
					<input
						type="password"
						name="password"
						id="password"
						autocomplete="on"
						required
					/>
				</div>
				<div class="form-group">
					<button type="submit" name="submit" class="btn">Prijavi se</button>
				</div>
			</form>
		</section>

		<?php include './layout/footer.php';?>

		<script src="../js/header.js"></script>
	</body>
</html>
