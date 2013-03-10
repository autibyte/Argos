<?php
/**
 * 	Replace <, >, &, quotes, etc with appropriate entites
**/
function clean_string($string){
	$string = stripslashes($string);
	return htmlentities($string, ENT_QUOTES);
}
function clean_array($array){
	$i = 0;
	foreach($array as $string){
		$array[$i] = clean_string($string);
		$i++;
	}
}
if(function_exists('lcfirst') === false) {
    function lcfirst($str) {
        $str[0] = strtolower($str[0]);
        return $str;
    }
}
function camel_case_to_underscore($string){
	return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
}
function var_contains_string($string, $var){
	return (is_array($var)) ? in_array($string, $var) : strstr($var, $string); 
}

?>