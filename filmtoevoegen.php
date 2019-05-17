<?php
	require_once('classes/autoloader.php');
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <a href="index.php">
                        <button class="btn btn-primary">Home</button>
                    </a>
                    <br>
                    <h2 align="center">Voeg hier een film toe: </h2>
                </div>
            </div>
            <div class="card-body bg-light">
                <form class="form" method="GET">
                    <div class="form-group">
                        <label>Titel: </label>
                        <input class="form-control" type="text" name="add_movie_title" required
                               placeholder="Planet of the Apes">

                        <label>Regisseur kiezen: </label>
                        <select class="form-control" name="add_movie_dir_nr" required>
							<?php
								Utility::generateDirectorDropdown();
							?>
                        </select>

                        <label>Jaar: </label>
                        <input class="form-control" type="number" min="1900" name="add_movie_year" required
                               placeholder="1997">

                        <label>Genre: </label>
                        <input class="form-control" type="text" name="add_movie_genre" placeholder="Horror">

                        <label>Speeltijd (in minuten): </label>
                        <input class="form-control" type="number" min="1" name="add_movie_length" required
                               placeholder="122">

                        <br>
                        <button type="submit" class="btn btn-primary">Toevoegen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
	if (isset($_GET['add_movie_title'])) {
		// Voeg film toe.
		Database::addMovie($_GET['add_movie_title'], $_GET['add_movie_dir_nr'], $_GET['add_movie_year'],
			$_GET['add_movie_genre'], $_GET['add_movie_length']);
	}
?>
</body>
</html>