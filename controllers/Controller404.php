<?php

/**
 * Class ControllerPost
 */
class Controller404 extends Controller
{

	/**
	 *  Page for error
	 */
	public function actionIndex()
	{
		$this->view->generate('404_view.php', 'layout_view.php');
	}
}