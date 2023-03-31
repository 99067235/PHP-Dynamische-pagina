<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Character - Bowser</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet"/>
</head>
<body>
<div id="container">
<a class="backbutton" href="index.php"><i class="fas fa-long-arrow-alt-left"></i> Terug</a></header>
<?php
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

$sql = "SELECT * FROM characters WHERE `id` =".$_GET["id"];
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<h1>". $row["name"] ."</h1>";
    ?>
        <div class="detail">
        <div class="left">
            <?php
            echo('<img class="avatar" src="resources/images/'.$row["avatar"].'">');
            ?>
            <div class="stats" style="background-color: yellowgreen">
                <ul class="fa-ul">
                    <?php
                        echo '<li><span class="fa-li"><i class="fas fa-heart"></i></span>'. $row["health"] .'</li>';
                        echo '<li><span class="fa-li"><i class="fas fa-fist-raised"></i></span>'. $row["attack"] .'</li>';
                        echo '<li><span class="fa-li"><i class="fas fa-shield-alt"></i></span>'. $row["defense"] .'</li>';
                    ?>
                </ul>
                <ul class="gear">
                    <?php
                    if ($row["weapon"] != NULL) {
                        echo "<li><b>Weapon</b>:". $row["weapon"] ."</li>";
                    }
                    if ($row["armor"] != NULL) {
                        echo "<li><b>Armor</b>:". $row["armor"] ."</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="right">
            <?php
            echo $row["bio"];
            ?>
        </div>
        <div style="clear: both"></div>
    </div>
    <?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>
</div>
<footer>&copy; Jurrian Schouten 2023</footer>
</body>
</html>