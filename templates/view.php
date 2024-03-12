<?php include_once 'templates/header.php'; ?>
    <main role="main">
        <div class="album py-5 bg-light">
            <div class="container">
                <?php include_once 'templates/menu.php'; ?>
                <h3><?=$article['title']?></h3>
                <p>Количество просмотров: <?=$article['views']?></p>
                <p>Количество лайков: <?=$article['likes']?></p>
                <p><button><img width="50" id="like" src="/images/like.png" alt="Поставь лайк"></button></p>
                <img src="/images/<?=$article['img']?>" alt="<?=$article['title']?>" align="left" vspace="5" hspace="5"/>
                <p>
                    <?=$article['content']?>
                </p>
                <div class="clear"></div>
                <div class="col-12">
                    <form action="" method="POST">
                        <input type="hidden" name="act" value="view"/>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comment text</label>
                            <textarea class="form-control" id="exampleInputEmail1" name="comment" rows="5" placeholder="Comment"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add comment</button>
                    </form>
                </div>
                <div class="clear"></div>
                <?php while($comment = $stmtComment->fetch()): ?>
                <p>
                    <?php if ($comment['userId']): ?>
                        <?=$comment['email']?>
                    <?php endif ?>
                    <?=$comment['content']?>
                </p>
                <?php endwhile ?>
            </div>
        </div>
    </main>
<?php include_once 'templates/footer.php'; ?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $("#like" ).on( "click", function() {
            $.post( "/?act=like&id=<?=$article['id']?>", function( data ) {
            }, "json");
        });
    });
</script>
