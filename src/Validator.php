<?php
class Validator{

    private function checkName($name){
		if($name == "")
			return false;
        $length = strlen($name);
        if($length > 30)
            return false;
        for($i = 0; $i < $length;$i++){
            if(is_numeric($name[$i]))
                return false;
        }
		return true;
    }
	
	private function checkSex($sex){
		if($sex == "мужской" || $sex == "женский")
			return true;
		else
			return false;
	}
	
	private function checkGroup($group){
		$regexp = "/^[а-яёА-ЯЁ]{2,3}-[0-9]{3}$/u";
		if(preg_match($regexp,$group))
			return true;
		else 
			return false;
	}
	
	private function checkEmail($email){
		$regexp = "/^[a-zA-z0-9]{2,20}@[a-zA-Z]{3,10}[.][a-zA-Z]{2,3}$/";
		if(preg_match($regexp,$email))
			return true;
		else 
			return false;
	}
	
	private function checkPoints($points){
		if(is_numeric($points) && ($points >=0 && $points <= 300))
			return true;
		else
			return false;
	}
	
	private function checkBirth($birth){
		$regexp = "/[.]/";
		$parts = preg_split($regexp,$birth);
		if(count($parts) != 3)
			return false;
		return checkdate($parts[1],$parts[0],$parts[2]);
	}
	
	private function checkLocation($location){
		if($location == "местный" || $location == "иногородний")
			return true;
		else
			return false;
	}

	public static function validate($name,$surname,$sex,$group,$email,$points,$birth,$location){
        if(self::checkName($name) == false)
            return "name";
		if(self::checkName($surname) == false)
			return "surname";
		if(self::checkSex($sex) == false)
			return "sex";
		if(self::checkGroup($group) == false)
			return "group";
		if(self::checkEmail($email) == false)
			return "email";
		if(self::checkPoints($points) == false)
			return "points";
		if(self::checkBirth($birth) == false)
			return "birth";
		if(self::checkLocation($location) == false)
			return "location";
		
		return "OK";
	}
}
