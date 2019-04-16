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
    
    $query0 = "SELECT * FROM game WHERE gameID = ?";
    $stmt0 = $mysqli->prepare($query0);
    if(isset($_POST['gameID'])){
        $stmt0 -> execute([$_POST['gameID']]);
    }else{
        $stmt0 -> execute([$_GET['gameID']]);
    }

    $row0 = $stmt0->fetch(PDO::FETCH_ASSOC);

    if(isset($_POST['start']) && $_POST['start'] !== "" && isset($_POST['end']) && $_POST['end'] !== ""){
        
        $startYear = date("y", strtotime($_POST['start']));
        $endYear = date("y", strtotime($_POST['end']));
        $startMonth = date("n", strtotime($_POST['start']));
        $endMonth = date("n", strtotime($_POST['end']));

        $cost = $row0['price'] + ($row0['monthly_price'] * (($endYear*12 + $endMonth) - ($startYear*12 + $startMonth)));

        $query1 = "INSERT INTO cOrder(CustomerID, Cost, orderDate) VALUES((SELECT customerID FROM customer WHERE email=?), ?, CURDATE())";
        $stmt1 = $mysqli->prepare($query1);
        $stmt1 -> execute([$_SESSION['Email'], $cost]);

        $query2 = "INSERT INTO order_game(orderID, gameID, startDate, endDate) VALUES((SELECT MAX(orderID) FROM cOrder), ?, ?, ?)";
        $stmt2 = $mysqli->prepare($query2);
        $stmt2 -> execute([$row0['gameID'], $_POST['start'], $_POST['end']]);

        redirect("customerView.php");

    }elseif(isset($_POST['start']) && isset($_POST['end'])){
        $_SESSION["message"] = "Please fill in all information";
        redirect("customerView.php");
    }elseif($row0['monthly_price'] === NULL){

        $query1 = "INSERT INTO cOrder(CustomerID, Cost, orderDate) VALUES((SELECT customerID FROM customer WHERE email=?), ?, CURDATE())";
        $stmt1 = $mysqli->prepare($query1);
        $stmt1 -> execute([$_SESSION['Email'], $row0['price']]);

        $query2 = "INSERT INTO order_game(orderID, gameID) VALUES((SELECT MAX(orderID) FROM cOrder), ?)";
        $stmt2 = $mysqli->prepare($query2);
        $stmt2 -> execute([$row0['gameID']]);

        redirect("customerView.php");

    }else{

        echo "<div class='row'>";
        echo "<center>";
        echo "<h4>This game requires a subscription</h2>";
        echo "<h6>Please input the start and end date for your subscription<hr />";

        echo "<form method=POST action=addGameToAccount.php>";

        echo "<input type=hidden name=gameID value=".$_GET['gameID']." />";
        echo "Start Date:<input type=date name=start />";
        echo "End Date:<input type=date name=end />";

        echo "<input type=submit name=submit value='Buy' class='button tiny round' />";

        echo "</form>";
        
        echo "</center>";
        echo "</div>";
    }
	
	Database::dbDisconnect();

	?>