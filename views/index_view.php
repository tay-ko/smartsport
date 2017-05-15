<h1>View full post</h1>
<p><?=$data['post']['post']?></p>

<div class="panel">
    <div class="panel-body">
        <div class="pull-left"><span class="glyphicon glyphicon-time"></span> Posted on <?= date("Y-m-d H:i:s", $post['date_create']) ?> by <span class="glyphicon glyphicon-user"></span> <?= $post['username'] ?></div>
    </div>
</div>

<h3>Comments</h3>
<?php if (count($data['comments']) > 0):?>
	<?php foreach ($data['comments'] as $comment): ?>
        <p id="comment"><?= $comment['comment'] ?></p>
        <p class="text-right"><span class="glyphicon glyphicon-user"></span> <?= $comment['author'] ?></p>
	<?php endforeach; ?>
<?php else: ?>
    <p>There are no comments yet. You can be first.</p>
<?php endif; ?>

<div class="panel panel-default">
    <div class="panel-body">
        <form action="/post/view" method="post">
            <div class="form-group">
                <div class="col-xs-4">
                    <label for="author">Author :</label>
                    <p><input type="text" class="form-control" id="author" name="author"></p>
                    <input type="hidden" value="<?= $data['post']['id'] ?>" name="post_id">

                    <label for="comment">Comment :</label>
                    <p><textarea class="form-control" rows="5" name="comment"></textarea></p>
                    <button type="submit" class="btn btn-default">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>



