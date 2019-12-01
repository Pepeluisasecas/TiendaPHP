<?php

/**
 * La clase Applications procesa a URL.
 */
class Application
{
	private $url_controller = null;
	private $url_action = null;
	private $url_params = [];

    function __construct()
    {
    	$url = $this->separarURL();

    	if ( ! $this->url_controller) {
    		require_once('../app/controllers/LoginController.php');
    		$page = new LoginController();
    		$page->index();
    	}elseif (file_exists('../app/controllers/'.ucfirst($this->url_controller).'Controller.php')) {
            $controller = ucfirst($this->url_controller).'Controller';
            require_once ('../app/controllers/'.$controller.'.php');
            $this->url_controller = new $controller;

            if (method_exists($this->url_controller, $this->url_action) && is_callable(array($this->url_controller, $this->url_action))) {

                if(! empty($this->url_params)) {
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                }else{
                    $this->url_controller->{$this->url_action}();
                }

            }else{
                if (strlen($this->url_action) == 0) {
                    $this->url_controller->index();
                }else{
                    header('HTTP/1.0 404 Not Found');
                }
            }
        }else{
          require_once('../app/controllers/LoginController.php');
            $page = new LoginController();
            $page->index();  
        }
    }

    public function separarURL()
    {
    	if ($_SERVER['REQUEST_URI'] != '/'){
    		$url = trim($_SERVER['REQUEST_URI'],'/');
    		$url = filter_var($url, FILTER_SANITIZE_URL);
    		$url = explode('/', $url);
    		
    		$this->url_controller = isset($url[0]) ? $url[0] : null;
    		$this->url_action = isset($url[1]) ? $url[1] : null;
    		
    		unset($url[0], $url[1]);

    		$this->url_params = array_values($url);

    	}
    }
}