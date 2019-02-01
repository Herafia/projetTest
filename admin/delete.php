<?php
	require 'database.php';
	
	if (!empty($_GET['id'])){
		$id = checkInput($_GET['id']);
	}
	
	if (!empty($_POST)){
		$id = checkInput($_POST['id']);
		$db = Database::connect();
		$statement = $db->prepare('DELETE FROM items WHERE id = ?');
		$statement->execute([$id]);
		Database::disconnect();
		header("Location: index.php");
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
	<h1><strong>Supprimer un item</strong></h1>
	<br>
	<form class="form" role="form" method="post" action="delete.php">
		<input type="hidden" name="id" value="<?php echo $id ?>">
		<p class="alert alert-warning">Etes-vous sûr de vouloir supprimer ?</p>
		<button type="submit" class="btn btn-warning">Oui</button>
		<a class="btn btn-outline-secondary" href="index.php">Non</a>
	</form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>