<?php
class Student
{
	const SEX_MALE = "мужской";
	const SEX_FEMALE = "женский";
	const LOCATION_LOCAL = "местный";
	const LOCATION_NONRESIDENT = "иногородний";
	private $name;
	private $surname;
	private $sex;
	private $student_group;
	private $email;
	private $points;
	private $birth;
	private $location;
	private $password;
	
	function getName(){
		return $this->name;
	}
	
	function getSurname(){
		return $this->surname;
	}
	
	function getGroup(){
		return $this->student_group;
	}
	
	function getSex(){
		return $this->sex;
	}
	
	function getEmail(){
		return $this->email;
	}
	
	function getPoints(){
		return $this->points;
	}
	
	function getBirth(){
		return $this->birth;
	}
	
	function getLocation(){
		return $this->location;
	}
	
	function getPassword(){
		return $this->password;
	}
	
	function setPassword($password){
		$this->password = $password;
	}
	
	function __construct($name,$surname,$sex,$student_group,$email,$points,$birth,$location,$password){
		$this->name = $name;
		$this->surname = $surname;
		$this->sex = $sex;
		$this->student_group = $student_group;
		$this->email = $email;
		$this->points = $points;
		$this->birth = $birth;
		$this->location = $location;
		$this->password = $password;
	}
}
?>