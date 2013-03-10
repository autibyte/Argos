<?php
class Strings{

	public $locale;

	function __construct($locale="en_us"){
		$this->locale = $locale;
	}

	public function key($key, $category){
		$strings_location = BASE . "config/i18n/" . $this->locale . ".xml";
		if(!file_exists($strings_location)){
			trigger_error("Error: Could not find strings XML for locale '" . $this->locale . "' in config/i18n/.");
		}
		$xml = file_get_contents($strings_location);
		$strings = new SimpleXMLElement($xml);
		$locale = $this->locale;
		
		foreach ($strings->{$locale}->{$category}->xpath('//string[@name="' . $key . '"]') as $value){
			return $value;
		}
	}

}
?>