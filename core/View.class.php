<?php
class View{

	private $_path;
	private $_ivars = array();

	function __construct($name, $ivars=false){
		$this->_path = BASE . "app/views/" . $name . ".html.php";
		if($ivars!=false){
			$this->_ivars = $ivars;
		}
	}

	public function render($layout=false){

		$view = $this;

		foreach($this->_ivars as $var => $value){
			$$var = $value;
		}

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
}
?>