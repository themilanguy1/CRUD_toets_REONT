<?php
	
	/**
	 * Class Utility
	 */
	class Utility
	{
		/**
		 * @param string $servername
		 * @param string $username
		 * @param null $password
		 * @return PDO
		 *
		 *  Connects Server to database using PDO.
		 */
		public static function pdoConnect($servername = "localhost", $username = "root", $password = NULL)
		{
			try {
				$conn = new PDO("mysql:host=$servername;dbname=filmdatabase", $username, $password);
				// set the PDO error mode to exception
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Connection failed: " . $e->getMessage();
				$conn = null;
			}
			return $conn;
		}
		
		/**
		 * @param $id_column
		 *  string Name of id column in table.
		 * @param $table
		 *  string Name of table in database.
		 * @return int|mixed
		 *
		 * Returns appropriate new id for table.
		 */
		public static function GetNewSqlId($id_column, $table)
		{
			$conn = self::PDOConnect();
			$sql = $conn->query("SELECT COUNT($id_column) FROM $table")->fetchColumn();
			
			if ($sql >= 1) {
				$new_id = $conn->query("SELECT MAX($id_column) + 1 FROM $table")->fetchColumn();
			} else {
				// no entries in this table yet.
				$new_id = 1;
			}
			return $new_id;
		}
		
		
		/**
		 * Generates dropdown for directory select in form.
		 */
		public static function generateDirectorDropdown()
		{
			$conn = Utility::pdoConnect();
			
			$sql = $conn->prepare("SELECT * FROM regisseurs");
			$sql->execute();
			
			$result = $sql->fetchAll();
			
			foreach ($result as $row) {
				echo "<option value=" . $row['NR'] . ">" . $row['VOORNAAM'] . " " . $row['ACHTERNAAM']
					. "</option>";
			}
		}
	}