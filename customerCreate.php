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

	echo "<h3>Create new customer account</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["Email"]) && $_POST["Email"] !== "") && (isset($_POST["Name"]) && $_POST["Name"] !== "") &&(isset($_POST["Address"]) && $_POST["Address"] !== "")){

                    $query1 = "SELECT * FROM customer WHERE email=?";

                    $stmt1 = $mysqli->prepare($query1);

                    $stmt1 -> execute([$_POST['Email']]);

                    if($stmt1->rowCount() === 0){

                        $query2 = "INSERT INTO customer(email, `name`, `address`) VALUES(?,?,?)";

                        $stmt2 = $mysqli->prepare($query2);		
                        
                        $stmt2 -> execute([$_POST['Email'], $_POST['Name'], $_POST['Address']]);
                        
                        if($stmt2){
                            $_SESSION['message'] = $_POST['Email']." "." has been added";
                        }else{
                            $_SESSION['message'] = "Error! Could not add account";
                        }

                        redirect("home.php");
                    
                    }else{
                        $_SESSION["message"] = "Unable to create account. That email is already in use.";
                        redirect("customerCreate.php"); 
                    }


		}
		else {
				$_SESSION["message"] = "Unable to add person. Fill in all information!";
				redirect("customerCreate.php");
		}
	}
	else {

		echo "<form method='POST' action='customerCreate.php'>

		<p>Email:<input type=text name='Email' /></p>
		<p>Name:<input type=text name='Name' /></p>
		<p>Address:<input type=text name='Address' /></p>

		<input type='submit' value='Create Account' name='submit' class='button tiny round' />

		</form>";

				
	}
	echo "</label>";
	echo "</div>";
    echo "<br /><p>&laquo:<a href='home.php'>Back to Main Page</a>";
	
	Database::dbDisconnect();

	?>