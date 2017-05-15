<?php

/**
 * Class ModelComment
 * @var $table_name
 */
class ModelComment extends Model
{
	public $table_name = 'comments_post';

	/**
	 * @param $id_post
	 * @param $comment
	 * @param $author
	 * @return bool
	 */
	public function setComment($id_post,$comment,$author)
	{
		if (!empty($id_post) && !empty($comment)) {
			$stmt = $this->connect->prepare('INSERT INTO '.$this->table_name.'(post_id, comment,author) VALUES (:id_post,:comment,:author)');
			$stmt->bindParam(':id_post', $id_post);
			$stmt->bindParam(':comment', $comment);
			$stmt->bindParam(':author', $author);
			if($stmt->execute())
				return true;
			else
				throw new PDOException('comment not set!');
		}
	}

	/**
	 * @param $post_id
	 * @return mixed
	 */
	public function getCountCommentsByPost($post_id)
	{
		return $this->connect->query("select * from ".$this->table_name)->fetchAll();
	}

	/**
	 * @param $post_id
	 * @return mixed
	 */
	public function getCommentsByPost($post_id)
	{
		return $this->connect->query("select * from ".$this->table_name." WHERE post_id=".$post_id)->fetchAll();
	}
}