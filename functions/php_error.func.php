<?php

function print_error_container($mode, $error, $trace){
	$div = "<div style='margin:10px;padding:20px;background-color:#f0f0f0;color:#1e1e1e;display:inline-block;border-radius:5px;font-family:\"Helvetica\", sans-serif;border:20px solid #ccc;position:relative;'>";
		$div .= "<h2>Whoops! Looks like an error.</h2>";
		$div .= "<p style='font-size:1.5em'>" . $error . "</p>";
		$div .= "<h3>Stack trace:</h3>";
		$div .= "<div style='position:absolute;top:10px;right:10px;color:blue'><strong>" . $mode . "</strong> mode</div>";
		$div .= "<pre>" . $trace . "</pre>";
	$div .= "</div>";
	echo $div;
}

function script_error($num, $str, $file, $line) {

    $error = "Error #" . $num . "<br/>\n";
    $error.= "Message: <strong>" . $str . "</strong><br/>\n";
    $error.= "On line <strong>" . $line . "</strong> of <i style='color:#666'>" . $file . "</i><br/>\n\n";
	
	if(ARGOS_ENV=="development"){
			$e = new Exception;
			print_error_container(ARGOS_ENV, $error, $e->getTraceAsString());
	}
    else{
		error_log($error, 3, ERROR_LOG_PATH);
	}
}

function shutdown_error() {

	$error = error_get_last();
        
	if(!is_null($error)&&$error['file']!="Unknown"){
		
		if(ARGOS_ENV=="development"){
			$trace = "None, on line <strong>" . $error['line'] . "</strong> of " . $error['file'];
			print_error_container(ARGOS_ENV, $error['message'], $trace);
		}
	    else{
			error_log("PRODUCTION ERROR:" . $error['message'] . "on line" . $error['line'] .
			"in " . $error['file'] . " at" . time() . "\n\n", 3, ERROR_LOG_PATH);
			error_log($error, 3, ERROR_LOG_PATH);
			header("Location: " . BASE_URL . "res/php/oops.php");
		}

		exit(); 
    }
}

?>