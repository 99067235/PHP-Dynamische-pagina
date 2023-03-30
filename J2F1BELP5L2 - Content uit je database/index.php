<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title>J2F1BELP5L2 - Content uit je database</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

	<!-- laad hier via php je header in (vanuit je includes map) -->


	<!-- Haal hier uit de URL welke pagina uit het menu is opgevraagd. Gebruik deze om de content uit de database te halen. -->


	<!-- Laat hier de content die je op hebt gehaald uit de database zien op de pagina. -->


	<!-- laad hier via php je footer in (vanuit je includes map)-->

	<?php
		include('includes/header.php');
		$servername = "localhost";
		$username = "root";
		$password = "mysql";
		$dbname = "databank_php";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		}

		$sql = "SELECT id, name, description, image FROM onderwerpen";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		// output data of each row
			$name = [];
			$description = [];
			$image = [];
			function exceptions_error_handler($severity, $message, $filename, $lineno) {
				if (error_reporting() == 0) {
					return;
				}
				if (error_reporting() & $severity) {
					throw new ErrorException($message, 0, $severity, $filename, $lineno);
				}
			}
			set_error_handler('exceptions_error_handler');
			if($_GET != null && $_GET != '') {
				try {
					while($row = $result->fetch_assoc()) {
						array_push($name, $row["name"]);
						array_push($description, $row["description"]);
						array_push($image, $row["image"]);
					}
					echo "<h1>". $name[$_GET["page"]]. "</h1>";
					echo "<p>". $description[$_GET["page"]]. "</p>";
					echo "<img class='mario' src=\"". $image[$_GET["page"]]. "\">";
				} catch(Exception $e) {
					echo "<div class='not-found'><img src='images/404.png'></div>";
				}
			} else {
				echo "<h1>Home</h1>";
				echo "<img class='homepage' src='images/thumbsup.png'>";
			}
		} else {
		echo "0 results";
		}
		$conn->close();
		include('includes/footer.php');
		set_error_handler(function ($err_severity, $err_msg, $err_file, $err_line, array $err_context)
		{
			throw new ErrorException( $err_msg, 0, $err_severity, $err_file, $err_line );
		}, E_WARNING);
		
		restore_error_handler();
	?>

</body>
</html>