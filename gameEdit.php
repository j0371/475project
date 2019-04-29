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

	echo "<h3>Edit A Game</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"]) ) {

		if($_POST["windows"] || $_POST["mac"] || $_POST["linux"]){

		if (isset($_POST["Name"]) && $_POST["Name"] !== "") {
			$query = "UPDATE game SET name = (?) WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Name"], $_POST["id"]]);
		}

		if (isset($_POST["Developer"]) && $_POST["Developer"] !== "") {
			$query = "UPDATE game SET developer = (?) WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Developer"], $_POST["id"]]);
		}

		if (isset($_POST["Genre"]) && $_POST["Genre"] !== "") {
			$query = "UPDATE game SET genre = (?) WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Genre"], $_POST["id"]]);
		}

		if ($_POST["Multiplayer"] === "yes") {
			$query = "UPDATE game SET multiplayer = true WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
		}else{
			$query = "UPDATE game SET multiplayer = false WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
		}

		if (isset($_POST["Price"]) && $_POST["Price"] !== "") {
			$query = "UPDATE game SET price = (?) WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Price"], $_POST["id"]]);
		}

		if (isset($_POST["mPrice"]) && $_POST["mPrice"] !== "") {
			$query = "UPDATE game SET monthly_price = (?) WHERE gameID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["mPrice"], $_POST["id"]]);
		}


		if ($_POST["windows"]) {
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 1";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] === null){
				$query = "INSERT INTO game_platform (gameID, platformID) VALUES (?,1)";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}else{
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 1";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] !== null){
				$query = "DELETE FROM game_platform WHERE  gameID = ? and platformID = 1";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}

		if ($_POST["mac"]) {
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 2";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] === null){
				$query = "INSERT INTO game_platform (gameID, platformID) VALUES (?,2)";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}else{
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 2";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] !== null){
				$query = "DELETE FROM game_platform WHERE  gameID = ? and platformID = 2";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}

		if ($_POST["linux"]) {
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 3";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] === null){
				$query = "INSERT INTO game_platform (gameID, platformID) VALUES (?,3)";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}else{
			$query = "SELECT platformID FROM game_platform WHERE gameID = ? and platformID = 3";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["id"]]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if($row["platformID"] !== null){
				$query = "DELETE FROM game_platform WHERE  gameID = ? and platformID = 3";
				$stmt = $mysqli->prepare($query);
				$stmt->execute([$_POST["id"]]);
			}
		}
	}else{
		$_SESSION["message"] = "Select a platform.";
	}



		redirect("adminView.php");

	}else {
		echo "<form method='POST' action='gameEdit.php'>

		<p><input type=hidden name=id value=".$_GET["id"]."></p>
		<p>Name:<input type=text name='Name' /></p>
        <p>Developer:<input type=text name='Developer' /></p>
        <p>Genre:<input type=text name='Genre' /></p>
        <p>Platforms: <input type=checkbox name=windows />Windows
                      <input type=checkbox name=mac />Mac
                      <input type=checkbox name=linux />Linux

        <p>multiplayer:<select name='Multiplayer'/></p>
        <option value=no>No</option>
        <option value=yes>Yes</option>
        </select>

		<p>Price:<input type=number step=.01 name='Price' /></p>
		<p>Monthly Price:<input type=number step=.01 name=mPrice placeholder=Optional /></p>

		<input type='submit' value='Edit Game' name='submit' class='button tiny round' />

		</form>";


	}
	echo "</label>";
	echo "</div>";
$stmt->close();
    Database::dbDisconnect();

	?>
