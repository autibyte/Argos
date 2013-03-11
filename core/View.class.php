<?php
class View{

	public $app;

	private $_path;
	private $_ivars = array();

	function __construct($name, $ivars=false, $controller=false){

		$this->_path = self::file_location($name, $controller);

		if($ivars!=false){
			$this->_ivars = $ivars;
		}

	}

	public function render($layout=false){

		$view = $this;

		foreach($this->_ivars as $var => $value){
			$$var = $value;
		}

		$app = $this->app;

		if(!file_exists($this->_path)){
				trigger_error("Couldn't show view, file '" . $this->_path . "' did not exist.");
		}

		if($layout==false){
			include_once($this->_path);
		}
		else{
			$layout_path = BASE . "app/layouts/" . $layout . ".html.php";
			if(!file_exists($layout_path)){
				trigger_error("Couldn't display page, layout '" . $layout . "' doesn't exist.");
			}
			else{
				include_once(BASE . "app/layouts/" . $layout . ".html.php");
			}
		}
	}

	public function yield(){
		$this->render();
	}

	public static function file_location($name, $controller){
		$location = BASE . "app/views/";
		if($controller!=false)
			$location .= $controller . "/";
		return $location . ucfirst($name) . ".html.php";
	}
}
?>