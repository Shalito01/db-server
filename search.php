<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/search.css">
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
  </div>

	<div class="sql">
			<div class="riga">
				<div class="headings"><h3>CATEGORIA</h3></div>
				<div class="headings"><h3>NOME</h3></div>
				<div class="headings"><h3>OWNER</h3></div>
				<div class="headings"><h3>DATA</h3></div>
				<div class="headings"><h3>URL</h3></div>
			</div>

			<?php
			require "./db/database.php";
			if (isset($_POST['submit'])) {
				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}
				
				$sql = "SELECT * FROM " . $_POST['category'] . " WHERE owner=" . $_POST['owner'] . " AND descr LIKE " . $_POST['description'] . " ORDER BY data";
				$req = $conn->prepare($sql);
				$req->bind_param('s', $_POST['category'], $_POST['owner'], $_POST['description']);
				$req->execute();

				$result = $req->get_result();
				if ($result->num_rows > 0) {
					echo '<div class="riga">';
					while($row = mysqli_fetch_assoc($result)) {
						echo '<div class="cella"><h4>' . htmlentities($row['category']) . '</h4></div>';
						echo '<div class="cella"><h4>' . htmlentities($row['name']) . '</h4></div>';
						echo '<div class="cella"><h4>' . htmlentities($row['owner']) . '</h4></div>';
						echo '<div class="cella"><h4>' . htmlentities($row['data']) . '</h4></div>';
						echo '<div class="cella">' . '<i class="fa fa-file-pdf-o" aria-hidden="true" href="' . htmlentities($row['url']) . '"></i>' . '</div>';
					}
					echo '</div>';
				}

			}
			?>
		</div>
</body>
</html>
