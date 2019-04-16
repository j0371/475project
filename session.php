<?php

	session_start();
	
	function message() {
		if (isset($_SESSION["message"])) {
			
			$output = "<div class='row'>";
			$output .= "<div data-alert class='alert-box info round'>";
			$output .= htmlentities($_SESSION["message"]);
			$output .= "</div>";
			$output .= "</div>";
			
			// clear message after use
			$_SESSION["message"] = null;
			
			return $output;
		}
		else {
			return null;
		}
	}

	function errors() {
		if (isset($_SESSION["errors"])) {
			$errors = $_SESSION["errors"];
			
			// clear message after use
			$_SESSION["errors"] = null;
			
			return $errors;
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
//  Step 7.     Write the function try_login which will need to be invoked in each of the webpages
//              for the Who's Who site	
	function verify_login() {
		if(!isset($_SESSION["admin_id"])&& $_SESSION["admin_id"] === NULL) {
			$_SESSION["message"] = "You must login in first!";
			header("Location: index.php");
			exit;
		}
	}
	
///////////////////////////////////////////////////////////////////////////////////////////////////	
	
?>