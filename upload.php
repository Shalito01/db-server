<?php
	if(isset($_POST['submit'])) {

		$target_dir = "db/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$target_filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		if ($target_filetype != "pdf") {
			echo "Sono permessi solo file PDF.";
			$uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo " File not uploaded.";
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}


	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/css/upload.css">
	<title>Uploader</title>
</head>
<body>

	<form action="upload.php" method="post" enctype="multipart/form-data">
		
		<div class="categoria">
			<h3>Categoria: </h3>
			<select name="category">
				<option value="fatture">Fatture</option>
				<option value="scuola">Scuola</option>
				<option value="fisco">Finanze</option>
				<option value="casa">Spese Casa</option>
				<option value="auto">Spese Auto</option>
				<option value="multe">Mancati Pagamenti</option>
			</select>
		</div>

		<div class="nome">
			<h3>Descrizione: </h3>
			<input type="text" name="description" required="required" placeholder="Breve descrizione">
		</div>

		<div class="proprietario">
			<h3>Proprietario: </h3>
			<select name="owner">
				<option value="naim">Naim Shala</option>
				<option value="yllka">Yllka Shala</option>
				<option value="klaus">Klaus Shala</option>
				<option value="daniel">Daniel Shala</option>
			</select>
		</div>

		<div class="data">
			<h3>Data: </h3>
			<input type="date" name="date" required="required">
		</div>

		<br>
		<div>
			Select file to upload:
			<input type="file" name="fileToUpload" id="fileToUpload" required="required">
		</div>

		<input type="submit" value="Upload" name="submit">

	</form>
</body>
</html>
