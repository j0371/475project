<?php
	require_once("session.php");
	require_once("included_functions.php");
    require_once("database.php");

    if (isset($_POST['Email'])){
        $_SESSION['Email'] = $_POST['Email'];
    }

	new_header("Online Game Store");
	$mysqli = Database::dbConnect();
	$mysqli -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	if (($output = message()) !== null) {
		echo $output;
    }

    $query0 = "SELECT name FROM customer WHERE email=?";
    $stmt0 = $mysqli->prepare($query0);
    $stmt0->execute([$_SESSION['Email']]);

    if($stmt0->rowCount() !== 0){

        $accName = $stmt0->fetch(PDO::FETCH_ASSOC)['name'];

        $query1 = "SELECT * FROM customer JOIN cOrder USING (CustomerID) JOIN order_game USING (orderID) JOIN game USING (gameID) WHERE email=? ORDER BY game.name ASC";

        $stmt1 = $mysqli->prepare($query1);
        $stmt1->execute([$_SESSION['Email']]);

        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Game Purchases for ".$accName."</h2>";

        if ($stmt1) {


            echo "<table>";
            echo "  <thead>";
            echo "    <tr><th>Your Games</th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
            echo "     <tr><th>Name</th><th>Developer</th><th>Genre</th><th>Multiplayer</th><th>Subscription Start</th><th>Subscription End</th><th></th>";
            echo "  </thead>";
            echo "  <tbody>";

            while($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";

                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['developer']."</td>";
                echo "<td>".$row['genre']."</td>";
                if($row['multiplayer']){
                    echo "<td>Yes</td>";
                }else{
                    echo "<td>No</td>";
                }
                if($row['startDate']){
                    echo "<td>".$row['startDate']."</td>";
                    echo "<td>".$row['endDate']."</td>";
                }else{
                    echo "<td>N/A</td>";
                    echo "<td>N/A</td>";
                }

								if($row['endDate']){
                	echo "<td><a href='subscriptionDelete.php?id=".urlencode($row["orderID"])."'>Cancel Subscription</a></td>";
								}

                echo "</tr>";
            }
            echo "  </tbody>";
            echo "</table>";
        }

        echo "</center>";
        echo "</div>";

        $query2 = "SELECT gameID, game.name as gName, developer, genre, multiplayer, price, monthly_price, GROUP_CONCAT(platform.name) as platformNames FROM game JOIN game_platform USING (gameID) JOIN platform USING (platformID) GROUP BY game.name ORDER BY game.name ASC";

        $stmt2 = $mysqli->prepare($query2);
        $stmt2->execute();

        echo "<div class='row'>";
        echo "<center>";
        echo "<h2>Purchase Games</h2>";

        if ($stmt2) {


            echo "<table>";
            echo "  <thead>";
            echo "    <tr><th>Purchasable Games</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>";
            echo "     <tr><th>Name</th><th>Developer</th><th>Genre</th><th>Platform(s)</th><th>Multiplayer</th><th>Price</th><th>Monthly Price</th><th></th>";
            echo "  </thead>";
            echo "  <tbody>";

            while($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
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
                echo "<td><a href=addGameToAccount.php?gameID=".$row['gameID'].">Buy</a></td>";

                echo "</tr>";
            }
            echo "  </tbody>";
            echo "</table>";
        }

        echo "<form action=editAccount.php>";
        echo "<input type=submit class='button tiny round' value='Edit Account Info' />";
        echo "</form>";

        echo "</center>";
        echo "</div>";

    }else{
        $_SESSION["message"] = "No Account found with that email";
				redirect("home.php");
    }

    echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>";

?>
