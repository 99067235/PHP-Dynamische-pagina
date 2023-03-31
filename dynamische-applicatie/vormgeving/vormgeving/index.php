<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Characters</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="resources/css/style.css" rel="stylesheet"/>
</head>
<body>
<div id="container">

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

    $sql = "SELECT * FROM characters";
    $result = $conn->query($sql);
    $rowcount = mysqli_num_rows( $result );
    
    echo "<h1>Alle ". $rowcount ." characters uit de database</h1>";
    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo('<a class="item" href="character.php?id='.$row["id"].'">');
        ?>
        <div class="left">
            <?php
            echo '<img class="avatar" src="resources/images/'. $row['avatar'] .'">';
            ?>
        </div>
        <div class="right">
            <?php
            echo "<h2>". $row["name"] ."</h2>";
            ?>
            <div class="stats">
                <ul class="fa-ul">
                    <?php
                    echo '<li><span class="fa-li"><i class="fas fa-heart"></i></span>'. $row["health"] .'</li>';
                    echo '<li><span class="fa-li"><i class="fas fa-fist-raised"></i></span>'. $row["attack"] .'</li>';
                    echo '<li><span class="fa-li"><i class="fas fa-shield-alt"></i></span>'. $row["defense"] .'</li>';
                    ?>
                </ul>
            </div>
        </div>
        <div class="detailButton"><i class="fas fa-search"></i> bekijk</div>
    </a>
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