<?php
	class Router{

		var $request;
		var $layout;
		var $type = false;
		var $controller = false;
		var $controller_method = "init";
		var $remaps = array();
		var $redirect;
		var $include_file = "";

		function __construct($layout){
			$this->request = gets("page_request") ? getv("page_request") : "";
			$this->layout = $layout;
			$this->request = (starts_with("/", $this->request)) ? substr($this->request, 1) : $this->request;

			define("PAGE_REQUEST", $this->request("first"));
			define("MODULE_REQUEST", $this->request("second"));
			define("ADDITION_REQUEST", $this->request("rest"));
			define("LAYOUT", $this->layout);
		}

		public function request($type=false){
			if(!$type) return $this->request;
			if(var_contains_string("/", $this->request)){
				$page_requests = explode("/", $this->request);
				if($type=="first") return $page_requests[0];
				if($type=="second") return $page_requests[1];
				if(count($page_requests)>2){
					if($type=="rest") return str_replace($page_requests[0] . "/" . $page_requests[1], "", implode($page_requests));
				}
			}
			else{
				if($type=="first") return $this->request;
			}
		}

		public function has($route){
			if(starts_with($route,$this->request)) return true;
			if(starts_with($route, "/" . $this->request)) return true;
			if($route==""||$route=="/"&&$this->request=="") return true;
			return false;
		}

		public function strip_slashes($route){
			$string = (starts_with("/", $route)) ? substr($route, 1) : $route;
			$string = (ends_with("/", $string)) ? substr_replace($string, "", -1) : $string;
			return $string;
		}

		public function map($route, $controller){
			if($this->has($route)){
				$this->include_file = BASE . "app/controllers/" . ucwords($controller) . ".php";
				include_once($this->include_file);
				$controller = ucwords($controller) . "Controller";
				$this->controller = new $controller();
				$method_request = $this->strip_slashes(str_replace($route, "", $this->request));
				$controller_method = ($method_request=="") ? "index" : $method_request;
				if(method_exists($this->controller, $controller_method)){
					$this->controller_method = $controller_method;
				}
				else{
					$this->controller_method = false;
				}
			}
		}

		public function map_view($route, $view){
			if($this->has($route)){
				$this->type = "view";
				$this->include_file = BASE . "app/views/" . $view . ".html.php";
			}
		}

		public function map_standalone($route, $filepath){
			if($this->has($route)){
				$this->type = "view";
				$this->include_file = BASE . $filepath;
			}
		}

		public function remap($from, $to){
			if($this->has($from)){
				$this->request = $to;
				$this->remaps[] = $from;
			}
		}

		public function remaps($route){
			return in_array($route, $this->remaps);
		}

		public function redirect($route, $to, $same_domain=true){
			if($this->has($route)){
				$location = ($same_domain) ? BASE_URL . $to : $to;
				header("Location: ". $location);
			}
		}

		public function finished_routing($app_instance){

			if(empty($this->include_file)){
				trigger_error("No route defined for '/" . $this->request .  "'.");
			}
			else if(!file_exists($this->include_file)){
				die("Router include file '" . $this->include_file . "' not found!");
			}
			else{
				if($this->controller_method==false||$this->type=="view"){
					if($this->controller_method=="init"){
						include_once($this->include_file);
					}
					else{
						trigger_error("Can't load view, method '" . $this->request . "' in " . $this->controller->_name . "Controller doesn't exist!");
					}
				}
				else{
					$controller_method = $this->controller_method;
					$this->controller->$controller_method();
				}
			}
		
		}

	}
?>