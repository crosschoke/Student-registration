<?php
	if($_GET['notify'] == 'changed'){
		$notify = 'changed';
		include("redirectTemplate.html");
	}
	
	else if($_GET['notify'] == 'registered'){
		$notify = 'registered';
		include("redirectTemplate.html");
	}
	
	else if(isset($_POST['returnButton']))
		include('main.php');
	
	else include('main.php');