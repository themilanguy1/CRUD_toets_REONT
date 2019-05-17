<?php
	/**
	 * Class Database
	 */
	class Database
	{
		/**
		 * @return array
		 *
		 * Fetches sql data.
		 */
		public static function Fetch()
		{
			$conn = utility::pdoConnect();
			
			$fetch_sql = $conn->prepare("SELECT *, films.NR as filmnr FROM films, regisseurs
    WHERE films.DIRNR = regisseurs.NR
    ORDER BY films.NR ASC");
			$fetch_sql->execute();
			
			$data = $fetch_sql->fetchAll();
			
			return $data;
		}
		
		/**
		 * @param $data
		 *
		 * Displays sql data in table.
		 */
		public static function Display($data)
		{
			if (!empty($data)) {
				$result = $data;
				
				?>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Film titel</th>
                        <th scope="col">Regisseur</th>
                        <th scope="col">Jaar</th>
                        <th scope="col">Genre</th>
                        <th scope="col">Tijdsduur</th>
                        <th scope="col">Wijzigen</th>
                        <th scope="col">Verwijderen</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php
						foreach ($result as $row) {
							echo "<tr>";
							echo "<td>" . $row['TITEL'] . "</td>";
							echo "<td>" . $row['VOORNAAM'] . " " . $row['ACHTERNAAM'] . "</td>";
							echo "<td>" . $row['JAAR'] . "</td>";
							echo "<td>" . $row['GENRE'] . "</td>";
							echo "<td>" . $row['TIJDSDUUR'] . "</td>";
							?>
                            <td><a href="filmwijzigen.php?wijzig_film_nr=<?php echo $row['filmnr'] ?>">
                                    <i class="far fa-edit"></i></a></td>
                            <td><a href="?verwijder_film_nr=<?php echo $row['filmnr']?>">
                                    <i class="fas fa-trash"></i></a></td>
							<?php
							echo "</tr>";
						}
					?>
                    </tbody>
                </table>
				<?php
			}
		}
		
		/**
		 * @param $movie_title
		 * @param $movie_director_nr
		 * @param $movie_year
		 * @param $movie_genre
		 * @param $movie_length
		 *
		 * Adds movie to table filmdatabase.films .
		 */
		public static function addMovie($movie_title, $movie_director_nr, $movie_year, $movie_genre, $movie_length)
		{
			$conn = utility::PDOConnect();
			
			$new_film_id = Utility::GetNewSqlId("NR", "films");
			
			// Kijk of film al bestaat.
			$check_query = $conn->prepare('SELECT NR, TITEL FROM films WHERE TITEL = ?');
			$check_query->bindParam(1, $movie_title);
			$check_query->execute();
			$check_query->fetchAll();
			
			// Zoniet, voeg film toe aan filmdatabase.films .
			if ($check_query->rowCount() == 0) {
				$query = $conn->prepare("INSERT INTO films (NR, TITEL, DIRNR, JAAR, GENRE, TIJDSDUUR) VALUES (?, ?, ?, ?, ?, ?)");
				// gebruik new film id ipv autoincrement
				$query->bindParam("1", $new_film_id);
				$query->bindParam("2", $movie_title);
				$query->bindParam("3", $movie_director_nr);
				$query->bindParam("4", $movie_year);
				$query->bindParam("5", $movie_length);
				$query->bindParam("6", $movie_genre);
				$query->execute();
				echo "<h4>Film toegevoegd</h4>";
			} else {
				echo "<h4>Film bestaat al.</h4>";
			}
		}
		
		/**
		 * @param $movie_id
		 * @param $movie_title
		 * @param $movie_director_nr
		 * @param $movie_year
		 * @param $movie_genre
		 * @param $movie_length
		 *
		 * Edit movie.
		 */
		public static function editMovie($movie_id, $movie_title, $movie_director_nr, $movie_year, $movie_genre, $movie_length)
		{
			$conn = utility::PDOConnect();
			
			$query = $conn->prepare("UPDATE films SET TITEL = ?, DIRNR = ?, JAAR = ?, GENRE = ?, TIJDSDUUR = ?
                                            WHERE NR = $movie_id");
			$query->bindParam("1", $movie_title);
			$query->bindParam("2", $movie_director_nr);
			$query->bindParam("3", $movie_year);
			$query->bindParam("4", $movie_length);
			$query->bindParam("5", $movie_genre);
			$query->execute();
			echo "<h4>Film gewijzigd.</h4>";
		}
		
		/**
		 * @param $movie_id
         *
         * Removes movie from table.
		 */
		public static function removeMovie($movie_id) {
			$conn = utility::PDOConnect();
			
			$delete = $conn->prepare("DELETE FROM films WHERE films.NR = $movie_id");
			$delete->execute();
        }
	}