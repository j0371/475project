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

echo $_GET["id"];
	echo "<h3>Edit Your Account</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {


		if (isset($_POST["Name"]) && $_POST["Name"] !== "") {
			$query = "UPDATE customer SET name = (?) WHERE customerID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Name"], $_POST["id"]]);
		}

		if (isset($_POST["Email"]) && $_POST["Email"] !== "") {
			$query = "UPDATE customer SET email = (?) WHERE customerID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Email"], $_POST["id"]]);
		}

		if (isset($_POST["Address"]) && $_POST["Address"] !== "") {
			$query = "UPDATE customer SET address = (?) WHERE customerID = (?)";
			$stmt = $mysqli->prepare($query);
			$stmt->execute([$_POST["Address"], $_POST["id"]]);
		}



		//redirect("adminView.php");

	}else {

		echo "<form method='POST' action='customerEdit.php'>

		<p><input type=hidden name=id value=".$_POST["id"]."></p>
		<p>Email:<input type=text name='Email' /></p>
		<p>Name:<input type=text name='Name' /></p>
		<p>Address:<input type=text name='Address' /></p>

		<input type='submit' value='Create Account' name='submit' class='button tiny round' />

		</form>";


	}

	echo "</label>";
	echo "</div>";
$stmt->close();
    Database::dbDisconnect();

	?>
