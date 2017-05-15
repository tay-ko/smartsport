<?php

/**
 * Class Route
 */
class Route
{
	/**
	 * Start method by find action
	 */
	static function start()
	{
		$controller_name = 'Main';
		$action_name = 'Index';
		$urlParts = parse_url($_SERVER['REQUEST_URI']);
		$path = $urlParts['path'] ?? '';
		$routes = explode('/', $path);

		if (!empty($routes[1])) {
			$controller_name = $routes[1];
		}

		if (!empty($routes[2])) {
			$action_name = $routes[2];
		}
		$model_name = 'Model' . mb_convert_case($controller_name, MB_CASE_TITLE, "UTF-8");
		$controller_name = 'Controller' . mb_convert_case($controller_name, MB_CASE_TITLE, "UTF-8");
		$action_name = 'action' . $action_name;

		$model_file = $model_name . '.php';
		$model_path = "models/" . $model_file;
		if (file_exists($model_path)) {
			include "models/" . $model_file;
		}

		$controller_file = $controller_name . '.php';
		$controller_path = "controllers/" . $controller_file;
		if (file_exists($controller_path)) {
			include "controllers/" . $controller_file;
		} else {
			self::ErrorPage404();
			exit;
		}

		$controller = new $controller_name;
		$action = $action_name;
		if (method_exists($controller, $action)) {
			$controller->$action();
		} else {
			self::ErrorPage404();
			exit;
		}
	}

	function ErrorPage404()
	{
		$host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
		header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:' . $host . '404');
	}
}
