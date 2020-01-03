<?php
require 'include/endecryption.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	/* print "<pre>";
	 print_r($_POST);
	 print "</pre>";
	 die('stop');
	 */
	$nonceValue = $_POST['enckey'];
	$Encryption = new Encryption();
	$username   = $Encryption->decrypt($_POST['username'], $nonceValue);
	$password   = $Encryption->decrypt($_POST['password'], $nonceValue);
	echo 'decrypted data: ' . $username . ' - ' . $password;
}