<?php
/**
 * The File class is just for convenience- to easily get the correct file paths
 * for controllers, models, views, and resources (like CSS, JS, etc)
**/
class File{
	
	public static function controller($controller){
		return APP_DIR . "app/controllers/" . $controller . "Controller" . ".php";
	}
	
	public static function module_base_controller($module){
		return APP_DIR . "app/controllers/" . $module . "/IndexController" . ".php";
	}
	
	public static function model($model){
		return APP_DIR . "app/models/" . $model . ".class" . ".php";
	}
	
	public static function view($view,$data=false,$folder=false){
		$file_path = APP_DIR . "app/views/" . $view . "View" . ".php";
		$folder_path = APP_DIR . "app/views/" . $folder . "/" . $view . "View" . ".php";
		return !$folder ? $file_path : $folder_path;
	}
	
	/**
	 * Resources should have the same file extension as their parent folder-
	 * otherwise, they should just be loaded in manually.
	**/
	public static function res($res,$dir="php"){
		if($dir=="php"){
			return APP_DIR . "lib/partials/" . $res . ".php";
		}
		else{
			return APP_DIR . "res/" . $dir . "/" . $res . "." . $dir;
		}
	}

	public static function image($file_path){
		return APP_DIR . "res/images/" . $file_path;
	}
	
	public static function layout($layout){
		$layout = ucwords($layout);
		return APP_DIR . "app/layouts/" . $layout . ".php";
	}
}
?>