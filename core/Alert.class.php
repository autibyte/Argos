<?php
/**
 * Alert class- used to display alert messages across the site.
 */
class Alert{

	var $title;
	var $message;
	var $type;
	var $close;

	const CLOSE = '<a class="close" data-dismiss="alert" href="#">×</a>';
	const BLOCK_START = '<h4 class="alert-heading">';
	const BLOCK_END = '</h4>';
	const INLINE_START = '<span class="bold">';
	const INLINE_END = '</span>';
	const SPACE = ' ';
	const CLASS_DELIMITER = ' alert-';

	function __construct($title="", $message=""){
		$this->title = clean_string($title);
		$this->message = $message;
	}

	public function show($type, $close=true){
		echo '<div class="alert ' . $this->type($type) . '" data-alert="alert">';
		echo $this->close($close) . $this->title() . $this->message() . '</div>';
	}

	private function title(){
		return ($this->is_block()) ? self::BLOCK_START . $this->title . self::BLOCK_END : self::INLINE_START . $this->title . self::INLINE_END . self::SPACE;
	}

	private function message(){
		return ($this->is_block()) ? "<p>" . $this->message . "</p>" : $this->message;
	}

	private function close($close){
		return ($close) ? self::CLOSE : "";
	}

	private function type($type){
		if(is_array($type)){
			foreach($type as $class){
				$this->type .= self::CLASS_DELIMITER . $class;
			}
		}
		else{
			$this->type = self::CLASS_DELIMITER . $type;
		}
		return $this->type;
	}

	private function is_block(){
		return var_contains_string("block", $this->type);
	}
}
?>