<?php
require_once 'models/ModelPost.php';

/**
 * Class ControllerMain
 */
class ControllerMain extends Controller
{
	const COUNT = 5;

	/**
	 * Main page, all posts
	 */
	function actionIndex()
	{
		$model = new ModelPost($this->db);
		if (isset($_POST['username'],$_POST['post']) && $model->setPost($_POST['username'],$_POST['post']))
			header("Location: /");
		$posts = $model->getPosts();
		$popularPosts = $model->getPopularPosts(self::COUNT);
		$data = [
			'posts' => $posts,
			'popularPosts' => $popularPosts
		];
		$this->view->generate('main_view.php', 'layout_view.php',$data);
	}
}