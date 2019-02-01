<?php
require 'database.php';

if (!empty($_GET['id'])){
	$id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
$statement->execute([$id]);
$item = $statement->fetch();
Database::disconnect();

function checkInput($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	
	return $data;
}
?>

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
		<div class="col-sm-6">
			<h1><strong>Voir un item</strong></h1>
			<br>
			<form>
				<div class="form-groupe">
					<label>Nom : <?php echo $item['name']; ?></label>
				</div>
				<div class="form-groupe">
					<label>Description : <?php echo $item['description']; ?></label>
				</div>
				<div class="form-groupe">
					<label>Prix : <?php echo number_format((float)$item['price'], 2, '.', ''); ?>€</label>
				</div>
				<div class="form-groupe">
					<label>Catégorie : <?php echo $item['category']; ?></label>
				</div>
				<div class="form-groupe">
					<label>Image : <?php echo $item['image']; ?></label>
				</div>
				<br>
					<a class="btn btn-primary" href="index.php"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhk
				iAAAAAlwSFlzAAABmwAAAZsBqMTCdgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAEESURBVEiJ7ZW7LkRRFEDX8Wgk4jOUCkqNgkjED0imV/gFP+EHFL5kojS1Q
				nSIeIxGMMxjKVwy7jjjMudEIrOSU+1kr73PPg8Y869QN9WVnIJpte4bbXUqh2RJbfqZudSSDfXZQdKJ1G21+4XkV6IQkewAe7E4cAjcAbfFugTOgFPgJITQqtLJltqLdFKVR3V3mGRN7Y
				woeacZ3Tr1AZj5tu1qdEMIH9dgohRsJ5IMUBatAi+Jct8MjarrI8ypp7bUC7XWnzd2vGvAPjAZqadeVHwNXAHnQAM4DiF0ftS3uqw+RSpP/gQtqvfZRYVsVj3KLuoTHhTDzvNNlGQL6nxW
				yZg/4xXGjsy3ikrNEQAAAABJRU5ErkJggg=="> Retour</a>
			</form>

		</div>
		
		<div class="col-sm-5">
			<div class="card">
				<img src="<?php echo '../assets/images/' . $item['image']?>" alt="..." class="card-img-top">
				<div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''); ?> €</div>
				<div class="caption">
					<h4><?php echo $item['name']; ?></h4>
					<p><?php echo $item['description']; ?></p>
					<a href="#" class="btn btn-order" role="button"><img src="https://img.icons8.com/ios-glyphs/30/000000/shopping-cart.png" alt="">Commander</a>
				</div>
			</div>
		</div>
		
	</div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>
