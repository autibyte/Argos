<?php
/**
 * The Load class is just like the File class, but requires files instead of
 * providing their paths. This is for semantic purposes- that is:
 *
 * 		File::model("Object") *returns* the file path for the Object model, and
 * 		Load::model("Object") *requires* the Object model via it's file path.
 *
 * Additionally, this class provides additional functionality, like view layouts.
**/
class Load extends File{
	
	public static function controller($controller,$data=false,$app=false,$module_page=false){
		
		// Controllers are called lowercase, but the files are uppercase
		$controller = ucwords($controller);
		
		// There's just a view
		if(file_exists(parent::view($controller))&&!file_exists(parent::controller($controller))){
			self::view($controller,$data);
		}
		
		// We're using a module
		else if($module_page!=false&&file_exists(parent::module_base_controller($controller))){
			require(parent::module_base_controller($controller));
		}
		
		// It's a regular view/controller situation
		
		else if(file_exists(parent::controller($controller))){
			require(parent::controller($controller));
		}
		
		// Is there no controller AND no view?
		else{
			// We'll let the 404 page know what controller was requested
			$message['404_error'] = "File did not exist: " . parent::controller($controller);
			self::view("Error",$message, ERROR_LAYOUT); 
		}
	}
	
	public static function model($model){
		$model = ucwords($model);
		require(parent::model($model));
	}
	
	public static function models($models_array){
		foreach($models_array as $model){
			self::model($model);
		}
	}
	
	public static function view($view,$data=false,$layout=DEFAULT_LAYOUT){
	
		// We'll make sure the views are uppercase, as they might be lowercase
		$view = ucwords($view);
		
		// This is the path of the view being included- layouts need this
		
		$view_path = parent::view($view);
		
		if(!$layout){
			require($view_path);
		}
		else{
			require(parent::layout($layout));
		}
		
	}
	
	public static function module_view($module, $view, $data=false, $layout=DEFAULT_LAYOUT){
		
		$module = ucwords($module);
		
		$view = ucwords($view);
		
		$view_path = APP_DIR . "app/views/" . $module . "/" . $view . "View.php";
		
		if(!$layout){
			require($view_path);
		}
		else{
			require(parent::layout($layout));
		}
		
	}
	
	/*
	* Shortcut to including PHP partials
	*/
	public static function partial($filename,$dir=false,$data=false,$path_only=false){
		if(!$dir){
			$path = parent::res($filename);
		}else{
			$path = APP_DIR . "res/php/" . $dir . "/" . $filename . ".php";
		}
		
		if($path_only){
			return $path;
		}
		else{
			require($path);
		}
	}
	
}
?>