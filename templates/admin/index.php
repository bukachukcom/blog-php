<?php
/**
 * @var $stmt
 */
?>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/header.php'; ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <h2>Articles</h2>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Image</th>
                  <th>Title</th>
                  <th>Created at</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $stmt->fetch()): ?>
                <tr>
                  <td><?=$row['id']?></td>
                  <td><img width="150" src="/images/<?=$row['img']?>" alt="<?=$row['title']?>"/></td>
                  <td><?=$row['title']?></td>
                  <td><?=$row['createdAt']?></td>
                    <td>
                        <a href="/admin/?act=edit&id=<?=$row['id']?>"><button type="button" class="btn btn-primary">Edit</button></a>
                        <a href="/admin/?act=delete&id=<?=$row['id']?>"><button type="button" class="btn btn-danger">Delete</button></a>
                    </td>
                </tr>
                <?php endwhile ?>
              </tbody>
            </table>
              <nav aria-label="Page navigation example">
                  <ul class="pagination">
                      <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                      <?php for ($i = 1; $i <= $pages; $i++): ?>
                          <li class="page-item"><a class="page-link" href="/admin/?page=<?=$i?>"><?=$i?></a></li>
                      <?php endfor ?>
                      <li class="page-item"><a class="page-link" href="#">Next</a></li>
                  </ul>
              </nav>
          </div>
        </main>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/footer.php'; ?>
