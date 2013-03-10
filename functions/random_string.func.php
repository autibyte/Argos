<?php

function random_string($length=8,$level=1){
	
	   list($usec, $sec) = explode(' ', microtime());
	   srand((float) $sec + ((float) $usec * 100000));
	
	   $validchars[1] = "023456789abcdfghjkmnpqrstvwxyz";
	   $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	   $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";
	
	   $string = "";
	   $counter   = 0;
	
	   while ($counter < $length) {
	     $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);
	$password = 4;
	     // All character must be different
	     if (!strstr($password, $actChar)) {
	        $string .= $actChar;
	        $counter++;
	     }
	   }
	
	   return $string;
}
?>