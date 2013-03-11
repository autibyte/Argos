<?php
	class Router{

		var $request;

		/**
		 * the type of request
		 */
		var $type;
		const TYPE_CONTROLLER_METHOD = 0;
		const TYPE_VIEW = 1;

		/**
		 * for controller/method requests
		 */
		var $method;

		// whether or not a route was found
		var $found_route;

		function __construct(){
			// set the request to be the variable from .htaccess
			$this->request = gets("page_request") ? getv("page_request") : "";
			// remove slash from request
			$this->request = (starts_with("/", $this->request)) ? substr($this->request, 1) : $this->request;
		}

		/**
		 * Whether or not the current request matches the given route
		 */
		public function has($route){
			if(starts_with($route,$this->request)) return true;
			if(starts_with($route, "/" . $this->request)) return true;
			if($route==""||$route=="/"&&$this->request=="") return true;
			return false;
		}

		/**
		 * map a route to a method of a controller (e.x. controller#method)
		 */
		public function map($route, $method){
			if($this->has($route)&&!$this->found_route){
				$this->found_route = true;
				$this->type = self::TYPE_CONTROLLER_METHOD;
				$this->method = $method;
			}
		}

		/**
		 * map() only when there is a post request
		 */
		public function map_post($route, $method){
			if(REQUEST_METHOD=="POST")
				$this->map($route, method);
		}

		/**
		 * map a route base (e.x. / or admin/) to a controller, while
		 * specifiying route-method pairs in an array
		 * (with_index denotes whether / is automatically mapped to an 'index' method)
		 */
		public function map_controller($controller, $route_base, $route_method_pairs, $with_index=true){
			foreach($route_method_pairs as $route => $method)
				$this->map($route_base . $route, $controller . "#" . $method);
			if($with_index)
				$this->map($route_base, $controller . "#index");
		}

		/**
		 * called when routing is complete
		 */
		public function finished_routing($app_instance){
			if(!$this->found_route){
				argos_error("No route defined for '/" . $this->request .  "'.");
			}
			else if ($this->type==self::TYPE_CONTROLLER_METHOD){
				// identify the controller and method
				$controller_method = explode("#", $this->method);
				$controller = $controller_method[0];
				$controller_proper = ucwords($controller);
				$controller_class_name = Controller::class_name($controller);
				$method = $controller_method[1];

				// verify the correct controller exists
				if(!file_exists(Controller::file_location($controller)))
					argos_error("The controller file " . $controller_proper . ".php does not exist!");

				// include the controller file and verify the class exists
				include_once Controller::file_location($controller);
				if(!class_exists($controller_class_name))
					argos_error("The controller class " . $controller_proper  . " is not declared yet!");

				// instantiate the controller and verify that the method exists 
				$this_controller = new $controller_class_name;
				$this_controller->app = $app_instance;

				if(!method_exists($this_controller, $method)){
					// if the method doesn't exist, attempt to locate an ivar-less view
					if(file_exists(View::file_location($method, $controller))){
						$this_view = new View($method, false, strtolower($controller));
						$this_view->app = $app_instance;
						$this_view->render($this_controller->_layout);
					}
					else{
						argos_error("'" . $method . "' is not a method for the " . $controller_proper . " controller, nor is there"
								. " a view called '" . $method . "' in app/views/" . $controller . "/.", E_USER_ERROR);
					}
				}
				else{
					// call the method
					$this_controller->$method();
				}
				
			}
		}

	}
?>