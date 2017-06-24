<?php

	spl_autoload_register(function ($class_name) {
		include '../src/'. $class_name . '.php';
	});
		
	if(!isset($_COOKIE['student'])){	
		$flag = true;
		$token = rand();
		setcookie('student',$token,time() + 60*60*60);
	}
	else{
		$flag = false;
		$token = $_COOKIE['student'];
		setcookie('student',$token, time() + 60*60*60);
		
		$errorField = $_GET['errorField'];
		
		if($errorField == null){
			$pdo = Helper::preparePDO();
			$db = new StudentTableGateway($pdo);
			$result = $db->getStudent($token);
			
			$name = $result->name;
			$surname = $result->surname;
			$sex = $result->sex;
			$group = $result->student_group;
			$email = $result->email;
			$points = $result->points;
			$birth = Helper::convertDateFromSql($result->birth);
			$location = $result->location;
			
			$pdo = null;
		}
		else{
			Helper::getGetData();
			$errorMessage = Helper::defineErrorMessage($errorField);
		}
	}
	
	include('registerTemplate.html');
	
	$create = $_POST['create'];
	$edit = $_POST['edit'];
	
	if($create != null || $edit != null){
		Helper::getPostData();
		$error = Validator::validate($name,$surname,$sex,$group,$email,$points,$birth,$location);
		if($error != "OK"){
			echo "<meta http-equiv=\"refresh\" content=\"0;URL=register.php?errorField=$error&name=$name&
			surname=$surname&sex=$sex&group=$group&email=$email&points=$points&birth=$birth&location=$location\">";
		}
		else{
			$birth = Helper::convertDateToSql($birth);
			$student = new Student($name,$surname,$sex,$group,$email,$points,$birth,$location,$token);
			$pdo = Helper::preparePDO();
			$db = new StudentTableGateway($pdo);
			
			if($create != null){
				$db->addStudent($student);
				$pdo = null;
				echo '<meta http-equiv="refresh" content="0;URL=index.php?notify=registered">';
			}
			else{
				$db->editStudent($student);
				$pdo = null;
				echo '<meta http-equiv="refresh" content="0;URL=index.php?notify=changed">';
			}
		}
	}
