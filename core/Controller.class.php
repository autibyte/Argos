<?php
class Controller{

	public $app;
	public $_name;
	public $_layout = ARGOS_DEFAULT_LAYOUT;

	private $_view;
	private $_ivars = array();

	function __construct(){
		$this->_name = str_replace("Controller", "", get_called_class());
	}
	
	public function start(){

		foreach(get_object_vars($this)  as $var => $value){
				$this->_ivars[$var] = $value;
		}

		// dirty way to get the name of the called method
		// I feel like cleaning my keyboard after this
		$called_function_backtrace = debug_backtrace();
		$method_name = $called_function_backtrace[1]['function'];

		$this->_view = new View($method_name, $this->_ivars, strtolower($this->_name));
		$this->_view->app = $this->app;
		$this->_view->render($this->_layout);

	}

	public static function file_location($name){
		return BASE . "app/controllers/" . $name . ".php";
	}

	public static function class_name($name){
		return ucwords($name) . "Controller";
	}
}
?>