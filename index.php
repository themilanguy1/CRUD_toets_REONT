<?php
	require_once('classes/autoloader.php');
	
	if(isset($_GET['verwijder_film_nr'])) {
		Database::removeMovie($_GET['verwijder_film_nr']);
		echo "film verwijdert";
	}
?>

<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12" align="left" style="margin-top: 1em;">
				<a href="filmtoevoegen.php">
					<button class="btn btn-primary">Film toevoegen</button>
				</a>
			</div>
			<div class="col-lg-12" align="center">
				<h2>Filmweergave:</h2>
			</div>
			<?php
				Database::Display(Database::Fetch());
			?>
		</div>
	</div>
</body>
</html>

