<?php
include('eveapi.php');
class Login {
	function __construct() {
		// Initialise MySQL connector
	}
	function login($user,$pass) {
		// Sanitise input and verify
		// Success: create session and set
		// Fail: fuck off and try again
	}
	function logout() {
		// Destroy session & cookies
	}
	function __destruct() {
		//kill MySQL connection
	}
}