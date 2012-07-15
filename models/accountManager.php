<?php
include("includes/app.php");
	class UserAccount {
		var $keyID;
		var $vcode;
		function listAccountChars() {
			/* 
			 * 1. Select associated characters and get charIDs from DB
			 * 2. Run query to get net worth from cached data/live info (in ecapi.php)
			 * 3. Return list of characters with names, order count and net worth.
			 */
		}
		function addChar($charID) {
			$a = new Account($this->keyID,$this->vcode);
		}
	}