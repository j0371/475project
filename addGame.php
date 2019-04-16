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

	echo "<h3>Add A Game</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["Name"]) && $_POST["Name"] !== "") && (isset($_POST["Developer"]) && $_POST["Developer"] !== "") &&(isset($_POST["Genre"]) && $_POST["Genre"] !== "") &&(isset($_POST["Multiplayer"]) && $_POST["Multiplayer"] !== "") &&(isset($_POST["Price"]) && $_POST["Price"] !== "")) {

					$query = "INSERT INTO game(`name`, developer, genre, multiplayer, price, monthly_price) VALUES(?,?,?,?,?,?)";

                    $stmt = $mysqli->prepare($query);

                    if($_POST['mPrice'] == ""){
					    $stmt -> execute([$_POST['Name'], $_POST['Developer'], $_POST['Genre'], $_POST['Multiplayer'], $_POST['Price'], NULL]);
                    }else{
                        $stmt -> execute([$_POST['Name'], $_POST['Developer'], $_POST['Genre'], $_POST['Multiplayer'], $_POST['Price'], $_POST['mPrice']]);
                    }

                    if($_POST['windows']){
                        $query1 = "INSERT INTO game_platform(gameID, platformID) VALUES((SELECT MAX(gameID) FROM game), (SELECT platformID FROM platform WHERE `name` = 'windows'))";
                        $stmt1 = $mysqli->prepare($query1);
                        $stmt1->execute();
                    }if($_POST['mac']){
                        $query1 = "INSERT INTO game_platform(gameID, platformID) VALUES((SELECT MAX(gameID) FROM game), (SELECT platformID FROM platform WHERE `name` = 'mac'))";
                        $stmt1 = $mysqli->prepare($query1);
                        $stmt1->execute();
                    }if($_POST['linux']){
                        $query1 = "INSERT INTO game_platform(gameID, platformID) VALUES((SELECT MAX(gameID) FROM game), (SELECT platformID FROM platform WHERE `name` = 'linux'))";
                        $stmt1 = $mysqli->prepare($query1);
                        $stmt1->execute();
                    }
                    
					if($stmt){
						$_SESSION['message'] = $_POST['Name']." has been added";
					}else{
						$_SESSION['message'] = "Error! Could not add game";
					}

					redirect("adminView.php");

		}
		else {
				$_SESSION["message"] = "Unable to add game. Fill in all required information!";
				redirect("addGame.php");
		}
	}
	else {

		echo "<form method='POST' action='addGame.php'>

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

		<input type='submit' value='Add Game' name='submit' class='button tiny round' />

		</form>";

				
	}
	echo "</label>";
	echo "</div>";
    
    Database::dbDisconnect();

	?>