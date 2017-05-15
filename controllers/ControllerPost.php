<?php
require_once 'models/ModelPost.php';
require_once 'models/ModelComment.php';

/**
 * Class ControllerPost
 */
class ControllerPost extends Controller
{

	/**
	 * View current post
	 */
	public function actionView()
	{
		$post_id = $_GET['id'] ?? $_POST['post_id'];
		$modelComments = new ModelComment($this->db);
		if (!empty($post_id) && !empty($_POST['comment']) && $modelComments->setComment($post_id,$_POST['comment'],$_POST['author']))
			header("Location: /post/view?id=".$post_id);

		$modelPost = new ModelPost($this->db);
		$post = $modelPost->getPostById($post_id);
		$comments = $modelComments->getCommentsByPost($post_id);

		$data = [
			'post' => $post,
			'comments' => $comments
		];
		$this->view->generate('index_view.php', 'layout_view.php',$data);
	}
}