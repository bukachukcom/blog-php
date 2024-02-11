<?php include_once 'templates/header.php'; ?>
<?php
/**
 * @var $stmt
 */
?>
<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <?php include_once 'templates/menu.php'; ?>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created at</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = $stmt->fetch()): ?>
                <tr>
                    <th scope="row"><?=$row['id']?></th>
                    <td><img src="/images/<?=$row['img']?>"/></td>
                    <td><?=$row['title']?></td>
                    <td><?=$row['createdAt']?></td>
                    <td>
                        <a href="/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-primary">Edit</button></a>
                        <a href="/?act=delete&id=<?=$row['id']?>"><button type="button" class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
                <?php endwhile ?>
                <?php if ($stmt->rowCount() === 0): ?>
                    <tr>
                        <td colspan="4" align="center">Not found</td>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include_once 'templates/footer.php'; ?>

