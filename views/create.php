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

        <section class="wrapping create">
			<form class="form form-grid" action="../controller/gallery.inc.php" method="post" enctype="multipart/form-data">
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
							rows="3"
							required
						></textarea>
					</div>
				</div>
				<div class="form-group file">
					<input type="file" name="file"  required />
					<!-- <div class="dropzone">Dodaj sliku</div> -->
				</div>
				<div class="form-group button">
					<button type="submit" name="submit" class="btn">Postavi</button>
				</div>
			</form>
		</section>

		<?php include './layout/footer.php';?>

		<script src="../js/header.js"></script>
	</body>
</html>
