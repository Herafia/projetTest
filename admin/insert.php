<?php
	require 'database.php';
	
	$nameError = $descriptionError = $priceError = $categoryError = $imageError = "";
	
	if (!empty($_POST)){
		$name = checkInput($_POST['name']);
		$description = checkInput($_POST['description']);
		$price = checkInput($_POST['price']);
		$category = checkInput($_POST['category']);
		$image = checkInput($_FILES['image']['name']);
		$imagePath = '../assets/images' . basename($image);
		$imageExtention = pathinfo($imagePath, PATHINFO_EXTENSION);
		$isSuccess = true;
		$isUploadSuccess = false;
		
		if (empty($name)){
			$nameError = 'Ne peut pas être vide';
			$isSuccess = false;
		}
		
		if (empty($description)){
			$descriptionError = 'Ne peut pas être vide';
			$isSuccess = false;
		}
		
		if (empty($price)){
			$priceError = 'Ne peut pas être vide';
			$isSuccess = false;
		}
		
		if (empty($category)){
			$categoryError = 'Ne peut pas être vide';
			$isSuccess = false;
		}
		
		if (empty($image)){
			$imageError = 'Ne peut pas être vide';
			$isSuccess = false;
		}else{
			$isUploadSuccess = true;
			if ($imageExtention != "jpg" && $imageExtention != "png" && $imageExtention != "jpeg" && $imageExtention != "gif"){
				$imageError = 'Les extentions autorisées sont  : jpg, png, jpeg, gif.';
				$isUploadSuccess = false;
			}
			if (file_exists($imagePath)){
				$imageError = 'Le fichier existe déja';
				$isUploadSuccess = false;
			}
			if ($_FILES['image']['size'] > 500000){ // octets
				$imageError = 'Le fichier est trop volumineux, il ne doit pas dépasser 500KB';
				$isUploadSuccess = false;
			}
			if ($isUploadSuccess){
				if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)){
					$imageError = "Il y a eu une erreur lors de l'upload";
					$isUploadSuccess = false;
				}
			}
		}
		
		if ($isSuccess && $isUploadSuccess){
			$db = Database::connect();
			$statement = $db->prepare("INSERT INTO items (name, description, price, category, image) VALUES (?, ?, ?, ?, ?)");
			$statement->execute([$name, $description, $price, $category, $image]);
			Database::disconnect();
			header("Location : index.php");
		}
		
		
	}
	
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
	<h1><strong>Ajouter un item</strong></h1>
	<br>
	<form class="form" role="form" method="post" action="insert.php" enctype="multipart/form-data">
		<div class="form-groupe">
			<label for="name" style="font-weight: bold">Nom :</label>
			<input type="text" class="form-control" id="name" name="name" value="<?php if (isset($name)) echo $name;?>">
			<span class="help-inline"><?php echo $nameError;?></span><br>
		</div>
		<div class="form-groupe">
			<label for="description" style="font-weight: bold">Description :</label>
			<input type="text" class="form-control" id="description" name="description" value="<?php if (isset($description)) echo $description;?>">
			<span class="help-inline"><?php echo $descriptionError;?></span><br>
		</div>
		<div class="form-groupe">
			<label for="price" style="font-weight: bold">Prix (en €) :</label>
			<input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $price;?>">
			<span class="help-inline"><?php echo $priceError;?></span><br>
		</div>
		<div class="form-groupe">
			<label for="category" style="font-weight: bold">Catégorie :</label>
			<select class="form-control" name="category" id="category">
				<?php
					$db = Database::connect();
					foreach ($db->query('SELECT * FROM categories') as $row){
						echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
					}
					Database::disconnect();
				?>
			</select>
			<span class="help-inline"><?php echo $categoryError;?></span>
			<br>
		</div>
		<div class="form-groupe">
			<label for="image" style="font-weight: bold">Sélectionner une image :</label><br>
			<input type="file" id="image" name="image"><br>
			<span class="help-inline"><?php echo $imageError;?></span>
		</div>
		<br>
		<button type="submit" class="btn btn-success" style="height: 41px;"><img style="width: 3vh" src="https://img.icons8.com/ios/50/000000/pencil.png"> Ajouter</button>
		<a class="btn btn-primary" href="index.php"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhk
				iAAAAAlwSFlzAAABmwAAAZsBqMTCdgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAEESURBVEiJ7ZW7LkRRFEDX8Wgk4jOUCkqNgkjED0imV/gFP+EHFL5kojS1Q
				nSIeIxGMMxjKVwy7jjjMudEIrOSU+1kr73PPg8Y869QN9WVnIJpte4bbXUqh2RJbfqZudSSDfXZQdKJ1G21+4XkV6IQkewAe7E4cAjcAbfFugTOgFPgJITQqtLJltqLdFKVR3V3mGRN7Y
				woeacZ3Tr1AZj5tu1qdEMIH9dgohRsJ5IMUBatAi+Jct8MjarrI8ypp7bUC7XWnzd2vGvAPjAZqadeVHwNXAHnQAM4DiF0ftS3uqw+RSpP/gQtqvfZRYVsVj3KLuoTHhTDzvNNlGQL6nxW
				yZg/4xXGjsy3ikrNEQAAAABJRU5ErkJggg=="> Retour</a>
	</form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>