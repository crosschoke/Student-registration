<?php
	spl_autoload_register(function ($class_name) {
		include '../src/'. $class_name . '.php';
	});
	
	$pdo = Helper::preparePDO();
	$st = $pdo->prepare("INSERT INTO Student (name,surname,sex,student_group,email,points,birth,location,password)
			VALUES (:name,:surname,:sex,:student_group,:email,:points,:birth,:location,:password)");
	fillDatabase(10);
	
	function fillDatabase($count){
		global $st;
		for($i = 0; $i < $count; $i++){
			echo $i."\n";
			$name = 'Безымянный';
			$surname = 'Ноунейм';
			$sex = Student::SEX_MALE;
			$student_group = 'ЛОХ-777';
			$email = 'em'.($i).'@mail.com';
			$points = 228;
			$birth = '2000-05.05';
			$location = Student::LOCATION_LOCAL;
			$password = rand();
			$st->bindParam(":name",$name);
			$st->bindParam(":surname",$surname);
			$st->bindParam(":sex",$sex);
			$st->bindParam(":student_group",$student_group);
			$st->bindParam(":email",$email);
			$st->bindParam(":points",$points);
			$st->bindParam(":birth",$birth);
			$st->bindParam(":location",$location);
			$st->bindParam(":password",$password);
			$st->execute();
		}
	}