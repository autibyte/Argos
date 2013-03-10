<?php
class Controller{

	public $_name;
	private $_view;
	private $_ivars = array();
	public $_layout = LAYOUT;

	function __construct(){
		$this->_name = str_replace("Controller", "", get_called_class());
	}
	
	public function init(){

		foreach(get_object_vars($this)  as $var => $value){
				$this->_ivars[$var] = $value;
		}
		$this->_view = new View($this->_name, $this->_ivars);
		$this->_view->render($this->_layout);

	}
}
?>