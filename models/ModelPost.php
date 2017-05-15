<?php

/**
 * Class ModelPost
 * @var $table_name
 */
class ModelPost extends Model
{
	public $table_name = 'post';

	/**
	 * @return array
	 */
	public function getPosts()
	{
		return $this->connect->query("
			SELECT *, count(cp.id) as count_comments FROM post as p
			LEFT JOIN comments_post as cp ON p.id = cp.post_id GROUP BY p.id
			ORDER BY date_create DESC 
		")->fetchAll();
	}

	/**
	 * @param $count
	 * @return array
	 */
	public function getPopularPosts($count)
	{
		return $this->connect->query("
			SELECT p.*, count(cp.id) as count_comments from post as p
			LEFT JOIN comments_post as cp ON p.id = cp.post_id
			  GROUP BY p.id
			ORDER BY count_comments DESC LIMIT ".$count
		)->fetchAll();
	}

	/**
	 * @param $username
	 * @param $post
	 * @return bool
	 */
	public function setPost($username,$post)
	{
		if (!empty($username) && !empty($post)) {
			$dateCreate = time();
			$stmt = $this->connect->prepare('INSERT INTO '.$this->table_name.'(username, post, date_create) VALUES (:username,:post,:date_create)');
			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':post', $_POST['post']);
			$stmt->bindParam(':date_create', $dateCreate);
			if($stmt->execute())
				return true;
			else
				throw new PDOException('post not set!');
		}
	}

	/**
	 * @param $post_id
	 * @return array
	 */
	public function getPostById($post_id)
	{
		if(!empty($post_id)) {
			$query = $this->connect->prepare("SELECT * FROM post WHERE id=:post_id");
			$query->execute(['post_id' => $post_id]);
			return $query->fetch();
		} else throw new PDOException('Post not found!');
	}
}