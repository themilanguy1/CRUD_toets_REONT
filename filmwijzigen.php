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
                    <h2 align="center">Film wijzigen </h2>
                </div>
            </div>
            <div class="card-body bg-light">
                <form class="form" method="GET">
                    <div class="form-group">
                        <input type="hidden" name="edit_movie_id" value="<?php echo $_GET['wijzig_film_nr'] ?>"
                        
                        <label>Titel: </label>
                        <input class="form-control" type="text" name="edit_movie_title" required
                               placeholder="Planet of the Apes">

                        <label>Regisseur kiezen: </label>
                        <select class="form-control" name="edit_movie_dir_nr" required>
							<?php
								Utility::generateDirectorDropdown();
							?>
                        </select>

                        <label>Jaar: </label>
                        <input class="form-control" type="number" min="1900" name="edit_movie_year" required
                               placeholder="1997">

                        <label>Genre: </label>
                        <input class="form-control" type="text" name="edit_movie_genre" placeholder="Horror">

                        <label>Speeltijd (in minuten): </label>
                        <input class="form-control" type="number" min="1" name="edit_movie_length" required
                               placeholder="122">

                        <br>
                        <button type="submit" class="btn btn-primary">Wijzigen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
	if (isset($_GET['edit_movie_title'])) {
	    // wijzig bestaande film.
		Database::editMovie($_GET['edit_movie_id'], $_GET['edit_movie_title'], $_GET['edit_movie_dir_nr'],
			$_GET['edit_movie_year'], $_GET['edit_movie_genre'], $_GET['edit_movie_length']);
	}
?>
</body>
</html>