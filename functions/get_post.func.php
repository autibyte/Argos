<?php
function getv($variable){
	if(empty($_GET[$variable])){
		return false;
	}
	else{
		return clean_string($_GET[$variable]);
	}
}

function postv($variable){
	if(empty($_POST[$variable])){
		return false;
	}
	else{
		return clean_string($_POST[$variable]);
	}
}
function has_session(){
	if(empty($_COOKIE[TOKEN])){
		return false;
	}
	else{
		return true;
	}
}
function gets($variable){
	return isset($_GET[$variable]) ? true : false;
}
function posts($variable){
	return isset($_POST[$variable]) ? true : false;
}
function get($key, $value=""){
	$_GET[$key] = $value;
}
function post($key, $value=""){
	$_POST[$key] = $value;
}
?>