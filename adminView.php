<?php
	require_once("session.php");
	require_once("included_functions.php");
	require_once("database.php");

	new_header("Online Game Store");
	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
	}

	$query = "SELECT gameID, game.name as gName, developer, genre, multiplayer, price, monthly_price, GROUP_CONCAT(platform.name) as platformNames FROM game JOIN game_platform USING (gameID) JOIN platform USING (platformID) GROUP BY game.name ORDER BY game.name ASC";

	$stmt = $mysqli->prepare($query);
	$stmt->execute();

	if ($stmt) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Edit the Game Store</h2>";
		echo "<table>";
		echo "  <thead>";
		echo "    <tr><th>Name</th><th>Developer</th><th>Genre</th><th>Platform(s)</th><th>Multiplayer</th><th>Price</th><th>Monthly Price</th><th></th><th></th>";
		echo "  </thead>";
		echo "  <tbody>";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";

            echo "<td>".$row['gName']."</td>";
            echo "<td>".$row['developer']."</td>";
            echo "<td>".$row['genre']."</td>";
            echo "<td>".$row['platformNames']."</td>";
            if($row['multiplayer']){
                echo "<td>Yes</td>";
            }else{
                echo "<td>No</td>";
            }
            echo "<td>$".$row['price']."</td>";
            if($row['monthly_price']){
                echo "<td>$".$row['monthly_price']."</td>";
            }else{
                echo "<td>N/A</td>";
            }
            echo "<td><a href=>Edit</a></td>";
            echo "<td><a href='gameDelete.php?id=".urlencode($row["gameID"])."'>Delete</a></td>";

            echo "</tr>";
        }
		echo "  </tbody>";
		echo "</table>";
        echo "<br /><br />";
        echo "<form action=addGame.php><input type=submit value='Add Game' class='button tiny round' /></form>";
		echo "</center>";
		echo "</div>";
    }

    echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>";

	Database::dbDisconnect();
 ?>
