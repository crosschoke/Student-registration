<?php
	class Helper{
		
		public static function defineErrorMessage($field){
			$message = "*Ошибка в поле ";
			switch($field){
				case "name":
					$f = '"Имя". Имя должно состоять только из букв русского или английского алфавита';
					break;
				case "surname":
					$f = '"Фамилия". Фамилия должна состоять только из букв русского или английского алфавита';
					break;
				case "group":
					$f = '"Номер группы". Номер группы состоит из 2-3 букв кириллицы, затем идет дефис и трехзначное число';
					break;
				case "email":
					$f = '"e-mail". Неверно указан электронный почтовый ящик';
					break;
				case "points":
					$f = '"Суммарные баллы ЕГЭ". Сумма не должна превышать 300';
					break;
				case "birth":
					$f = '"Год рождения". Дата указывается в формает d.m.y';
					break;
				default:
					return "";
			}
			$message = $message.$f;
			return $message;
		}
		
		public static function defineErrorField(){
			;
		}
		
		public static function defineErrorValue($field){
			;
		}
		
		public static function showStudentsList($mass,$page,$blockSize){
			$count = count($mass);
			$pageNumber = ceil($count / 25);
			if($page == $pageNumber)
				$max = $count;
			else
				$max = $page*$blockSize-1;
			if($page == 1)
				$min = 0;
			else
				$min = ($page-1) * $blockSize;
			
			for($i = $min; $i <= $max; $i++){
				$name = $mass[$i]["name"];
				$surname = $mass[$i]["surname"];
				$student_group = $mass[$i]["student_group"];
				$points = $mass[$i]["points"];
				echo '<div>';
				echo "<span class=\"name_column\">$name</span>";
				echo "<span class=\"surname_column\">$surname</span>";
				echo "<span class=\"group_column\">$student_group</span>";
				echo "<span class=\"points_column\">$points</span>";
				echo '</div>';
			}
		}
		
		
		public static function convertDateToSql($date){
		$regexp = "/[.]/";
		$parts = preg_split($regexp,$date);
		$result = $parts[2]."-".$parts[1]."-".$parts[0];
		return $result;
	}
	
		public static function convertDateFromSql($date){
			$regexp = "/[-]/";
			$parts = preg_split($regexp,$date);
			$result = $parts[2].".".$parts[1].".".$parts[0];
			return $result;
		}
	
		public static function getPostData(){
			global $name, $surname, $sex, $group, $email, $points, $birth, $location;
			$name = htmlspecialchars ($_POST["name"]);
			$surname = htmlspecialchars ($_POST["surname"]);
			$sex = htmlspecialchars ($_POST["sex"]);
			$group = htmlspecialchars ($_POST["group"]);
			$email = htmlspecialchars ($_POST["email"]);
			$points = htmlspecialchars ($_POST["points"]);
			$birth = htmlspecialchars ($_POST["birth"]);
			$location = htmlspecialchars ($_POST["location"]);
		}
		
		public static function getGetData(){
			global $name, $surname, $sex, $group, $email, $points, $birth, $location;
			$name = htmlspecialchars($_GET["name"]);
			$surname = htmlspecialchars($_GET["surname"]);
			$sex = htmlspecialchars($_GET["sex"]);
			$group = htmlspecialchars($_GET["group"]);
			$email = htmlspecialchars($_GET["email"]);
			$points = htmlspecialchars($_GET["points"]);
			$birth = htmlspecialchars($_GET["birth"]);
			$location = htmlspecialchars($_GET["location"]);
		}
		
		public static function preparePDO(){
			$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
			); 
			$pdo = new PDO("mysql:host=localhost;dbname=Students",root,"",$options);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		}
	}