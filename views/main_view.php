	<?php if(!empty($data['popularPosts'])): ?>
    <div class="row">
        <div class='col-md-offset-2 col-md-8 text-center'>
            <h2>Most commented posts</h2>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-offset-2 col-md-8'>
            <div class="carousel slide" data-ride="carousel" id="quote-carousel">
                <!-- Bottom Carousel Indicators -->
                <ol class="carousel-indicators">
                    <?php for ($i = 0; $i < count($data['popularPosts']); $i++):?>
                    <li data-target="#quote-carousel" data-slide-to="<?=$i;?>" class="<?=($i === 0) ? 'active' : '';?>"></li>
                    <?php endfor;?>
                </ol>

                <!-- Carousel Slides / Quotes -->
                <div class="carousel-inner">
                    <?php $isActive = true ?>
					<?php foreach ($data['popularPosts'] as $item): ?>
                    <div class="item <?=$isActive ? 'active' : ''?> ">
                        <blockquote>
                            <div class="row">
                                <div>
                                    <?php //var_dump($item);die;?>
                                    <p><?=mb_substr($item['post'], 0, 100) . (mb_strlen($item['post']) > 100 ? '...' : ''); ?> <a href="/post/view?id=<?=$item['id']?>" target="_blank">Read More <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                                    <small><?=$item['username']?></small>
                                </div>
                            </div>
                        </blockquote>
                    </div>
                        <?php $isActive = false; ?>
					<?php endforeach; ?>
                </div>
                <!-- Carousel Buttons Next/Prev -->
                <a data-slide="prev" href="#quote-carousel" class="left carousel-control">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a data-slide="next" href="#quote-carousel" class="right carousel-control">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php foreach ($data['posts'] as $post): ?>
    <p><?=mb_substr($post['post'], 0, 100) . (mb_strlen($post['post']) > 100 ? '...' : ''); ?> <a href="/post/view?id=<?=$post[0]?>" target="_blank">Read More <span class="glyphicon glyphicon-chevron-right"></span></a></p>

    <div class="panel">
        <div class="panel-body">
            <div class="pull-left"><span class="glyphicon glyphicon-time"></span> Posted on <?= date("Y-m-d H:i:s", $post['date_create']) ?> by <span class="glyphicon glyphicon-user"></span> <?= $post['username'] ?></div>
            <div class="label label-default pull-right"><?= $post['count_comments'] ?> comments</div>
        </div>
    </div>
<?php endforeach; ?>
<div class="panel panel-default">
    <div class="panel-body">
        <form role="form" action="/" method="post">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="username">Author:</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="post">Post:</label>
                        <textarea class="form-control" rows="5" name="post"></textarea>
                    </div>
                    <input type="submit" class="btn btn-default"></input>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //Set the carousel options
    $('#quote-carousel').carousel({
      pause: true,
      interval: 5000,
    });
  });
</script>

