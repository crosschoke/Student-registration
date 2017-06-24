<?php
	spl_autoload_register(function ($class_name) {
		include '../src/'. $class_name . '.php';
	});
	
	$pdo = Helper::preparePDO();
	$db = new StudentTableGateway($pdo);
	$pageSize = 25;
	
	if(!isset($_GET['page']))
		$page = 1;
	else
		$page = htmlspecialchars($_GET['page']);
	
	if(isset($_POST['find'])){
		$word = htmlspecialchars($_POST['find_word']);
		$students = $db->getFoundStudents($word);		
	}
	else{
		$students = $db->getStudentsList();
	}
	
	$count = count($students);
	$pageNumber = ceil($count / 25);
	
	include('mainTemplate.html');