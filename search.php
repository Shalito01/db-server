<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css">
  <title>DB Connect</title>
</head>
<body>
  <div class="fquery">
    <form action="./search.php" method="post">
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
				<input type="date" name="date">
			</div>

			<br>

			<input type="submit" class="button" value="Search" name="submit">

    </form>

		<div class="sql">

		<?php
		require "./db/database.php";
		if (isset($_POST['submit'])) {
			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}
		?>

		<div class="riga">
			<div class="headings">CATEGORIA</div>
			<div class="headings">NOME</div>
			<div class="headings">OWNER</div>
			<div class="headings">DATA</div>
			<div class="headings">URL</div>
		</div>
		
		<?php
			$sql = "SELECT * FROM documents WHERE category=" . $_POST['category'] . " AND owner=" . $_POST['owner'] . " AND name LIKE " . $_POST['description'] . " ORDER BY data";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				echo '<div class="riga">';
				while($row = mysqli_fetch_assoc($result)) {
					echo '<div class="cella">' . $row['category'] . '</div>';
					echo '<div class="cella">' . $row['name'] . '</div>';
					echo '<div class="cella">' . $row['owner'] . '</div>';
					echo '<div class="cella">' . $row['data'] . '</div>';
					echo '<div class="cella">' . '<i class="fa fa-file-pdf-o" aria-hidden="true" href="' . $row['url'] . '"></i>' . '</div>';
				}
				echo '</div>';
			}

		}
		?>

		</div>


  </div>
</body>
</html>