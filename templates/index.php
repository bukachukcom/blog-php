<?php include_once 'templates/header.php'; ?>
<?php
/**
 * @var $stmt
 * @var $user array
 */
?>
<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <?php include_once 'templates/menu.php'; ?>
            <div class="row">
                <?php while($row = $stmt->fetch()): ?>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="/images/<?=$row['img']?>" alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text"><?=htmlspecialchars($row['title'])?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="/?act=view&id=<?=$row['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a>
                                    <?php if ($user && $row['userId'] == $user['id']): ?>
                                       <a href="/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
                                    <?php endif ?>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</main>
<?php include_once 'templates/footer.php'; ?>
