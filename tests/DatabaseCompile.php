<?php
	require "../vendor/autoload.php";
	use \Joeybab3\Database\Wrapper as Database;
	
	$D = new Database("username","password","database");
	
	echo "Works";
	
	// Will show if there's syntax errors