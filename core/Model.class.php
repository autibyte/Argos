<?php

class Model{
	
	public static function require_db(){
		if(USES_DB&&!ORM::can_connect(DB_HOST)){
			trigger_error(DB_MODEL_ERROR);
		}
		else if(!USES_DB){
			trigger_error("Error: Can't use models without a database connection!");
		}
	}
	
}

?>