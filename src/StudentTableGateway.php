<?php
	class StudentTableGateway{
		
		private $pdo;
		
		public function __construct(PDO $pdo){
			$this->pdo = $pdo;
		}
		
		public function getStudent($password){
			$st = $this->pdo->prepare("SELECT name,surname,sex,student_group,email,points,birth,location FROM Student where password=?");
			$st->execute(array($password));
			$result = $st->fetch(PDO::FETCH_OBJ);
			return $result;
		}
		
		public function getFoundStudents($word){
			$st = $this->pdo->prepare("SELECT name,surname,student_group,points FROM Student WHERE (name LIKE ?)
			|| (surname LIKE ?) || (student_group LIKE ?) || (points LIKE ?)");
			$st->execute(array("%$word%","%$word%","%$word%","%$word%"));
			$result = $st->FetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		public function getStudentsList(){
			$st = $this->pdo->query("SELECT name,surname,student_group,points FROM Student");
			$result = $st->FetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		
		public function addStudent(Student $student){
			$st = $this->pdo->prepare("INSERT INTO Student (name,surname,sex,student_group,email,points,birth,location,password)
			VALUES (:name,:surname,:sex,:student_group,:email,:points,:birth,:location,:password)");
			$st->bindParam(":name",$name);
			$st->bindParam(":surname",$surname);
			$st->bindParam(":sex",$sex);
			$st->bindParam(":student_group",$student_group);
			$st->bindParam(":email",$email);
			$st->bindParam(":points",$points);
			$st->bindParam(":birth",$birth);
			$st->bindParam(":location",$location);
			$st->bindParam(":password",$password);
			$name = $student->getName();
			$surname = $student->getSurname();
			$sex = $student->getSex();
			$student_group = $student->getGroup();
			$email = $student->getEmail();
			$points = $student->getPoints();
			$birth = $student->getBirth();
			$location = $student->getLocation();
			$password = $student->getPassword();
			$st->execute();	
		}
		
		public function editStudent(Student $student){
			$st = $this->pdo->prepare("UPDATE Student SET name=:name,surname=:surname,sex=:sex,student_group=:student_group,
			email=:email,points=:points,birth=:birth,location=:location WHERE password=:password");
			$st->bindParam(":name",$name);
			$st->bindParam(":surname",$surname);
			$st->bindParam(":sex",$sex);
			$st->bindParam(":student_group",$student_group);
			$st->bindParam(":email",$email);
			$st->bindParam(":points",$points);
			$st->bindParam(":birth",$birth);
			$st->bindParam(":location",$location);
			$st->bindParam(":password",$password);
			$name = $student->getName();
			$surname = $student->getSurname();
			$sex = $student->getSex();
			$student_group = $student->getGroup();
			$email = $student->getEmail();
			$points = $student->getPoints();
			$birth = $student->getBirth();
			$location = $student->getLocation();
			$password = $student->getPassword();
			$st->execute();	
		}
	}
	