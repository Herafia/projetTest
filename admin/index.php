<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<link rel="stylesheet" href="../assets/css/stylesheet.css">
	<link href="https://fonts.googleapis.com/css?family=Holtwood+One+SC" rel="stylesheet">
	
	<title>Burger Code</title>
</head>

<body>

<h1 class="text-logo"><img src="https://img.icons8.com/doodle/48/000000/dining-room.png"> Burger Code <img src="https://img.icons8.com/doodle/48/000000/dining-room.png"></h1>
<div class="container admin">
	<div class="row">
		<h1><strong>Liste des items</strong>
			<a href="insert.php" class="btn btn-success"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAABmwAAAZsBqMTCdgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAADJSURBVEiJ7ZQ9CgIxEIXHGbPY6AWsxFLBxt6Tqdh6kz2GvY1gK1bWC1osmWFGG1ldcBfjXyH5usB7+V4RAhD5Bao6E5FcRHJVnYZ0m4GigXOuBQAgIsOQLoaE3yGKoqigcX9Q1YWZjarCiDhGxC4AgJkdzGxdk90Q0fyhiJmPzrn267tviMgpSZJOIf7Epc9Q+hmIaCki/aowEU0QsQcAYGZ7VV3VZHcvr2Lm9HyFmdOQ7v897yj6MxERbb33mfc+I6Ltt0ZFSlwAwsxSV6l7VX0AAAAASUVORK5CYII="> Ajouter</a>
		</h1>
		<table class="table table-striped table-bordered">
			<thead>
			<tr>
				<th>Nom</th>
				<th>Description</th>
				<th>Prix</th>
				<th>Catégorie</th>
				<th>Actions</th>
			</tr>
			</thead>

			<tbody>
				<?php
				require 'database.php';
				$db = Database::connect();
				$statement = $db->query('SELECT items.id, items.name, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');
				while ($item = $statement->fetch())
				{
					echo '<tr>';
				echo '<td>' . $item['name'] . '</td>';
				echo '<td>' . $item['description'] . '</td>';
				echo '<td>' . number_format((float)$item['price'], 2,'.', '') . '€</td>';
				echo '<td>' . $item['category'] . '</td>';
				echo '<td style="width: 350px">';
				echo '<a class="btn btn-outline-secondary mr-1" href="/admin/view.php?id='. $item['id'] .'"><img style="width: 2.8vh" src="https://img.icons8.com/ios/50/000000/visible.png"> Voir</a>';
				echo '<a class="btn btn-primary mr-1" href="update.php?id='. $item['id'] .'"><img style="width: 2.8vh" src="https://img.icons8.com/ios/50/000000/pencil.png"> Modifier</a>';
				echo '<a class="btn btn-danger" href="delete.php?id='. $item['id'] .'"><img style="width: 2.8vh" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAA
				BHNCSVQICAgIfAhkiAAAAAlwSFlzAAAB2wAAAdsBV+WHHwAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAEbSURBVEiJ7ZZdD8EwGEbLL3ElIkvER1xIloX//18QNkY4LnTRzdq3m4YEz+16etp9PKtS//xkgD6
				wBnbAqAU/1uwa6PtCEyDjkRyIG0hjzRTJgIkPuOU5Bx8YmOmx1WwlsAOkNWAhn7WQoufsSPKocqvN5EBSwyTAycJkQCTdrWKisWP1J2BpjF0GkRoTTiU5sAoqNeQLym+omVy4tmgl9dx52J2+IA8nNeRzQX7E8blV023gPiulcFy/KqU
				uDeaTw3MN2tKoXiVp4ikNJ9fP9egQ2BbkrFefndrKIeVerRH2bq+tV0nqqsEUGBpjhw55qV4lqasGS9Jgcj78W3z/QUDDPWBjQHtgIIIPfqCZIhug5wu//7D3z9flBr7Fj56dDUU4AAAAAElFTkSuQmCC"> Supprimer</a>';
				echo '</td>';
			echo '</tr>';
				}
				Database::disconnect();
				?>
			</tbody>
		</table>
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>