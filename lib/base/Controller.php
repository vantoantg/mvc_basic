<?php
namespace lib\base;

/**
 * Class Controller
 * @package lib\base
 */
class Controller
{
	/** @var View */
	public $view = null;

	/** @var \Symfony\Component\HttpFoundation\Request */
	protected $request;
	// the current action
	protected $action = null;
	
	protected $namedParameters = array();
	
	/**
	 * initializes various things in the controller
	 */
	public function init()
	{
		$this->view = new View();
	    $this->request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
		$this->view->settings->action = $this->action;
		$this->view->settings->controller = strtolower(str_replace('Controller', '', get_class($this)));
	}
	
	/**
	 * These filters are run BEFORE the action is run
	 */
	public function beforeFilters()
	{
		// no standard filers
	}
	
	/**
	 * These filters are run AFTER the action is run
	 */
	public function afterFilters()
	{
		// no standard filers
	}
	
	/**
	 * The main entry point into the controller execution path. The parameter 
	 * taken is the action to execute.
	 * @param string $action the action to execute
	 * @throws \Exception
	 */
	public function execute($action = 'index')
	{
		// stores the current action
		$this->action = $action;
		
		// initializes the controller
		$this->init();
		
		// executes the before filters
		$this->beforeFilters();
		
		// adds the action suffix to the function to call
		$actionToCall = $action.'Action';
		
		// executes the action
		$this->$actionToCall();
		
		// executes the after filterss
		$this->afterFilters();
		
		// renders the view
		$this->view->render($this->getViewScript($action));
	}
	
	/**
	 * fetches the view script for the given action
	 * @param string $action
	 * @return string the path to the view script
	 */
	protected function getViewScript($action)
	{
		// fetches the current controller executed
		$controller = get_class($this);
        $controller = str_replace("app\\controllers\\", '', $controller);
		// removes the "Controller" part and adds the action name to the path
		$script = strtolower(substr($controller, 0, -10) . '/' . $action . '.phtml');
		// returns the script to render
		return $script;
	}
	
	/**
	 * The base url is used if the application is located in a subfolder. Use
	 * this function when linking to things.
	 * @return string the baseUrl for the application.
	 */
	protected function baseUrl()
	{
		return WEB_ROOT;
	}
	
	/**
	 * Fetches the current request
	 * @return Request
	 */
	public function getRequest()
	{
		// initializes the request object
		if ($this->request == null) {
			$this->request = new Request();
		}
		
		return $this->request;
	}
	
	/**
	 * A way to access the current request parameters
	 * @param string $key the key to look for
	 * @param mixed $default the default value, else null
	 * @return mixed
	 */
	protected function getParam($key, $default = null)
	{
		// tests against the named parameters first
		if (isset($this->namedParameters[$key])) {
			return $this->namedParameters[$key];
		}
		
		// tests against the GET/POST parameters
		return $this->getRequest()->getParam($key, $default);
	}
	
	/**
	 * Fetches all the current parameters
	 * @return array a list of all the parameters
	 */
	protected function getAllParams()
	{
		return array_merge($this->getRequest()->getAllParams(), $this->namedParameters);
	}
	
	public function addNamedParameter($key, $value)
	{
		$this->namedParameters[$key] = $value;
	}
}
